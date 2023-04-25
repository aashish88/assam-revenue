@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<style>
    .item-list-batch {
        margin: 10px 00px 00px 12px;
    }
    .card-title{
        /*background: rgb(119, 185, 216);*/
    align-content: center;
    margin: 15px 1px 1px 143px;
    }

    .ajaxitemheader{
        text-align: justify;
        font-size: 18px;
    }


</style>
<div class="content-wrapper">

    <div class="col-lg-12 grid-margin stretch-card">

        <div class="card">
            @if (session('success'))
            <div id="hideDivAlert">
                <div class="alert alert-success mt-4 d-flex align-items-center hideDivAlert">
                    <div class="row"><i class="menu-icon mdi mdi-login-variant"></i> &nbsp;
                        <p>
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif
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
                                <div class="modal-footer modifyDatabatchIdGet">
                                    <p id="getInputll" name="batch_id" class="btn btn-success mr-2">Approved</p>
                                    <p id="getInputll" name="batch_id" class="btn btn-danger mr-2">Dispproved</p>
                                </div>
                            </div>
                        @endif

                    @endif

                    @if (session('title') == 'Vendor')
                        <div class="col-sm-4">
                            <div class="modal-footer">
                                {{-- <input type="button" class="btn btn-primary mr-2" name="submit" value="Request Send"> --}}
                                {{-- <button id="getInputAll"> Submet Request</button> --}}
                                <a id="show-value" class="btn btn-primary mr-2">Request Send</a>
                                {{-- <a href="{{ route('vendor_req_item') }}" class="btn btn-primary mr-2">Request Send</a> --}}
                                {{-- <button type="button" class="btn btn-primary mr-2" data-dismiss="modal">Submit</button> --}}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered display nowrap table-striped" id="example" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Item Name</th>
                                {{-- <th>Item Type</th> --}}
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Serial No.</th>
                                {{-- @if (session('title') != 'Vendor')
                                    <th>Action</th>
                                @endif --}}
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            {{-- @foreach ($product_data as $res)
                                <tr>
                                    <input type="hidden" value="{{ $res->site_id }}" class="site_values">
                                    <td>{{ $res->id }}</td>
                                    <td>{{ substr($res->item_title, 0, 10) }}</td>
                                    <td>{{ substr($res->item_title, 0, 70) }}</td>
                                    <td>{{ $res->item }}</td>
                                    <td>
                                        <input type="number" class="user_values">
                                    </td>
                                    @if (session('title') != 'Vendor')
                                    <td><i class="mdi mdi-rename-box"></i> | <i class="mdi mdi-delete"></i>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function getfunction(){
            var select = $('#dropdownMenuSizeButton3');
            $('tbody').empty();
            //var selected = $('#selected');
            select.on('change', function(){

                var selectedOptionText = $(this).children(':selected').text();
                $('.modifyDatabatchIdGet').empty();
                $.ajax({
                    type: "POST",
                    url: 'ajaxgetbatchlist',
                    data: { "batch_id": selectedOptionText , _token: '{{csrf_token()}}' },
                    success: function (data) {
                        var productDatadata = data.productData;
                        $('tbody').empty();
                        for (let i = 0; i < productDatadata.length; i++) {
                            console.log(i);
                            var res = productDatadata[i];
                            var id = res.id;
                            var resstr = res.item_title;
                            console.log(res);
                            $('.tbody').append('<tr><td>'+id+'</td><td class="ask_td">'+resstr+'</td><td>'+res.item+'</td><td><p class="btn btn-outline-info btn-fw redirectserialall" batch_id='+res.batch_id+' site_id='+res.site_id+' qty='+res.qty+'>'+res.qty+'</p></td> <td><p type="button" class="btn btn-outline-info btn-icon-text appendSerialNo" onclick="serialnoParity('+res.qty+')" batch_id='+res.batch_id+' site_id='+res.site_id+' qty='+res.qty+'>+ Serial No</p></td>'); //<td><i class="mdi mdi-rename-box"></i> | <i class="mdi mdi-delete"></i></tr><td class="ask_td">'+resstr.substring(0,10)+'</td>
                        }

                        var sitedata = data.site_data;

                        alert(sitedata.length);

                        for (let j = 0; j < sitedata.length; j++) {
                            var siteresall = sitedata[j];
                            var id = siteresall.id;
                            var siteres = siteresall.item_title;
                            $('.tbody').append('<tr><td>'+id+'</td><td class="ask_td">'+siteres+'</td><td>'+siteresall.item+'</td><td><p class="btn btn-outline-info btn-fw redirectserialall" batch_id='+siteresall.batch_id+' site_id='+siteresall.site_id+' qty='+siteresall.qty+'>'+siteresall.qty+'</p></td> <td><p type="button" class="btn btn-outline-info btn-icon-text redirectserialall" item_title="'+siteresall.item_title+'" onclick="serialnoParity('+siteresall.qty+')" batch_id='+siteresall.batch_id+' site_id='+siteresall.site_id+' qty='+siteresall.qty+'>Click</p></td>');
                            //$('.tbody').append('<tr><td>'+id+'</td><td class="ask_td">'+siteres.substring(0,10)+'</td><td class="ask_td">'+siteres.substring(0,70)+'</td><td>'+siteresall.item+'</td><td><p class="btn btn-outline-info btn-fw redirectserialall" batch_id='+siteresall.batch_id+' site_id='+siteresall.site_id+' qty='+siteresall.qty+'>'+siteresall.qty+'</p></td> <td><p type="button" class="btn btn-outline-info btn-icon-text redirectserialall" item_title="'+siteresall.item_title+'" onclick="serialnoParity('+siteresall.qty+')" batch_id='+siteresall.batch_id+' site_id='+siteresall.site_id+' qty='+siteresall.qty+'>Click</p></td>'); //<td><i class="mdi mdi-rename-box"></i> | <i class="mdi mdi-delete"></i></tr>
                        }

                    $('.modifyDatabatchIdGet').html('<p id="getInputll" batch_id='+selectedOptionText+' name="batch_id" class="btn btn-primary btn-rounded mr-2">Send for Approval (Store Incharge)</p>');
                    },
                    error: function (data, textStatus, errorThrown) {

                        // $('.modifyDatabatchIdGet').empty();
                        $('.modifyDatabatchIdGet').html('<p id="getInputll" batch_id="0" name="batch_id" class="btn btn-primary btn-rounded mr-2">Send for Approval (Store Incharge)</p>');
                        $('tbody').empty();
                        //console.log(data);
                    },
                });
            // selected.text(selectedOptionText + 'ashsfsdkjj');
            });
        });

        $('body').on('click','#getInputll',function(){
            alert('158');
            var batch_id = $(this).attr('batch_id');
            // var serial_no = $('.serialNo').val();
            // alert(serial_no);
            // alert(serial_no.length);
            $.ajax({
                type: "POST",
                url: 'adminbatch-send-officer',
                data: { "batch_id": batch_id , _token: '{{csrf_token()}}' },
                success: function (data) {
                    $('.error-msg-response').html('<div class="error-msg-response bg-success" style="text-align: center; padding: 2px 0px 2px 0px; font-size: 27px;">'+data+'</div>');
                }
            });
        });

        //Create Serial No Table depen on qty batch
        $('body').on('click','.appendSerialNo',function(){
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
                    //console.log(data.result);
                },
            });
        });

        /*Click btn click then Start Serial No Update working this page*/
        $('body').on('click','.redirectserialall',function(){
            var qty = $(this).attr("qty");
            var batch_id = $(this).attr("batch_id");
            var site_id = $(this).attr("site_id");
            var item_header = $(this).attr("item_title");
            // $.ajax({
            //         type: "POST",
            //         url: 'batch-item-serial-no',
            //         data: { "qty": qty ,"batch_id": batch_id, 'site_id': site_id,'item_header': item_header , _token: '{{csrf_token()}}' },
            //         success: function (data) {
            //             $('.content-wrapper .card .card-body .row').empty();
            //             $('.content-wrapper .card .card-body .table-responsive').empty();
            //             $('.content-wrapper .card .card-body .row').append('<div class="col-sm-4"><h4 class="card-title">BoQ Details</h4><div class="row"><p class="card-description item-list-batch"><code>Item List '+data.result.length+'</code></p></div></div><h4 class="ajaxitemheader">'+data.item_header+'</h4>');
            //             $('.content-wrapper .card .card-body .table-responsive').html('<form action="post-serial-no" method="post" enctype="multipart/form-data">@csrf<table class="table table-bordered"><thead><tr><th>#</th><th>Batch Id</th><th>Serial No</th></tr></thead><tbody></tbody></table><button type="submit" class="btn btn-success">Submit</button></form>'); //<th>Item Name</th>
            //             //console.log(data[0]['batch_id']);
            //             for (let i = 0; i < data.result.length; i++) {
            //                 $('.content-wrapper .card .card-body .table-responsive table tbody').append('<tr><td>'+(i+1)+'</td><td>'+data.result[i]['batch_id']+'</td><td><input type="hidden" value='+data.result[i].id+' name="serial_id[]" /><input type="text" class="form-control" name="serialNo[]" placeholder="Enter Serial No" value="'+data.result[i]['serial_no']+'" /><input type="hidden" name="batch_id[]" value="'+data.result[i]['batch_id']+'" /><input type="hidden" name="site_id[]" value="'+data.result[i]['site_id']+'" /></td></tr>');  //<td>'+data[i]['site_id']+'</td>
            //             }
            //         }
            //     });
        });



</script>

@endsection
