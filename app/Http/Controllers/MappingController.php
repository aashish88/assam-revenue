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

    /**UpdateBy: Aashish Date:26-04-2023 Function postVendorSite */
    public function postVendorSite(Request $request){
        if($request->post('submit') == "vendor-site"){

            dd($request->post());
            $request->validate([
                'vendor_name' => 'required',
                'site_id' => 'required',
                'date' => 'required',
                'end_date' => 'required',
                'priority' => 'required',
            ]);
            $mapping_ven_site = MappingVendorSite::where('vendor_name','LIKE','%'.$request->post('vendor_name').'%')->first();
            //error_reporting(0);
            if($mapping_ven_site){
                $mapping_ven_site_id = $mapping_ven_site->id;
            }else{
                $mapping_ven_site_id = null;
            }
            if($mapping_ven_site_id){
                //$mappingVendorSite = new MappingVendorSite;
                $mappingVendorSite = MappingVendorSite::find($mapping_ven_site_id);
                if($request->vendor_name){
                    $mappingVendorSite->vendor_name = $request->vendor_name;
                }
                if($request->site_id){
                    $site_id = implode(',', $request->site_id);
                    $mappingVendorSite->site_id = $site_id;
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
                return redirect()->intended('vendor-site')->withSuccess('Vendor and Site has been Mapped successfully.');
            }else{
                $mappingVendorSite = new MappingVendorSite;
                if($request->vendor_name){
                    $mappingVendorSite->vendor_name = $request->vendor_name;
                }
                if($request->site_id){
                    $site_id = implode(',', $request->site_id);
                    $mappingVendorSite->site_id = $site_id;
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
                return redirect()->intended('vendor-site')->withSuccess('Vendor and Site has been Mapped successfully.');
            }
        }
    }



    public function getUser(){
        Return User::where('user_type',3)->get(['id','name']);
    }

    public function mappingVendorSite(Request $request){
        $sidebar_btn = ['UI Elements','Data List','Inventory'];
        $childSidebar = ['sl'=> "Site List", 'sa'=> "Site Create", 'se'=> "Site Edit"];
        $sitedata = MappingVendorSite::get();
        $paggination = count($sitedata);
        $name = array();
        //error_reporting(0);
        for ($i=0; $i < $paggination; $i++) {
           // array_push($name, $this->getIdByUserName($sitedata[$i]->id));
            $sitedata[$i]['vendor_name'] = $this->getIdByUserName($sitedata[$i]['vendor_name']);
        }
        return view('mapping.vendor_site_list',compact('sidebar_btn','childSidebar','sitedata','paggination'));
    }

    public function getIdByUserName($id){
        $name = User::where('id',$id)->get(['name']);
        return $name[0]->name;
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
        dd($request->post());
        return redirect("dashboard")->withSuccess('Mail sent successfully to Admin');
    }

    public function invMgmtSta(Request $request){
        return view('product.inv_mgmt_sta');
    }

    public function siteAllocWrkSta(Request $request){
        return view('product.site_alloc_wrk_sta');
    }

    public function siteAllEng(Request $request){
        return view('engineer.site-list');
    }

    public function siteComList(Request $request){
        return view('engineer.site-complet-list');
    }

    public function siteRepLst(Request $request){
        return view('engineer.site-reports-list');
    }

    public function siteActiveWrk(Request $request){
        return view('engineer.site-active-work');
    }

    public function siteAppList(Request $request){
        return view('engineer.site-approve-list');
    }

    public function appSiteComWork(Request $request){
        return view('engineer.approve-site-complete-work');
    }
}




