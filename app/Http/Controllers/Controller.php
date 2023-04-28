<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
//use GuzzleHttp\Psr7\Request;
//use Illuminate\Contracts\Session\Session;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $title = null;
    protected $sidebar_btn = null;
    protected $user_master = null;
    protected $credentials = null;
    /* UpdateBy Aashish 25-March-2023 __construct */
    public function __construct(Request $request){
        if($request->post('login') == "signin"){
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);
            session([
                'token' => $request->post('_token'),
                'email' => $request->post('email'),
                'password' => $request->post('password')
            ]);
            Session::forget('token');
            if(Auth::attempt(Session::all())){
                if(Auth::user()->user_type == 1){
                    $title = "Admin";
                }elseif(Auth::user()->user_type == 2){
                    $title = "Officer";
                }elseif(Auth::user()->user_type == 3){
                    $title = "Vendor";
                }
                elseif(Auth::user()->user_type == 4){
                    $title = "Engineer";
                }else{
                    $title = "Site Officer";
                }
                session([
                    'user_id' => Auth::user()->id,
                    'user_name' => Auth::user()->name,
                    'title' => $title,
                    'user_token' => Auth::user()->remember_token,
                    'user_name' => Auth::user()->name,
                    'user_type' => Auth::user()->user_type,
                    'date_today' => Carbon::now()->format('M d'),
                    'login_status' => "sucess"
                ]);
            }else{
                session([
                    'login_status' => "fail"
                ]);
            }
            return Session::all();
        }

    }






}
