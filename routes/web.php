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
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StoreOfficerController;
use App\Http\Controllers\EngineerController;
use App\Http\Controllers\SiteOfficerController;
use App\Http\Controllers\VendorController;


    /*Page Redirect Start */
    Route::redirect('assam-revenue-product', 'login', 301);
    Route::get('/', function () {
        if (session::get('user_id') && session::get('user_name')) {
            return redirect("dashboard");
        }
        return view('auth.login');
    });
    /* Redirect End
    |
    |
    Createby:Aashish Date: 24-March-2023 Kumar AuthController Start */
    Route::match(['get', 'post'], 'login', [AuthController::class, 'index'])->name('login');
    Route::match(['get', 'post'], 'post-login', [AuthController::class, 'postLogin'])->name('login.post');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    /* AuthController End
    |
    |Createby:Aashish Kumar DashboardController Start */
    Route::match(['get', 'post'], 'dashboard', [DashboardController::class, 'index'])->name('dashboard');
    /* DashboardController End
    |
    |
    /* Createby:Aashish Kumar UserController Start */
    Route::get('user-list', [UserController::class, 'list'])->name('user_list');
    Route::get('change-role/{id}', [UserController::class, 'StatusChange']);
    Route::match(['get', 'post'], 'create-user', [UserController::class, 'create'])->name('create-user');
    /* User Admin AdminController Start*/
    Route::match(['get', 'post'], 'boq-list', [BatchController::class, 'boQlist'])->name('boq.list');
    Route::match(['get', 'post'], 'boq-edit/{id}', [BatchController::class, 'boQedit'])->name('boq.edit');
    Route::match(['get', 'post'], 'boq-store', [BatchController::class, 'boQStore'])->name('boq.store');
    Route::match(['get', 'post'], 'boq-delete', [BatchController::class, 'boQlist'])->name('boq.drop');
    Route::match(['get', 'post'], 'batch_list', [BatchController::class, 'list'])->name('batch_list');
    Route::match(['get', 'post'], 'site-list', [AdminController::class, 'list'])->name('site_list');/* User Admin End*/
    Route::match(['get', 'post'], 'site-add', [AdminController::class, 'create'])->name('site_add');
    /* User Admin End*/
    /** Mapping Vendor Site Priority post-vendor-site **/
    Route::match(['get', 'post'], 'vendor-site-mapping', [MappingController::class, 'vendorSiteMapping'])->name('vendor-site-mapping');
    Route::match(['get', 'post'], 'post-vendor-site', [MappingController::class, 'postVendorSite'])->name('post-vendor-site');
    Route::match(['get', 'post'], 'vendor-site', [MappingController::class, 'mappingVendorSite'])->name('vendor.site');
    Route::match(['get', 'post'], 'vendor-site/{id}', [MappingController::class, 'mappingVendorSite']);
    Route::post('getUserIdBySiteNotAssign', [MappingController::class, 'getUserIdBySiteNotAssign']);
    /* AdminController End UserController   SiteController
    |
    |
    Createby:Aashish Kumar StoreOfficerController Start */
    Route::get('item-issue-vendor', [StoreOfficerController::class, 'ItemIssueVendor'])->name('item_issue_vendor');
    Route::post('ajaxgetidbysite', [StoreOfficerController::class, 'ajaxgetIdBySiteName'])->name('ajaxgetidbysite');
    Route::post('ajax-post-vendorIdToSiteId', [StoreOfficerController::class, 'vendorIdToSiteId'])->name('vendor_id_to_site_id');
    Route::match(['get', 'post'], 'post-issue-material-vendor', [StoreOfficerController::class, 'issueMaterialVendor'])->name('post-issue-material-vendor');
    /*
    |
    |
    Createby:Aashish Kumar EngineerController Start */
    Route::match(['get', 'post'], 'site_active_wrk', [EngineerController::class, 'siteActiveWrk'])->name('site_active_wrk');
    Route::match(['get', 'post'], 'update-site-officer', [EngineerController::class, 'updateSiteOfficer'])->name('update_site_officer');
    Route::match(['get', 'post'], 'edit-site-officer/{id}/{site_id}', [EngineerController::class, 'editSiteOfficer'])->name('edit_site_officer/{id}');
    Route::match(['get', 'post'], 'site_rep_lst', [EngineerController::class, 'siteRepLst'])->name('site_rep_lst');
    Route::match(['get', 'post'], 'update-site-officer-allocated', [EngineerController::class, 'updateSiteOfficerAllocated'])->name('update_site_officer_allocated');
    Route::match(['get', 'post'], 'post-update-site-activity', [EngineerController::class, 'postUpdateSiteActivity'])->name('post_update_site_activity');
    Route::match(['get', 'post'], 'ajax-update-site-activity', [EngineerController::class, 'AjaxPostUpdateSite'])->name('ajax_update');
    Route::post('ajax-site-officer-approve', [EngineerController::class, 'AjaxSiteOfficerApprove'])->name('ajax_site_officer_approve');
    /* EngineerController End
    |
    |
    Createby:Aashish Kumar SiteOfficerController Start */
    Route::match(['get', 'post'], 'site-allocated', [SiteOfficerController::class, 'siteAllocated'])->name('site_allocated');
    Route::match(['get', 'post'], 'view-site-activitywise', [SiteOfficerController::class, 'viewSiteActivitywise'])->name('view_site_activitywise');
    Route::match(['get', 'post'], 'site-approve-list', [SiteOfficerController::class, 'siteApproveList'])->name('site_approve_list');
    Route::match(['get', 'post'], 'view-site-activity/{id}/{vendor_id}', [SiteOfficerController::class, 'viewSiteActivity'])->name('view_site_activity_id');
    Route::match(['get', 'post'], 'view-site-activity', [SiteOfficerController::class, 'viewSiteActivity'])->name('view_site_activity');
    /* SiteOfficerController End
    |
    |
    CreateBy:Aashish Kumar VendorController Start*/
    Route::get('vendor-product-list', [VendorController::class, 'ProductList'])->name('vendor_product_list');
    Route::get('vendor-view-site-list', [VendorController::class, 'ViewSiteList'])->name('vendor_view_site_list');
    Route::match(['get', 'post'], 'vendor-request-site-list', [VendorController::class, 'VendorRequestSiteList'])->name('vendor_request_site_list');
    Route::post('ajax-vendor-request-site-list-send-store-officer', [VendorController::class, 'AjaxVendorRequestSiteListSendStoreOfficer'])->name('ajax_vendor_request_site_list_send_store_officer');
    Route::match(['get', 'post'], 'vendor-confirm-item-list', [VendorController::class, 'VendorConfirmItemList'])->name('vendor_confirm_item_list');
    Route::post('ajax-vendor-confirm-site-list', [VendorController::class, 'AjaxVendorConfirmSiteList'])->name('ajax_vendor_confirm_site_list');
    Route::match(['get', 'post'], 'vendor-allocated-engineer', [VendorController::class, 'VendorAllocatedEngineer'])->name('vendor_allocated_engineer');
    Route::post('ajax-post-vendor-allocated-engineer', [VendorController::class, 'AjaxPostVendorAllocatedEngineer'])->name('ajax_post_vendor_allocated_engineer');;
    Route::post('ajax-site_id', [VendorController::class, 'AjaxSiteId'])->name('ajax_site_id');
    /* VendorController End
    | http://localhost/assam/request-site-list mail send store officer */







