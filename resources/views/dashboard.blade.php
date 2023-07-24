@extends('layouts.app')
@section('content')
    <div class="content-wrapper">


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

        @if (session('user_type') == 1)
            <link rel="stylesheet"
                href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.0/bootstrap-table.min.css.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css.css">

            <style>
                .table>tbody>tr>td,
                .table>tbody>tr>th,
                .table>tfoot>tr>td,
                .table>tfoot>tr>th,
                .table>thead>tr>td,
                .table>thead>tr>th {
                    padding: 8px;
                    line-height: 1.42857143;
                    vertical-align: top;
                    border-top: 1px solid #ddd;
                }

                .table thead th {
                    border-top: 0;
                    border-bottom-width: 1px;
                    font-weight: 500;
                    font-size: 1rem;
                }


                .next,
                .previous,
                .paginate_button {
                    border-radius: 33px;
                    background-color: #844fc1;
                    border: none;
                    color: white;
                    padding: 0px 6px;
                    margin: 7px;
                    text-align: right;
                    text-decoration: revert;
                    display: inline-block;
                    font-size: 16px;
                }

                #example_paginate, #inventoryExample_paginate {
                    margin: 00 00 00 589px;
                }

                #example_info, #inventoryExample_info {
                    position: absolute;
                }

                .dataTables_length,
                #example_filter label, .dataTables_filter label,
                input,
                #inventoryExample_info, #example_info {
                    margin: 00 00 00 16px;
                }
            </style>
            {{-- Start Admin Dashboard --}}
            <div class="row">

                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="text-align: center;">Site Data</h4>
                            <div class="row">
                                <canvas id="lineChart" width="455" height="227"
                                    style="display: block; width: 455px; height: 227px;"
                                    class="chartjs-render-monitor"></canvas>
                            </div>
                            <p style="text-align: center;">Total Site : {{ $total_site }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 grid-margin stretch-card">

                    <div class="card">
                        <div class="card-body">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <h4 class="card-title">Total Site {{ $total_site }}</h4>
                            <canvas id="barChart" style="display: block; width: 455px; height: 227px;" width="455"
                                height="227" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
                
                {{--Start Infra Status--}}
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="margin: 18px 18px 18px 90px;">Infra Status</h4>
                            <div class="row">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Status</th>
                                        <th></th>
                                        <th>Count</th>
                                    </tr>
                                    <tr>
                                        <td>Inprogress</td>
                                        <td></td>
                                        <td>{{ $total_infra_process[0]->total }}</td>
                                    </tr>
                                    <tr>
                                        <td>Unassign</td>
                                        <td></td>
                                        <td>{{ $total_unassign[0]->total }}</td>
                                    </tr>
                                    <tr>
                                        <td>Completed</td>
                                        <td></td>
                                        <td>{{ $total_infra_done[0]->total }}</td>
                                    </tr>
                                    <tr>
                                        <td>Assign Vendor</td>
                                        <td></td>
                                        <td>{{$totalassign_vendor}}</td>
                                    </tr>
                                    <tr>
                                        <td>Assign Engineer</td>
                                        <td></td>
                                        <td>{{$totalassign_engg}}</td>
                                    </tr>
                                     <tr>
                                        <td>Unactivity Work</td>
                                        <td></td>
                                        <td>{{ $unassign_engg }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <h4 class="card-title">Infra Status</h4>
                            <canvas id="InfraStatusBarChart" style="display: block; width: 455px; height: 227px;"
                                width="455" height="227" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>

                {{--End Infra Status--}}

                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="margin: 18px 18px 18px 90px;">User Registered Details</h4>
                            <div class="row">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Role</th>
                                        <th></th>
                                        <th>Count</th>
                                    </tr>
                                    <tr>
                                        <td>Admin</td>
                                        <td></td>
                                        <td>{{ session('total_admin') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Store Officer</td>
                                        <td></td>
                                        <td>{{ session('total_Storofficer') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Vendor</td>
                                        <td></td>
                                        <td>{{ session('total_vendor') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Engineer</td>
                                        <td></td>
                                        <td>{{ session('total_engineer') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Site Officer</td>
                                        <td></td>
                                        <td>{{ session('total_siteOfficer') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <h4 class="card-title">User Role</h4>
                            <canvas id="userRoleBarChart" style="display: block; width: 455px; height: 227px;"
                                width="455" height="227" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <h4 class="card-title">Inventory chart</h4>
                            <canvas id="pieChart" width="455" height="227"
                                style="display: block; width: 455px; height: 227px;"
                                class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="margin: 18px 18px 18px 90px;">Store Inventory Details</h4>
                            <div class="row">
                                <table class="table table-striped">

                                    <tr>
                                        <th>Total Quantity</th>
                                        <th>Quantity Issue</th>
                                        <th>Quantity in hand</th>
                                    </tr>
                                    <tr>
                                        <td>{{ $total_allqty }}</td>
                                        <td>{{ $total_qtyissue }}</td>
                                        <td>{{ $total_qtyinhand }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{--Inventory Details Start Dashbord Only--}}
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card col-md-12 col-lg-6 col-sm-4"><br>
                        <h4>Inventory Details</h4>
                        <div class="row table-responsive">
                            <table class="table table-striped display" id="inventoryExample" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Item Name') }}</th>
                                        <th>{{ __('Total Quantity') }}</th>
                                        <th>{{ __('Quantity Rejected') }}</th>
                                        <th>{{ __('Quantity Issue') }}</th>
                                        <th>{{ __('Quantity In Hand') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 0; @endphp

                                    @foreach ($inventryData as $res)
                                        @php $i++; @endphp
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $res->item_title }}</td>
                                            <td class="ask_td">
                                                @if ($res->status == 0)
                                                    {{$res->qty}}
                                                @else
                                                0
                                                @endif
                                            </td>
                                            <td class="ask_td">
                                                @if (($res->status != 0) & ($res->status != 1) & ($res->status != 2))
                                                    {{$res->qty}}
                                                @else
                                                0
                                                @endif
                                            </td>
                                            <td class="ask_td">
                                                @if ($res->status == 1)
                                                    {{$res->qty}}
                                                @else
                                                0
                                                @endif
                                            </td>
                                            <td>
                                                @if ($res->status == 2)
                                                    {{$res->qty}}
                                                @else
                                                0
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table><br>
                        </div>
                    </div>
                </div>
                {{--Inventory Details End--}}

                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card col-md-12 col-lg-6 col-sm-4"><br>
                        <h4>Site Details</h4>
                        <div class="row table-responsive">
                            <table class="table table-striped display" id="example" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Site Id') }}</th>
                                        <th>{{ __('Site Name') }}</th>
                                        <th>Site Address</th>
                                        <th>Site Officer</th>
                                        <th>{{ __('Site Engineer') }}</th>
                                        <th>Work Start Date</th>
                                        <th>Work End Date</th>
                                        <th>Priority</th>
                                        <th>{{ __('Physical Infra Status') }}</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 0; @endphp

                                    @foreach ($sitedata as $res)
                                        @php $i++; @endphp
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $res->site_id }}</td>
                                            <td class="ask_td">{{ $res->site_circle_office }}</td>
                                            <td class="ask_td">{{ $res->site_add_w_pincode }}</td>
                                            <td>NA</td>
                                            <td>
                                                @if ($res->site_engg)
                                                    {{ $res->site_engg }}
                                                @else
                                                    NA
                                                @endif
                                            </td>
                                            <td>{{ $res->sdate }}</td>
                                            <td>{{ $res->edate }}</td>
                                            <td>{{ $res->priority }}</td>
                                            <td>{{ $res->physical_infra_status }}</td>
                                            <td>
                                                @if ($res->status == 0)
                                                    Unassign Site
                                                @elseif ($res->status == 1)
                                                    Completed Site
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody><br>
                            </table><br>
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        var table = $('#example').DataTable({
                            select: false,
                            "columnDefs": [{
                                className: "Name",
                                "targets": [0],
                                "visible": true,
                                "searchable": false
                            }]
                        }); //End of create main table


                        $('#example tbody').on('click', 'tr', function() {
                            // alert(table.row(this).data()[0]);

                        });
                    });


                    $(document).ready(function() {
                        var table = $('#inventoryExample').DataTable({
                            select: false,
                            "columnDefs": [{
                                className: "Name",
                                "targets": [0],
                                "visible": true,
                                "searchable": false
                            }]
                        }); //End of create main table
                        $('#inventoryExample tbody').on('click', 'tr', function() {
                            // alert(table.row(this).data()[0]);
                        });
                    });
                </script>


            </div>

            {{-- End Admin Dashboard --}}
        @elseif(session('user_type') == 2)
            {{-- Start Officer Dashboard --}}

            <div class="row">
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="text-align: center;">Site Data</h4>
                            <div class="row">
                                <canvas id="lineChart" width="455" height="227"
                                    style="display: block; width: 455px; height: 227px;"
                                    class="chartjs-render-monitor"></canvas>
                            </div>
                            <p style="text-align: center;">Site Name</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">


                            <h4 style="text-align: center;">Site Data</h4>
                            <div class="row">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Total Site</th>
                                        <th>Completed</th>
                                        <th>In-progress</th>
                                        <th>Unallocated</th>
                                    </tr>
                                    <tr>
                                        <td>212</td>
                                        <td>35</td>
                                        <td>21</td>
                                        <td>10</td>
                                    </tr>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>


            </div>

            <div class="row">


                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="margin: 18px 18px 18px 90px;">Store Inventory Details</h4>
                            <div class="row">
                                <table class="table table-striped">

                                    <tr>
                                        <th>Total Quantity</th>

                                        <th>Quantity Issue</th>

                                        <th>Quantity in hand</th>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>2</td>
                                        <td>8</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="margin: 18px 18px 18px 90px;">Bill of Quantity Details</h4>
                            <div class="row">
                                <table class="table table-striped">

                                    <tr>
                                        <th>Approved</th>
                                        <th>Pending</th>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>1</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(session('user_type') == 3)
            <div class="row">
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="text-align: center;">Site Data</h4>
                            <div class="row">
                                <canvas id="lineChart" width="455" height="227"
                                    style="display: block; width: 455px; height: 227px;"
                                    class="chartjs-render-monitor"></canvas>
                            </div>
                            <p style="text-align: center;">Site Name</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">


                            <h4 style="text-align: center;">Site Data</h4>
                            <div class="row">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Total Site</th>
                                        <th>Completed</th>
                                        <th>In-progress</th>
                                        <th>Unallocated</th>
                                    </tr>
                                    <tr>
                                        <td>{{ $total_vendor }}</td>
                                        <td>1</td>
                                        <td>{{ $totalinprogressSiteData[0]->total }}</td>
                                        <td>1</td>
                                    </tr>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>


            </div>

            <div class="row">


                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="margin: 18px 18px 18px 90px;">Store Inventory Details</h4>
                            <div class="row">
                                <table class="table table-striped">

                                    <tr>
                                        <th>Total Quantity</th>

                                        <th>Quantity Issue</th>

                                        <th>Quantity in hand</th>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>2</td>
                                        <td>8</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="margin: 18px 18px 18px 90px;">Bill of Quantity Details</h4>
                            <div class="row">
                                <table class="table table-striped">

                                    <tr>
                                        <th>Approved</th>
                                        <th>Pending</th>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>1</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(session('user_type') == 4)
            <div class="row">
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="text-align: center;">Engineer Data</h4>
                            <div class="row">
                                <canvas id="lineChart" width="455" height="227"
                                    style="display: block; width: 455px; height: 227px;"
                                    class="chartjs-render-monitor"></canvas>
                            </div>
                            <p style="text-align: center;">Engineer Name</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="text-align: center;">Engineer Data</h4>
                            <div class="row">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Total Engineer </th>
                                        <th>Completed</th>
                                        <th>In-progress</th>
                                        <th>Unallocated</th>
                                    </tr>
                                    <tr>
                                        <td>{{ $total_engineer }}</td>
                                        <td>35</td>
                                        <td>21</td>
                                        <td>10</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <div class="row">


                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="margin: 18px 18px 18px 90px;">Store Inventory Details</h4>
                            <div class="row">
                                <table class="table table-striped">

                                    <tr>
                                        <th>Total Quantity</th>

                                        <th>Quantity Issue</th>

                                        <th>Quantity in hand</th>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>2</td>
                                        <td>8</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="margin: 18px 18px 18px 90px;">Bill of Quantity Details</h4>
                            <div class="row">
                                <table class="table table-striped">

                                    <tr>
                                        <th>Approved</th>
                                        <th>Pending</th>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>{{ $totalinprogressSiteData }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Officer Dashboard --}}
        @elseif(session('user_type') == 13)
           {{-- Start Management Dashboard --}}
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.0/bootstrap-table.min.css.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css.css">

            <style>
                .table>tbody>tr>td,
                .table>tbody>tr>th,
                .table>tfoot>tr>td,
                .table>tfoot>tr>th,
                .table>thead>tr>td,
                .table>thead>tr>th {
                    padding: 8px;
                    line-height: 1.42857143;
                    vertical-align: top;
                    border-top: 1px solid #ddd;
                }

                .table thead th {
                    border-top: 0;
                    border-bottom-width: 1px;
                    font-weight: 500;
                    font-size: 1rem;
                }


                .next,
                .previous,
                .paginate_button {
                    border-radius: 33px;
                    background-color: #844fc1;
                    border: none;
                    color: white;
                    padding: 0px 6px;
                    margin: 7px;
                    text-align: right;
                    text-decoration: revert;
                    display: inline-block;
                    font-size: 16px;
                }

                #example_paginate,
                #inventoryExample_paginate {
                    margin: 00 00 00 589px;
                }

                #example_info,
                #inventoryExample_info {
                    position: absolute;
                }

                .dataTables_length,
                #example_filter label,
                .dataTables_filter label,
                input,
                #inventoryExample_info,
                #example_info {
                    margin: 00 00 00 16px;
                }
            </style>
            
            <style>
                article {
                    background: #32C0C0;
                    padding: 5px;
                    font-size: 24px;
                }
            </style>
                
                <article>
                    <marquee behavior="alternate" direction="left" style="margin: 00 00 -7px 0px; color: white;">
                        Live dashboard of DLRS state Sites
                    </marquee>
                </article><br>
                
            
                <!--<div class="row">-->
                <!--     <div class="col-lg-12 grid-margin stretch-card" style="align-items: center; display: ruby-text-container;">-->
                <!--        Live dashboard of DLRS state Sites-->
                <!--    </div>-->
                <!--</div>-->
                
                
             <div class="row">
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="text-align: center;">Site Data</h4>
                            <div class="row">
                                <canvas id="lineChart" width="455" height="227"
                                    style="display: block; width: 455px; height: 227px;"
                                    class="chartjs-render-monitor"></canvas>
                            </div>
                            <p style="text-align: center;">Total Site : {{ $total_site }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 grid-margin stretch-card">

                    <div class="card">
                        <div class="card-body">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <h4 class="card-title">Total Site {{ $total_site }}</h4>
                            <canvas id="barChart" style="display: block; width: 455px; height: 227px;" width="455"
                                height="227" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
                {{-- Start Infra Status --}}
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="margin: 18px 18px 18px 90px;">Infra Status</h4>
                            <div class="row">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Status</th>
                                        <th></th>
                                        <th>Count</th>
                                    </tr>
                                    <tr>
                                        <td>Inprogress</td>
                                        <td></td>
                                        <td>{{ $total_infra_process[0]->total }}</td>
                                    </tr>
                                    <tr>
                                        <td>Unassign</td>
                                        <td></td>
                                        <td>{{ $total_unassign[0]->total }}</td>
                                    </tr>
                                    <tr>
                                        <td>Completed</td>
                                        <td></td>
                                        <td>{{ $total_infra_done[0]->total }}</td>
                                    </tr>
                                    <tr>
                                        <td>Assign Vendor</td>
                                        <td></td>
                                        <td>{{$totalassign_vendor}}</td>
                                    </tr>
                                    <tr>
                                        <td>Assign Engineer</td>
                                        <td></td>
                                        <td>{{$totalassign_engg}}</td>
                                    </tr>
                                     <tr>
                                        <td>Unactivity Work</td>
                                        <td></td>
                                        <td>{{ $unassign_engg }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <h4 class="card-title">Infra Status</h4>
                            <canvas id="InfraStatusBarChart" style="display: block; width: 455px; height: 227px;"
                                width="455" height="227" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
                {{-- End Infra Status --}}
                {{----}}
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="margin: 18px 18px 18px 90px;">User Registered Details</h4>
                            <div class="row">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Role</th>
                                        <th></th>
                                        <th>Count</th>
                                    </tr>
                                    <tr>
                                        <td>Admin</td>
                                        <td></td>
                                        <td>{{ session('total_admin') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Store Officer</td>
                                        <td></td>
                                        <td>{{ session('total_Storofficer') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Vendor</td>
                                        <td></td>
                                        <td>{{ session('total_vendor') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Engineer</td>
                                        <td></td>
                                        <td>{{ session('total_engineer') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Site Officer</td>
                                        <td></td>
                                        <td>{{ session('total_siteOfficer') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <h4 class="card-title">User Role</h4>
                            <canvas id="userRoleBarChart" style="display: block; width: 455px; height: 227px;" width="455"
                                height="227" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
                {{----}}
                {{--Inventry Details--}}
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <h4 class="card-title">Inventory chart</h4>
                            <canvas id="pieChart" width="455" height="227" style="display: block; width: 455px; height: 227px;"
                                class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="margin: 18px 18px 18px 90px;">Store Inventory Details</h4>
                            <div class="row">
                                <table class="table table-striped">

                                    <tr>
                                        <th>Total Quantity</th>
                                        <th>Quantity Issue</th>
                                        <th>Quantity in hand</th>
                                    </tr>
                                    <tr>
                                        <td>{{ $total_allqty }}</td>
                                        <td>{{ $total_qtyissue }}</td>
                                        <td>{{ $total_qtyinhand }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{--Inventory Details Start Dashbord Only--}}
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card col-md-12 col-lg-6 col-sm-4"><br>
                        <h4>Inventory Details</h4>
                        <div class="row table-responsive">
                            <table class="table table-striped display" id="inventoryExample" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Item Name') }}</th>
                                        <th>{{ __('Total Quantity') }}</th>
                                        <th>{{ __('Quantity Rejected') }}</th>
                                        <th>{{ __('Quantity Issue') }}</th>
                                        <th>{{ __('Quantity In Hand') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 0; @endphp

                                    @foreach ($inventryData as $res)
                                    @php $i++; @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $res->item_title }}</td>
                                        <td class="ask_td">
                                            @if ($res->status == 0)
                                            {{$res->qty}}
                                            @else
                                            0
                                            @endif
                                        </td>
                                        <td class="ask_td">
                                            @if (($res->status != 0) & ($res->status != 1) & ($res->status != 2))
                                            {{$res->qty}}
                                            @else
                                            0
                                            @endif
                                        </td>
                                        <td class="ask_td">
                                            @if ($res->status == 1)
                                            {{$res->qty}}
                                            @else
                                            0
                                            @endif
                                        </td>
                                        <td>
                                            @if ($res->status == 2)
                                            {{$res->qty}}
                                            @else
                                            0
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table><br>
                        </div>
                    </div>
                </div>
                {{--Inventory Details End--}}
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card col-md-12 col-lg-6 col-sm-4"><br>
                        <h4>Site Details</h4>
                        <div class="row table-responsive">
                            <table class="table table-striped display" id="example" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Site Id') }}</th>
                                        <th>{{ __('Site Name') }}</th>
                                        <th>Site Address</th>
                                        <th>Site Officer</th>
                                        <th>{{ __('Site Engineer') }}</th>
                                        <th>Work Start Date</th>
                                        <th>Work End Date</th>
                                        <th>Priority</th>
                                        <th>{{ __('Physical Infra Status') }}</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 0; @endphp

                                    @foreach ($sitedata as $res)
                                    @php $i++; @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $res->site_id }}</td>
                                        <td class="ask_td">{{ $res->site_circle_office }}</td>
                                        <td class="ask_td">{{ $res->site_add_w_pincode }}</td>
                                        <td>NA</td>
                                        <td>
                                            @if ($res->site_engg)
                                            {{ $res->site_engg }}
                                            @else
                                            NA
                                            @endif
                                        </td>
                                        <td>{{ $res->sdate }}</td>
                                        <td>{{ $res->edate }}</td>
                                        <td>{{ $res->priority }}</td>
                                        <td>{{ $res->physical_infra_status }}</td>
                                        <td>
                                            @if ($res->status == 0)
                                            Unassign Site
                                            @elseif ($res->status == 1)
                                            Completed Site
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody><br>
                            </table><br>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function () {
                        var table = $('#example').DataTable({
                            select: false,
                            "columnDefs": [{
                                className: "Name",
                                "targets": [0],
                                "visible": true,
                                "searchable": false
                            }]
                        });
                        $('#example tbody').on('click', 'tr', function () {

                        });
                    });

                    $(document).ready(function () {
                        var table = $('#inventoryExample').DataTable({
                            select: false,
                            "columnDefs": [{
                                className: "Name",
                                "targets": [0],
                                "visible": true,
                                "searchable": false
                            }]
                        }); //End of create main table
                        $('#inventoryExample tbody').on('click', 'tr', function () {
                            // alert(table.row(this).data()[0]);
                        });
                    });
                </script>

            </div>
        @else
            {{-- Start Vendor Dashboard --}}



            <div class="row">
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="text-align: center;">Site Vendor Dashboard</h4>
                            <div class="row">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Allocated</th>
                                        <th>Completed</th>
                                        <th>Work In Progress</th>
                                        <th>Open</th>
                                    </tr>
                                    <tr>
                                        <td>15</td>
                                        <td>4</td>
                                        <td>8</td>
                                        <td>3</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="text-align: center;">Site Vendor Dashboard</h4>
                            <div class="row">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Allocated</th>
                                        <th>Completed</th>
                                        <th>Work In Progress</th>
                                        <th>Open</th>
                                    </tr>
                                    <tr>
                                        <td>15</td>
                                        <td>4</td>
                                        <td>8</td>
                                        <td>3</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            {{-- <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <div class="row">
                <div class="card">

                    <div class="card-body">
                        <h4>Site Data Vendor or Officer</h4>
                        <div class="row">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Officer</th>
                                    <th></th>
                                    <th>Vendor</th>
                                </tr>
                                <tr>
                                    <td>01</td>
                                    <td></td>
                                    <td>05</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    {{-- <div class="card-body d-flex flex-column justify-content-between">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <p class="mb-0 text-muted">Total Site</p>
                            <p class="mb-0 text-muted">212</p>
                        </div>
                        <h4>35</h4>
                        <canvas id="transactions-chart" class="mt-auto" height="65"></canvas>
                    </div> --}}
            {{-- <div class="card-body d-flex flex-column justify-content-between">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <p class="mb-2 text-muted">Request</p>
                                <h6 class="mb-0">V-004</h6>
                            </div>
                            <div>
                                <p class="mb-2 text-muted">Orders</p>
                                <h6 class="mb-0">720</h6>
                            </div>
                            {{-- <div>
                                <p class="mb-2 text-muted">Revenue</p>
                                <h6 class="mb-0">5900</h6>
                            </div>
                        </div>
                        <canvas id="sales-chart-a" class="mt-auto" height="65"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
            {{-- End Vendor Dashboard --}}
        @endif
    </div>

    <script>
        $(function() {
            /*CreateBy Aashish Shah 12 march 2023*/
            'use strict';
            var data = {
                labels: ["February", "March", "April", "May", "June"],
                datasets: [{
                    label: '212 of Sites',
                    data: {{ $chartData }},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        //'rgba(88,40,200,8)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                    fill: false
                }]
            };
            var bardata = {
                labels: ["Total Site", "Commissioned Site", "Inprogress Site", "Unassign Site"], //Completed
                datasets: [{
                    label: 'Sites',
                    data: {{ $barchartData }},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)'
                    ],
                    borderColor: [
                        //'rgba(88,40,200,8)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                    fill: false
                }]
            };
            var userRoleData = {
                labels: ["Admin", "Store Officer", "Vendor", "Engineer", "Site Officer"],
                datasets: [{
                    label: 'Role',
                    data: {{ $userRolechartData }},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)'
                    ],
                    borderColor: [
                        //'rgba(88,40,200,8)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                    fill: false
                }]
            };
            var options = {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: false
                        }
                    }]
                },
                legend: {
                    display: true
                },
                elements: {
                    point: {
                        radius: 0
                    }
                }

            };
            
            /*InfraStatus*/
            
             var infraStatusData = {
                labels: ["Inprogress", "Unassign","Completed"],
                datasets: [{
                    label: 'Infra',
                    data: {{ $infraStatuschartData }},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)'
                    ],
                    borderColor: [
                        //'rgba(88,40,200,8)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                    fill: false
                }]
            };

            var options = {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: false
                        }
                    }]
                },
                legend: {
                    display: true
                },
                elements: {
                    point: {
                        radius: 0
                    }
                }

            };
            
            /*CreateBy Aashish Shah 13 June 2023 ASK 08 No.*/
            var doughnutPieData = {
                datasets: [{
                    data: {{ $inventryPieData }},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.9)',
                        'rgba(54, 162, 235, 0.9)',
                        'rgba(255, 206, 86, 0.9)',
                        'rgba(75, 192, 192, 0.9)',
                        'rgba(153, 102, 255, 0.9)',
                        'rgba(255, 159, 64, 0.9)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                }],

                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: [
                    'Total Quantity',
                    'Quantity Issue',
                    'Quantity in hand',
                ]
            };

            var doughnutPieOptions = {
                responsive: true,
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            };
            /*CreateBy Aashish Shah 12 march 2023*/
            var scatterChartData = {
                datasets: [{
                        label: 'Store Officer',
                        data: [{
                                x: -10,
                                y: 0
                            },
                            {
                                x: 40,
                                y: 5
                            }
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)'
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'Site Officer',
                        data: [{
                                x: 10,
                                y: 5
                            },
                            {
                                x: -10,
                                y: 5
                            }
                        ],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                        ],
                        borderWidth: 1
                    }
                ]
            }
            var scatterChartOptions = {
                scales: {
                    xAxes: [{
                        type: 'linear',
                        position: 'bottom'
                    }]
                }
            }


            if ($("#lineChart").length) {
                var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
                var lineChart = new Chart(lineChartCanvas, {
                    type: 'line',
                    data: data,
                    options: options
                });
            }


            // Get context with jQuery - using jQuery's .get() method.
            if ($("#barChart").length) {
                var barChartCanvas = $("#barChart").get(0).getContext("2d");
                // This will get the first returned node in the jQuery collection.
                var barChart = new Chart(barChartCanvas, {
                    type: 'bar',
                    data: bardata,
                    options: options
                });
            }

            if ($("#userRoleBarChart").length) {
                var barChartCanvas = $("#userRoleBarChart").get(0).getContext("2d");
                // This will get the first returned node in the jQuery collection.
                var userRoleBarChart = new Chart(barChartCanvas, {
                    type: 'bar',
                    data: userRoleData,
                    options: options
                });
            }
            
            if ($("#InfraStatusBarChart").length) {
                var barChartCanvas = $("#InfraStatusBarChart").get(0).getContext("2d");
                // This will get the first returned node in the jQuery collection.
                var InfraStatusBarChart = new Chart(barChartCanvas, {
                    type: 'bar',
                    data: infraStatusData,
                    options: options
                });
            }

            if ($("#pieChart").length) {
                var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
                var pieChart = new Chart(pieChartCanvas, {
                    type: 'pie',
                    data: doughnutPieData,
                    options: doughnutPieOptions
                });
            }
        });
    </script>
@endsection
