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
                    <div class="card-body">
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

                        <div class="row">
                            <table class="table table-striped">
                                <tr>
                                    {{-- <th>#</th> --}}
                                    <th>Select Site</th>
                                    <th>Site Name</th>
                                    <th>Site Address</th>
                                    <th>Site Officer</th>
                                    <th>Work Start Date</th>
                                    <th>Work End Date</th>
                                    <th>Priority</th>
                                    <th>Select Engineer</th>
                                </tr>
                                <tr class="countrow">
                                    <td class="ask_t">
                                        <select class="form-control" id="click_site_id" name="site_id" class="site_id">
                                            <option value="0">---Select Site---</option>
                                                                                            @foreach ($SiteData as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>

                                                @endforeach
                                        </select>
                                    </td>
                                    <td class="ask_td" id="sitename"></td>
                                    <td class="ask_td" id="siteadd"></td>
                                    <td id="siteoff"></td>
                                    <td>
                                        <input type="date" name="sdate" id="startdate">
                                    </td>
                                    <td>
                                        <input type="date" name="edate" id="enddate">
                                    </td>
                                    <td id="sp"></td>
                                    <td>
                                        <select class="form-control" id="user_id" name="user_id">
                                            <option value="0">---Select Engineer---</option>
                                            @foreach ($userData as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(function() {
                var select = $('#click_site_id');
                select.on('change', function() {
                    var selectedOptionText = $(this).children(':selected').text();
                    $.ajax({
                        type: 'POST',
                        url: 'ajax-site_id',
                        data: {
                            "site_id": selectedOptionText,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(result) {
                            $('#sitename').html(result.site_circle_office);
                            $('#siteadd').html(result.site_add_w_pincode);
                            $('#sp').html(result.priority);
                        }
                    });
                });
            });
            let now = new Date();
            let day = ("0" + now.getDate()).slice(-2);
            let month = ("0" + (now.getMonth() + 1)).slice(-2);
            let today = (day)+"-"+(month)+"-"+ now.getFullYear();
            $('#startdate').val(today);
            $('#enddate').val(today);
            $('body').on('click', '#totalItemList', function() {
                var user_id = $('#user_id').val();
                var site_id = $('#click_site_id').val();
                var start_date = $('#startdate').val();
                var end_date = $('#enddate').val();
                $.ajax({
                    type: 'POST',
                    url: 'ajax-post-vendor-allocated-engineer',
                    data: {
                        "user_id": user_id,
                        "site_id": site_id,
                        "start_date": start_date,
                        "end_date": end_date,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(result) {
                        window.location.replace("https://assam-revenue.parityinfotech.in/vendor-product-list");
                    }
                });
            });
        })
    </script>
@endsection
