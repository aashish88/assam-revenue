@extends('layouts.app')
@section('content')

<style>
    .ask_td {
        white-space: inherit;
    }
</style>

<div class="content-wrapper">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title" style="font-size: 30px;">Sites Management</h4>
                        <div class="row">
                        {{--<p class="card-description item-list-batch">
                                 <code>Item List</code>
                            </p> --}}
                            <div class="col-sm-1"></div>
                            <div class="col-sm-0">

                            </div>
                            <div class="col-sm-1"></div>
                            <div class="dropdown">
                                {{-- <select id="dropdownMenuSizeButton" class="btn btn-light dropdown-toggle" name="select" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton" style="">
                                        <option value="1">--Select Batch--</option>
                                        @foreach ($batch_data as $res)
                                            <option onclick="getfunction()" value="{{$res->batch_id}}" class="dropdown-item">{{ $res->batch_id }}</option>
                                        @endforeach
                                    </div>
                                </select> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3"></div>
                        <div class="col-sm-4">
                            {{--Send Data Admin To Officer and Review--}}
                            {{-- <div class="modal-footer modifyDatabatchIdGet">
                                <p id="getInputll" name="batch_id" class="btn btn-info btn-rounded mr-2" style="">Request for Site Item</p>
                            </div> --}}
                        </div>
                    </div>

                    <div class="table-responsive pt-3">
                        <table class="table table-bordered display nowrap" id="example" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Site Name</th>
                                    <th>Site Address</th>
                                    <th>Vendor Name</th>
                                    <th>Enginner Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Work Status</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($sitedata as $res)

                                {{-- <?php print_r($res); ?> --}}
                                @php
                                    $i++;
                                @endphp
                                    <tr>
                                        <th>{{$i}}</th>
                                        <td class="ask_td">{{ $res->dst_site }}{{ __(', ') }}{{ $res->site_id }}</td>
                                        <td class="ask_td">{{ $res->add_w_pincode }}</td>
                                        <td class="ask_td"></td>
                                        <td class="ask_td"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>



@endsection

