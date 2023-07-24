<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function list()
    {
        if (session::get('user_type')) {
            if (session::get('user_type') == "1") {
                $title = "Admin";
            } else if (session::get('user_type') == "2") {
                $title = "Officer";
            } else if (session::get('user_type') == "3") {
                $title = "Vendor";
            } else {
                $title = "Guest";
            }
        } else {
            $title = "Guest";
        }
        $userData = User::get();
        $sidebar_btn = ['UI Elements', 'Data List', 'Inventory'];
        $childSidebar = ['sl' => "Site List", 'sa' => "Site Create", 'se' => "Site Edit"];
        return view('user.list', compact('sidebar_btn', 'title', 'childSidebar', 'userData'));
    }
    
    public function create(Request $request)
    {

        if ($request->post('submit') === "user") {
            $pwd = Hash::make($request->post('pwd'));
            $request->validate(                [
                    'user_name' => 'required|min:8',
                    'staff_type' => 'required',
                    'role_type' => 'required',
                    'user_email' => 'required',
                    'user_no' => 'min:10',
                    'pwd' => 'required|min:8|max:20',
                    'status' => 'required',
                ],
                [
                    'user_name.required' => 'The User Name must be required.',
                    'user_name.min' => 'The User Name must be at least :min.',
                    'staff_type.required' => 'The User Role must be required.',
                    'pwd.required' => 'The User Name must be required.',
                    'pwd.min' => 'The Password must be at least :min.',
                    'pwd.max' => 'The Password less then :max char.',
                    'user_no.min' => 'The Mobile number must be at least :min.',
                ]
        );
            $user = new User;
            $user->name = $request->user_name;
            $user->user_type = $request->staff_type;
            //$user->user_type = $request->id_no;
            $user->user_role_type = $request->role_type;
            $user->email = $request->user_email;
            $user->password = $pwd;
            $user->contect_no = $request->user_no;
            $user->status = $request->status;
            $user->remember_token = $request->_token;
            $user->created_by = '';
            $user->updated_by = '';
            $user->save();
            return redirect()->route('user_list')->with('success', 'User has been created successfully.');
        }
        if (session::get('user_type')) {
            if (session::get('user_type') == "1") {
                $title = "Admin";
            } else if (session::get('user_type') == "2") {
                $title = "Officer";
            } else if (session::get('user_type') == "3") {
                $title = "Vendor";
            } else {
                $title = "Guest";
            }
        } else {
            $title = "Guest";
        }
        $sidebar_btn = ['UI Elements', 'Data List', 'Inventory'];
        $childSidebar = ['sl' => "Site List", 'sa' => "Site Create", 'se' => "Site Edit"];
        return view('user.create', compact('sidebar_btn', 'title', 'childSidebar'));
    }


    // public function create(Request $request)
    // {
    //     if ($request->post('submit') === "user") {
    //         $pwd = Hash::make($request->post('pwd'));
    //         $request->validate([
    //             'user_name' => 'required',
    //             'staff_type' => 'required',
    //             'role_type' => 'required',
    //             'user_email' => 'required',
    //             'status' => 'required',
    //         ],[
    //             'user_name.required' => 'The User Name must be required.',
    //             ]);
    //         $user = new User;
    //         $user->name = $request->user_name;
    //         $user->user_type = $request->staff_type;
    //         //$user->user_type = $request->id_no;
    //         $user->user_role_type = $request->role_type;
    //         $user->email = $request->user_email;
    //         $user->password = $pwd;
    //         $user->contect_no = $request->user_no;
    //         $user->status = $request->status;
    //         $user->remember_token = $request->_token;
    //         $user->created_by = '';
    //         $user->updated_by = '';
    //         $user->save();
    //         return redirect()->route('user_list')->with('success', 'User has been created successfully.');
    //     }
    //     if (session::get('user_type')) {
    //         if (session::get('user_type') == "1") {
    //             $title = "Admin";
    //         } else if (session::get('user_type') == "2") {
    //             $title = "Officer";
    //         } else if (session::get('user_type') == "3") {
    //             $title = "Vendor";
    //         } else {
    //             $title = "Guest";
    //         }
    //     } else {
    //         $title = "Guest";
    //     }
    //     $sidebar_btn = ['UI Elements', 'Data List', 'Inventory'];
    //     $childSidebar = ['sl' => "Site List", 'sa' => "Site Create", 'se' => "Site Edit"];
    //     return view('user.create', compact('sidebar_btn', 'title', 'childSidebar'));
    // }
    
    /*CreateBy: Aashish Date:22-june-2023 function name StatusChange
    This function User Permission Login*/
    public function StatusChange($id){
        $user  = User::find($id);
        if($user->status == 1){
            $user  = User::find($id);
            $user->status = 0;
            $user->save();
            return redirect()->route('user_list')->with('success', 'User has been Deactive.');
        }else{
            if($user->status == 11){
                return redirect()->route('user_list')->with('success', 'User has been Not Update.');
            }
            $user  = User::find($id);
            $user->status = 1;
            $user->save();
            return redirect()->route('user_list')->with('success', 'User has been Active.');
        }
    }
}
