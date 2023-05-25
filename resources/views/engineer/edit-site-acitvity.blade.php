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
                    <h4 class="card-title" style="font-size: 25px;">Update Sites allocated to Engineer</h4>
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered display nowrap" id="example" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>

                                    <th>Site Name</th>
                                    {{-- <th>Engineer Name</th> --}}
                                    <th>Site Address</th>
                                    <th>Site Officer</th>
                                    <th>Vendor Name</th>
                                    <th>Work Start Date</th>
                                    <th>Work End Date</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            @php
                                $i = 0;
                            @endphp
                            <tbody class="tbody">
                                @foreach ($siteData as $res)


                                @php
                                    $i++;
                                @endphp
                                    <tr>
                                        <th>{{$i}}</th>

                                        <td class="ask_td">{{$res->site_id}}</td>
                                        <td class="ask_td">{{$res->site_address}}</td>
                                        <td class="ask_td">{{$res->priority}}</td>
                                        <td class="ask_td">{{ $res->vendor_id }}</td>
                                        <td class="ask_td">{{substr("$res->s_date",0,10);}}</td>
                                        <td class="ask_td">{{substr("$res->e_date",0,10);}}</td>
                                        <td class="ask_td">{{$res->priority}}</td>
                                        <td class="ask_td">
                                            @if($res->status == 1) Active @else Deactive
                                            @endif
                                        </td>
                                 </tr>
                                @endforeach
                            </tbody>
                        </table><hr><br>
                    </div>
                    <form class="form-sample" action="{{ route('update_site_officer_allocated') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <p class="card-description">
                            Personal Info
                        </p> --}}
                        <div class="row">

                            <div class="col-md-6">
                                {{-- <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Select Site</label>
                                    <div class="col-sm-9">
                                        <select id="SiteNameASK" class="form-control" value="{{ old('batch_name') }}" name="site_name">
                                            <option value="0">---Select Site---</option>
                                        </select>
                                    </div>
                                </div> --}}
                            </div>


                            <div class="col-md-10 dynamic-field ask_dynamic_field" id="dynamic-field-1" style="display:block">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Work Activity</label>
                                            <div class="col-sm-9">
                                                <select id="itemName2" class="form-control itemName2" value="{{ old('work_activity') }}" name="work_activity[]">
                                                    <option value="0">---Select Work Activity---</option>
                                                    @foreach ($workData as $workdata)
                                                            <option value="{{ $workdata->id }}" class="dropdown-item">{{ $workdata->work_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Actual End Date</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="s_date[]" id="exampleInputEmail2" placeholder="qty">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Actual End Date</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="e_date[]" id="exampleInputEmail2" placeholder="qty">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="exampleInputEmail3" class="col-sm-3 col-form-label">Testing Document</label>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control" name="document[]" id="exampleInputEmail2" placeholder="qty">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="exampleInputEmail3" class="col-sm-3 col-form-label">Site Photo</label>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control" name="sitepic[]" id="exampleInputEmail2" placeholder="qty">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Status</label>
                                            <div class="col-sm-9">
                                                <select class="form-control SerialNameASK" value="{{ old('status') }}" name="status[]">
                                                    <option value="0">---Select Status---</option>
                                                    @foreach ($site_status as $res)
                                                        <option value="{{ $res->id }}" class="dropdown-item">{{ $res->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr style="border:2px solid black;">
                            </div><br>
                            <div class="append-buttons" style="display:block">
                                <div class="clearfix" style="margin: 138px 3px 11px 3px">
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
                                <button type="submit" name="submit" value="update-site-officer-allocated" class="btn btn-primary mr-2">Submit</button>
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
          /*  $(function getfunction1(){
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
                                    $("#itemName2").append('<option onclick="getfunction3()" value='+sitedata[i].id+' getvaldata='+sitedata[i].id+' name="batch_name[]" class="dropdown-item">'+sitedata[i].item_title+'</option>');
                                }
                            }
                        });
                    })




                    var item_id = $('.itemName2');
                    item_id.on('change', function(){
                        var item = $(this).children(':selected').val();
                        $.ajax({
                            type: "POST",
                            url: 'ajaxgetitemidbyserial',
                            data: { "item_id": item , _token: '{{csrf_token()}}' },
                            success: function (data) {
                                $(".SerialNameASK").empty();
                                $(".SerialNameASK").append('<option value="0">---Select Serial No---</option>');
                                var serialdata = data.serialdata;
                                for (let i = 0; i < serialdata.length; i++) {
                                    if(serialdata[i].serial_no == null){
                                        var serial_data = serialdata[i].box_no;
                                    }else{
                                        var serial_data = serialdata[i].serial_no;
                                    }
                                    $("#dynamic-field-1 .SerialNameASK").append('<option onclick="getfunction3()" value='+serialdata[i].id+' name="batch_name[]" class="dropdown-item datacheck_1">'+serial_data+'</option>');
                                }
                            }
                        });
                    });


                    var siteValData = $('.getvaldata');
                    siteValData.on('change', function(){
                        alert("hi");
                    })
                });*/

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

            function addNewField() {
                //alert(('.ask_dynamic_field').length);
                count = totalFields() + 1;
                field = $("#dynamic-field-1").clone();
                field.attr("id", "dynamic-field-" + count);
                field.children("label").text("Field " + count);
                field.find("input").val("");
                $(className + ":last").after($(field));

                $('.SerialNameASK .datacheck_1').html('<option class="datacheck_'+count+'" class="dropdown-item">Testing</option>');
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

        });
    </script>


@endsection

