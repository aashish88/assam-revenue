<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MappingVendorSiteEngineer;
use App\Models\User;
use App\Models\SiteMaster;
use Illuminate\Support\Facades\DB;
use App\Models\UpdateSiteAllocatedToEngg;
use App\Models\VSAllocatedToE;
use App\Models\MappingVendorSite;
use Illuminate\Support\Facades\Session;
use App\Models\ReqSendSiteToStoreOfficer;
use App\Models\VendorRecivedItem;
use Illuminate\Support\Facades\Request as FacadesRequest;

class VendorController extends Controller
{
    public function ProductList()
    {
        if (session::get('user_id')) {
            $user_id = session::get('user_id');
            $vendorSite = MappingVendorSite::where('vendor_name', $user_id)->get(['site_id']);
            $noVendorSite = count($vendorSite);
        }
        
       $siteData = DB::select('SELECT t1.*, t2.site_id as site_id,t2.id as count_id, t2.site_circle_office, t2.site_add_w_pincode, t4.name as UserName, t3.status
       FROM `mapping_vendor_sites` as t1
       LEFT JOIN site_district_data_master as t2 ON t2.id = t1.site_id
       left JOIN mapping_vendor_site_engineers as t3 ON t3.site_id = t1.site_id
       left JOIN users as t4 ON t4.id = t3.vendor_id where t1.vendor_name = "'.$user_id.'"');
       
        $totalSite = count($siteData);
        return view('vendor.vendor-product-list', compact('siteData', 'vendorSite', 'noVendorSite', 'totalSite'));
    }

    public function ViewSiteList()
    {
        if (session::get('user_id')) {
            $user_id = session::get('user_id');
            $vendorSite = MappingVendorSite::where('vendor_name', $user_id)->get(['site_id']);
            $noVendorSite = count($vendorSite);
        }

        $siteData = DB::select('SELECT t1.*, t2.site_id as site_id,t2.id as count_id, t2.site_circle_office, t2.site_add_w_pincode, t4.name as UserName, t3.status
        FROM `mapping_vendor_sites` as t1
        LEFT JOIN site_district_data_master as t2 ON t2.id = t1.site_id
        left JOIN mapping_vendor_site_engineers as t3 ON t3.site_id = t1.site_id
        left JOIN users as t4 ON t4.id = t3.vendor_id
        WHERE t1.vendor_name = '.$user_id.'');
        return view('vendor.view-site-list', compact('siteData', 'vendorSite', 'noVendorSite'));
    }

    public function VendorRequestSiteList(Request $request)
    {
        
        if(session::get('user_id') === 3){
            if (session::get('user_id')) {
                $user_id = session::get('user_id');
                $vendorSite = MappingVendorSite::where('vendor_name', $user_id)->get(['site_id']);
                $noVendorSite = count($vendorSite);
            }
            $siteData = DB::select('SELECT t1.*, t2.site_id as site_id,t2.id as count_id, t2.site_circle_office, t2.site_add_w_pincode, t4.name as UserName, t3.status
            FROM `mapping_vendor_sites` as t1
            LEFT JOIN site_district_data_master as t2 ON t2.id = t1.site_id
            left JOIN mapping_vendor_site_engineers as t3 ON t3.site_id = t1.site_id
            left JOIN users as t4 ON t4.id = t3.vendor_id WHERE t1.vendor_name = '.$user_id.'');
            $totalSite = count($siteData);
            return view('vendor.vendor-request-site-list', compact('siteData', 'vendorSite', 'noVendorSite', 'totalSite'));
        } else {
            return redirect("dashboard");
        }
        
    }

    public function AjaxVendorRequestSiteListSendStoreOfficer(Request $request)
    {
        if ($request->ajax()) {
            $user_id = session::get('user_id');
            if ($request->checkData) {
                if (count($request->checkData) > 0) {
                    $site_id = $request->checkData;
                    $reqSiteToStoreOfficer = new ReqSendSiteToStoreOfficer;
                    $reqSiteToStoreOfficer->user_id = $user_id;
                    $reqSiteToStoreOfficer->site_id = implode(",", $request->checkData);
                    $reqSiteToStoreOfficer->status = "1";
                    $reqSiteToStoreOfficer->save();
                    return True;
                }
                return False;
            }
            return False;
        }
        return False;
    }

    public function VendorConfirmItemList(Request $request)
    {
        if (session::get('user_id')) {
            $user_id = session::get('user_id');
            $vendorSite = MappingVendorSite::where('vendor_name', $user_id)->get(['site_id']);
            $noVendorSite = count($vendorSite);
        }
        
        $siteData = DB::select('SELECT t1.*, t2.site_id as site_id,t2.id as count_id, t2.site_circle_office, t2.site_add_w_pincode, t4.name as UserName, t3.status
        FROM `mapping_vendor_sites` as t1
        LEFT JOIN site_district_data_master as t2 ON t2.id = t1.site_id
        left JOIN mapping_vendor_site_engineers as t3 ON t3.site_id = t1.site_id
        left JOIN users as t4 ON t4.id = t3.vendor_id WHERE t1.vendor_name = '.$user_id.'');
        $totalSite = count($siteData);

        return view('vendor.vendor-confirm-item-list', compact('siteData', 'vendorSite', 'noVendorSite', 'totalSite'));
    }

    public function AjaxVendorConfirmSiteList(Request $request)
    {
        if ($request->ajax()) {
            if (session::get('user_id')) {
                $user_id = session::get('user_id');
            }
            $site_id = implode('","', $request->confirmcheckData);
            $date = implode('","', $request->date);
            $vendorRecivedItem  =   new VendorRecivedItem();
            $vendorRecivedItem->vendor_id   =   $user_id;
            $vendorRecivedItem->site_id   =   $site_id;
            $vendorRecivedItem->recived_date   =   $date;
            $vendorRecivedItem->login_id   =   $user_id;
            $vendorRecivedItem->visitor   =   "Testing";
            $vendorRecivedItem->device   =   FacadesRequest::ip();
            $vendorRecivedItem->save();
            return "sucess";
        }
        return "error";
    }

    public function VendorAllocatedEngineer(Request $request)
    {
        if (session::get('user_id')) {
            $user_id = session::get('user_id');
        }
        $SiteData = DB::select('SELECT t2.id as id, t2.site_id as name
        FROM `mapping_vendor_sites` as t1
        LEFT JOIN site_district_data_master as t2 ON t2.id = t1.site_id
        LEFT JOIN mapping_vendor_site_engineers as t3 ON t3.site_id = t1.site_id
        left JOIN users as t4 ON t4.id = t3.vendor_id
        WHERE t1.vendor_name = '.$user_id.' and t1.status != 1');
        
        $userData = User::where('user_type', 4)->get(['id', 'name']);
        return view('vendor.allocated-engineer', compact('userData', 'SiteData'));
    }

    public function AjaxPostVendorAllocatedEngineer(Request $request)
    {

        if (session::get('user_id')) {
            $user_id = session::get('user_id');
        }
        if ($request->ajax()) {
            if ($request->site_id) {
                $site_id = $request->site_id;
                $dataGet = MappingVendorSiteEngineer::where('site_id', $site_id)->where('vendor_id', $request->user_id)->where('created_by', session::get('user_id'))->get(['id']);
                $countNum = count($dataGet);
                $mappingVendorSite = MappingVendorSite::where('site_id', $site_id)->where('vendor_name', $user_id)->get(['id']);
                $dataupdate = MappingVendorSite::find($mappingVendorSite[0]->id);
                $dataupdate->status = '1';
                $dataupdate->save();
            }

            if ($request->user_id) {
                $user_id = $request->user_id;
            }
            if ($countNum > 0) {
                if (($site_id != null) and ($user_id != null)) {
                    $venSitAllEngg = MappingVendorSiteEngineer::find($dataGet[0]->id);
                    $venSitAllEngg->site_id = $site_id;
                    $venSitAllEngg->vendor_id = $user_id;
                    $venSitAllEngg->status = "1";
                    $venSitAllEngg->priority = "1";
                    if ($request->start_date) {
                        $venSitAllEngg->s_date = $request->start_date;
                    }
                    if ($request->end_date) {
                        $venSitAllEngg->e_date = $request->end_date;
                    }
                    if ($venSitAllEngg->created_by == session::get('user_id')) {
                        $venSitAllEngg->save();
                    }
                }
                return "Update Sucess";
            } else {
                if (($site_id != null) and ($user_id != null)) {
                    $venSitAllEngg = new MappingVendorSiteEngineer();
                    $venSitAllEngg->site_id = $site_id;
                    $venSitAllEngg->vendor_id = $user_id;
                    $venSitAllEngg->status = "1";
                    $venSitAllEngg->priority = "1";
                    if (session::get('user_id')) {
                        $venSitAllEngg->created_by = session::get('user_id');
                    }
                    if ($request->start_date) {
                        $venSitAllEngg->s_date = $request->start_date;
                    }
                    if ($request->end_date) {
                        $venSitAllEngg->e_date = $request->end_date;
                    }
                    $venSitAllEngg->remark = "0";
                    $venSitAllEngg->approve_status = "0";
                    $venSitAllEngg->save();
                    return "New Created";
                }
            }
            return "Select Site ID";
        }
        return "Post Method";
        return redirect()->route('vendor_product_list')->with('success', 'Site Allocated has been successfully.');
    }

    public function IdByName($id)
    {
        return User::where('id', $id)->get(['name'])[0]->name;
    }

    public function AjaxSiteId(Request $request)
    {
        if ($request->ajax()) {
            $site_id = $request->site_id;
            return DB::Select("SELECT * FROM `site_district_data_master` WHERE site_id = '$site_id'")[0];
        }
    }
}
