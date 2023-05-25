<?php

namespace App\Http\Controllers;

use App\Models\BatchMaster;
use App\Models\SiteMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use PhpParser\Node\Stmt\Return_;
use App\Models\MappingVendorSite;
use App\Models\ProductBatchMaster;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\MappingVendorSiteEngineer;

use function Symfony\Component\VarDumper\Dumper\esc;

class MappingController extends Controller
{

    public function vendorSiteMapping(Request $request){

        if(session::get('user_type') == null){
            return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
        }

        if(session::get('user_type')){
            if(session::get('user_type') == "1"){
                $title = "Admin";
            }else if(session::get('user_type') == "2"){
                $title = "Officer";
            }else if(session::get('user_type') == "3"){
                $title = "Vendor";
            }else{
                $title = "Guest";
            }
        }else{
            $title = "Guest";
        }
        $sidebar_btn = ['UI Elements','Data List','Inventory'];
        $vendors = $this->getUser();
        $childSidebar = ['sl'=> "Site List", 'sa'=> "Site Create", 'se'=> "Site Edit"];
        $siteData = $this->getSiteData();
        return view('mapping.vendor_site', compact('sidebar_btn','title','vendors','childSidebar','siteData'));
    }

    public function getSiteData(){
        return SiteMaster::get(['id','name']);
    }

    /**UpdateBy: Aashish Date:26-04-2023 Function postVendorSite
     * UpdateBY : Aashish Date: 22-05-2023
    */
    public function postVendorSite(Request $request){
        if($request->post('submit') == "vendor-site"){

            $request->validate([
                'vendor_name' => 'required',
                'site_id' => 'required',
                'date' => 'required',
                'end_date' => 'required',
                'priority' => 'required',
            ]);

            $batchbydata = $request->vendor_name;
            $email = $this->getIdByUserEmail($batchbydata);

            $siteName = implode(',', $request->site_id);
            $siteData = DB::select("SELECT t1.name FROM `site_masters` as t1 WHERE id In ($siteName)");
            $data2 = view('vendorpdf',compact('siteData'))->render();
            view()->share('siteData', $siteData);
            $pdf = PDF::loadView("vendorpdf", array($siteData));
            Mail::send('vendorpdf', array($siteData), function($message)use($siteData, $pdf, $email) {
                $message->to($email, $email)
                        ->subject("Site Assign by Parity Admin")
                        ->attachData($pdf->output(), "assignSite.pdf");
            });

            for ($i=0; $i < count($request->site_id); $i++) {
                $mappingVendorSite = new MappingVendorSite;
            if($request->vendor_name){
                $mappingVendorSite->vendor_name = $request->vendor_name;
            }
            if($request->site_id){
                $mappingVendorSite->site_id = $request->site_id[$i];
            }
            if($request->date){
                $mappingVendorSite->date = $request->date;
            }
            if($request->end_date){
                $mappingVendorSite->end_date = $request->end_date;
            }
            if($request->priority){
                $mappingVendorSite->priority = $request->priority;
            }
            $mappingVendorSite->save();
            }
            return redirect()->intended('vendor-site')->withSuccess('Vendor and Site has been Mapped successfully.');

        }
    }



    public function getUser(){
        Return User::where('user_type',3)->get(['id','name']);
    }

    public function mappingVendorSite(Request $request){
        $sidebar_btn = ['UI Elements','Data List','Inventory'];
        $childSidebar = ['sl'=> "Site List", 'sa'=> "Site Create", 'se'=> "Site Edit"];
        $sitedata = DB::table('mapping_vendor_sites as t1')
            ->join('site_district_data_master as t2', 't2.id', '=', 't1.site_id')->get(['t1.vendor_name', 't2.site_id', 't2.dst_head_quert', 't2.priority', 't2.status']);

        $paggination = count($sitedata);
        error_reporting(0);
        $name = array();

        for ($i=0; $i < $paggination; $i++) {
           $sitedata[$i]->vendor_name = $this->getIdByUserName($sitedata[$i]->vendor_name);
           // array_push($name, $this->getIdByUserName($sitedata[$i]->id));
            //$sitedata[$i]['vendor_name'] =   $id; // $this->getIdByUserName($sitedata[$i]['vendor_name']);
        }
        return view('mapping.vendor_site_list',compact('sidebar_btn','childSidebar','sitedata','paggination'));
    }

    public function getIdByUserName($id){
        $name = User::where('id',$id)->get(['name']);
        return $name[0]->name;
    }

    public function getIdByUserEmail($id){
        $name = User::where('id',$id)->get(['email']);
        return $name[0]->email;
    }

    public function getIdBymappingId($id){
        $name = MappingVendorSite::where('id',$id)->get(['vendor_name']);
        return $name[0]->vendor_name;
    }

    public function issueVendor(Request $request){
        if(session::get('user_type') == null){
            return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
        }
        $vendors = User::where('user_type', '3')->get(['id','name']);
        $batchs = BatchMaster::get(['id','name']);
        $site = SiteMaster::get();
        //dd($site);
        $items = ProductBatchMaster::get(['id','item_title','qty']);
        $items_list = ProductBatchMaster::take(6)->get(['id','item_title','qty','item','batch_id','site_id']);

        return view("mapping.issue_vendor", compact('vendors','batchs','items','items_list'));
    }

