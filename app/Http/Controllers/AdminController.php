<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MappingVendorSiteEngineer;
use App\Models\User;
use App\Models\BatchMaster;
use App\Models\SiteMaster;

class AdminController extends Controller
{
    //Site List
    public function list(){
        $sitedata = DB::Select('SELECT t1.*, t2.edate, t2.sdate, t3.engineer_id, users.name as site_engg FROM `site_district_data_master` as t1
        RIGHT JOIN site_masters as t2 ON t2.id = t1.id
        Left JOIN mapping_vendor_site_engineers as t3 ON t3.site_id = t1.id
        Left JOIN users ON users.id = t3.engineer_id');
        $sidebar_btn = ['UI Elements','Data List','Site Management'];
        $childSidebar = ['sl'=> "Site List", 'sa'=> "Site Create", 'se'=> "Site Edit"];
        return view('admin.site.list', compact('sidebar_btn', 'childSidebar', 'sitedata')); //compact('sidebar_btn', 'childSidebar')
    }

    //Site Create
    public function create(Request $request){
        if($request->post('submit') == "site_add"){
            $request->validate([
                'site_ID' => 'required',
                'site_name' => 'required',
                'site_address' => 'required',
                'site_officer' => 'required',
                'site_engineer' => 'required',
                'priority' => 'required',
                // 'site_name' => 'required',
                // 'item_id' => 'required',
                // 'batch_id' => 'required',
                // 'status' => 'required',
                // 'sdate' => 'required',
                // 'edate' => 'required',
            ]);
            if($request->status){
                $status = $request->status;
            }
            else{
                $status = "0";
            }

            return redirect()->route('site_list')->with('success','Site has been created successfully.');
            $sitedata = new SiteMaster;
            $sitedata->name = $request->site_ID;
            $sitedata->item_id = $request->site_name;
            $sitedata->batch_id = $request->batch_id;
            $sitedata->status = $status;
            $sitedata->sdate = $request->sdate;
            $sitedata->priority = $request->priority;
            $sitedata->save();
            return redirect()->route('site_list')->with('success','Site has been created successfully.');
        }
        $sidebar_btn = ['UI Elements','Data List','Site Management'];
        $childSidebar = ['sl'=> "Site List", 'sa'=> "Site Create", 'se'=> "Site Edit"];
        $batchdata = BatchMaster::get(['id','name']);

        return view('admin.site.add', compact('sidebar_btn','childSidebar','batchdata'));
    }
}
