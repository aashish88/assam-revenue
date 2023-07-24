@extends('layouts.app')
@section('content')
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
                                <h4>Vendor Confirm List</h4>
                            </div>
                            <div class="col-sm-5"></div>
                            <div class="col-sm-3">
                                <p id="reqConfirmItemList" class="btn btn-info btn-rounded mr-2" style="font-size: 22px;">
                                    Confirm Recived</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="overflow: scroll;">
                        <div class="row">
                            <table class="table table-striped">
                                <tr>
                                    <th>#</th>
                                    <th>Site ID</th>
                                    <th>Site Name</th>
                                    <th>Site Address</th>
                                    <th>Site Officer</th>
                                    <th>Work Start Date</th>
                                    <th>Work End Date</th>
                                    <th>Priority</th>
                                    <th>Allocated Engineer</th>
                                    <th>Status</th>
                                    <th>Recived Date</th>
                                    <th>Select Site</th>
                                </tr>
                                @php $i = 0; @endphp
                                @foreach ($siteData as $res)
                                    @php $i = $i+1;  @endphp
                                    @if ($i <= $noVendorSite)
                                        @for ($j = 0; $j < $totalSite; $j++)
                                            @if ($vendorSite[$i - 1]->site_id == $siteData[$j]->count_id)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td class="ask_t">{{ $siteData[$j]->site_id }}</td>
                                                    <td class="ask_td">{{ $siteData[$j]->site_circle_office }}</td>
                                                    <td class="ask_td">{{ $siteData[$j]->site_add_w_pincode }}</td>
                                                    <td>NA</td>
                                                    <td>{{ $siteData[$j]->date }}</td>
                                                    <td>{{ $siteData[$j]->end_date }}</td>
                                                    <td>{{ $siteData[$j]->priority }}</td>
                                                    <td>
                                                        @if ($siteData[$j]->UserName)
                                                            {{ $siteData[$j]->UserName }}
                                                            @else
                                                            NA
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($siteData[$j]->status)
                                                            {{ $siteData[$j]->status }}
                                                            @else
                                                            NA
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <input id="recDate_{{ $i }}" class="rec_date"
                                                            type="date" name="rec_date">
                                                    </td>
                                                    <td>
                                                        <input id="confirmcheck_{{ $i }}" class="confirmcheck"
                                                            value="{{ $siteData[$j]->site_id }}" type="checkbox"
                                                            name="confirmcheck" style="height: 25px; width: 25px;">
                                                    </td>
                                                </tr>
                                            @endif
                                        @endfor
                                    @endif
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
                // let now = new Date();
                // let day = ("0" + now.getDate()).slice(-2);
                // let month = ("0" + (now.getMonth() + 1)).slice(-2);
                // let today = (day)+"-"+(month)+"-"+ now.getFullYear();
                // var totalcount = $('.confirmcheck').length;
                // var datetoday = [];
                // for (let i = 1; i <= totalcount; i++) {
                //     var reqdate = "#recDate_".concat(i);
                //     datetoday.push($(reqdate).val(today));
                // }


            $('body').on('click', '#reqConfirmItemList', function() {

                var totalcount = $('.confirmcheck').length;
                var totaldate = $('.rec_date').length;
                var datearray = [];
                var dataarray = [];
                for (let i = 1; i <= totalcount; i++) {
                    var reqsend = "#confirmcheck_".concat(i);
                    var reqdate = "#recDate_".concat(i);
                    if ($(reqsend).is(":checked") != false) {
                        dataarray.push($(reqsend).val());
                        datearray.push($(reqdate).val());
                    } else {
                        //dataarray = null;
                    }
                }
                $.ajax({
                    type: 'POST',
                    url: 'ajax-vendor-confirm-site-list',
                    data: {
                        "confirmcheckData": dataarray,
                        "date" : datearray,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {

                    }
                });
            });
        });
    </script>
@endsection
