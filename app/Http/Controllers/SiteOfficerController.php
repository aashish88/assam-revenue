<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\MappingVendorSiteEngineer;
use App\Models\User;
use App\Models\SiteMaster;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\SiteApproval;
use App\Models\UpdateSiteAllocatedToEngg;
//use CreateUpdateSiteAllocatedToEnggsTable;
use Illuminate\Database\Eloquent\Collection;

class SiteOfficerController extends Controller
{
    public function siteAllocated(Request $request){
        if(session::get('user_type') == 5){
            $siteData = DB::table('mapping_vendor_site_engineers as t1')
            ->leftJoin('site_district_data_master as t2', function($join){
                $join->on('t2.id', '=', 't1.site_id');
            })
            ->leftJoin('users as t3', function($join){
                $join->on('t3.id', '=', 't1.vendor_id');
            })
            ->select('*', 't2.*', 't3.name as engineer_name')
            ->get();
            return view('site-officer.site-allocated', compact('siteData'));
        }else{
            return redirect('logout');
        }
    }

    public function viewSiteActivitywise(Request $request){
        $siteData = DB::table('mapping_vendor_site_engineers as t1')
            ->leftJoin('site_district_data_master as t2', function($join){
                $join->on('t2.id', '=', 't1.site_id');
            })
            ->leftJoin('users as t3', function($join){
                $join->on('t3.id', '=', 't1.vendor_id');
            })
            ->select('*', 't2.*', 't3.name as engineer_name')
            ->get();
        return view('site-officer.list-site-activitywise', compact('siteData'));
    }

    public function viewSiteActivity(Request $request, $id, $vendor_id){
        if(session::get('user_id')){
            $login_id = session::get('user_id');
        }

        //$readData = UpdateSiteAllocatedToEngg::get();
        $readData = UpdateSiteAllocatedToEngg::where('site_id', $id)->where('login_id', $vendor_id)->get();
        if(count($readData) > 0){
            for ($i=0; $i < count($readData); $i++) {
                $readData[$i]->work_activity = explode(",", $readData[$i]->work_activity);
                $readData[$i]->s_date = explode(",", $readData[$i]->s_date);
                $readData[$i]->e_date = explode(",", $readData[$i]->e_date);
                $readData[$i]->status = explode(",", $readData[$i]->status);
                $readData[$i]->remark = explode(",", $readData[$i]->remark);
                $readData[$i]->document_filepath = explode(",", $readData[$i]->document_filepath);
                $readData[$i]->sitepic_filepath = explode(",", $readData[$i]->sitepic_filepath);
                $readData[$i]['countrow'] = count($readData[$i]->work_activity);
            }
            $countappendcolumn = count($readData[0]->status);
        }
        else{
            $countappendcolumn = 1;
        }

        $siteData = DB::table('mapping_vendor_site_engineers as t1')
        ->leftJoin('site_district_data_master as t2', function($join){
            $join->on('t2.id', '=', 't1.site_id');
        })
        ->leftJoin('users as t3', function($join){
            $join->on('t3.id', '=', 't1.vendor_id');
        })->where('t2.site_id', '=', $id)->where('vendor_id', '=', $vendor_id)
        ->select('*', 't2.*', 't3.name as engineer_name')
        ->get();

        $workData = DB::Select('SELECT * FROM `work_master`');
        $site_status = DB::select('SELECT * FROM `site_status`');

        return view('site-officer.view-site-activity-list', compact('siteData','workData','site_status','readData','countappendcolumn'));
    }

    public function siteApproveList(Request $request){
        if(session::get('user_type') == 5){
            $siteData = DB::table('mapping_vendor_site_engineers as t1')
            ->leftJoin('site_district_data_master as t2', function($join){
                $join->on('t2.id', '=', 't1.site_id');
            })
            ->leftJoin('users as t3', function($join){
                $join->on('t3.id', '=', 't1.vendor_id');
            })
            ->select('*', 't2.*', 't3.name as engineer_name')
            ->get();

            return view('site-officer.site-approve-list', compact('siteData'));
        }else{
            return redirect('logout');
        }
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
