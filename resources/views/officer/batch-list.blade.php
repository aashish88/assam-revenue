@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<style>
    .item-list-batch {
        margin: 10px 00px 00px 12px;
    }
</style>
<div class="content-wrapper">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <h4 class="card-title">Sent by admin (parity)</h4>
                        <div class="row">

                            <p class="card-description item-list-batch">
                                BOQ <code>List Item</code>
                            </p>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-0">

                            </div>
                            <div class="col-sm-1"></div>
                            <div class="dropdown">
                                <select id="dropdownMenuSizeButton" class="btn btn-light dropdown-toggle" name="select" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton" style="">
                                        <option value="1">--Select BOQ Order--</option>
                                        @foreach ($batch_data as $res)
                                            <option onclick="getfunction()" value="{{$res->batch_id}}" class="dropdown-item">{{ $res->batch_id }}</option>
                                        @endforeach
                                    </div>
                                </select>
                            </div>
                        </div>


                    </div>
                    <div class="col-sm-4"></div>

                    @if (session('title') != 'Vendor')
                    @if (session('user_type') == 1)
                        <div class="col-sm-4">
                            {{--Send Data Admin To Officer and Review--}}
                            <div class="modal-footer modifyDatabatchIdGet">
                                <p id="getInputll" name="batch_id" class="btn btn-info mr-2" style="display: none">Send Admin To Officer</p>
                            </div>
                        </div>
                    @elseif(session('user_type') == 2)
                        <div class="col-sm-4">
                            <div class="modal-footer officerDatabatchIdGet">
                                <p id="getBranchId" name="batch_id" class="btn btn-success mr-2">Approved</p>
                                <p id="getBranchId" name="batch_id" class="btn btn-danger mr-2">Dispproved</p>
                            </div>
                        </div>
                    @endif

                    @endif

                    @if (session('title') == 'Vendor')
                        <div class="col-sm-4">
                            <div class="modal-footer">
                                {{-- <input type="button" class="btn btn-primary mr-2" name="submit" value="Request Send"> --}}
                                {{-- <button id="getInputAll"> Submet Request</button> --}}
                                <a id="show-value" class="btn btn-primary mr-2">Request Send</a>
                                {{-- <a href="{{ route('vendor_req_item') }}" class="btn btn-primary mr-2">Request Send</a> --}}
                                {{-- <button type="button" class="btn btn-primary mr-2" data-dismiss="modal">Submit</button> --}}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered display nowrap" id="example" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Item Name</th>
                                <th>Item Type</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                {{-- @if (session('title') != 'Vendor')
                                    <th>Action</th>
                                @endif --}}
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            {{-- @foreach ($product_data as $res)
                                <tr>
                                    <input type="hidden" value="{{ $res->site_id }}" class="site_values">
                                    <td>{{ $res->id }}</td>
                                    <td>{{ substr($res->item_title, 0, 10) }}</td>
                                    <td>{{ substr($res->item_title, 0, 70) }}</td>
                                    <td>{{ $res->item }}</td>
                                    <td>
                                        <input type="number" class="user_values">
                                    </td>
                                    @if (session('title') != 'Vendor')
                                    <td><i class="mdi mdi-rename-box"></i> | <i class="mdi mdi-delete"></i>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function getfunction(){
            var select = $('#dropdownMenuSizeButton');

            $('tbody').empty();
            //var selected = $('#selected');
            select.on('change', function(){
                var selectedOptionText = $(this).children(':selected').text();
                $('.officerDatabatchIdGet').empty();
                $.ajax({
                    type: "POST",
                    url: 'ajaxgetbatchlist',
                    data: { "batch_id": selectedOptionText , _token: '{{csrf_token()}}' },
                    success: function (data) {
                    $('tbody').empty();
                    for (let i = 0; i < data.length; i++) {
                        var res = data[i];
                        var id = res.id;
                        var resstr = res.item_title;
                        $('.tbody').append('<tr><td>'+id+'</td><td>'+resstr.substring(0,10)+'</td><td>'+resstr.substring(0,70)+'</td><td>'+res.item+'</td><td>'+res.qty+'</td>'); //<td><i class="mdi mdi-rename-box"></i> | <i class="mdi mdi-delete"></i></tr>
                    }
                    $('.officerDatabatchIdGet').html('<p id="getBranchId" batch_id='+selectedOptionText+' name="batch_id" class="btn btn-success mr-2">Approved</p><p id="getBranchId" name="batch_id" class="btn btn-danger mr-2">Dispproved</p>');
                   // $('.officerDatabatchIdGet').html('<p id="getInputll" batch_id='+selectedOptionText+' name="batch_id" class="btn btn-primary mr-2">Send Admin To Officer</p>');
                    },
                    error: function (data, textStatus, errorThrown) {
                        // $('.officerDatabatchIdGet').empty();
                        $('.officerDatabatchIdGet').html('<p id="getBranchId" name="batch_id" class="btn btn-success mr-2">Approved</p><p id="getBranchId" name="batch_id" class="btn btn-danger mr-2">Dispproved</p>');
                        //$('.officerDatabatchIdGet').html('<p id="getInputll" batch_id="0" name="batch_id" class="btn btn-primary mr-2">Send Admin To Officer</p>');
                        $('tbody').empty();
                        console.log(data);
                    },
                });
            // selected.text(selectedOptionText + 'ashsfsdkjj');
            });
        });

        $('body').on('click','#getBranchId',function(){
            var batch_id = $(this).attr('batch_id');
            alert("hi");
            $.ajax({
                type: "POST",
                url: 'officer_to_admin_send',
                data: { "batch_id": batch_id , _token: '{{csrf_token()}}' },
                success: function (data) {
                    console.log('Product Approved by Officer and send  Admin');
                    console.log(data);
                }
            });
        });

</script>

@endsection
