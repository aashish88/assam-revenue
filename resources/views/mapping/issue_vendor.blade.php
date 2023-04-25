@extends('layouts.app')
@section('content')
<style>
    .item-list-batch {
        margin: 10px 00px 00px 12px;
    }
    .card-title{
    align-content: center;
    /* margin: 15px 1px 1px 143px; */
    }

    [type='checkbox'] {
        position: absolute;
        height: 25px;
        width: 25px;
        background-color: #eee;
    }
</style>
<div class="content-wrapper">
    @if (session('success'))
        <div id="hideDivAlert">
            <div class="alert alert-success mt-4 d-flex align-items-center hideDivAlert">
                {{-- <i class="typcn typcn-warning"></i> --}}
                <p>
                    {{ session('success') }}
                </p>
            </div>
        </div>
    @endif

    <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Issue Material To Vendor</h4>
            <form class="form-sample" action="{{ route('post-issue-material-vendor') }}" method="POST" enctype="multipart/form-data">
              @csrf
              {{-- <p class="card-description">
                Personal Info
              </p> --}}
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group row">
                    {{-- <label class="col-sm-3 col-form-label">Vendor Name</label> --}}
                    <div class="col-sm-9">
                        <select id="vendorName" class="form-control" value="{{ old('vendor_name') }}" name="vendor_name">
                            <option value="">---Select Vendor---</option>
                            @foreach ($vendors as $res)
                            <option onclick="getfunction1()" value="{{$res->id}}" class="dropdown-item">{{$res->name}}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group row">
                        <div class="col-sm-9">
                            <select id="vendorName2" class="form-control" value="{{ old('batch_name') }}" name="batch_name">
                                <option value="">---Select Batch---</option>
                                @foreach ($batchs as $res)
                                <option onclick="getfunction2()" value="{{$res->id}}" class="dropdown-item">{{$res->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group row">
                        <div class="col-sm-9">
                            <select id="vendorName3" class="form-control" value="{{ old('item_name') }}" name="item_name">
                                <option value="">---Select Item---</option>
                                @foreach ($items as $res)
                                <option onclick="getfunction3()" value="{{$res->id}}" class="dropdown-item">{{$res->item_title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
              </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                          <div class="table-responsive pt-3">
                            <table class="table table-striped project-orders-table">
                              <thead>
                                <tr>
                                  <th class="ml-5">ID</th>
                                  <th>Item name</th>
                                  <th>Item</th>
                                  <th>Quantity</th>
                                  <th>Batch Id</th>
                                  <th>Site Id</th>
                                  <th>Allocation</th>
                                </tr>
                              </thead>
                              <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($items_list as $res)
                                @php
                                    $i++;
                                @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $res->item_title }}</td>
                                        <td>{{ $res->item }}</td>
                                        <td>{{ $res->qty }}</td>
                                        <td>{{ $res->batch_id }}</td>
                                        <td>{{ $res->site_id }}</td>
                                        <td class="ask_td1 checkcolumn1">
                                            <input type="checkbox" class="form-check-input" value="{{ $res->id }}" name="allocateitemtovendor[]" style="width: 85px; margin: -14px 00 00 -45px">
                                        </td>
                                    </tr>
                                @endforeach

                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-9">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" name="submit" value="vendor-site" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                    </div>

                </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    <script>
        $(function getfunction1(){
            var select = $('#vendorName');
            select.on('change', function(){
                var vendor_id = $(this).children(':selected').val();
                $.ajax({
                    type: "POST",
                    url: 'ajaxgetvendoridbymateriallist',
                    data: { "vendor_id": vendor_id , _token: '{{csrf_token()}}' },
                    success: function (data) {

                    }
                });

            });
        });
    </script>


@endsection

