@extends('layouts.app')
@section('content')
    <style>
        .ask_td {
            white-space: inherit;
        }

        .item-list-batch {
            margin: 10px 00px 00px 12px;
        }

        .icons-list>div i {
            display: inline-block;
            font-size: 20px;
            width: 40px;
            text-align: left;
            color: #844fc1;
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
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="card-title" style="font-size: 25px;">List of Sites allocated to Engineer</h4>
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

                        <div class="col-sm-2"></div>
                        <div class="col-sm-4">
                            {{-- Send Data Admin To Officer and Review --}}
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
                                    <th>Site Id</th>
                                    <th>Site Name</th>
                                    {{-- <th>Engineer Name</th> --}}
                                    <th>Site Address</th>
                                    <th>Site Officer</th>
                                    <th>Vendor Name</th>
                                    <th>Work Start Date</th>
                                    <th>Work End Date</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Action</th>
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
                                        <td>{{$i}}</td>

                                        <td>{{ $res->site_id }}</td>

                                        <td class="ask_td">{{$res->site_circle_office}}</td>
                                        <td class="ask_td">{{$res->site_add_w_pincode}}</td>

                                        <td class="ask_td">
                                        @if (!empty($res->site_officer))
                                            {{$res->site_officer}}
                                            @else
                                            NA
                                        @endif
                                        </td>
                                        <td class="ask_td">{{$res->name}}</td>

                                        <td>{{substr("$res->s_date",0,10);}}</td>
                                        <td>{{substr("$res->e_date",0,10);}}</td>
                                        <td class="ask_td">{{$res->priority}}</td>
                                        <td class="ask_td">
                                            @if($res->status == 1) Active @else Deactive
                                            @endif
                                        </td>
                                        <td style="font-size: 30px;">
                                            <a href="{{ __('edit-site-officer') }}/{{ $res->id }}/{{$res->site_id}}"
                                                style="color: hsl(207, 78%, 53%);"><i class="mdi mdi-tooltip-edit"></i></a>
                                            </a>
                                        </td>
                                        {{-- <th>{{ $i }}</th>q

                                        <td class="ask_td">{{ $res->site_id }}</td>
                                        <td class="ask_td">{{ $res->site_address }}</td>
                                        <td class="ask_td">{{ $res->priority }}</td>
                                        <td class="ask_td">{{ $res->vendor_id }}</td>


                                        <td class="ask_td">{{ substr("$res->s_date", 0, 10) }}</td>
                                        <td class="ask_td">{{ substr("$res->e_date", 0, 10) }}</td>
                                        <td class="ask_td">{{ $res->priority }}</td>
                                        <td class="ask_td">
                                            @if ($res->status == 1)
                                                Active
                                            @else
                                                Deactive
                                            @endif
                                        </td>
                                         --}}
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
