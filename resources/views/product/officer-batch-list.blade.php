@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<style>
    .item-list-batch {
        margin: 10px 00px 00px 12px;
    }
    .card-title{
    align-content: center;
    margin: 15px 1px 1px 143px;
    }

    [type='checkbox'] {
        position: absolute;
        height: 25px;
        width: 25px;
        background-color: #eee;
    }
</style>
<div class="content-wrapper">

    <div class="col-lg-12 grid-margin stretch-card">

        <div class="card">
            <div class="card"><div class="error-msg-response bg-warning" style="text-align: center; display: none; padding: 2px 0px 2px 0px; font-size: 27px;">This is already exist</div></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <h4 class="card-title">Bill of Quantity Details</h4>
                        <div class="row">

                            <p class="card-description item-list-batch">
                               BOQ <code>Item</code>
                            </p>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-0">

                            </div>
                            <div class="col-sm-1"></div>
                            <div class="dropdown">
                                <select id="dropdownMenuSizeButton3" class="btn btn-light dropdown-toggle" name="select" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3" style="">
                                        <option value="1">--Select BOQ Order--</option>
                                        @foreach ($batch_data as $res)

                                            <option onclick="getfunction()" value="{{$res->batch_id}}" class="dropdown-item">{{ $res->batch_id }}</option>
                                        @endforeach
                                    </div>
                                </select>
                            </div>
                        </div>


                    </div>
                    <div class="col-sm-4"></div>
                    @if (session('title') != 'Vendor')
                        @if (session('user_type') == 1)
                            <div class="col-sm-4">
                                {{--Send Data Admin To Officer and Review--}}
                                <div class="modal-footer modifyDatabatchIdGet">
                                    <p id="getInputll" name="batch_id" class="btn btn-info mr-2" style="display: none">Send for Approval(Store Incharge)</p>
                                </div>
                            </div>
                        @elseif(session('user_type') == 2)

                            <div class="col-sm-4">
                                <div class="modal-footer modifybtnsubmit" style="display: none"></div>
                            </div>
                        @endif

                    @endif

                    @if (session('title') == 'Vendor')
                        <div class="col-sm-4">
                            <div class="modal-footer">
                                <a id="show-value" class="btn btn-primary mr-2">Request Send</a>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="table-responsive pt-3">
                    <form action="approve-all-batch-serial-no" method="post" enctype="multipart/form-data">@csrf
                        <table class="table table-bordered display nowrap table-striped" id="example" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Item Name</th>
                                    <th>Item Type</th>
                                    <th>Box No</th>
                                    <th>Serial No</th>
                                    {{-- <th>Quantity</th> <br>Check All&nbsp;&nbsp;<input type="checkbox" id="SelectAllApprove" name="chkallapprove" /> --}}
                                    <th>Approve</th>
                                    <th>Disapprove</th>
                                    <th>Remark</th>

                                    {{-- @if (session('title') != 'Vendor')
                                        <th>Action</th>
                                    @endif --}}
                                </tr>
                            </thead>
                            <tbody class="tbody" id="tbody">


                            </tbody>

                        </table><br>
                        <div class="row">
                            <div class="col-sm-10"></div>

                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-primary mr-2" id="alldataSubmit" style="display:none;">Submit</button>
                            </div>
                        </div>
                        <br>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    /* UpdateBy:Aashish 20 april 2023 This function fatch data according batch id B-001  batch_id status 1*/
    $(function getfunction(){
            var select = $('#dropdownMenuSizeButton3');
            select.on('change', function(){
                var selectedOptionText = $(this).children(':selected').text();
                $.ajax({
                    type: "POST",
                    url: 'ajaxpostbatchlist',
                    data: { "batch_id": selectedOptionText , _token: '{{csrf_token()}}' },
                    success: function (data) {
                        console.log(data.data);
                        $('.modifybtnsubmit').html('<p id="getInputll" batch_id='+selectedOptionText+' class="btn btn-success mr-2">Approved</p><p id="getInputll" batch_id='+selectedOptionText+' class="btn btn-danger mr-2">Dispproved</p>');
                        var productDatadata = data.data;
                        if(productDatadata.length < 1){
                            $("#alldataSubmit").css("display", "none");
                            $('tbody').empty();
                            $('.modifybtnsubmit').hide();
                            $('tbody').append("<tr><td colspan='8'>No Data Available</td></tr>");
                        }else{
                            $('tbody').empty();
                            //$('.modifybtnsubmit').show();
                            $('.modifybtnsubmit').hide();
                            $("#alldataSubmit").css("display", "block");
                        }
                        for (let i = 0; i < productDatadata.length; i++) {
                            var res = productDatadata[i];
                            var id = res.id;
                            var resstr = res.item_title;
                            var a = i+1;
                            $('.tbody').append('<tr><td>'+a+'</td><td>'+resstr.substring(0,10)+'</td><td class="ask_td">'+resstr.substring(0,500)+'</td><td>'+res.serial_no+'</td><td class="ask_td'+a+' checkcolumn1"><input type="checkbox" class="form-check-input" value='+res.id+' name="approve[]" style="width: 85px; margin: -14px 00 00 -45px" /></td><td class="ask_td"><input type="checkbox" class="form-check-input" value='+res.id+' name="disapprove[]" style="width: 85px; margin: -14px 00 00 -45px" /></td><td class="ask_td"><input type="text" name="remark[]" style="width: 85px;" /><input type="hidden" name="post_id[]" value='+res.id+' /></td>');
                        }
                    },
                    error: function (data, textStatus, errorThrown) {
                        $('.modifybtnsubmit').html('<p id="getInputll" batch_id="0" name="batch_id" class="btn btn-primary btn-rounded mr-2">Send for Approval (Store Incharge)</p>');
                    },
                });
            });
        });
        $('body').on('click','#getInputll',function(){
            console.log("ask->send data pdf and apprve by store officer((warehouse))");
            var batch_id = $(this).attr('batch_id');
            $.ajax({
                type: "POST",
                url: 'officer-approve',
                data: { "batch_id": batch_id , _token: '{{csrf_token()}}' },
                success: function (data) {
                    console.log(data);
                }
            });
        });

        $('body').on('click','.appendSerialNo',function(){
            alert('174');
            var batch_id = $(this).attr("batch_id");
            var site_id = $(this).attr("site_id");
            var qty = $(this).attr("qty");
            $.ajax({
                type: "POST",
                url: 'ajax_serial_no_qty',
                data: { "batch_id": batch_id , "site_id": site_id, "qty": qty, _token: '{{csrf_token()}}' },
                success: function (data) {
                    $('.error-msg-response').css({'display':'block'});
                    setTimeout(function(){
                        $('.error-msg-response').css({'display':'none'});
                    }, 5000);
                    console.log(data.result);
                },
            });
        });

        $('body').on('click','.redirectserialall',function(){
            alert('197');
            var qty = $(this).attr("qty");
            var batch_id = $(this).attr("batch_id");
            var site_id = $(this).attr("site_id");
            $.ajax({
                    type: "POST",
                    url: 'batch-item-serial-no',
                    data: { "qty": qty ,"batch_id": batch_id, 'site_id': site_id, _token: '{{csrf_token()}}' },
                    success: function (data) {
                        $('.content-wrapper .card .card-body .row').empty();
                        $('.content-wrapper .card .card-body .table-responsive').empty();
                        $('.content-wrapper .card .card-body .row').append('<div class="col-sm-4"><h4 class="card-title">BoQ Details</h4><div class="row"><p class="card-description item-list-batch"><code>Item List '+data.length+'</code></p></div></div>');
                        $('.content-wrapper .card .card-body .table-responsive').html('<form action="post-serial-no" method="post" enctype="multipart/form-data">@csrf<table class="table table-bordered"><thead><tr><th>#</th><th>Batch Id</th><th>Site Id</th><th>Serial No</th></tr></thead><tbody></tbody></table><button type="submit" class="btn btn-success">Submit</button></form>');
                        console.log(data[0]['batch_id']);
                        for (let i = 0; i < data.length; i++) {

                            $('.content-wrapper .card .card-body .table-responsive table tbody').append('<tr><td>'+(i+1)+'</td><td>'+data[i]['batch_id']+'</td><td>'+data[i]['site_id']+'</td><td><input type="text" class="form-control" name="serialNo" placeholder="Enter Serial No" /></td></tr>');
                        }
                    }
                });
        });
</script>

@endsection
