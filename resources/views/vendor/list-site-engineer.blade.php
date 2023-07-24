@extends('layouts.app')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <style>
        .item-list-batch {
            margin: 10px 00px 00px 12px;
        }

        /* body {
        font-family: "Open Sans", sans-serif;
        font-size: 13px;
        font-weight: 400;
        color: #8184a1;
        line-height: 1.3;
        } */
        /* h4 {
        margin-top: 0;
        margin-bottom: 50px;
        } */
        /* a:link, a:visited {
        transition: color 0.15s ease 0s, border-color 0.15s ease 0s, background-color 0.15s ease 0s;
        } */
        /* .container {
        display: flex;
        width: 100%;
        height: 100vh;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        } */
        .quantity {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .quantity__minus,
        .quantity__plus {
            display: block;
            width: 22px;
            height: 23px;
            margin: 0;
            background: #dee0ee;
            text-decoration: none;
            text-align: center;
            line-height: 23px;
        }

        .quantity__minus:hover,
        .quantity__plus:hover {
            background: #575b71;
            color: #fff;
        }

        .quantity__minus {
            border-radius: 3px 0 0 3px;
        }

        .quantity__plus {
            border-radius: 0 3px 3px 0;
        }

        .quantity__input {
            width: 32px;
            height: 19px;
            margin: 0;
            padding: 0;
            text-align: center;
            border-top: 2px solid #dee0ee;
            border-bottom: 2px solid #dee0ee;
            border-left: 1px solid #dee0ee;
            border-right: 2px solid #dee0ee;
            background: #fff;
            color: #8184a1;
        }

        .quantity__minus:link,
        .quantity__plus:link {
            color: #8184a1;
        }

        .quantity__minus:visited,
        .quantity__plus:visited {
            color: #fff;
        }
    </style>
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <h4 class="card-title"> Allocate Engineer</h4>
                            <div class="row">

                                <p class="card-description item-list-batch">
                                    <code> Allocate Engineer </code>
                                </p>
                                <div class="col-sm-1"></div>
                                <div class="col-sm-0">

                                </div>
                                <div class="col-sm-1"></div>
                                <div class="dropdown">
                                    {{-- <select id="dropdownMenuSizeButton" class="btn btn-light dropdown-toggle" name="select" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton" style="">
                                        <option value="1">--Select Batch--</option>
                                        @foreach ($batch_data as $res)
                                            <option onclick="getfunction(e)" value="{{$res->batch_id}}"
                                class="dropdown-item">{{ $res->batch_id }}</option>
                                @endforeach
                            </div>
                            </select> --}}
                                </div>
                            </div>


                        </div>
                        <div class="col-sm-4"></div>

                        <!-- button /////// -->
                        <div class="col-sm-4">
                            <!-- {{-- Send Data Admin To Officer and Review --}} -->
                            <div class="modal-footer modifyDatabatchIdGet">
                                <button id="myButton" name="batch_id"
                                    class="btn btn-info btn-rounded mr-2">Allocate</button>
                            </div>
                        </div>





                    </div>
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered display nowrap" id="example" style="width:100%">

                            <tbody class="tbody">
                                <tr>
                                    <th>#</th>
                                    <th>Site Name</th>
                                    <!-- <th>Site Name</th> -->
                                    <th>Site Address</th>
                                    <th>Site Officer</th>
                                    <th>Work Start Date</th>
                                    <th>Work End Date</th>
                                    <th>Priority</th>
                                    <th>Allocated Engineer</th>
                                    <!-- <th>Status</th> -->
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <th style="width: 25%" id="exam"><select class="form-control" name="site_id"
                                            id="site_id">
                                            <option value="">---Select Id---</option>
                                            @foreach ($data as $res)
                                                <option value="{{ $res->id }}"
                                                    {{ old('site_id') == $res->id ? 'selected' : '' }}>
                                                    {{ $res->site_id }}
                                                </option>
                                            @endforeach

                                        </select></th>

                                    <<td id="address">
                                        </td>
                                        <td></td>
                                        <td id="date"></td>
                                        <td id="end_date"></td>
                                        <td id="priority"></td>
                                        <th style="width: 25%"><select class="form-control" name="priority">
                                                <option value="">---Select Engineer---</option>
                                                @foreach ($users as $res)
                                                    <option value="{{ $res->id }}"
                                                        {{ old('site_id') == $res->id ? 'selected' : '' }}>
                                                        {{ $res->name }}
                                                    </option>
                                                @endforeach
                                            </select></th>
                                        <!-- <td>Active</td> -->


                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {

            k = 0;
            var a = new Array();
            $('tbody .getall').each(function(i, e) {
                if ($(e).val() == "") {
                    a.push(k);
                    k++;
                }
            });
            //console.log(a);

            var totalcount = a.length;

            console.log(totalcount);

            //alert('test');

            // alert(count($('tbody .getall').attr('value')));
            const minus = $('.quantity__minus');
            const plus = $('.quantity__plus');
            const input = $('.quantity__input');
            minus.click(function(e) {
                e.preventDefault();
                var value = input.val();
                if (value > 1) {
                    value--;
                }
                input.val(value);
            });

            plus.click(function(e) {
                e.preventDefault();
                var value = input.val();
                value++;
                input.val(value);
            })
        });


        ///////////////////////////////////autoload script/


        $(document).ready(function() {
            $('#site_id').change(function() {
                var selectedId = $(this).val();
                var selectedData = @json($data->keyBy('id'));

                if (selectedId !== '') {
                    var selectedAddress = selectedData[selectedId].add_w_pincode;
                    var selectedDate = selectedData[selectedId].date;
                    var selectedEndDate = selectedData[selectedId].end_date;
                    var selectedPriority = selectedData[selectedId].priority;
                } else {
                    var selectedAddress = '';
                    var selectedDate = '';
                    var selectedEndDate = '';
                    var selectedPriority = '';
                }

                $('#address').text(selectedAddress);
                $('#address').attr('data-site-id', selectedId);
                $('#date').text(selectedDate);
                $('#end_date').text(selectedEndDate);
                $('#priority').text(selectedPriority);
            });
        });
        //////////////////////////////////////////

        document.getElementById('myButton').addEventListener('click', function(e) {
            e.preventDefault();
            console.log('nothing');
            // Get form field values
            // var siteid = document.getElementById('exam').value;
            //  var siteAddress = document.getElementById('address').innerText;
            // var siteOfficer = document.getElementById('Site Officer').value;
            var workStartDate = document.getElementById('date').innerText;
            //  var workEndDate = document.getElementById('end_date').value;
            //  var priority = document.getElementById('priority').innerText;
            // var allocatedEngineer = document.getElementById('Priority').value;
            // var workStartDate = document.getElementById('date').textContent;



            console.log('Site Name:', workStartDate);

            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });



            // $.post('productEng', {
            //     workStartDate: workStartDate
            // }).done(function(response) {
            //     console.log('Success:', response.message);
            //     // Handle the successful response here
            // }).fail(function(error) {
            //     console.log('Error:', error.responseText);
            //     // Handle the error response here
            // });
            // $.post('productEng', {
            //     //     siteName: siteName,
            //     // siteAddress: siteAddress,
            //     // siteOfficer: siteOfficer,

            //     workStartDate: workStartDate,

            //     // workEndDate: workEndDate,
            //     //    priority: priority,
            //     // allocatedEngineer: allocatedEngineer
            // }, function(response) {
            //     console.log('After POST request');
            //     if (response.success) {
            //         console.log('fuck');
            //         console.log('Success:', response.message);
            //     } else {
            //         console.log('Error:', response.error);
            //     }
            // });

        });
    </script>

    <!-- //
@endsection -->
