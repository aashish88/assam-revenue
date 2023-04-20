<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ProductBatchMaster;

class ParityCronController extends Controller
{
    public function batchListAddSerial(Request $request){
        $re = ProductBatchMaster::where('batch_id', 'B-001')->get();
        dd($re);
    }
}