    /* CreateBy: Aashish Shah
    Date: 24-april-2023 Issue Material To Vendor */
    public function issueMaterialVendor(Request $request){
        if($request->post()){
            $user_id = $request->post('vendor_name');
            $site_id = $request->post('site_name');
            $batch_name = implode(",",$request->post('batch_name'));
            $qty = implode(",",$request->post('qty'));

            $res = DB::select("INSERT INTO `mapping_vendor_items` (`user_id`, `site_id`, `item_id`, `qty`, `status`) VALUES ($user_id, $site_id, '$batch_name', '$qty', '1')");


            if($res){
                return redirect("dashboard")->withSuccess('Mail sent successfully to Admin');
            }

        }
        return redirect("dashboard")->withSuccess('Mail sent successfully to Admin');
    }

    public function invMgmtSta(Request $request){
        if(session::get('user_id')){
            $sitedata = DB::select("SELECT * FROM `site_district_data_master`");
             return view('product.inv_mgmt_sta',compact('sitedata'));
        }
        return redirect('login');

    }

    public function siteAllocWrkSta(Request $request){
        if(session::get('user_id')){
            $sitedata = DB::select("SELECT * FROM `site_district_data_master`");
            return view('product.site_alloc_wrk_sta',compact('sitedata'));
        }
        return redirect('login');
    }

    public function siteAllEng(Request $request){
        if(session::get('user_id')){
            $siteData = MappingVendorSiteEngineer::get();
            for ($i=0; $i < count($siteData); $i++) {
                $siteData[$i]->vendor_id = $this->getIdByUserName($siteData[$i]->vendor_id);
                $siteData[$i]->engineer_id = $this->getIdByUserName($siteData[$i]->engineer_id);
                $siteData[$i]->site_id = explode(",", $siteData[$i]->site_id);
            }
            for ($i=0; $i < count($siteData); $i++) {
                $user = $siteData[$i]['site_id'];
                for ($j=0; $j < count($siteData[$i]->site_id); $j++) {
                    $user[$j] = $this->getSiteByName($user[$j]);
                }
                $siteData[$i]['site_id'] = $user;
                $siteData[$i]['site_id'] = implode(", ", $siteData[$i]['site_id']);
            }
            return view('engineer.site-list',compact('siteData'));
        }
        return redirect('login');
    }

    public function siteComList(Request $request){
        $siteData  = MappingVendorSiteEngineer::where('status', 3)->get();
        for ($i=0; $i < count($siteData); $i++) {
            $siteData[$i]->vendor_id = $this->getIdByUserName($siteData[$i]->vendor_id);
            $siteData[$i]->engineer_id = $this->getIdByUserName($siteData[$i]->engineer_id);
            $siteData[$i]->site_id = explode(",", $siteData[$i]->site_id);

            $user = $siteData[$i]['site_id'];
            for ($j=0; $j < count($siteData[$i]->site_id); $j++) {
                $user[$j] = $this->getSiteByName($user[$j]);
            }
            $siteData[$i]['site_id'] = $user;
            $siteData[$i]['site_id'] = implode(", ", $siteData[$i]['site_id']);
        }
        return view('engineer.site-complet-list', compact('siteData'));
    }

    public function siteRepLst(Request $request){
        $siteData  = MappingVendorSiteEngineer::where('status', 1)->get();
        for ($i=0; $i < count($siteData); $i++) {
            $siteData[$i]->vendor_id = $this->getIdByUserName($siteData[$i]->vendor_id);
            $siteData[$i]->engineer_id = $this->getIdByUserName($siteData[$i]->engineer_id);
            $siteData[$i]->site_id = explode(",", $siteData[$i]->site_id);

            $user = $siteData[$i]['site_id'];
            for ($j=0; $j < count($siteData[$i]->site_id); $j++) {
                $user[$j] = $this->getSiteByName($user[$j]);
            }
            $siteData[$i]['site_id'] = $user;
            $siteData[$i]['site_id'] = implode(", ", $siteData[$i]['site_id']);
        }
        return view('engineer.site-reports-list', compact('siteData'));
    }

    public function siteActiveWrk(Request $request){
        $siteData  = MappingVendorSiteEngineer::where('status', 1)->get();
        for ($i=0; $i < count($siteData); $i++) {
            $siteData[$i]->vendor_id = $this->getIdByUserName($siteData[$i]->vendor_id);
            $siteData[$i]->engineer_id = $this->getIdByUserName($siteData[$i]->engineer_id);
            $siteData[$i]->site_id = explode(",", $siteData[$i]->site_id);

            $user = $siteData[$i]['site_id'];
            for ($j=0; $j < count($siteData[$i]->site_id); $j++) {
                $user[$j] = $this->getSiteByName($user[$j]);
            }
            $siteData[$i]['site_id'] = $user;
            $siteData[$i]['site_id'] = implode(", ", $siteData[$i]['site_id']);
        }

        return view('engineer.site-active-work', compact('siteData') );
    }

    public function siteAppList(Request $request){
        return view('engineer.site-approve-list');
    }

    public function appSiteComWork(Request $request){
        return view('engineer.approve-site-complete-work');
    }

    public function getSiteByName($id){

        return (SiteMaster::where('id', $id)->get(['name']))[0]->name;

    }

    public function uploadRepTest(Request $request){
        return view('engineer.upload-site-test');
    }
}




