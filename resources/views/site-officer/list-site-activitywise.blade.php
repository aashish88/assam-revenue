@extends('layouts.app')
@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                        <h4 class="card-title" style="font-size: 30px;">Site Allocated List</h4>
                        <div class="row">

                            {{-- <p class="card-description item-list-batch">
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
                                    <th>Site ID</th>
                                    <th>Site Name</th>
                                    <th>Site Address</th>
                                    <th>Work Start Date</th>
                                    <th>Work End Date</th>
                                    <th>Priority</th>
                                    <th>Allocated Engineer</th>
                                    <th>Status</th> {{-- Open, Completed --}}
                                    <th>View</th>
                                </tr>
                            </thead>
                            @php
                                $i = 0;
                            @endphp
                            <tbody class="tbody">
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
                                        <td>{{$res->site_id}}</td>
                                        <td class="ask_td">{{ $res->site_circle_office }}</td>
                                        <td class="ask_td">{{ $res->site_add_w_pincode }}</td>
                                        <td>{{substr("$res->s_date",0,10);}}</td>
                                        <td>{{substr("$res->e_date",0,10);}}</td>
                                        <td>{{ $res->priority }}</td>
                                        <td class="ask_td">{{$res->engineer_name}}</td>
                                        <td class="ask_td">
                                            @if($res->status == 3) Complete
                                            @else
                                            NA
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('view_site_activity') }}/{{$res->site_id}}/{{$res->vendor_id}}"><i class="fa fa-eye" style="font-size:24px"></i></a>
                                        </td>
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

