@extends('layouts.app')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.0/bootstrap-table.min.css.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css.css">
    <style>
        .item-list-batch {
            margin: 10px 00px 00px 12px;
        }

        .card-title {
            align-content: center;
            margin: 15px 1px 1px 143px;
        }

        [type='checkbox'] {
            position: absolute;
            height: 25px;
            width: 25px;
            background-color: #eee;
        }


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

        <div class="col-lg-12 grid-margin stretch-card">

            <div class="card">
                <div class="card">
                    <div class="error-msg-response bg-warning"
                        style="text-align: center; display: none; padding: 2px 0px 2px 0px; font-size: 27px;">This is
                        already
                        exist</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <h4 class="card-title">Approve Items Details</h4>

                        </div>
                    </div>

                    <div class="table-responsive pt-3">
                        <form action="approve-all-batch-serial-no" method="post" enctype="multipart/form-data">@csrf
                            <table class="table table-bordered display nowrap table-striped display" id="example"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Item Name</th>
                                        <th>Item Type</th>
                                        <th>Box No</th>
                                        <th>Serial No</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($approveserialdata as $res)
                                        @php
                                            $i++;
                                        @endphp

                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td class="ask_td">{{ $res->item_title }}</td>
                                            <td class="ask_td">{{ $res->item }}</td>
                                            <td>{{ $res->box_no }}</td>

                                            <td class="ask_td">{{ $res->serial_no }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table><br>
                            <div class="row">
                                <div class="col-sm-10"></div>

                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-primary mr-2" id="alldataSubmit"
                                        style="display:none;">Submit</button>
                                </div>
                            </div>
                            <br>

                        </form>
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
