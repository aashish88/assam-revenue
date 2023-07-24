<?php

namespace App\Http\Controllers;

use App\Models\BatchMaster;
use Illuminate\Http\Request;
use App\Models\SiteMaster;
use Illuminate\Support\Facades\DB;
use App\Models\MappingVendorSiteEngineer;
use App\Models\User;

class SiteController extends Controller
{
    public function list(){
        $sitedata = DB::Select('SELECT * FROM `site_district_data_master`');
        $enggName = $this->IdByEnggNameMappingVendorSiteEngineer(3);
        $sidebar_btn = ['UI Elements','Data List','Site Management'];
        $childSidebar = ['sl'=> "Site List", 'sa'=> "Site Create", 'se'=> "Site Edit"];
        return view('site.list', compact('sidebar_btn', 'childSidebar', 'sitedata')); //compact('sidebar_btn', 'childSidebar')
    }

    public function add(Request $request){
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

            return redirect()->route('site.list')->with('success','Site has been created successfully.');
            $sitedata = new SiteMaster;
            $sitedata->name = $request->site_ID;
            $sitedata->item_id = $request->site_name;
            $sitedata->batch_id = $request->batch_id;
            $sitedata->status = $request->status;
            $sitedata->sdate = $request->sdate;
            $sitedata->priority = $request->priority;
            $sitedata->save();
            return redirect()->route('site.list')->with('success','Site has been created successfully.');
        }
        $sidebar_btn = ['UI Elements','Data List','Site Management'];
        $childSidebar = ['sl'=> "Site List", 'sa'=> "Site Create", 'se'=> "Site Edit"];
        $batchdata = BatchMaster::get(['id','name']);

        return view('site.add', compact('sidebar_btn','childSidebar','batchdata'));
    }

    public function edit($id){
        $editdata = SiteMaster::where('id', $id)->first();
        $sidebar_btn = ['UI Elements','Data List','Site Management'];
        $childSidebar = ['sl'=> "Site List", 'sa'=> "Site Create", 'se'=> "Site Edit"];
        return view('site.edit', compact('sidebar_btn','childSidebar','editdata'));
    }

    public function store(Request $request){
        if($request->post('submit') == "site_store"){
            $request->validate([
                'id' => 'required',
                'site_name' => 'required',
                'item_id' => 'required',
                'batch_id' => 'required',
                'status' => 'required',
            ]);
            $sitedata = SiteMaster::find($request->id);
            $sitedata->name = $request->site_name;
            $sitedata->item_id = $request->item_id;
            $sitedata->batch_id = $request->batch_id;
            $sitedata->status = $request->status;
            $sitedata->save();
            //SiteMaster::where('id', $id)->delete();
            return redirect()->intended('site-list')->withSuccess('Site has been Update successfully.');

        }

    }




    public function drop($id){
        SiteMaster::where('id', $id)->delete();
        return redirect()->intended('site-list')->withSuccess('Site has been deleted successfully.');
    }

    function getSiteData(){}


    public function dataTable(Request $request){
        $sidebar_btn = ['UI Elements','Data List','Site Management'];
        $childSidebar = ['sl'=> "Site List", 'sa'=> "Site Create", 'se'=> "Site Edit"];
        return view('datatable', compact('sidebar_btn', 'childSidebar'));
    }

    public function IdByEnggNameMappingVendorSiteEngineer($id){
        return User::where('id',MappingVendorSiteEngineer::where('id', '1')->where('vendor_id', '3')->get(['engineer_id'])[0]->engineer_id)->get(['name'])[0]->name;
    }
}
