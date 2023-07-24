<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MappingVendorSiteEngineer;
use App\Models\User;
use App\Models\SiteMaster;
use Illuminate\Support\Facades\DB;
use App\Models\UpdateSiteAllocatedToEngg;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\Exit_;

class EngineerController extends Controller
{
    public function updateSiteOfficer(Request $request){
        $siteData = DB::table('mapping_vendor_site_engineers as t1')
        //->join('site_approvals as t2', 't1.engineer_id', '=', 't2.user_id')
        ->join('site_district_data_master as t4', 't4.id', '=', 't1.site_id')
        ->join('users as t3', 't3.id', '=', 't1.created_by')
        ->where('t1.status', 1)
        ->where('t1.vendor_id',session::get('user_id'))
        ->select('t1.*','t3.name', 't4.site_id','t4.site_circle_office','t4.site_add_w_pincode')
        ->get();
        return view('engineer.update-site-acitvity', compact('siteData'));
    }

    public function getIdByUserName($id){
        $name = User::where('id',$id)->get(['name']);
        return $name[0]->name;
    }

    public function editSiteOfficer(Request $request, $id, $site_id)
    {
        if(session::get('user_id')){
            $login_id = session::get('user_id');
        }
        if($id){
            $readData = UpdateSiteAllocatedToEngg::where('login_id', $login_id)->where('site_id', $site_id)->get();
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
            ->join('site_district_data_master as t4', 't4.id', '=', 't1.site_id')
            ->join('users as t3', 't3.id', '=', 't1.created_by')
            ->where('t1.id', $id)
            ->where('t1.vendor_id',session::get('user_id'))
            ->select('t1.*','t3.name', 't4.site_id','t4.site_circle_office','t4.site_add_w_pincode')
            ->get();
            $workData = DB::Select('SELECT * FROM `work_master`');
            $site_status = DB::select('SELECT * FROM `site_status`');
            return view('engineer.edit-site-acitvity', compact('siteData','workData','site_status','readData','countappendcolumn'));
        }
    }

    public function siteActiveWrk(Request $request){
        //$siteData  = MappingVendorSiteEngineer::where('status', 1)->get();
        // for ($i=0; $i < count($siteData); $i++) {
        //     $siteData[$i]->vendor_id = $this->getIdByUserName($siteData[$i]->vendor_id);
        //     $siteData[$i]->engineer_id = $this->getIdByUserName($siteData[$i]->engineer_id);
        //     $siteData[$i]->site_id = explode(",", $siteData[$i]->site_id);
        //     if($siteData[$i]->site_id[0]){
        //         $siteData[$i]['site_address'] = $this->getSiteByName($siteData[$i]->site_id[0])[0]->dst_site;
        //     }
        //     $user = $siteData[$i]['site_id'];
        //     for ($j=0; $j < count($siteData[$i]->site_id); $j++) {
        //         $user[$j] = $this->getSiteByName($user[$j])[0]->site_id;
        //     }
        //     $siteData[$i]['site_id'] = $user;
        //     $siteData[$i]['site_id'] = implode(", ", $siteData[$i]['site_id']);
        // }

        $siteData = DB::table('mapping_vendor_site_engineers as t1')
            //->join('site_approvals as t2', 't1.engineer_id', '=', 't2.user_id')
            ->join('site_district_data_master as t4', 't4.id', '=', 't1.site_id')
            ->join('users as t3', 't3.id', '=', 't1.created_by')
            ->where('t1.status', 1)
            ->where('t1.vendor_id',session::get('user_id'))
            ->select('t1.*','t3.name', 't4.site_id','t4.site_circle_office','t4.site_add_w_pincode')
            ->get();

            //dd($siteData);
        return view('engineer.site-active-work', compact('siteData') );
    }

