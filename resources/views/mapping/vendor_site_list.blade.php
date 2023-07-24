@extends('layouts.app')
@section('content')
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

    #example_paginate {
        margin: 00 00 00 589px;
    }

    #example_info {
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
                <div class="card-body" style="overflow: scroll">
                    <h4 class="headertext">Mapping Vendor Site:</h4><br><br>
                    <div class="row">
                        <table class="table table-striped display" id="example" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>{{ __('#') }}</th>
                                    <th>{{ __('Vendor Name') }}</th>
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
                            <tbody>
                            @php
                            $i = 0;
                            @endphp
                            @foreach ($sitedata as $res)
                            @php
                            $i++;
                            @endphp
                            
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $res->vendor_name }}</td>
                                <td>{{ $res->site_id }}</td>
                                <td class="ask_td">{{ $res->site_circle_office }}</td>
                                <td class="ask_td">{{ $res->site_add_w_pincode }}</td>


                                <td>NA</td>
                                <td>{{ $res->site_engg }}</td>
                                <td>{{ $res->start_date }}</td>
                                <td>{{ $res->end_date }}</td>
                                <td>{{ $res->priority }}</td>
                                <td>
                                    @if ($res->newStatus == 8)
                                    Completed
                                    @else
                                    Work In Progress
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><br>

                    <!--<nav aria-label="Page navigation example">-->
                    <!--    <ul class="pagination justify-content-center">-->
                    <!--        @if ($newlimit = 1)-->
                    <!--            <li class="page-item disabled">-->
                    <!--                <a class="page-link listShowPrevious" href="http://localhost/assam/vendor-site/{{$newlimit}}">Previous</a>-->
                    <!--            </li>-->
                    <!--        @else-->
                    <!--            <li class="page-item">-->
                    <!--                <a class="page-link listShowPrevious" href="http://localhost/assam/vendor-site/{{$newlimit}}">Previous</a>-->
                    <!--            </li>-->
                    <!--        @endif-->

                    <!--      {{-- <li class="page-item"><a class="page-link" href="#">1</a></li>-->
                    <!--      <li class="page-item"><a class="page-link" href="#">2</a></li>-->
                    <!--      <li class="page-item"><a class="page-link" href="#">3</a></li> --}}-->
                    <!--      <li class="page-item">-->

                    <!--        @if ($newlimit)-->
                    <!--            <a class="page-link listShowNext" href="http://localhost/assam/vendor-site/{{$newlimit + 1}}">Next</a>-->
                    <!--        @endif-->

                    <!--      </li>-->
                    <!--    </ul>-->
                    <!--  </nav>-->

                    {{-- pagination --}}

                    {{-- @if ($paggination > 5000) --}}
                    {{-- <div class="pagination">
                        <button class="btn-nav left-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="left-icon">
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
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="right-icon">
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
    $('body').on('click', '.listShowNext', function () {
        alert($(this.text()));
    })
</script>


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
        }); //End of create main table


        $('#example tbody').on('click', 'tr', function () {
            //alert(table.row(this).data()[0]);
        });
    });
</script>
@endsection