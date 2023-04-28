<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(session::get('user_type')){
            if(session::get('user_type') == "1"){
                $title = "Admin";
            }else if(session::get('user_type') == "2"){
                $title = "Officer";
            }else if(session::get('user_type') == "3"){
                $title = "Vendor";
            }else if(session::get('user_type') == "4"){
                $title = "Engineer";
            }
            else if(session::get('user_type') == "5"){
                $title = "Site Officer";
            }
        }else{
            $title = "Guest";
        }
        $user_name = session::get('name');
        $user_type = session::get('user_type');
        $mytime = Carbon::now();
        session([
            'login_id' => $mytime->toDateTimeString()
        ]);
        if(!empty($user_type)){
            $sidebar_btn = ['UI Elements','Data List','Site Management'];
            $childSidebar = ['sl'=> "Site List", 'sa'=> "Site Create", 'se'=> "Site Edit"];
            return view('dashboard', compact('title','sidebar_btn','childSidebar'));
        }
        // if($user_type == '1'){
        //     $sidebar_btn = ['UI Elements','Data List','Inventory'];
        //     return view('dashboard', compact('title','sidebar_btn'));
        // }
        // elseif($user_type == '2'){
        //     $sidebar_btn = ['UI Elements','Data List','Inventory'];
        //     return view('officer_dashboard', compact('title','sidebar_btn'));
        // }
        // elseif($user_type == '3'){
        //     $sidebar_btn = ['UI Elements','Item List','Inventory'];
        //     //return redirect('vendor-dashboard', compact('title','sidebar_btn'));
        //     return view('vendor_dashboard', compact('title','sidebar_btn'));
        // }
        return redirect('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd("hi");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
