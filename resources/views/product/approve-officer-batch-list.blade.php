@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<style>
    .item-list-batch {
        margin: 10px 00px 00px 12px;
    }
    .card-title{
    align-content: center;
    margin: 15px 1px 1px 143px;
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
            <div class="card"><div class="error-msg-response bg-warning" style="text-align: center; display: none; padding: 2px 0px 2px 0px; font-size: 27px;">This is already exist</div></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <h4 class="card-title">Approve Items Details</h4>

                    </div>
                </div>

                <div class="table-responsive pt-3">
                    <form action="approve-all-batch-serial-no" method="post" enctype="multipart/form-data">@csrf
                        <table class="table table-bordered display nowrap table-striped" id="example" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Item Name</th>
                                    <th>Item Type</th>
                                    <th>Box No</th>
                                    <th>Serial No</th>
                                    {{-- <th>Quantity</th> <br>Check All&nbsp;&nbsp;<input type="checkbox" id="SelectAllApprove" name="chkallapprove" /> --}}


                                    {{-- @if (session('title') != 'Vendor')
                                        <th>Action</th>
                                    @endif --}}
                                </tr>
                            </thead>
                            <tbody class="tbody" id="tbody">
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
                                <button type="submit" class="btn btn-primary mr-2" id="alldataSubmit" style="display:none;">Submit</button>
                            </div>
                        </div>
                        <br>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
