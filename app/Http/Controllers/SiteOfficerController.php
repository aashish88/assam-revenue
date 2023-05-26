<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\MappingVendorSiteEngineer;
use App\Models\User;
use App\Models\SiteMaster;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SiteOfficerController extends Controller
{
    public function siteAllocated(Request $request){
        if(session::get('user_type') == 5){
            $siteData  = MappingVendorSiteEngineer::where('status', 1)->get();
            for ($i=0; $i < count($siteData); $i++) {
                $siteData[$i]->vendor_id = $this->getIdByUserName($siteData[$i]->vendor_id);
                $siteData[$i]->engineer_id = $this->getIdByUserName($siteData[$i]->engineer_id);
                $siteData[$i]->site_id = explode(",", $siteData[$i]->site_id);
                if($siteData[$i]->site_id[0]){
                    $siteData[$i]['site_address'] = $this->getSiteByName($siteData[$i]->site_id[0])[0]->dst_site;
                    $siteData[$i]['dst_head_quert'] = $this->getSiteByName($siteData[$i]->site_id[0])[0]->dst_head_quert;
                }
                $user = $siteData[$i]['site_id'];
                for ($j=0; $j < count($siteData[$i]->site_id); $j++) {
                    $user[$j] = $this->getSiteByName($user[$j])[0]->site_id;
                }
                $siteData[$i]['site_id'] = $user;
                $siteData[$i]['site_id'] = implode(", ", $siteData[$i]['site_id']);
            }
            return view('site-officer.site-allocated', compact('siteData'));
        }else{
            return redirect('logout');
        }
    }

    public function viewSiteActivitywise(Request $request){
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
        return view('site-officer.list-site-activitywise', compact('siteData'));
    }

    public function viewSiteActivity(Request $request){
        return view('site-officer.view-site-activity-list');
    }

    public function siteApproveList(Request $request){
        return view('site-officer.site-approve-list');
    }

    public function getIdByUserName($id){
        $name = User::where('id',$id)->get(['name']);
        return $name[0]->name;
    }

    public function getSiteByName($id){
        $siteName = SiteMaster::where('id', $id)->get(['name']);
        $siteName = $siteName[0];
        $response = DB::select("SELECT t1.site_id, t1.dst_site, t1.dst_head_quert FROM `site_district_data_master` as t1 where site_id = '$siteName->name'");
        return $response;
    }
}
