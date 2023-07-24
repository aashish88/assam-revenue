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
use Illuminate\Support\Facades\DB;
use APP\Models\User;

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
                }elseif(Auth::user()->user_type == 13){
                    $title = "Management";
                }else{
                    $title = "Site Officer";
                }
                session([
                    'user_id' => Auth::user()->id,
                    'user_name' => Auth::user()->name,
                    'user_status' => Auth::user()->status,
                    'total_admin' => User::where('user_type','1')->count(),
                    'total_vendor' => User::where('user_type','3')->count(),
                    'total_Storofficer' => User::where('user_type','2')->count(),
                    'total_engineer' => User::where('user_type','4')->count(),
                    'total_siteOfficer' => User::where('user_type','5')->count(),
                    
                    'total_unassign' => DB::select("SELECT COUNT(id) as total FROM `site_district_data_master` WHERE site_commissioned = 'Planned for July'"),
                    'total_infra_process' => DB::select("SELECT COUNT(id) as total FROM `site_district_data_master` WHERE site_commissioned LIKE '%In Progress'"),
                    'total_infra_done' =>DB::select("SELECT COUNT(id) as total FROM `site_district_data_master` WHERE site_commissioned LIKE '%ed'"),
                    
                    'title' => $title,
                    'user_token' => Auth::user()->remember_token,
                    'user_type' => Auth::user()->user_type,
                    'date_today' => Carbon::now()->format('M d'),
                    'login_status' => "sucess"
                ]);
            }else{
                session([
                    'login_status' => "fail"
                ]);
            }


//dd(DB::table('mapping_vendor_site_engineers')->where('status',1)->where('vendor_id',12)->count());
            return Session::all();
        }

    }


    public function PreCheckUser(Request $request){
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
