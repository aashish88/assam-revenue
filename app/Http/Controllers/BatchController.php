<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ProductBatchMaster;
use App\Models\BatchMaster;
use App\Models\SerialNoBatch;
use Illuminate\Support\Facades\Session;

class BatchController extends Controller
{
    public function list(Request $request){
        $childSidebar = ['sl'=> "Site List", 'sa'=> "Site Create", 'se'=> "Site Edit"];
        if(session::get('user_id') && session::get('user_name')){
            if(session::get('user_id') == 2){
                $re = ProductBatchMaster::where('batch_id', 'B-001')->get();
                $no = count($re);
                $branch_item_id = array();
                $branch_s_no = array();
                for ($i=0; $i < $no; $i++) {
                    array_push($branch_item_id,$re[$i]->id);
                    array_push($branch_s_no, $re[$i]->site_id);
                }
                $batch_data = BatchMaster::get();
                $product_data = ProductBatchMaster::get();
                $sidebar_btn = ['UI Elements','Item List','Inventory'];
                return view('officer.batch-list',compact('sidebar_btn','product_data','batch_data','branch_s_no','branch_item_id','childSidebar'));
            }
            elseif(session::get('user_id') == 1){
                $batch_data = BatchMaster::get();
                $product_data = ProductBatchMaster::get();
                $sidebar_btn = ['UI Elements','Item List','Inventory'];
                return view('product.batch-list',compact('sidebar_btn','product_data','batch_data','childSidebar'));
            }
        }
        return view('auth.login');
    }

    public function batchListOfficer(Request $request){
        if(session::get('user_id')){
            $batch_data = BatchMaster::get(['id','name']);
            $sidebar_btn = ['UI Elements','Item List','Inventory'];
            return view('product.officer-batch-list', compact('sidebar_btn','batch_data'));
        }
    }

    public function postSerialNo(Request $request){

        if($request->post()){

            for ($i=0; $i < count($request->post('serialNo')); $i++) {
                $serialNo = $request->post('serialNo')[$i];
                $siteID = $request->post('site_id')[$i];
                $id = $request->post('serial_id')[$i];
                if($serialNo == null){
                    $serialNo = "";
                }
                SerialNoBatch::where('id', $id)->where('site_id', $siteID)->update(
                    [
                    'serial_no' => $serialNo
                    ]
                );
            }
        }
        return redirect()->intended('batch_list')->withSuccess('Serial Number has been Update successfully.');
    }

    public function productList(Request $request){
            if(session::get('user_id')){
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
                $products = ProductBatchMaster::where('store_manager', 1)->get();
                $no_product = count($products);
                return view('product.vendor-list', compact('title','products','no_product'));
            }

            return redirect('login');
    }


    public function boQlist(){
        $product_data = ProductBatchMaster::get();
        $count = count($product_data);
        $sidebar_btn = ['UI Elements','Data List','Site Management'];
        $childSidebar = ['sl'=> "Site List", 'sa'=> "Site Create", 'se'=> "Site Edit"];
        return view('product.boq.list',compact('product_data','count','sidebar_btn','childSidebar'));
    }

    public function boQedit($id){
        $product_data = ProductBatchMaster::where('id', $id)->first();
        $sidebar_btn = ['UI Elements','Data List','Site Management'];
        $childSidebar = ['sl'=> "Site List", 'sa'=> "Site Create", 'se'=> "Site Edit"];
        return view('product.boq.edit',compact('product_data','id','sidebar_btn','childSidebar'));
    }

    public function boQStore(Request $request)
    {
        if($request->post('submit') == "boq_update"){
            $probatmas = ProductBatchMaster::find($request->id);
            $probatmas->item_title = $request->item_title;
            $probatmas->item = $request->item;
            $probatmas->qty = $request->qty;
            $probatmas->uom = $request->uom;
            $probatmas->oem = $request->oem;
            $probatmas->batch_id = $request->batch_id;
            $probatmas->site_id = $request->site_id;
            $probatmas->store_manager = $request->store_manager;
            $probatmas->save();
            return redirect()->intended('boq-list')->withSuccess('BOQ has been Update successfully.');
        }
    }





}