Route::match(['get', 'post'], 'ajaxgetbatchlist', [AjaxController::class, 'ajaxgetBatchList'])->name('ajaxgetbatchlist');
Route::match(['get', 'post'], 'ajaxpostbatchlist', [AjaxController::class, 'ajaxpostBatchList'])->name('ajaxpostbatchlist');
Route::match(['get', 'post'], 'adminbatch-send-officer', [AjaxController::class, 'officerToAdminSend'])->name('officer_to_admin_send');
Route::match(['get', 'post'], 'officer-approve', [AjaxController::class, 'officerApprove'])->name('officer-approve');
Route::match(['get', 'post'], 'officer_to_admin_send', [AjaxController::class, 'adminSendByOfficer'])->name('adminbatch-send-officer');
Route::match(['get', 'post'], 'batch_list_officer', [BatchController::class, 'batchListOfficer'])->name('batch_list_officer');
Route::match(['get', 'post'], 'approve-batch_list_officer', [BatchController::class, 'approveBatchListOfficer'])->name('approve-batch_list_officer');
Route::match(['get', 'post'], 'batch_list_add_serial', [ParityCronController::class, 'batchListAddSerial'])->name('batch_list_add_serial');
Route::match(['get', 'post'], 'ajax_serial_no_qty', [AjaxController::class, 'ajaxSerialNoQty'])->name('ajax_serial_no_qty');
// Route::match(['get','post'], 'vendor-dashboard', [ParityCronController::class, 'batchListAddSerial'])->name('vendor-dashboard');
Route::match(['get', 'post'], 'batch-item-serial-no', [AjaxController::class, 'batchItemSerialNo'])->name('batch-item-serial-no');
Route::match(['get', 'post'], 'post-serial-no', [BatchController::class, 'postSerialNo'])->name('post-serial-no');


