@extends('layouts.app')
@section('content')
<style>

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
                    <div class="card-body" style="overflow: scroll;">
                        <div class="row">
                            <div class="col-sm-4">
                                <h4>Allocate Engineer</h4>
                            </div>
                            <div class="col-sm-5"></div>
                            <div class="col-sm-3">
                                <p id="totalItemList" class="btn btn-info btn-rounded mr-2" style="font-size: 22px;">
                                    Allocate Site</p>
                            </div>
                        </div>
                    {{-- </div>
                    <div class="card-body" style="overflow: scroll;"> --}}
                        <div class="row">
                            <table class="table table-striped">
                                <tr>
                                    <th>#</th>
                                    <th>Select Site</th>
                                    <th>Site Address</th>
                                    <th>Site Officer</th>
                                    <th>Work Start Date</th>
                                    <th>Work End Date</th>
                                    <th>Priority</th>
                                    <th>Select Engineer</th>
                                    {{-- <th>Allocated Engineer</th> --}}
                                </tr>
                                @php $i = 0; @endphp
                                @foreach ($siteData as $res)
                                    @php $i = $i+1;  @endphp
                                    <tr class="countrow">
                                        <td>{{ $i }}</td>
                                        <td class="ask_t">
                                            <select class="form-control" id="site_id{{ $i }}" name="site_id"
                                                class="site_id">
                                                <option value="0">---Select Site---</option>
                                                @foreach ($SiteData as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="ask_td">{{ $res->site_circle_office }}</td>
                                        <td class="ask_td">{{ $res->site_add_w_pincode }}</td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ $res->priority }}</td>
                                        <td>
                                            <select class="form-control" id="user_id{{ $i }}" name="user_id">
                                                <option value="0">---Select Engineer---</option>
                                                @foreach ($userData as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('body').on('click', '#totalItemList', function() {
                var totalcount = $('.countrow').length;
                var bindUserData = new Array();
                var bindSiteData = new Array();
                for (let i = 0; i < totalcount; i++) {
                    var reqsend = "#user_id".concat(i).concat(" :selected");
                    var reqSitesend = "#site_id".concat(i).concat(" :selected");
                    var dataval = $(reqsend).val();
                    var siteval = $(reqSitesend).val();
                    if (dataval == 0 || dataval == undefined) {} else {
                        bindUserData.push(dataval);
                    }
                    if (siteval == 0 || siteval == undefined) {} else {
                        bindSiteData.push(siteval);
                    }
                }
                $.ajax({
                    type: 'POST',
                    url: 'ajax-post-vendor-allocated-engineer',
                    data: {
                        "confirmcheckData": bindUserData,
                        "site_id": bindSiteData,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(result) {
                        //window.location.replace("http://localhost/assam/vendor-product-list");
                    }
                });
            });

        })
    </script>
@endsection
