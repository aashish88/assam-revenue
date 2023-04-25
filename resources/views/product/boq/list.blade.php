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
                        <h4>Site List:</h4>
                        <div class="row">
                            <table class="table table-striped">
                                <tr>
                                    <th>#</th>
                                    <th>Item Name</th>
                                    <th>Item Description</th>
                                    <th>QTY</th>
                                    <th>UOM</th>
                                    <th>OEM</th>
                                    <th>Batch Id</th>
                                    <th>Site Id</th>
                                    <th>Store Manager</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                @php $i = 0; @endphp
                                @foreach ($product_data as $res)
                                @php $i = $i+1;  @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td class="ask_td">{{ $res->item_title }}</td>
                                    <td class="ask_td">{{ $res->item }}</td>
                                    <td>{{ $res->qty }}</td>
                                    <td>{{ $res->uom }}</td>
                                    <td>{{ $res->oem }}</td>
                                    <td>{{ $res->batch_id }}</td>
                                    <td>{{ $res->site_id }}</td>
                                    <td>{{ $res->store_manager }}</td>

                                    {{-- <td>{{ __('Item-00') }}{{$res->item_id }}</td>
                                    <td>{{ __('S-') }}{{$res->site_id }}</td>
                                    <td>{{ __('B-00') }}{{$res->batch_id }}</td> --}}
                                    <td>Active</td>
                                    <td style="font-size: 30px;">
                                        <a href="{{ url('boq-edit') }}/{{$res->id }}" style="color: hsl(207, 78%, 53%);"><i class="mdi mdi-tooltip-edit"></i></a> | <a href="{{ url('boq-delete') }}/{{$res->id }}" style="color: #DC3545;"><i class="mdi mdi-delete-forever"></i></a>
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
@endsection