    public function postUpdateSiteActivity(Request $request){


        if($request->allarray){

            if(session::get('user_id')){
                $login_id = session::get('user_id');
            }

            if($request->site_id){
                $site_id = $request->site_id;
            }

            $updateSiteAllocate = new UpdateSiteAllocatedToEngg();



            if($request->work_act){
                $work_act = implode(",",$request->work_act);
            }
            if($request->work_activity){
                $work_activity = implode(",",$request->work_activity);
            }
            if($request->s_date){
                $s_date = implode(",",$request->s_date);
            }
            if($request->e_date){
                $e_date = implode(",",$request->e_date);
            }
            if($request->status){
                $status = implode(",",$request->status);
            }
            if($request->remark){
                $remark = implode(",",$request->remark);
            }
            $documentpath = array();
            $sitepicpath = array();
            if($request->file()){
                $count = count($request->work_act);
                for ($i=0; $i < $count; $i++) {
                    if($request->document){
                        $documentfileName = time().'_'.'document_'.$request->file('document')[$i]->getClientOriginalName();
                        $documentfilePath = $request->file('document')[$i]->storeAs('uploads', $documentfileName, 'public');
                       // $updateSiteAllocate->time().'_'.$request->file('document')[$i]->getClientOriginalName();
                         array_push($documentpath, '/storage/app/public/'.$documentfilePath);
                        //$updateSiteAllocate->document_filepath = '/storage/' . $documentfilePath;
                    }else{
                        $documentpath = array();
                    }
                    if($request->sitepic){
                        $sitepicfileName = time().'_'.'sitepic_'.$request->file('sitepic')[$i]->getClientOriginalName();
                        $sitepicfilePath = $request->file('sitepic')[$i]->storeAs('uploads', $sitepicfileName, 'public');
                        array_push($sitepicpath, '/storage/app/public/'.$sitepicfilePath);
                        //$updateSiteAllocate->time().'_'.$request->file('sitepic')[$i]->getClientOriginalName();
                        //$updateSiteAllocate->sitepic_filepath = '/storage/' . $sitepicfilePath;
                    }else{
                        $sitepicpath = array();
                    }
                }
            }

            if(count($updateSiteAllocate->where('login_id', $login_id)->where('site_id', $site_id)->get('id')) > 0){
                $updateSiteAllocate = UpdateSiteAllocatedToEngg::find($login_id);
                UpdateSiteAllocatedToEngg::where('login_id', $login_id)
                ->where('site_id', $site_id)
                ->update([
                    'sitepic_filepath' => implode(",", $sitepicpath),
                    'document_filepath' => implode(",", $documentpath),
                    'user_name' => session::get('user_name'),
                    'login_id' => session::get('user_id'),
                    'work_activity' => $work_activity,
                    's_date' => implode(",", $request->s_date),
                    'e_date' => implode(",", $request->e_date),
                    'status' => $status,
                    'remark' => $remark,
                    'site_id' => $site_id
                ]);
                return redirect()->intended('dashboard')->withSuccess('Data has been Update successfully.');
            }
            $updateSiteAllocate->sitepic_filepath = implode(",", $sitepicpath);
            $updateSiteAllocate->document_filepath = implode(",", $documentpath);
            $updateSiteAllocate->user_name = session::get('user_name');
            $updateSiteAllocate->login_id = session::get('user_id');
            $updateSiteAllocate->work_activity = $work_activity;
            $updateSiteAllocate->s_date = implode(",", $request->s_date);
            $updateSiteAllocate->e_date = implode(",", $request->e_date);
            $updateSiteAllocate->status = $status;
            $updateSiteAllocate->remark = $remark;
            $updateSiteAllocate->site_id = $site_id;
            $updateSiteAllocate->save();
        }
        return redirect()->intended('dashboard')->withSuccess('Data has been Update successfully.');
    }

    public function getSiteByName($id){
        $siteName = SiteMaster::where('id', $id)->get(['name']);
        $siteName = $siteName[0];
        $response = DB::select("SELECT t1.site_id, t1.dst_site FROM `site_district_data_master` as t1 where site_id = '$siteName->name'");
        return $response;
    }

    public function siteRepLst(Request $request){
        $siteData = DB::table('mapping_vendor_site_engineers as t1')
            ->join('site_district_data_master as t4', 't4.id', '=', 't1.site_id')
            ->join('users as t3', 't3.id', '=', 't1.created_by')
            ->where('t1.status', 1)
            ->where('t1.vendor_id',session::get('user_id'))
            ->select('t1.*','t3.name', 't4.site_id','t4.site_circle_office','t4.site_add_w_pincode')
            ->get();
        return view('engineer.site-reports-list', compact('siteData'));
    }

    public function updateSiteOfficerAllocated(Request $request){
        dd($request->post());
    }

    public function AjaxPostUpdateSite(Request $request){
        if($request->ajax()){

            for ($i=0; $i < count($request->approve_status); $i++) {
                $id = $request->approve_status[$i];
                if($id != null){
                    $mappingVendorSiteEngineer = MappingVendorSiteEngineer::find($id);
                    $mappingVendorSiteEngineer->status = '0';
                    $mappingVendorSiteEngineer->approve_status = '1';
                    $mappingVendorSiteEngineer->save();
                }
            }
            return true;
        }else{
            return false;
        }
    }
    
    public function AjaxSiteOfficerApprove(Request $request){
        if($request->ajax()){
            $disapproveall = null;
            $approveall = null;
            if($request->approve){
                $approve = $request->approve;
                $approveall = implode(",",$approve);
            }
            if($request->disapprove){
                $disapprove = $request->disapprove;
                $disapproveall = implode(",",$disapprove);
            }
            if($disapproveall != null){
                $remark = $request->remark;
                DB::select("UPDATE `mapping_vendor_site_engineers` SET `approve_status` = '0', `remark` = '$remark' WHERE `mapping_vendor_site_engineers`.`site_id` IN ($disapproveall)");
                DB::select("UPDATE `site_district_data_master` SET `status` = '0' WHERE `site_district_data_master`.`id` IN ($disapproveall)");
                return True;
            }else{
                if($request->remark){
                    $remark = $request->remark;
                }else{
                    $remark = "";
                }
                DB::select("UPDATE `mapping_vendor_site_engineers` SET `approve_status` = '1', `remark` = '$remark' WHERE `mapping_vendor_site_engineers`.`site_id` IN ($approveall)");
                DB::select("UPDATE `site_district_data_master` SET `status` = '8' WHERE `site_district_data_master`.`id` IN ($approveall)");
                return True;
            }
            return false;
        }
    }
}


