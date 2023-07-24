@extends('layouts.app')
@section('content')
    <style>
        .item-list-batch {
        margin: 10px 00px 00px 12px;
        }
        .card-title{
        align-content: center;
        }

        [type='checkbox'] {
        position: absolute;
        height: 25px;
        width: 25px;
        background-color: #eee;
        }
    </style>
    <div class="content-wrapper">
        @if (session('success'))
            <div id="hideDivAlert">
                <div class="alert alert-success mt-4 d-flex align-items-center hideDivAlert">
                    {{-- <i class="typcn typcn-warning"></i> --}}
                    <p>
                        {{ session('success') }}
                    </p>
                </div>
            </div>
        @endif

        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Issue Material To Vendor</h4>
                    <form class="form-sample" action="{{ route('post-issue-material-vendor') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <p class="card-description">
                            Personal Info
                        </p> --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Select Vendor</label>
                                    {{-- <label class="col-sm-3 col-form-label">Vendor Name</label> --}}
                                    <div class="col-sm-9">
                                        <select id="vendorName" class="form-control" value="{{ old('vendor_name') }}" name="vendor_name">
                                            <option value="0">---Select Vendor---</option>
                                            @foreach ($vendors as $res)
                                            <option onclick="getfunction1()" value="{{$res->id}}" class="dropdown-item">{{$res->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Select Site</label>
                                    <div class="col-sm-9">
                                        <select id="SiteNameASK" class="form-control vendorSiteName" value="{{ old('site_name') }}" name="site_name">
                                            <option value="0">---Select Site---</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-10 dynamic-field" id="dynamic-field-1" style="display:none">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Item</label>
                                            <div class="col-sm-9">
                                                <select id="itemName2" class="form-control itemName2 batchNameGetItemName" value="{{ old('batch_Item_name') }}" name="batch_Item_name[]">
                                                    <option value="0">---Select Item---</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Qty</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="qty[]" id="exampleInputEmail2" placeholder="qty">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Serial</label>
                                            <div class="col-sm-9">
                                                <select class="form-control SerialNameASK" value="{{ old('serial_no') }}" name="serial_no[]">
                                                    <option value="0">---Select Serial No---</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="append-buttons" style="display:none">
                                <div class="clearfix">
                                    <button type="button" id="add-button" class="btn btn-secondary float-left text-uppercase shadow-sm"><i class="fa fa-plus fa-fw menu-arrow">+</i>
                                    </button>
                                    <button type="button" id="remove-button" class="btn btn-secondary float-left text-uppercase ml-1" disabled="disabled"><i class="menu-arrow">-</i>
                                    </button>
                                </div>
                            </div>


                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-9">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" name="submit" value="vendor-site" class="btn btn-primary mr-2">Submit</button>
                                <button class="btn btn-light">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(function getfunction1(){
                    var select = $('#vendorName');
                    select.on('change', function(){
                        var vendor_id = $(this).children(':selected').val();
                        $.ajax({
                            type: "POST",
                            url: 'ajaxgetidbysite',
                            data: { "vendor_id": vendor_id , _token: '{{csrf_token()}}' },
                            success: function (data) {
                                $("#SiteNameASK").empty();
                                $("#SiteNameASK").append('<option value="0">---Select Item---</option>');
                                var sitedata = data.sitedata;
                                for (let i = 0; i < sitedata.length; i++) {
                                    $("#SiteNameASK").append('<option onclick="getfunction3()" value='+sitedata[i].id+' class="dropdown-item">'+sitedata[i].name+'</option>');
                                }
                            }
                        });
                    });

                    var site_id = $('#SiteNameASK');
                    site_id.on('change', function(){
                        var site_id = $(this).children(':selected').val();
                        if(site_id){
                            $('#dynamic-field-1').css({'display':'block'});
                            $('.append-buttons').css({'display':'block'});
                        }
                        $.ajax({
                            type: "POST",
                            url: 'ajaxgetsiteidbyitem',
                            data: { "site_id": site_id , _token: '{{csrf_token()}}' },
                            success: function (data) {
                                $("#itemName2").empty();
                                $("#itemName2").append('<option value="0">---Select Item---</option>');
                                var sitedata = data.sitedata;
                                for (let i = 0; i < sitedata.length; i++) {
                                    $("#itemName2").append('<option onclick="getfunction3()" value='+sitedata[i].id+' getvaldata='+sitedata[i].id+' name="batch_name[]" class="dropdown-item siteName">'+sitedata[i].item_title+'</option>');
                                }
                            }
                        });
                    })




                    // var item_id = $('.itemName2');
                    // item_id.on('change', function(){
                    //     var item = $(this).children(':selected').val();
                    //     $.ajax({
                    //         type: "POST",
                    //         url: 'ajaxgetitemidbyserial',
                    //         data: { "item_id": item , _token: '{{csrf_token()}}' },
                    //         success: function (data) {
                    //             $(".SerialNameASK").empty();
                    //             $(".SerialNameASK").append('<option value="0">---Select Serial No---</option>');
                    //             var serialdata = data.serialdata;
                    //             for (let i = 0; i < serialdata.length; i++) {
                    //                 if(serialdata[i].serial_no == null){
                    //                     var serial_data = serialdata[i].box_no;
                    //                 }else{
                    //                     var serial_data = serialdata[i].serial_no;
                    //                 }
                    //                 $("#dynamic-field-1 .SerialNameASK").append('<option onclick="getfunction3()" value='+serialdata[i].id+' name="batch_name[]" class="dropdown-item datacheck_1">'+serial_data+'</option>');
                    //             }
                    //         }
                    //     });
                    // });


                    var siteValData = $('.getvaldata');
                    siteValData.on('change', function(){
                        alert("hi");
                    })
                });

            /*Append Input Field CreateBY: Aashish Shah
            Date: 28-April-2023*/
            var buttonAdd = $("#add-button");
            var buttonRemove = $("#remove-button");
            var className = ".dynamic-field";
            var count = 0;
            var field = "";
            var maxFields =500;

            function totalFields() {
                return $(className).length;
            }

            function ItemNameGet(){
                $('body').on('click', '#dynamic-field-1', function(){
                    //alert($('#dynamic-field-1 .batchNameGet').text());
                })
            }



            function addNewField() {

                count = totalFields() + 1;
                field = $("#dynamic-field-1").clone();
                field.attr("id", "dynamic-field-" + count);
                field.children("label").text("Field " + count);
                field.find("input").val("");
                $(className + ":last").after($(field));


                //$('.SerialNameASK .datacheck_1').html('<option class="datacheck_'+count+'" class="dropdown-item">Testing</option>');
            }

            function removeLastField() {
                if (totalFields() > 1) {
                    $(className + ":last").remove();
                }
            }

            function enableButtonRemove() {
                if (totalFields() === 2) {
                    buttonRemove.removeAttr("disabled");
                    buttonRemove.addClass("shadow-sm");
                }
            }

            function disableButtonRemove() {
                if (totalFields() === 1) {
                    buttonRemove.attr("disabled", "disabled");
                    buttonRemove.removeClass("shadow-sm");
                }
            }

            function disableButtonAdd() {
                if (totalFields() === maxFields) {
                buttonAdd.attr("disabled", "disabled");
                buttonAdd.removeClass("shadow-sm");
                }
            }

            function enableButtonAdd() {
                if (totalFields() === (maxFields - 1)) {
                buttonAdd.removeAttr("disabled");
                buttonAdd.addClass("shadow-sm");
                }
            }

            buttonAdd.click(function() {
                addNewField();
                enableButtonRemove();
                disableButtonAdd();
            });

            buttonRemove.click(function() {
                removeLastField();
                disableButtonRemove();
                enableButtonAdd();
            });


            $('body').on('click', '.batchNameGetItemName', function(){
                a = "#dynamic-field- .batchNameGetItemName";
                b = totalFields();
                position = 15;
                output = [a.slice(0, position), b, a.slice(position)].join('');
                var select = $(output);
                console.log(output);
                select.on('change', function(){
                    var product_batch_id = $(this).children(':selected').val();
                    if(product_batch_id != null){
                        $.ajax({
                            method: "POST",
                            url: "ajax-post-vendorIdToSiteId",
                            data: {"product_batch_id":product_batch_id, _token: '{{csrf_token()}}'},
                            cache: false,
                            success: function(response){
                                ares = "#dynamic-field- .SerialNameASK";
                                bres = totalFields();
                                position = 15;
                                outputres = [a.slice(0, position), bres, ares.slice(position)].join('');
                                var selectres = $(outputres);
                                $(selectres).html("<option value='0'>---Select Serial No---</option>");
                                var rescount = response.length;
                                var result = response[0];
                                for (let i = 0; i < rescount; i++) {
                                    $(selectres).append('<option value='+response[i].serial_no+' name="serial_no[]" class="dropdown-item datacheck_1">'+response[i].serial_no+'</option>');
                                }
                            }
                        });
                    }
                });
            })

        });




    </script>


@endsection

