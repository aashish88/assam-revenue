<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\BatchMaster;
use App\Models\ProductBatchMaster;
use App\Models\SerialNoBatch;
use App\Models\User;
use App\Models\MappingVendorItem;


class StoreOfficerController extends Controller
{
    public function ItemIssueVendor()
    {
        if (session::get('user_type') == null) {
            return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
        }
        $vendors = User::where('user_type', '3')->get(['id', 'name']);
        $batchs = BatchMaster::get(['id', 'name']);
        $items = ProductBatchMaster::get(['id', 'item_title', 'qty']);
        $items_list = ProductBatchMaster::take(6)->get(['id', 'item_title', 'qty', 'item', 'batch_id', 'site_id']);
        return view("store-officer.item-issue_vendor", compact('vendors', 'batchs', 'items', 'items_list'));
    }

    public function ajaxgetIdBySiteName(Request $request){
        if($request->ajax()){
            $vendor_id = $request->post('vendor_id');
            $mapvensite = DB::table('mapping_vendor_sites as t1')
            ->join('site_masters as t2', 't2.id', '=', 't1.site_id')
            ->where('t1.vendor_name',$vendor_id)
            ->select('t2.id','t2.name')
            ->get();
            $data = [
                "sitedata"=> $mapvensite,
            ];
            return response()->json($data);
        }
    }

    public function vendorIdToSiteId(Request $request){
        if($request->ajax()){
            $product_batch_id = $request->product_batch_id;
            $data = SerialNoBatch::where('product_batch_id', $product_batch_id)->get(['id','serial_no']);
            return $data;
        }
    }

     /* CreateBy: Aashish Shah
    Date: 24-april-2023 Issue Material To Vendor */
    public function issueMaterialVendor(Request $request)
    {
        if ($request->post()) {
            $mappingVendorItem = new MappingVendorItem();
            if($request->post('vendor_name')){
                $mappingVendorItem->user_id = $request->post('vendor_name');
            }
            if($request->post('site_name')){
                $mappingVendorItem->site_id = $request->post('site_name');
            }
            if($request->post('batch_Item_name')){
                $batch_id = str_replace(',','","',implode(",", $request->post('batch_Item_name')));
                $mappingVendorItem->item_id = '"'.$batch_id.'"';
            }
            if($request->post('qty')){
                $qty = str_replace(',','","',implode(",", $request->post('qty')));
                $mappingVendorItem->qty = '"'.$qty.'"';
            }
            if($request->post('serial_no')){
                $serial_no = str_replace(',','","',implode(",", $request->post('serial_no')));
                $mappingVendorItem->serial_id ='"'.$serial_no.'"';
            }
            $mappingVendorItem->status = "1";
            $mappingVendorItem->save();
            return redirect("dashboard")->withSuccess('Mail sent successfully to Admin');
        }
        return redirect("dashboard")->withSuccess('Mail sent successfully to Admin');
    }
}