Route::match(['get', 'post'], 'product-list', [BatchController::class, 'productList'])->name('product-list');
/** SiteController **/


Route::match(['get', 'post'], 'site-edit/{id}', [SiteController::class, 'edit'])->name('site.edit');
Route::match(['get', 'post'], 'site-store', [SiteController::class, 'store'])->name('site.store');
Route::match(['get', 'post'], 'site-delete/{id}', [SiteController::class, 'drop'])->name('site.drop');
Route::match(['get', 'post'], 'getSiteData', [SiteController::class, 'getSiteData']);
Route::match(['get', 'post'], 'datatable', [SiteController::class, 'dataTable'])->name('datatable');
Route::match(['get', 'post'], 'approve-all-batch-serial-no', [AjaxController::class, 'approveallbatchserial']);
Route::match(['get', 'post'], 'issue_vendor', [MappingController::class, 'issueVendor'])->name('issue_vendor');
//Route::match(['get', 'post'], 'post-issue-material-vendor', [MappingController::class, 'issueMaterialVendor'])->name('post-issue-material-vendor');
Route::match(['get', 'post'], 'ajaxgetvendoridbymateriallist', [AjaxController::class, 'getvendoridbymateriallist'])->name('ajaxgetvendoridbymateriallist');
Route::match(['get', 'post'], 'inv_mgmt_sta', [MappingController::class, 'invMgmtSta'])->name('inv_mgmt_sta');
Route::match(['get', 'post'], 'site_alloc_wrk_sta', [MappingController::class, 'siteAllocWrkSta'])->name('site_alloc_wrk_sta');
/*engineer Site Allocation to Engineer Controller MappingController
1->List of Sites allocated to Engineer
2->Update site activity work items,
3->Upload Test reports/images of site,
4->Request for Site completion approval*/
Route::match(['get', 'post'], 'site_all_eng', [MappingController::class, 'siteAllEng'])->name('site_all_eng');
Route::match(['get', 'post'], 'site_com_list', [MappingController::class, 'siteComList'])->name('site_com_list');
Route::match(['get', 'post'], 'site_app_list', [MappingController::class, 'siteAppList'])->name('site_app_list');
Route::match(['get', 'post'], 'app_site_com_work', [MappingController::class, 'appSiteComWork'])->name('app_site_com_work');
Route::match(['get', 'post'], 'upload_rep_test', [MappingController::class, 'uploadRepTest'])->name('upload_rep_test');
Route::match(['get', 'post'], 'ajaxgetBatchIDbylist', [AjaxController::class, 'ajaxgetBatchIDbylist'])->name('ajaxgetBatchIDbylist');
//Route::match(['get', 'post'], 'ajaxgetidbysite', [AjaxController::class, 'ajaxgetIdBySiteName'])->name('ajaxgetidbysite');
Route::match(['get', 'post'], 'ajaxgetsiteidbyitem', [AjaxController::class, 'ajaxGetSiteIdbyItem'])->name('ajaxgetsiteidbyitem');
Route::match(['get', 'post'], 'ajaxgetitemidbyserial', [AjaxController::class, 'ajaxGetItemIdBySerial'])->name('ajaxgetitemidbyserial');

Route::get('getpdf', [AjaxController::class, 'GetPdf']);

Route::get('save-csv-site' , [AjaxController::class, 'CSVDownloadSite'])->name('save-csv-site');
