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
                            <p style="text-align: center;">Site Name</p>
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
                            <h4 class="card-title">Vendor chart</h4>
                            <canvas id="scatterChart" width="455" height="227"
                                style="display: block; width: 455px; height: 227px;"
                                class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="margin: 18px 18px 18px 90px;">User Registered Details</h4>
                            <div class="row">
                                <table class="table table-striped">

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
                                        <td>10</td>
                                        <td>2</td>
                                        <td>8</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


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
                        <h4 style="text-align: center;">Engineer  Data</h4>
                        <div class="row">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Total Engineer </th>
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
            {{-- End Officer Dashboard --}}
        @elseif(session('user_type') == 4)
        {{-- Start Site Officer Dashboard --}}
        {{-- Start Site Officer Dashboard --}}
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
            /* ChartJS
             * -------
             * Data and config for chartjs
             */
            'use strict';
            var data = {
                labels: ["S-001", "S-002", "S-003", "S-004", "S-005", "S-006"],
                datasets: [{
                    label: '# of Votes',
                    data: [10, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
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
            var multiLineData = {
                labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                datasets: [{
                        label: 'Dataset 1',
                        data: [12, 19, 3, 5, 2, 3],
                        borderColor: [
                            '#587ce4'
                        ],
                        borderWidth: 2,
                        fill: false
                    },
                    {
                        label: 'Dataset 2',
                        data: [5, 23, 7, 12, 42, 23],
                        borderColor: [
                            '#ede190'
                        ],
                        borderWidth: 2,
                        fill: false
                    },
                    {
                        label: 'Dataset 3',
                        data: [15, 10, 21, 32, 12, 33],
                        borderColor: [
                            '#f44252'
                        ],
                        borderWidth: 2,
                        fill: false
                    }
                ]
            };
            var options = {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                legend: {
                    display: false
                },
                elements: {
                    point: {
                        radius: 0
                    }
                }

            };
            var doughnutPieData = {
                datasets: [{
                    data: [30, 40, 30],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(255, 159, 64, 0.5)'
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
                    'Pink',
                    'Blue',
                    'Yellow',
                ]
            };
            var doughnutPieOptions = {
                responsive: true,
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            };
            var areaData = {
                labels: ["2013", "2014", "2015", "2016", "2017"],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                    fill: true, // 3: no fill
                }]
            };

            var areaOptions = {
                plugins: {
                    filler: {
                        propagate: true
                    }
                }
            }

            var multiAreaData = {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                        label: 'Facebook',
                        data: [8, 11, 13, 15, 12, 13, 16, 15, 13, 19, 11, 14],
                        borderColor: ['rgba(255, 99, 132, 0.5)'],
                        backgroundColor: ['rgba(255, 99, 132, 0.5)'],
                        borderWidth: 1,
                        fill: true
                    },
                    {
                        label: 'Twitter',
                        data: [7, 17, 12, 16, 14, 18, 16, 12, 15, 11, 13, 9],
                        borderColor: ['rgba(54, 162, 235, 0.5)'],
                        backgroundColor: ['rgba(54, 162, 235, 0.5)'],
                        borderWidth: 1,
                        fill: true
                    },
                    {
                        label: 'Linkedin',
                        data: [6, 14, 16, 20, 12, 18, 15, 12, 17, 19, 15, 11],
                        borderColor: ['rgba(255, 206, 86, 0.5)'],
                        backgroundColor: ['rgba(255, 206, 86, 0.5)'],
                        borderWidth: 1,
                        fill: true
                    }
                ]
            };

            var multiAreaOptions = {
                plugins: {
                    filler: {
                        propagate: true
                    }
                },
                elements: {
                    point: {
                        radius: 0
                    }
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false
                        }
                    }]
                }
            }

            var scatterChartData = {
                datasets: [{
                        label: 'First Dataset',
                        data: [{
                                x: -10,
                                y: 0
                            },
                            {
                                x: 0,
                                y: 3
                            },
                            {
                                x: -25,
                                y: 5
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
                        label: 'Second Dataset',
                        data: [{
                                x: 10,
                                y: 5
                            },
                            {
                                x: 20,
                                y: -30
                            },
                            {
                                x: -25,
                                y: 15
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

            //   var scatterChartOptions = {
            //     scales: {
            //       xAxes: [{
            //         type: 'linear',
            //         position: 'bottom'
            //       }]
            //     }
            //   }



            if ($("#lineChart").length) {
                var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
                var lineChart = new Chart(lineChartCanvas, {
                    type: 'line',
                    data: data,
                    options: options
                });
            }






        });
    </script>
@endsection
