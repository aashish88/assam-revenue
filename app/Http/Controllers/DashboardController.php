<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
   public function index(Request $request)
    {
        if(session::get('user_status') == 0){
            return view('back-dashboard');
        }
        $total_vendor = "";
        $total_site = "";
        $chartData = "";
        $barchartData = "";
        $chartName = "";
        $sitedata = "";
        $totalinprogressSiteData = "";
        $userRolechartData = "";
        $inventryPieData = "";
        $total_qtyissue = "";
        $total_qtyinhand = "";
        $inventryData = "";
        $total_allqty = "";
        $infraStatuschartData = "";
        
        $total_unassign = "";
        $total_infra_process = "";
        $total_infra_done = "";
        $totalassign_engg = null;
        $totalassign_vendor = null;
        $unassign_engg = "";
        
        $totalassign_vendor = DB::select("SELECT COUNT(t1.id) as total FROM `mapping_vendor_sites` as t1");
        $totalassign_vendor = $totalassign_vendor[0]->total;
        
        $totalassign_engg = DB::select("SELECT COUNT(t1.id) as total FROM `mapping_vendor_site_engineers` as t1");
        $totalassign_engg = $totalassign_engg[0]->total;
        $unassign_engg = DB::select("SELECT COUNT(t1.id) - count(t3.user_name) as newtotal FROM `mapping_vendor_site_engineers` as t1
                JOIN site_district_data_master as t2 ON t2.id = t1.site_id
                LEFT JOIN update_site_allocated_to_enggs as t3 ON t3.site_id = t2.site_id");

        if (session::get('user_type')) {
            if (session::get('user_type') == "1") {
                $title = "Admin";
                $total_site = "212";
                $chartData = "[2, 5, 10, 40, 50]";
                //$barchartData = "[212, 50, 12, 160]";

                $chartName = ["Site Data", '212 of Sites'];
                $sitedata = DB::Select('SELECT t1.*, t2.edate, t2.sdate, t3.engineer_id, users.name as site_engg FROM `site_district_data_master` as t1
                RIGHT JOIN site_masters as t2 ON t2.id = t1.id
                Left JOIN mapping_vendor_site_engineers as t3 ON t3.site_id = t1.id
                Left JOIN users ON users.id = t3.engineer_id');

                $total_allqty = DB::select('SELECT SUM(qty) as total FROM `product_batch_masters`');
                $total_allqty = $total_allqty[0]->total;

                $total_qtyissue = DB::select('SELECT SUM(t1.qty) as total FROM `product_batch_masters` as t1
                Left JOIN site_district_data_master as t2 ON t2.id = t1.site_id
                where t2.status = 1');
                $total_qtyissue = $total_qtyissue[0]->total;

                $total_qtyinhand = DB::select('SELECT SUM(t1.qty) as total FROM `product_batch_masters` as t1
                Left JOIN site_district_data_master as t2 ON t2.id = t1.site_id
                where t2.status = 0');
                $total_qtyinhand = $total_qtyinhand[0]->total;
                $inventryPieData = "[$total_allqty, $total_qtyissue, $total_qtyinhand]";
                $userRolechartData = [session::get('total_admin'), session::get('total_Storofficer'), session::get('total_vendor'), session::get('total_engineer'), session::get('total_siteOfficer')];
                $userRolechartData = implode(",", $userRolechartData);
                $userRolechartData .= "]";
                $c = "[";
                $userRolechartData = $c . $userRolechartData;

                $inventryData = DB::select('SELECT t1.*, t2.status FROM `product_batch_masters` as t1
                Left JOIN site_district_data_master as t2 ON t2.id = t1.site_id');
             
                $total_unassign = DB::select("SELECT COUNT(t1.id) as total FROM `update_site_allocated_to_enggs` as t1 WHERE work_activity = 9 and status Like '%5'");
                $total_infra_process = DB::select("SELECT COUNT(t1.id) as total FROM `update_site_allocated_to_enggs` as t1 WHERE work_activity = 9 and status Like '%2'");
                $total_infra_done = DB::select("SELECT COUNT(t1.id) as total FROM `update_site_allocated_to_enggs` as t1 WHERE work_activity = 9 and status Like '%4'");
            
                $infraStatuschartData = [ ($total_infra_process), ($total_unassign), ($total_infra_done)];
                
                $unassign_engg = DB::select("SELECT COUNT(t1.id) - count(t3.user_name) as newtotal FROM `mapping_vendor_site_engineers` as t1
                JOIN site_district_data_master as t2 ON t2.id = t1.site_id
                LEFT JOIN update_site_allocated_to_enggs as t3 ON t3.site_id = t2.site_id");

            $infraStatuschartData[0] = $infraStatuschartData[0][0]->total;
            $infraStatuschartData[1] = $infraStatuschartData[1][0]->total;
            $infraStatuschartData[2] = $infraStatuschartData[2][0]->total;
            
            $completeSite = $infraStatuschartData[0]+$infraStatuschartData[1]+$infraStatuschartData[2];
            $barchartData = "[212, 0, $completeSite, (212-$completeSite)]";
            
            $infraStatuschartData = implode(",", $infraStatuschartData);
            $infraStatuschartData .= "]";
            $c = "[";
            $infraStatuschartData = $c . $infraStatuschartData;
            


            } else if (session::get('user_type') == "2") {
                $title = "Officer";
                $total_site = "212";
                $chartData = "[10, 50, 190, 200, 212]";
            } else if (session::get('user_type') == "3") {
                $title = "Vendor";
                $total_vendor = DB::table('mapping_vendor_sites')->where('vendor_name', session::get('user_type'))->count();
                $totalinprogressSiteData = DB::select('SELECT count(t2.id) as total
                FROM `mapping_vendor_sites` as t1
                LEFT JOIN site_district_data_master as t2 ON t2.id = t1.site_id
                LEFT JOIN mapping_vendor_site_engineers as t3 ON t3.site_id COLLATE utf8mb4_unicode_ci = t1.site_id COLLATE utf8mb4_unicode_ci
                left JOIN users as t4 ON t4.id = t3.vendor_id
                WHERE t1.vendor_name = ' . session::get('user_id') . '');
                $matchsite = DB::select('SELECT t1.*,t2.id as id, t2.site_id as name
                FROM `mapping_vendor_sites` as t1
                LEFT JOIN site_district_data_master as t2 ON t2.id = t1.site_id
                WHERE t1.vendor_name = 3 and t1.status != 0');
                $commonsite = DB::select('SELECT t1.*,t2.id as id, t2.site_id as name
                FROM `mapping_vendor_sites` as t1
                LEFT JOIN site_district_data_master as t2 ON t2.id = t1.site_id
                WHERE t1.vendor_name = 3 and t1.status != 0');
            } else if (session::get('user_type') == "4") {
                $title = "Engineer";
            } else if (session::get('user_type') == "5") {
                $title = "Site Officer";
            } else if (session::get('user_type') == "13") {
                $title = "Management";
                $completeSite = "60";
                $total_site = "212";
                $chartData = "[2, 5, 10, 40, 50]";
                //$barchartData = "[212, $completeSite, 12, 160]";

                $chartName = ["Site Data", '212 of Sites'];
                $sitedata = DB::Select('SELECT t1.*, t2.edate, t2.sdate, t3.engineer_id, users.name as site_engg FROM `site_district_data_master` as t1
                RIGHT JOIN site_masters as t2 ON t2.id = t1.id
                Left JOIN mapping_vendor_site_engineers as t3 ON t3.site_id = t1.id
                Left JOIN users ON users.id = t3.engineer_id');

                $total_allqty = DB::select('SELECT SUM(qty) as total FROM `product_batch_masters`');
                $total_allqty = $total_allqty[0]->total;

                $total_qtyissue = DB::select('SELECT SUM(t1.qty) as total FROM `product_batch_masters` as t1
                Left JOIN site_district_data_master as t2 ON t2.id = t1.site_id
                where t2.status = 1');
                $total_qtyissue = $total_qtyissue[0]->total;

                $total_qtyinhand = DB::select('SELECT SUM(t1.qty) as total FROM `product_batch_masters` as t1
                Left JOIN site_district_data_master as t2 ON t2.id = t1.site_id
                where t2.status = 0');
                $total_qtyinhand = $total_qtyinhand[0]->total;
                $inventryPieData = "[$total_allqty, $total_qtyissue, $total_qtyinhand]";
                $userRolechartData = [session::get('total_admin'), session::get('total_Storofficer'), session::get('total_vendor'), session::get('total_engineer'), session::get('total_siteOfficer')];
                $userRolechartData = implode(",", $userRolechartData);
                $userRolechartData .= "]";
                $c = "[";
                $userRolechartData = $c . $userRolechartData;

                $inventryData = DB::select('SELECT t1.*, t2.status FROM `product_batch_masters` as t1
                Left JOIN site_district_data_master as t2 ON t2.id = t1.site_id');
                $total_unassign = DB::select("SELECT COUNT(t1.id) as total FROM `update_site_allocated_to_enggs` as t1 WHERE work_activity = 9 and status = 5");
                $total_infra_process = DB::select("SELECT COUNT(t1.id) as total FROM `update_site_allocated_to_enggs` as t1 WHERE work_activity = 9 and status = 2");
                $total_infra_done = DB::select("SELECT COUNT(t1.id) as total FROM `update_site_allocated_to_enggs` as t1 WHERE work_activity = 9 and status = 4");


                //$infraStatuschartData = [session::get('total_infra_process'), session::get('total_unassign'), session::get('total_infra_done')];

                $infraStatuschartData = [($total_infra_process), ($total_unassign), ($total_infra_done)];

               // dd($infraStatuschartData);
                $infraStatuschartData[0] = $infraStatuschartData[0][0]->total;
                $infraStatuschartData[1] = $infraStatuschartData[1][0]->total;
                $infraStatuschartData[2] = $infraStatuschartData[2][0]->total;

                $completeSite = $infraStatuschartData[0]+$infraStatuschartData[1]+$infraStatuschartData[2];

                $barchartData = "[212, 0, $completeSite, (212-$completeSite)]";

                $infraStatuschartData = implode(",", $infraStatuschartData);
                $infraStatuschartData .= "]";
                $c = "[";
                $infraStatuschartData = $c . $infraStatuschartData;
            }
        } else {
            $title = "Guest";
        }
        $user_name = session::get('name');
        $user_type = session::get('user_type');
        $mytime = Carbon::now();
        $total_engineer = DB::table('users')->where('user_type', '4')->count();
        // session([
        //     'login_id' => $mytime->toDateTimeString()
        // ]);
        $mytime = Carbon::now()->setTimezone('Asia/Kolkata');
        $current_date = $mytime->toDateTimeString();
        session([
            'login_id' =>  $current_date
        ]);
        
        $unassign_engg = $unassign_engg[0]->newtotal;
        
        if (!empty($user_type)) {
            $sidebar_btn = ['UI Elements', 'Data List', 'Site Management'];
            $childSidebar = ['sl' => "Site List", 'sa' => "Site Create", 'se' => "Site Edit"];
            return view('dashboard', compact('title', 'sidebar_btn', 'childSidebar', 'total_vendor', 'total_engineer', 'totalinprogressSiteData', 'total_site', 'chartData', 'barchartData', 'chartName', 'sitedata', 'total_allqty', 'userRolechartData','inventryPieData','total_qtyissue','total_qtyinhand','inventryData','infraStatuschartData','total_unassign','total_infra_process','total_infra_done','unassign_engg','totalassign_engg','totalassign_vendor'));
        }
        return redirect('login');
    }
    public function create()
    {
        //dd("hi");
    }
    // if($user_type == '1'){
    //     $sidebar_btn = ['UI Elements','Data List','Inventory'];
    // elseif($user_type == '2'){
    //     $sidebar_btn = ['UI Elements','Data List','Inventory'];
    // elseif($user_type == '3'){
    //     $sidebar_btn = ['UI Elements','Item List','Inventory'];
}
