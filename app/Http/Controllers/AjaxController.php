<?php

namespace App\Http\Controllers;

use App\Models\MappingVendorSite;
use Illuminate\Http\Request;
use App\Models\ProductBatchMaster;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\SerialNoBatch;
use App\Models\SiteMaster;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AjaxController extends Controller
{
    public function ajaxgetBatchList(Request $request){

        if($request->ajax()){
            $id = $request->post('batch_id');
            $site_data = DB::select('SELECT site_id as sitedata FROM product_batch_masters as t WHERE t.site_id in (SELECT site_id FROM serial_no_batches GROUP BY site_id HAVING COUNT(id) > 0)');
            $totalsite_id = count($site_data);
            $stack = array();
            for ($i=0; $i < $totalsite_id; $i++) {
                $name = $site_data[$i]->sitedata;
                array_push($stack, strval($name));
            }
            $allsite = implode('","', $stack);
            $productData = DB::select('SELECT * FROM `product_batch_masters` WHERE site_id not in ("'.$allsite.'") AND batch_id = "'.$id.'"');
            $sitePreData = DB::select('SELECT * FROM `product_batch_masters` WHERE site_id in ("'.$allsite.'") AND batch_id = "'.$id.'"');
            $id = $request->post('batch_id');
            $officerItemData = ProductBatchMaster::where('batch_id', $id)->where('batch_status','1')->get();
            $data = [
                "response code"=> "200 OK",
                "site_data"=> $sitePreData,
                "productData"=> $productData,
                "officerData" => $officerItemData
            ];
            return response()->json($data);
        }else{
            return false;
        }
    }
    /* Officer Data Insert and Approved */
    public function ajaxpostbatchlist(Request $request){
        if($request->ajax()){
            $id = $request->post('batch_id');
            $serialdata = DB::select("SELECT *, t1.id as serial_id FROM `serial_no_batches` as t1 Left JOIN product_batch_masters as t2 ON t2.id = t1.product_batch_id WHERE t1.batch_id = $id and t1.officer_status != 1 LIMIT 500");
            $data = [
                "response code"=> "200 OK",
                "status"=> "sucess",
                "data"=> $serialdata,
                "result" => "Serial no all Admin Parity Updated"
            ];
            return $data;
        }
    }

    public function adminSendByOfficer(Request $request){
        if($request->ajax()){
            $id = $request->post('batch_id');
            $batchbydata = ProductBatchMaster::where('batch_id', $id)->get();
        }
        $batchbydata = ProductBatchMaster::where('batch_id', 'B-001')->get();
        view()->share('batchbydata', $batchbydata);
        $pdf = PDF::loadView("resume", array($batchbydata));

        $data["email"] = "aashish.kumar@paritysystems.in";
        $data["title"] = "From Aashishkumar8893@gmail.com";
        $data["body"] = "This is Demo";

        Mail::send('resume', array($batchbydata), function($message)use($data, $pdf) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "text.pdf");
        });
        dd('Mail sent successfully to Officer');
        exit();

        if(session::get('user_id') && session::get('user_name')){
        }
        if($request->ajax()){
            $id = $request->post('batch_id');
            $batchbydata = ProductBatchMaster::where('batch_id', $id)->get();

            dd(view('document.batch-pdf',compact('batchbydata'))->render());

            dd($batchbydata);
        }
    }


    /* UpdateBy:Aashish Shah Date: Wed, 19 Apr 2023 function Name -> officerToAdminSend*/
    public function officerToAdminSend(Request $request){
        if($request->ajax()){

            dd($request->post());

            if(Session::get('user_id')){
                $user_id = Session::get('user_id');
            }
            $email_id = User::where('id', $user_id)->first('email');
            $email = $email_id['email'];
            $mytime = Carbon::now();
            $current_date = $mytime->toDateTimeString();
            $id = $request->post('batch_id');
            $batchbydata = SerialNoBatch::where('batch_id', $id)->get();
            $data2 = view('boq-serial',compact('batchbydata'))->render();
            view()->share('batchbydata', $batchbydata);
            $pdf2 = PDF::loadView("boq-serial", array($batchbydata));
            $date = date("YmdHmi");
            $datasave = "detailsbatchitems" . $date . "_" . $user_id . ".pdf";

            $batchbydata = ProductBatchMaster::where('batch_id', $id)->get();
            $datanew = [
                "batchbydata"=> $batchbydata,
                "date"=> $current_date,
            ];
            view()->share('datanew', $datanew);
            $pdf = PDF::loadView("resume", $datanew);

            //return $pdf->loadView()
            $data["email"] = $email;
            $data["title"] = "From Aashishkumar8893@gmail.com";
            $data["body"] = "This is Demo";
            Mail::send('resume', array($batchbydata), function($message)use($data, $pdf, $pdf2, $datasave) {
                $message->to($data["email"], $data["email"])
                        ->subject($data["title"])
                        ->attachData($pdf->output(), "parityboqlist.pdf")
                        ->attachData($pdf2->output(), $datasave);
            });
            $update_status = ProductBatchMaster::where('batch_id', $id)->update([
                'batch_status' => '1'
                ]);
            if($update_status){
                return 'Mail sent successfully to Admin';
            }
                return false;

        }else{
            return "204 Error!...";
        }
    }
    /** Fatch  bachIDGetdataProductBatchMaster  **/
    public function ajaxSerialNoQty(Request $request){

        if($request->ajax()){
            $batch_id = $request->post('batch_id');
            $site_id = $request->post('site_id');
            $qty = $request->post('qty');
            $s_no_c = SerialNoBatch::where('batch_id',$batch_id)->where('site_id',$site_id)->get()->count();

            //dd($s_no_c);
            $qty_no = ProductBatchMaster::where('batch_id', $batch_id)->where('site_id', $site_id)->get('qty');
            //dd($qty_no[0]->qty);
            if($qty != $s_no_c){
                $count_serial = $qty_no[0]->qty;
                $val_no = intval($count_serial);
                for ($i=0; $i < $val_no; $i++) {
                    echo $i+1;
                    $serial_no = new SerialNoBatch();
                    $serial_no->batch_id = $batch_id;
                    $serial_no->serial_no = '';
                    $serial_no->site_id = $site_id;
                    $serial_no->save();
                }
                if($serial_no->save()){
                    $insert_count = SerialNoBatch::where('batch_id',$batch_id)->where('site_id',$site_id)->get()->count();
                }
                dd($insert_count);
            }else{

                $data = [
                    "response"=> "sucess",
                    "result"=> "This is alrady exist"
                ];
                return response()->json($data);
                dd("This is alrady exist");
            }
        }
    }

    public function batchItemSerialNo(Request $request){

        if($request->ajax()){
            session([
                'item_header' => $request->post('item_header'),
            ]);
            $itemheader = Session::get('item_header');
            $siteId = $request->post('site_id');
            $site_id = $request->post('site_id');
            $batch_id = $request->post('batch_id');
            $serialData = SerialNoBatch::
            //join('product_batch_masters as t1', 't1.site_id', '=', 'serial_no_batches.product_batch_id')
            where('product_batch_id',$site_id)
            ->where('serial_no_batches.batch_id',$batch_id)->get();
            //->get(['t1.item','t1.item_title','serial_no_batches.serial_no','serial_no_batches.id'])->toSql();
            //dd($serialData);
            //SELECT * FROM `serial_no_batches` WHERE id = 1
            // "qty" => "212"
            //   "batch_id" => "1"
            //   "site_id" => "1"
            //   "item_header" => "SDWAN Branch device"

            // $site_id = $request->post('site_id');
            // $batch_id = $request->post('batch_id');
             $qty = $request->post('qty');
             //dd($qty);
            // $serialData = SerialNoBatch::where('batch_id',$batch_id)->where('site_id',$site_id)->get();
            $data = [
                "result"=> $serialData,
                "item_header"=> $itemheader,
            ];
            return response()->json($data);
        }
        return view('product.batch-serial-no');
    }


    public function officerApprove(Request $request){
        if($request->ajax()){
            $user_id = session::get('user_id');
            $email_id = User::where('id', $user_id)->first('email');
            $email = $email_id['email'];
            $mytime = Carbon::now();
            $current_date = $mytime->toDateTimeString();
            $id = $request->post('batch_id');
            $batchbydata = ProductBatchMaster::where('batch_id', $id)->get();
            $datanew = [
                "batchbydata"=> $batchbydata,
                "date"=> $current_date,
            ];
            view()->share('datanew', $datanew);
            $pdf = PDF::loadView("resume", $datanew);
            $data["email"] = "akansha.gaur@paritysystems.in";
            $data["title"] = "From Store Officer Approve";
            $data["body"] = "This is Demo";
            Mail::send('resume', array($batchbydata), function($message)use($data, $pdf) {
                $message->to($data["email"], "Parity InfoTech Solutions Pvt. Ltd.")->subject($data["title"])->attachData($pdf->output(), "parityboqlist.pdf");
                $message->to("aashish.kumar@paritysystems.in", "Parity InfoTech Solutions Pvt. Ltd.")->subject($data["title"]);
                $message->to("utkarsh.dixit@paritysystems.in", "Parity InfoTech Solutions Pvt. Ltd.")->subject($data["title"]);
            });
            $update_status = ProductBatchMaster::where('batch_id', $id)->update([
                'batch_status' => '1'
                ]);

            if($update_status){
                return 'Mail sent successfully to Admin';
            }
                return false;
        }
        return "0";

    }

    /* User_Type-> Officer Mail send Admin and Vendor */
    public function approveallbatchserial(Request $request){
        if($request->post()){
            if(Session::get('user_id')){
                $user_id = Session::get('user_id');
                $email = User::where('id',$user_id)->first()->email;
            }
            if($request->post('approve')){
                $approveData = implode(",",$request->post('approve'));
                DB::select("UPDATE `serial_no_batches` SET `officer_status` = '1' WHERE `serial_no_batches`.`id` IN ($approveData)");
            }
            if($request->post('disapprove')){
                $disapproveData = implode(",",$request->post('disapprove'));
                DB::select("UPDATE `serial_no_batches` SET `officer_status` = '0' WHERE `serial_no_batches`.`id` IN ($disapproveData)");
                $maxtype = 2;
            }
            $maxtype = 2;
            if($maxtype == 2){
                sleep(2);
            }
            if($request->post('remark')){
                $no = count($request->post('remark'));
                for ($i=0; $i < $no; $i++) {
                    $j = $i+1;
                    $remarknew = $request->post('remark')[$i];
                    //dd("UPDATE `serial_no_batches` SET `officer_remark` = '$remarknew' WHERE `serial_no_batches`.`id` IN ($j)");
                    DB::select("UPDATE `serial_no_batches` SET `officer_remark` = '$remarknew' WHERE `serial_no_batches`.`id` IN ($j)");
                }
            }
            $maxtype = 3;
            if($maxtype == 3){
                sleep(2);
            }

            //$serialdata = DB::select("SELECT snb.id, snb.batch_id, snb.serial_no, snb.site_id, snb.officer_status, pbm.item, pbm.item_title FROM `serial_no_batches` as snb JOIN product_batch_masters pbm ON pbm.site_id = snb.site_id WHERE snb.batch_id = 'B-002' and pbm.batch_status = 1 ORDER BY site_id");
            $serialdata = DB::select("SELECT * FROM `serial_no_batches` as t1 LEFT JOIN product_batch_masters as t2 ON t1.product_batch_id = t2.id WHERE t2.batch_id = 1");
            view()->share('serialdata', $serialdata);
            $pdf = PDF::loadView("approve_pdf", array($serialdata));
            //return $pdf->stream("demo.pdf");
            $date = date("YmdHmi");
            $datasave = "detailsbatchitems" . $date . "_" . $user_id . ".pdf";
            $data["email"] = array($email,"aashish.kumar@paritysystems.in");
            $data["title"] = "From Aashishkumar8893@gmail.com";
            $data["body"] = "This is Demo";
            Mail::send('approve_pdf', array($serialdata), function($message)use($data, $pdf, $datasave) {
                $message->to($data["email"], $data["email"])
                        ->subject($data["title"])
                        ->attachData($pdf->output(), $datasave);
                        //->attachData($pdf2->output(), $datasave);
            });
            return redirect("dashboard")->withSuccess('Mail sent successfully to Admin');

        }
    }

    public function getvendoridbymateriallist(Request $request){
        if($request->post('vendor_id')){
            $user_id = $request->post('vendor_id');
        }
    }

    public function ajaxgetBatchIDbylist(Request $request){
        if($request->ajax()){
            $id = $request->post('batch_id');
            $batchbydata = ProductBatchMaster::where('batch_id', $id)->get();
            return $batchbydata;
        }
    }

    public function ajaxgetIdBySiteName(Request $request){
        if($request->ajax()){
            $id = $request->post('vendor_id');
            $mapvensite = MappingVendorSite::where('vendor_name', $id)->get(['site_id']);
            $mapvensiteid = str_replace('"','',$mapvensite[0]->site_id);
            $sitedata = SiteMaster::whereIn('id', explode(",", $mapvensiteid))->get(['id','name']);

            $data = [
                "sitedata"=> $sitedata,
            ];
            return response()->json($data);
        }
    }

    public function ajaxGetSiteIdbyItem(Request $request){
        if($request->ajax()){
            $id = $request->post('site_id');
            //$sitedata = ProductBatchMaster::where('site_id', $id)->get(['id','item_title','batch_id','qty']);
            $sitedata = ProductBatchMaster::get(['id','item_title','batch_id','qty']);

            $data = [
                "sitedata"=> $sitedata,
            ];
            return response()->json($data);
        }
    }

    public function ajaxGetItemIdBySerial(Request $request){
        if($request->ajax()){
            $id = $request->post('item_id');

            $serialdata = SerialNoBatch::where('product_batch_id', $id)->get(['id','box_no','quantity','serial_no','product_batch_id']);

            $data = [
                "serialdata"=> $serialdata,
            ];
            return response()->json($data);
        }
    }


}
