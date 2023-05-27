@extends('layouts.app')
@section('content')

<style>
    /* .item-list-batch {
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
    } */
    /* .card-body{
        overflow: scroll;
    } */

    .customfieldappend td button {
        margin: 0px -30px 0px 0px
    }

    .btnmargin {
        margin: 0px 0px 8px 1326px;
    }

    .submitbtn{
        margin: 0px 0px 8px 1326px;
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

                    <div class="table-responsive pt-3">

                        <div class="card" id="addrowappend">
                            <form action="{{route('post_update_site_activity')}}" method="post" enctype="multipart/form-data">
                                @csrf
                            <table class="table table-bordered display nowrap" id="example" style="width:156%">
                                <thead>
                                    <tr>
                                        <th>Work Activity</th>
                                        <th>Actual Start Date</th>
                                        <th>Actual End Date</th>
                                        <th>Testing Document</th>
                                        <th>Site Photo</th>
                                        <th style="width:15%">Status</th>
                                        <th>Remark</th>
                                        {{-- <th colspan="2"></th> --}}
                                    </tr>
                                </thead>


                                    <tbody class="tbody">
                                        <div class="col-md-10 dynamic-field ask_dynamic_field" id="dynamic-field-1" style="display:block">
                                            <div class="row append_parity_row">


                                                    <tr class="customfield_1 appendask appendask_1" id="appendask">
                                                        <td style="width: 25%;" class="append_parity_colmn1" id="append_parity_colon1">
                                                            <select id="itemName2" class="form-control itemName2" value="{{ old('work_activity') }}" name="work_activity[]">
                                                                <option value="0">---Select Work Activity---</option>
                                                                @foreach ($workData as $workdata)
                                                                        <option value="{{ $workdata->id }}" class="dropdown-item">{{ $workdata->work_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>

                                                        <td class="append_parity_colmn2" id="append_parity_colon2">
                                                                        <input type="date" class="form-control" name="s_date[]" id="exampleInputEmail2" placeholder="qty">

                                                        </td>

                                                        <td class="append_parity_colmn3" id="append_parity_colon3">
                                                                        <input type="date" class="form-control" name="e_date[]" id="exampleInputEmail2" placeholder="qty">

                                                        </td>

                                                        <td style="width: 20%;" class="append_parity_colmn4" id="append_parity_colon4">
                                                                        <input type="file" class="form-control" name="document[]" id="exampleInputEmail2" placeholder="qty">

                                                        </td>

                                                        <td style="width: 20%;">

                                                                        <input type="file" class="form-control" name="sitepic[]" id="exampleInputEmail2" placeholder="qty">

                                                        </td>

                                                        <td style="width: 25%;">
                                                            <select class="form-control SerialNameASK" value="{{ old('status') }}" name="status[]">
                                                                <option value="0">---Select Status---</option>
                                                                @foreach ($site_status as $res)
                                                                    <option value="{{ $res->id }}" class="dropdown-item">{{ $res->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td style="width: 15%;"><input type="text" class="form-control" name="remark[]" id="exampleInputEmail2" placeholder="remark"></td>

                                                    </tr>


                                                <div class="col-8"></div>
                                                {{-- <div class="col-4">
                                                    <button type="button" id="add-button" class="btn btn-secondary float-left text-uppercase shadow-sm"><i class="fa fa-plus fa-fw menu-arrow">+</i>
                                                    </button>

                                                    <button type="button" id="remove-button" class="btn btn-secondary float-left text-uppercase ml-1" disabled="disabled"><i class="menu-arrow">-</i>
                                                    </button>
                                                </div> --}}


                                            </div>


                                        </div>

                                    </tbody>

                            </table>

                            <div class="col-4 btnmargin">
                                <button type="button" id="add-button" class="btn btn-secondary float-left text-uppercase shadow-sm"><i class="fa fa-plus fa-fw menu-arrow">+</i>
                                </button>

                                <button type="button" id="remove-button" class="btn btn-secondary float-left text-uppercase ml-1" disabled="disabled"><i class="menu-arrow">-</i>
                                </button>
                            </div><br> <br>
                            <button type="submit" class="btn btn-primary mr-2 submitbtn">Submit</button>
                        </form>

                        </div>





                    </div>
                </div>
            </div>
        </div>
    </div>










    <script>
        $(document).ready(function() {
            /*Append Input Field CreateBY: Aashish Shah
            Date: 27-May-2023*/
            $('body').on('click', '#add-button', function() {
                var className = ".appendask";
                function totalFields() {
                    return $(className).length;
                }
                count = totalFields();

                //alert(count);

                if (totalFields() === 1) {
                    var buttonRemove = $("#remove-button");
                    buttonRemove.removeAttr("disabled");
                    //buttonRemove.addClass("shadow-sm");
                }




                var buttonRemove = $("#remove-button");
                buttonRemove.removeClass("shadow-sm");

                if(totalFields() > 6){
                    var buttonAdd = $("#add-button");
                    buttonAdd.attr("disabled", "disabled");
                }
                field = $("#appendask").clone();
                field.find("input").val("");
                field.attr("id", "appendask_1");
                field.attr("id", "appendask-" + count);
                $(className + ":last").after($(field));
                });
            });
            $('body').on('click', '#remove-button', function() {
                var className = ".appendask";
                function totalFields() {
                    return $(className).length;
                }

                if (totalFields() > 1) {
                    $(className + ":last").remove();
                }
                if (totalFields() < 2) {
                    var buttonRemove = $("#remove-button");
                    buttonRemove.attr("disabled", "disabled");
                }

                if (totalFields() < 8) {
                    var buttonAdd = $("#add-button");
                    buttonAdd.removeAttr("disabled");
                    //buttonRemove.addClass("shadow-sm");
                }
            });

            // function disableButtonRemove() {
            //     var buttonAdd = $("#add-button");
            //     var buttonRemove = $("#remove-button");
            //     if (totalFields() === 1) {
            //         buttonRemove.attr("disabled", "disabled");
            //         buttonRemove.removeClass("shadow-sm");
            //     }
            // }


            /*Append Input Field CreateBY: Aashish Shah
            Date: 28-April-2023*/

            /*
            var buttonAdd = $("#add-button");
            var buttonRemove = $("#remove-button");
            var className = ".dynamic-field";
            var count = 0;
            var field = "";
            var maxFields =8;

            function totalFields() {
                return $(className).length;
            }

            function addNewField() {
                //alert(('.ask_dynamic_field').length);
                count = totalFields();
                const startTime = performance.now();

                console.log($('.row append_parity_row').html());

                const duration = performance.now() - startTime;
                console.log(`someMethodIThinkMightBeSlow took ${duration}ms`);

                console.log($('.append_parity_colmn2').html());
                console.log($('.append_parity_colmn3').html());
                console.log($('.append_parity_colmn4').html());
                console.log($('.append_parity_colmn5').html());

                field = $("#append_parity_colon1").clone();
                field2 = $("#append_parity_colon2").clone();

                alert(field);

                field.attr("id", "dynamic-field-" + count);
                field.children("label").text("Field " + count);
                field.find("input").val("");
                $(className + ":last").after($(field));

                // field2.attr("id", "dynamic-field-" + count);
                // field2.find("input").val("");
                // $(className + ":last").after($(field));

                // console.log($('.append_parity_row').text());

                // alert(count);

               // field = $("#dynamic-field-1").clone();
                // field.attr("id", "dynamic-field-" + count);
                // field.children("label").text("Field " + count);
                // field.find("input").val("");
                // $(className + ":last").after($(field));

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

        });*/
    </script>


@endsection
