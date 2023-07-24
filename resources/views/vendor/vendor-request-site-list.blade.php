@extends('layouts.app')
@section('content')
    <style>
        .item-list-batch {
            margin: 10px 00px 00px 12px;
        }

        .card-title {
            align-content: center;
            margin: 15px 1px 1px 143px;
        }

        [type='checkbox'] {
            position: inherit;
            height: 25px;
            width: 25px;
            background-color: #eee;
            margin: -12px 00px 00px 00px;
        }
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
                                <h4>Allocated Site List</h4>
                            </div>
                            <div class="col-sm-5"></div>
                            <div class="col-sm-3">
                                <p id="reqSendStoreSubmit" class="btn btn-info btn-rounded mr-2" style="font-size: 22px;">Request Site Items</p>
                            </div>
                        </div>

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
                                    <th>Select Site</th>
                                </tr>
                                @php $i = 0; @endphp
                                @foreach ($siteData as $res)
                                    @php $i = $i+1;  @endphp
                                    @if ($i <= $noVendorSite)
                                        @for ($j = 0; $j < $totalSite; $j++)
                                            @if ($vendorSite[$i-1]->site_id == $siteData[$j]->count_id)
                                                <tr class="devel-generate-content">
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
                                                        @endif</td>
                                                    <td>
                                                        @if ($siteData[$j]->status)
                                                            {{ $siteData[$j]->status }}
                                                        @else
                                                            NA
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <input id="reqSendStroe_{{ $i }}" type="checkbox"
                                                            value="{{ $res->site_id }}" name="reqSendStore" class="reqSendStore">
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
            $('body').on('click', '#reqSendStoreSubmit', function() {
                var totalcount = $('.reqSendStore').length;
                var dataarray = [];
                for (let i = 1; i <= totalcount; i++) {
                    var reqsend = "#reqSendStroe_".concat(i);
                    //var $checkboxes = $('.devel-generate-content td input[type="checkbox"]');
                    //alert($checkboxes.filter(':checked').length);
                    if ($(reqsend).is(":checked") != false) {
                        dataarray.push($(reqsend).val());
                    }else{
                        //dataarray = null;
                    }
                }
                $.ajax({
                    type:'POST',
                    url:'ajax-vendor-request-site-list-send-store-officer',
                    data:{"checkData" : dataarray, _token: '{{csrf_token()}}'},
                    success:function(response) {
                        window.location.replace("http://assam-revenue.parityinfotech.in/vendor-request-site-list");
                        console.log(response);
                    }
                });
            });
        });


    </script>
@endsection
