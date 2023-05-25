<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MappingVendorSiteEngineer;
use App\Models\User;
use App\Models\SiteMaster;
use Illuminate\Support\Facades\DB;

class EngineerController extends Controller
{
    public function updateSiteOfficer(Request $request){

        $siteData  = MappingVendorSiteEngineer::where('status', 1)->get();
        for ($i=0; $i < count($siteData); $i++) {
            $siteData[$i]->vendor_id = $this->getIdByUserName($siteData[$i]->vendor_id);
            $siteData[$i]->engineer_id = $this->getIdByUserName($siteData[$i]->engineer_id);
            $siteData[$i]->site_id = explode(",", $siteData[$i]->site_id);
            if($siteData[$i]->site_id[0]){
                $siteData[$i]['site_address'] = $this->getSiteByName($siteData[$i]->site_id[0])[0]->dst_site;
            }
            $user = $siteData[$i]['site_id'];
            for ($j=0; $j < count($siteData[$i]->site_id); $j++) {
                $user[$j] = $this->getSiteByName($user[$j])[0]->site_id;
            }
            $siteData[$i]['site_id'] = $user;
            $siteData[$i]['site_id'] = implode(", ", $siteData[$i]['site_id']);
        }
        return view('engineer.update-site-acitvity', compact('siteData'));
    }

    public function getIdByUserName($id){
        $name = User::where('id',$id)->get(['name']);
        return $name[0]->name;
    }

    public function editSiteOfficer(Request $request, $id)
    {
        if($id){
            $siteData  = MappingVendorSiteEngineer::where('status', 1)->get();
            for ($i=0; $i < count($siteData); $i++) {
                $siteData[$i]->vendor_id = $this->getIdByUserName($siteData[$i]->vendor_id);
                $siteData[$i]->engineer_id = $this->getIdByUserName($siteData[$i]->engineer_id);
                $siteData[$i]->site_id = explode(",", $siteData[$i]->site_id);
                if($siteData[$i]->site_id[0]){
                    $siteData[$i]['site_address'] = $this->getSiteByName($siteData[$i]->site_id[0])[0]->dst_site;
                }
                $user = $siteData[$i]['site_id'];
                for ($j=0; $j < count($siteData[$i]->site_id); $j++) {
                    $user[$j] = $this->getSiteByName($user[$j])[0]->site_id;
                }
                $siteData[$i]['site_id'] = $user;
                $siteData[$i]['site_id'] = implode(", ", $siteData[$i]['site_id']);
            }
            $workData = DB::Select('SELECT * FROM `work_master`');
            $site_status = DB::select('SELECT * FROM `site_status`');
            return view('engineer.edit-site-acitvity', compact('siteData','workData','site_status'));
        }
    }

    public function siteActiveWrk(Request $request){
        $siteData  = MappingVendorSiteEngineer::where('status', 1)->get();
        for ($i=0; $i < count($siteData); $i++) {
            $siteData[$i]->vendor_id = $this->getIdByUserName($siteData[$i]->vendor_id);
            $siteData[$i]->engineer_id = $this->getIdByUserName($siteData[$i]->engineer_id);
            $siteData[$i]->site_id = explode(",", $siteData[$i]->site_id);
            if($siteData[$i]->site_id[0]){
                $siteData[$i]['site_address'] = $this->getSiteByName($siteData[$i]->site_id[0])[0]->dst_site;
            }
            $user = $siteData[$i]['site_id'];
            for ($j=0; $j < count($siteData[$i]->site_id); $j++) {
                $user[$j] = $this->getSiteByName($user[$j])[0]->site_id;
            }
            $siteData[$i]['site_id'] = $user;
            $siteData[$i]['site_id'] = implode(", ", $siteData[$i]['site_id']);
        }
        return view('engineer.site-active-work', compact('siteData') );
    }

    public function getSiteByName($id){

        $siteName = SiteMaster::where('id', $id)->get(['name']);
        $siteName = $siteName[0];
        $response = DB::select("SELECT t1.site_id, t1.dst_site FROM `site_district_data_master` as t1 where site_id = '$siteName->name'");
        return $response;
    }

    public function siteRepLst(Request $request){
        $siteData  = MappingVendorSiteEngineer::where('status', 1)->get();
        for ($i=0; $i < count($siteData); $i++) {
            $siteData[$i]->vendor_id = $this->getIdByUserName($siteData[$i]->vendor_id);
            $siteData[$i]->engineer_id = $this->getIdByUserName($siteData[$i]->engineer_id);
            $siteData[$i]->site_id = explode(",", $siteData[$i]->site_id);
            if($siteData[$i]->site_id[0]){
                $siteData[$i]['site_address'] = $this->getSiteByName($siteData[$i]->site_id[0])[0]->dst_site;
            }
            $user = $siteData[$i]['site_id'];
            for ($j=0; $j < count($siteData[$i]->site_id); $j++) {
                $user[$j] = $this->getSiteByName($user[$j][0])[0]->site_id;
            }
            $siteData[$i]['site_id'] = $user;
            $siteData[$i]['site_id'] = implode(", ", $siteData[$i]['site_id']);
        }
        return view('engineer.site-reports-list', compact('siteData'));
    }

    public function updateSiteOfficerAllocated(Request $request){
        dd($request->post());
    }

}



