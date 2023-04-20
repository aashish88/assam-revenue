<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class UserController extends Controller
{
    public function list(Request $request){
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

        $userData = User::get();

        $sidebar_btn = ['UI Elements','Data List','Inventory'];
        $childSidebar = ['sl'=> "Site List", 'sa'=> "Site Create", 'se'=> "Site Edit"];
        return view('user.list',compact('sidebar_btn','title','childSidebar','userData'));
    }
    public function index(Request $request)
    {
        if($request->post('submit') === "user"){
            $request->validate([
                'user_name' => 'required',
                'staff_type' => 'required',
                'role_type' => 'required',
                'user_email' => 'required',
                'status' => 'required',
            ]);

            //dd($request->post());
            $user = new User;
            $user->name = $request->user_name;
            $user->user_type = $request->staff_type;
            //$user->user_type = $request->id_no;
            $user->user_role_type = $request->role_type;
            $user->email = $request->user_email;
            $user->password = '';
            $user->contect_no = $request->user_no;
            $user->status = $request->status;
            $user->remember_token = $request->_token;
            $user->created_by = '';
            $user->updated_by = '';
            //dd($user);
            $user->save();
            return redirect()->route('user.list')->with('success','User has been created successfully.');
        }

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

        $sidebar_btn = ['UI Elements','Data List','Inventory'];

        $childSidebar = ['sl'=> "Site List", 'sa'=> "Site Create", 'se'=> "Site Edit"];
        return view('user.create',compact('sidebar_btn','title','childSidebar'));


    }


}
