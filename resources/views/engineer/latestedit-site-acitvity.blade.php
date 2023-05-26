@extends('layouts.app')
@section('content')

<style>
    .ask_td {
        white-space: inherit;
    }

    .item-list-batch {
        margin: 10px 00px 00px 12px;
    }
    .icons-list > div i {
    display: inline-block;
    font-size: 20px;
    width: 40px;
    text-align: left;
    color: #844fc1;
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
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="card-title" style="font-size: 30px;">Update Sites allocated to Engineer</h4>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-0">

                            </div>
                            <div class="col-sm-1"></div>
                            <div class="dropdown">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-2"></div>
                        <div class="col-sm-4">
                        </div>
                    </div>

                    <div class="table-responsive pt-3">
                        <table class="table table-bordered display nowrap" id="example" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Vendor Name</th>
                                    <th>Site Name</th>
                                    <th>Engineer Name</th>
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
                                        <td class="ask_td">{{ $res->vendor_id }}</td>
                                        <td class="ask_td">{{$res->site_id}}</td>
                                        <td class="ask_td">{{$res->engineer_id}}</td>
                                        <td class="ask_td">{{$res->priority}}</td>
                                        <td class="ask_td">
                                            @if($res->status == 1) Active @else Deactive
                                            @endif
                                        </td>
                                 </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <hr>

                    <div class="col-md-10 dynamic-field ask_dynamic_field" id="dynamic-field-1" style="display:none">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Item</label>
                                    <div class="col-sm-9">
                                        <select id="itemName2" class="form-control itemName2" value="{{ old('batch_name') }}" name="batch_name[]">
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
                                        <select class="form-control SerialNameASK" value="{{ old('batch_name') }}" name="site_name">
                                            <option value="0">---Select Serial No---</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="table-responsive pt-3">


                        <table class="table table-bordered display nowrap" id="example" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Work Activity</th>
                                    <th>Actual Start Date</th>
                                    <th>Actual End Date</th>
                                    <th>Testing Document</th>
                                    <th>Site Photo</th>
                                    <th>Status</th>
                                    <th>Remark</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                @foreach ($siteData as $res)


                                    <tr>
                                        <td class="ask_td">
                                            <div class="dropdown">
                                                <select id="dropdownMenuSizeButton3" class="btn btn-light dropdown-toggle" name="select" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <option value="0">--Select Work Activity--</option>
                                                        @foreach ($workData as $workdata)
                                                            <option value="{{ $workdata->id }}" class="dropdown-item">{{ $workdata->work_name }}</option>
                                                        @endforeach
                                                </select>
                                            </div>

                                        </td>
                                        <td class="ask_td"><input type="date" name="remark"></td>
                                        <td class="ask_td"><input type="date" name="remark"></td>
                                        <td class="ask_td">
                                            <input type="file" name="" id="">
                                        </td>
                                        <td class="ask_td">
                                            <input type="file" name="" id="">
                                        </td>
                                        <td class="ask_td">
                                            <div class="dropdown">
                                                <select class="btn btn-light dropdown-toggle" name="select" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <option value="0">--Select Status--</option>
                                                    @foreach ($site_status as $res)
                                                        <option value="{{ $res->id }}" class="dropdown-item">{{ $res->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td class="ask_td">
                                            <input type="text" name="remark">
                                        </td>
                                 </tr>
                                @endforeach
                            </tbody>


                        </table>


                    </div> --}}
                </div>
            </div>
        </div>
    </div>











<script>
      $(document).ready(function() {
            $(function getfunction1(){
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
                        alert(totalFields());
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

            })
</script>


@endsection
