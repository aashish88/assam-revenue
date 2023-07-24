<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(Request $request){
        if(session::get('user_id') && session::get('user_name')){
            return redirect("dashboard");
        }
        return view('auth.login');
    }
    public function postLogin(Request $request)
    {
       if(session::get('user_id') && session::get('user_name')){
            return redirect()->intended('dashboard')->withSuccess('You have Successfully loggedin');
        }
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
     /* CreateBy Aashish 25-March-2023 Function Name dashboard */
     public function dashboard(Request $request){

        if(session::get('user_type')){
            if(session::get('user_type') == "1"){
                $title = "Admin";
            }else if(session::get('user_type') == "2"){
                $title = "Officer";
            }else if(session::get('user_type') == "3"){
                $title = "Vendor";
            }else if(session::get('user_type') == "4"){
                $title = "Engineer";
            }else{
                $title = "Guest";
            }
        }else{
            $title = "Guest";
        }
        $user_name = session::get('name');
        $user_type = session::get('user_type');
        //$ldate = Carbon::now();
        $mytime = Carbon::now();
        session([
            'login_id' => $mytime->toDateTimeString()
        ]);
        if($user_type == '1'){
            $sidebar_btn = ['UI Elements','Data List','Inventory'];
            return view('dashboard', compact('title','sidebar_btn'));
        }
        elseif($user_type == '2'){
            $sidebar_btn = ['UI Elements','Data List','Inventory'];
            return view('officer_dashboard', compact('title','sidebar_btn'));
        }
        elseif($user_type == '3'){
            $sidebar_btn = ['UI Elements','Item List','Inventory'];
            //return redirect('vendor-dashboard', compact('title','sidebar_btn'));
            return view('vendor_dashboard', compact('title','sidebar_btn'));
        }
        return redirect('login');

        $sidebar_btn = ['UI Elements','Item List','Inventory'];
        return view('guest_dashboard', compact('sidebar_btn','title'));
    }
    /* CreateBy Aashish 25-March-2023 Logout Function */
    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
