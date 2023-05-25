<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ParityCronController;
use App\Http\Controllers\MappingController;
use App\Http\Controllers\UserController;
use  App\Http\Controllers\SiteController;

Route::redirect('assam-revenue-product', 'login', 301);

Route::get('/', function () {
    if(session::get('user_id') && session::get('user_name')){
        return redirect("dashboard");
    }
    return view('auth.login');
});
Route::match(['get','post'], 'login', [AuthController::class, 'index'])->name('login');
Route::match(['get','post'],'post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


Route::match(['get','post'], 'dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::match(['get','post'], 'batch_list', [BatchController::class, 'list'])->name('batch_list');
Route::match(['get','post'], 'ajaxgetbatchlist', [AjaxController::class, 'ajaxgetBatchList'])->name('ajaxgetbatchlist');
Route::match(['get','post'], 'ajaxpostbatchlist', [AjaxController::class, 'ajaxpostBatchList'])->name('ajaxpostbatchlist');
Route::match(['get','post'], 'adminbatch-send-officer', [AjaxController::class, 'officerToAdminSend'])->name('officer_to_admin_send');
Route::match(['get','post'], 'officer-approve', [AjaxController::class, 'officerApprove'])->name('officer-approve');
Route::match(['get','post'], 'officer_to_admin_send', [AjaxController::class, 'adminSendByOfficer'])->name('adminbatch-send-officer');

Route::match(['get','post'], 'batch_list_officer', [BatchController::class, 'batchListOfficer'])->name('batch_list_officer');
Route::match(['get','post'], 'approve-batch_list_officer', [BatchController::class, 'approveBatchListOfficer'])->name('approve-batch_list_officer');
Route::match(['get','post'], 'batch_list_add_serial', [ParityCronController::class, 'batchListAddSerial'])->name('batch_list_add_serial');
Route::match(['get','post'], 'ajax_serial_no_qty', [AjaxController::class, 'ajaxSerialNoQty'])->name('ajax_serial_no_qty');
// Route::match(['get','post'], 'vendor-dashboard', [ParityCronController::class, 'batchListAddSerial'])->name('vendor-dashboard');

Route::match(['get','post'], 'batch-item-serial-no', [AjaxController::class, 'batchItemSerialNo'])->name('batch-item-serial-no');
Route::match(['get','post'], 'post-serial-no', [BatchController::class, 'postSerialNo'])->name('post-serial-no');

/** Mapping Vendor Site Priority post-vendor-site **/
Route::match(['get','post'], 'vendor-site-mapping', [MappingController::class, 'vendorSiteMapping'])->name('vendor-site-mapping');
Route::match(['get','post'], 'post-vendor-site', [MappingController::class, 'postVendorSite'])->name('post-vendor-site');
Route::match(['get','post'], 'vendor-site', [MappingController::class, 'mappingVendorSite'])->name('vendor.site');



Route::match(['get','post'], 'create-user', [UserController::class, 'index'])->name('create-user');
Route::match(['get','post'], 'user-list', [UserController::class, 'list'])->name('user.list');

Route::match(['get','post'], 'product-list', [BatchController::class,'productList'])->name('product-list');


/** SiteController **/
Route::match(['get','post'], 'site-list', [SiteController::class, 'list'])->name('site.list');
Route::match(['get','post'], 'site-add', [SiteController::class, 'add'])->name('site.add');
Route::match(['get','post'], 'site-edit/{id}', [SiteController::class, 'edit'])->name('site.edit');
Route::match(['get','post'], 'site-store', [SiteController::class, 'store'])->name('site.store');
Route::match(['get','post'], 'site-delete/{id}', [SiteController::class, 'drop'])->name('site.drop');
Route::match(['get','post'], 'getSiteData', [SiteController::class, 'getSiteData']);


Route::match(['get','post'], 'boq-list', [BatchController::class, 'boQlist'])->name('boq.list');
Route::match(['get','post'], 'boq-edit/{id}', [BatchController::class, 'boQedit'])->name('boq.edit');
Route::match(['get','post'], 'boq-store', [BatchController::class, 'boQStore'])->name('boq.store');
Route::match(['get','post'], 'boq-delete', [BatchController::class, 'boQlist'])->name('boq.drop');


Route::match(['get','post'], 'datatable', [SiteController::class, 'dataTable'])->name('datatable');
Route::match(['get','post'], 'approve-all-batch-serial-no', [AjaxController::class, 'approveallbatchserial']);

Route::match(['get','post'], 'issue_vendor', [MappingController::class, 'issueVendor'])->name('issue_vendor');
Route::match(['get','post'], 'post-issue-material-vendor', [MappingController::class, 'issueMaterialVendor'])->name('post-issue-material-vendor');
Route::match(['get','post'], 'ajaxgetvendoridbymateriallist', [AjaxController::class, 'getvendoridbymateriallist'])->name('ajaxgetvendoridbymateriallist');

Route::match(['get','post'], 'inv_mgmt_sta', [MappingController::class, 'invMgmtSta'])->name('inv_mgmt_sta');
Route::match(['get','post'], 'site_alloc_wrk_sta', [MappingController::class, 'siteAllocWrkSta'])->name('site_alloc_wrk_sta');


/*engineer Site Allocation to Engineer Controller MappingController
1->List of Sites allocated to Engineer
2->Update site activity work items,
3->Upload Test reports/images of site,
4->Request for Site completion approval*/
Route::match(['get','post'], 'site_all_eng', [MappingController::class, 'siteAllEng'])->name('site_all_eng');
Route::match(['get','post'], 'site_com_list', [MappingController::class, 'siteComList'])->name('site_com_list');
Route::match(['get','post'], 'site_rep_lst', [MappingController::class, 'siteRepLst'])->name('site_rep_lst');
Route::match(['get','post'], 'site_active_wrk', [MappingController::class, 'siteActiveWrk'])->name('site_active_wrk');
Route::match(['get','post'], 'site_app_list', [MappingController::class, 'siteAppList'])->name('site_app_list');
Route::match(['get','post'], 'app_site_com_work', [MappingController::class, 'appSiteComWork'])->name('app_site_com_work');

Route::match(['get','post'], 'upload_rep_test', [MappingController::class, 'uploadRepTest'])->name('upload_rep_test');



Route::match(['get','post'], 'ajaxgetBatchIDbylist', [AjaxController::class, 'ajaxgetBatchIDbylist'])->name('ajaxgetBatchIDbylist');

Route::match(['get','post'], 'ajaxgetidbysite', [AjaxController::class, 'ajaxgetIdBySiteName'])->name('ajaxgetidbysite');
Route::match(['get','post'], 'ajaxgetsiteidbyitem', [AjaxController::class, 'ajaxGetSiteIdbyItem'])->name('ajaxgetsiteidbyitem');
Route::match(['get','post'], 'ajaxgetitemidbyserial', [AjaxController::class, 'ajaxGetItemIdBySerial'])->name('ajaxgetitemidbyserial');



Route::get("testui", function(){
    return  "testing";
});
