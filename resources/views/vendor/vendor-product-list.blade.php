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
                    <div class="card-body" style="overflow: scroll;">
                        <h4>Allocated Site List</h4>
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
                                </tr>
                                @php $i = 0; @endphp
                                @foreach ($siteData as $res)
                                {{-- @php $i++; @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td class="ask_t">{{ $res->site_id }}</td>
                                    <td class="ask_td">{{ $res->site_circle_office }}</td>
                                    <td class="ask_td">{{ $res->site_add_w_pincode }}</td>
                                    <td>NA</td>
                                    <td>{{ $res->date }}</td>
                                    <td>{{ $res->end_date }}</td>
                                    <td>{{ $res->priority }}</td>
                                    <td>@if ($res->UserName)
                                        {{ $res->UserName }}
                                        @else
                                        NA
                                    @endif</td>
                                    <td>
                                        @if ($res->status)
                                        {{ $res->status }}
                                        @else
                                            NA
                                        @endif
                                    </td>
                                </tr> --}}

                                @php $i = $i+1; @endphp
                                    @if ($i <= $noVendorSite)
                                        @for ($j = 0; $j < $totalSite; $j++)

                                            @if ($vendorSite[$i-1]->site_id == $siteData[$j]->count_id)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td class="ask_t">{{ $siteData[$j]->site_id }}</td>
                                                    <td class="ask_td">{{ $siteData[$j]->site_circle_office }}</td>
                                                    <td class="ask_td">{{ $siteData[$j]->site_add_w_pincode }}</td>
                                                    <td>NA</td>
                                                    <td>{{ $siteData[$j]->date }}</td>
                                                    <td>{{ $siteData[$j]->end_date }}</td>
                                                    <td>{{ $siteData[$j]->priority }}</td>
                                                    <td>@if ($siteData[$j]->UserName)
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
@endsection

