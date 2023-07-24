@extends('layouts.app')
@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                        <div class="col-sm-2"></div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary mr-2" id="SiteOfficerApproveDisapprove">Submit</button>
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
                                    <th>Approve</th>
                                    <th>Disapprove</th>
                                    <th>Remark</th>
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
                                        {{-- <td>
                                            <a href=""><i class="fa fa-eye" style="font-size:24px"></i></a>
                                        </td> --}}

                                        <td>
                                            <input name="approve" class="checkapprove dataval_{{$i}}" value="{{$res->id}}" type="checkbox">
                                        </td>
                                        <td>
                                            <input name="disapprove" class="checkdisapprove dataval2_{{$i}}" value="{{$res->id}}" type="checkbox">
                                        </td>
                                        <td>
                                            <input name="remark" class="remark" type="text">
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
     $('body').on('click', '#SiteOfficerApproveDisapprove', function(e){
        $('#SiteOfficerApproveDisapprove').css({'cursor':'not-allowed', 'opacity': '0.5'})
        $('#SiteOfficerApproveDisapprove').removeAttr('id','none');
        var n = $('tbody tr').length;
        var datastore = [];
        var disdatastore = [];
            for (let i = 1; i <= n; i++) {
                var dataval = ".dataval_"+i;
                var dataval2 = ".dataval2_"+i;
                if($(dataval).is(":checked") == true){
                    var approve = $(dataval).val();
                    datastore.push(approve);
                }
                if($(dataval2).is(":checked") == true){
                    var approve = $(dataval2).val();
                    disdatastore.push(approve);
                }
            }
            var remark = $('.remark').val();

        var approve = datastore;
        var disapprove = disdatastore;

        console.log(disapprove);

        $.ajax({
            type:'POST',
            url:'ajax-site-officer-approve',
            data:{"approve" : approve, "disapprove" : disapprove, "remark" : remark, _token: '{{csrf_token()}}'},
            success:function(data) {
                $("#msg").html(data.msg);
            }
        });
    })
</script>


@endsection
