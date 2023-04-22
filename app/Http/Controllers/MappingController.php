<?php

namespace App\Http\Controllers;

use App\Models\SiteMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use PhpParser\Node\Stmt\Return_;
use App\Models\MappingVendorSite;

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

    public function postVendorSite(Request $request){

        if($request->post('submit') == "vendor-site"){


            $request->validate([
                'vendor_name' => 'required',
                'site_id' => 'required',
                'date' => 'required',
                'priority' => 'required',
            ]);

            error_reporting(0);

            $mappingVendorSite = MappingVendorSite::get();
            for ($i=0; $i < count($mappingVendorSite); $i++) {

                if($request->post('vendor_name') === $this->getIdBymappingId($i)){
                    echo "tested";
                    dd("EXIT");
                }else{

                }
            }
            dd("fasdg");

            dd($mappingVendorSite[0]->vendor_name);

            dd($request->post());

            $mappingVendorSite = new MappingVendorSite;
            $mappingVendorSite->vendor_name = $request->vendor_name;
            $mappingVendorSite->site_id = implode(',', $request->site_id);
            $mappingVendorSite->date = $request->date;
            $mappingVendorSite->priority = $request->priority;
            $mappingVendorSite->save();

            return redirect()->intended('vendor-site')->withSuccess('Vendor and Site has been Mapped successfully.');

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
        return view("issue_vendor");
    }
}
