@extends('layouts.app')
@section('content')

<style>
    .ask_td {
        white-space: inherit;
    }

    [type='checkbox'] {
        position: inherit;
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
                    <div class="col-sm-5">
                        <h4 class="card-title" style="font-size: 25px;">List of Site Allocated</h4>

                        <div class="row">
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

                    <div class="col-sm-4"></div>
                    <div class="modal-footer" style=""><p id="getInputll" batch_id="1" name="batch_id" class="btn btn-primary btn-rounded mr-2">Request for Approval</p></div>
                        <div class="col-sm-4">
                        </div>
                    </div>

                    <div class="table-responsive pt-3">
                        <table class="table table-bordered display nowrap" id="example" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Site Id</th>
                                    <th>Site Name</th>
                                    <th>Site Address</th>
                                    <th>Site Officer</th>
                                    <th>Vendor Name</th>
                                    <th>Work Start Date</th>
                                    <th>Work End Date</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Site for Approval</th>
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
                                        <td class="ask_td1 checkcolumn1">
                                            <input type="checkbox" value="{{$res->id}}" class="form-check-input checkapprove" id="checkapproved_{{$i}}" style="width: 85px; margin: -14px 00 00 -45px" name="updatebysiteofficer">
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

<script>
    // Engg Side ,Site Approve send all data to Site Officer
    $('body').on('click', '#getInputll', function(){
        var totalrow = $('.checkapprove').length;
        let checkarray = [];
        for (let i = 1; i <= totalrow; i++) {
            let checkapproved = '#checkapproved_'+i+'';
            if($(checkapproved).is(":checked") == true){
                var checkapprovedData = $(checkapproved).val();
                checkarray.push(checkapprovedData);
            }else{}
        }
        console.log(checkarray);
        $.ajax({
            type: "POST",
            url: 'ajax-update-site-activity',
            data: { "approve_status": checkarray , _token: '{{csrf_token()}}' },
            success: function (data) {
                console.log('Product Approved by Officer and send  Admin');
                console.log(data);
                location.reload();
            }
        });
    })
</script>

@endsection
