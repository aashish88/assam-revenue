<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ProductBatchMaster;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\SerialNoBatch;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
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
            $serialdata = DB::select("SELECT snb.id, snb.batch_id, snb.serial_no, snb.site_id, pbm.item, pbm.item_title FROM `serial_no_batches` as snb JOIN product_batch_masters pbm ON pbm.site_id = snb.site_id WHERE snb.batch_id = '$id' and pbm.batch_status = 1 ORDER BY site_id");
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
        dd("44");
        if($request->ajax()){
            $id = $request->post('batch_id');
            $batchbydata = ProductBatchMaster::where('batch_id', $id)->get();
        }


        // $countno = count($batchbydata);

        // for ($i=0; $i < $countno; $i++) {

        //     echo $batchbydata[$i]['id'];
        //     echo $batchbydata[$i]['site_id'];
        //     echo ' '.$batchbydata[$i]['qty'];
        //     echo "</br>";
        // }
        // exit();
        $batchbydata = ProductBatchMaster::where('batch_id', 'B-001')->get();
        view()->share('batchbydata', $batchbydata);
        $pdf = PDF::loadView("resume", array($batchbydata));
       // $result = $pdf->stream('resume.pdf');
        //return $result;
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

        dd('Mail sent successfully');
        exit();
        echo "email send successfully !!";


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
            $site_id = $request->post('site_id');
            $batch_id = $request->post('batch_id');
            $qty = $request->post('qty');
            $serialData = SerialNoBatch::where('batch_id',$batch_id)->where('site_id',$site_id)->get();
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


    public function demopdf()
    {
        if(Session::get('user_id')){
            $user = Session::get('user_id');
        }
        $var  = Carbon::now('Asia/Kolkata');
        $time = $var->toTimeString();
        $date = date("Ymd");
        $datasave = "detailsbatchitems" . $date . " " . $time . "_" . $user . ".pdf";
        return $datasave;


        $batchbydata = SerialNoBatch::where('batch_id', "B-001")->get();
        //return view('boq-serial',compact('batchbydata'));
        $data2 = view('boq-serial',compact('batchbydata'))->render();
        //return $data2;
        view()->share('batchbydata', $batchbydata);
        $pdf = PDF::loadView("boq-serial", array($batchbydata));
        return $pdf;
        $date = date("YmdHmi");
        $datasave = "detailsbatchitems" . $date . "_" . $user . ".pdf";

        return $pdf->download($datasave);


        return response()->download(public_path($datasave));

        return public_path();

        //return response()->download($file_path);

        //$datadownload = public_path($datasave));

        //return download($datadownload);

        //return

        return $pdf->stream();

        $data["email"] = "aashish.kumar@paritysystems.in";
        $data["title"] = "From Aashishkumar8893@gmail.com";
        $data["body"] = "This is Demo";

        Mail::send('boq-serial', $batchbydata, function($message)use($data, $pdf) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"]);
        });

        dd('Mail sent successfully to Officer');

        exit();
    }

    public function approveallbatchserial(Request $request){
        if($request->post()){
            if($request->post('approve')){
                if($request->post('post_id')){
                    $post_id = implode(',',$request->post('post_id'));
                }
                if(Session::get('user_id')){
                    $user_id = Session::get('user_id');
                }
                $email = User::where('id',$user_id)->first()->email;
                if($request->post('approve')){
                    $approve_id = implode(',',$request->post('approve'));
                    DB::select("UPDATE `serial_no_batches` SET `officer_status` = '1' WHERE `serial_no_batches`.`id` IN ($approve_id)");
                    $maxtype = 1;
                    if($maxtype == 1){
                        sleep(2);
                    }
                    $serialdata = DB::select("SELECT snb.id, snb.batch_id, snb.serial_no, snb.site_id, snb.officer_status, pbm.item, pbm.item_title FROM `serial_no_batches` as snb JOIN product_batch_masters pbm ON pbm.site_id = snb.site_id WHERE snb.batch_id = 'B-002' and pbm.batch_status = 1 ORDER BY site_id");
                    view()->share('serialdata', $serialdata);
                    $pdf = PDF::loadView("approve_pdf", array($serialdata));
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
                    //$result = $pdf->stream('approve.pdf');
                }
            }
        }
    }






}
