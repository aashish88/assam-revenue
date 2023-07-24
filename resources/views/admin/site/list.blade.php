@extends('layouts.app')
@section('content')

{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.0/bootstrap-table.min.css.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css.css">
    <style>
        /* * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body,
        button {
            font-family: "Inter", sans-serif;
            color: #343a40;
            line-height: 1;
        }

        .pagination,
        .page-numbers {
            display: flex;
            align-items: center;
            justify-content: end;
            gap: 12px;
        }

        .pagination {
            margin-top: -15px;
            padding: 20px
        }

        .btn-nav,
        .btn-page {
            border-radius: 50%;
            background-color: #fff;
            cursor: pointer;
        }

        .btn-nav {
            padding: 5px;
        }

        .btn-nav {
            width: 42px;
            height: 42px;
            border: 1.5px solid #087f5b;
            color: #087f5b;
        }

        .btn-nav:hover,
        .btn-page:hover {
            background-color: #087f5b;
            color: #fff;
        }

        .btn-page {
            border: none;
            width: 36px;
            height: 36px;
            font-size: 16px;
        }

        .btn-selected {
            background-color: #087f5b;
            color: #fff;
        } */






        /* body {

            margin: 2rem;
        }

        .paginate_button {
            border-radius: 0 !important;
        } */


        /* .table>thead>tr>th {
    vertical-align: bottom;
    border-bottom: 2px solid #ddd;
} */

.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
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


    .next, .previous, .paginate_button{
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

    #example_paginate{
        margin: 00 00 00 589px;
    }

    #example_info{
        position: absolute;
    }



    </style>
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
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body" style="overflow: scroll;">
                        <h4>Site List:</h4><br>
                        <div class="row">
                            <table class="table table-striped display" id="example" cellspacing="0" width="100%">


                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>{{ __('Site Id') }}</th>
                                        <th>{{ __('Site Name') }}</th>
                                        <th>Site Address</th>
                                        <th>Site Officer</th>
                                        <th>{{ __('Site Engineer') }}</th>
                                        <th>Work Start Date</th>
                                        <th>Work End Date</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                {{-- <tfoot>
                                    <tr>
                                        <th>S.No</th>
                                        <th>{{ __('Site Id') }}</th>
                                        <th>{{ __('Site Name') }}</th>
                                        <th>Site Address</th>
                                        <th>Site Officer</th>
                                        <th>{{ __('Site Engineer') }}</th>
                                        <th>Work Start Date</th>
                                        <th>Work End Date</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot> --}}

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
                                            <td>{{ $res->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody><br>
                            </table>
                        </div>
                        {{-- pagination --}}

                        {{-- @if ($paggination > 5000) --}}
                        {{-- <div class="pagination">
                            <button class="btn-nav left-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="left-icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                </svg>
                            </button>
                            <div class="page-numbers">
                                <button class="btn-page">1</button>
                                <button class="btn-page">2</button>
                                <button class="btn-page btn-selected">3</button>
                                <button class="btn-page">4</button>
                                <button class="btn-page">5</button>
                                <button class="btn-page">6</button>
                                <span class="dots">...</span>
                                <button class="btn-page">23</button>
                            </div>
                            <button class="btn-nav right-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="right-icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </button>
                        </div> --}}

                        {{-- @endif --}}

                        {{-- end pagination --}}
                    </div>
                </div>
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
                //alert(table.row(this).data()[0]);
            });
        });
    </script>
@endsection
