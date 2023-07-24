@extends('layouts.app')
@section('content')

    <style>
        /* .item-list-batch {
        margin: 10px 00px 00px 12px;
        }
        .card-title{
        align-content: center;
        }

        [type='checkbox'] {
        position: absolute;
        height: 25px;
        width: 25px;
        background-color: #eee;
        } */
        /* .card-body{
            overflow: scroll;
        } */

        .customfieldappend td button {
            margin: 0px -30px 0px 0px
        }

        .btnmargin {
            margin: 0px 0px 8px 1326px;
        }

        .submitbtn {
            margin: 0px 0px 8px 1226px;
        }
    </style>

    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="card-title" style="font-size: 30px;">Update Sites allocated to Engineer</h4>
                            <div class="row">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-0">

                                </div>
                                <div class="col-sm-1"></div>
                                <div class="dropdown">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2"></div>
                        <div class="col-sm-4">
                        </div>
                    </div>

                    <div class="table-responsive pt-3">
                        <table class="table table-bordered display nowrap" id="example" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Vendor Name</th>
                                    <th>Site Name</th>
                                    <th>Engineer Name</th>
                                    <th>Priority</th>
                                    <th>Status</th>
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
                                        <th>{{ $i }}</th>
                                        <td class="ask_td">{{ $res->vendor_id }}</td>
                                        <td class="ask_td">{{ $res->site_id }}</td>
                                        <td class="ask_td">{{ $res->engineer_name }}</td>
                                        <td class="ask_td">{{ $res->priority }}</td>
                                        <td class="ask_td">
                                            @if ($res->status == 1)
                                                Active
                                            @else
                                                Deactive
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>



                    <div class="col-md-10 dynamic-field ask_dynamic_field" id="dynamic-field-1" style="display:none">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Item</label>
                                    <div class="col-sm-9">
                                        <select id="itemName2" class="form-control itemName2"
                                            value="{{ old('batch_name') }}" name="batch_name[]">
                                            <option value="0">---Select Item---</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Qty</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="qty[]" id="exampleInputEmail2"
                                            placeholder="qty">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Serial</label>
                                    <div class="col-sm-9">
                                        <select class="form-control SerialNameASK" value="{{ old('batch_name') }}"
                                            name="site_name">
                                            <option value="0">---Select Serial No---</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive pt-3">

                        <div class="card" id="addrowappend">


                                <table class="table table-bordered display nowrap" id="example" style="width:156%">
                                    <thead>
                                        <tr>
                                            <th>Work Activity</th>
                                            <th>Actual Start Date</th>
                                            <th>Actual End Date</th>
                                            <th>Testing Document</th>
                                            <th>Site Photo</th>
                                            <th style="width:15%">Status</th>
                                            <th>Remark</th>
                                            {{-- <th colspan="2"></th> --}}
                                        </tr>
                                    </thead>

                                    <tbody class="tbody">
                                        <div class="col-md-10 dynamic-field ask_dynamic_field" id="dynamic-field-1"
                                            style="display:block">
                                            <div class="row append_parity_row">
                                                @if ($readData)
                                                @php
                                                    $i=0;
                                                @endphp



                                                    @foreach ($readData as $resData)

                                                    {{-- {{ $res->countrow }} --}}
                                                    {{-- @foreach ($res->work_activity as $resdata) --}}
                                                    @php
                                                    $i++;
                                                    @endphp


                                                    @for ($j = 0; $j < $resData->countrow; $j++)

                                                    <tr class="customfield_1 appendask appendask_{{$i}}" id="appendask">
                                                        <td style="width: 25%;" class="append_parity_colmn1"
                                                            id="append_parity_colon1">
                                                            <select id="itemName2" class="form-control itemName2"
                                                                value="{{ old('work_activity') }}" name="work_activity[]">
                                                                <option value="0">---Select Work Activity---</option>
                                                                @foreach ($workData as $workdata)
                                                                @if($workdata->id == $resData->work_activity[$j])
                                                                <option value="{{ $workdata->id }}"
                                                                    class="dropdown-item" selected>{{ $workdata->work_name }}
                                                                </option>
                                                                @else
                                                                <option value="{{ $workdata->id }}"
                                                                    class="dropdown-item">{{ $workdata->work_name }}
                                                                </option>
                                                                @endif

                                                                @endforeach
                                                            </select>
                                                            <select value="{{ old('work_act') }}" name="work_act[]"
                                                                style="visibility: hidden;">
                                                                <option value="0" selected></option>
                                                            </select>
                                                        </td>
                                                        <input type="hidden" name="allarray[]" value="0">
                                                        <td class="append_parity_colmn2" id="append_parity_colon2">
                                                            <input type="date" class="form-control" name="s_date[]"
                                                                id="exampleInputEmail2" placeholder="qty" value='{{ $resData->s_date[$j] }}' readonly>
                                                        </td>
                                                        <td class="append_parity_colmn3" id="append_parity_colon3">
                                                            <input type="date" class="form-control" name="e_date[]"
                                                                id="exampleInputEmail2" placeholder="qty" value='{{ $resData->e_date[$j] }}' readonly>
                                                        </td>
                                                        <td style="width: 20%;" class="append_parity_colmn4"
                                                            id="append_parity_colon4">
                                                            <input type="file" class="form-control" name="document[]"
                                                                id="exampleInputEmail2" placeholder="qty" value='{{ url($resData->document_filepath[0]) }}'>
                                                        </td>
                                                        <td style="width: 20%;">
                                                            <a href="{{ url($resData->sitepic_filepath[0]) }}">
                                                                <img src="{{ url($resData->sitepic_filepath[0]) }}" alt="" srcset=""></a>

                                                            {{-- <input type="file" class="form-control" name="sitepic[]"
                                                                id="exampleInputEmail2" placeholder="qty" value='{{ url($resData->sitepic_filepath[0]) }}'> --}}
                                                        </td>
                                                        <td style="width: 25%;">
                                                            <select class="form-control SerialNameASK"
                                                                value="{{ old('status') }}" name="status[]">
                                                                <option value="0">---Select Status---</option>
                                                                @foreach ($site_status as $res)
                                                                @if($res->id == $resData->status[$j])
                                                                <option value="{{ $res->id }}"
                                                                    class="dropdown-item" selected>{{ $res->name }}
                                                                </option>
                                                                @else
                                                                <option value="{{ $res->id }}"
                                                                    class="dropdown-item">{{ $res->name }}
                                                                </option>
                                                                @endif

                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td style="width: 15%;"><input type="text"
                                                                class="form-control" name="remark[]"
                                                                id="exampleInputEmail2" placeholder="remark" value='{{ $resData->remark[$j] }}' readonly></td>
                                                    </tr>
{{-- {{ $res->s_date[0] }} --}}

                                                    @endfor



                                                    {{-- @endforeach --}}

                                                    @endforeach
                                                @else
                                                    Error
                                                @endif
                                                {{-- @foreach ($readData as $res) --}}
                                                {{-- <tr class="customfield_1 appendask appendask_1" id="appendask">
                                                    <td style="width: 25%;" class="append_parity_colmn1"
                                                        id="append_parity_colon1">
                                                        <select id="itemName2" class="form-control itemName2"
                                                            value="{{ old('work_activity') }}" name="work_activity[]">
                                                            <option value="0">---Select Work Activity---</option>
                                                            @foreach ($workData as $workdata)
                                                                <option value="{{ $workdata->id }}"
                                                                    class="dropdown-item">{{ $workdata->work_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <select value="{{ old('work_act') }}" name="work_act[]"
                                                            style="visibility: hidden;">
                                                            <option value="0" selected></option>
                                                        </select>
                                                    </td>
                                                    <input type="hidden" name="allarray[]" value="0">
                                                    <td class="append_parity_colmn2" id="append_parity_colon2">
                                                        <input type="date" class="form-control" name="s_date[]"
                                                            id="exampleInputEmail2" placeholder="qty">
                                                    </td>
                                                    <td class="append_parity_colmn3" id="append_parity_colon3">
                                                        <input type="date" class="form-control" name="e_date[]"
                                                            id="exampleInputEmail2" placeholder="qty">
                                                    </td>
                                                    <td style="width: 20%;" class="append_parity_colmn4"
                                                        id="append_parity_colon4">
                                                        <input type="file" class="form-control" name="document[]"
                                                            id="exampleInputEmail2" placeholder="qty">
                                                    </td>
                                                    <td style="width: 20%;">
                                                        <input type="file" class="form-control" name="sitepic[]"
                                                            id="exampleInputEmail2" placeholder="qty">
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <select class="form-control SerialNameASK"
                                                            value="{{ old('status') }}" name="status[]">
                                                            <option value="0">---Select Status---</option>
                                                            @foreach ($site_status as $res)
                                                                <option value="{{ $res->id }}"
                                                                    class="dropdown-item">{{ $res->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td style="width: 15%;"><input type="text" class="form-control"
                                                            name="remark[]" id="exampleInputEmail2" placeholder="remark">
                                                    </td>
                                                </tr> --}}
                                                {{-- @endforeach --}}
                                                <div class="col-8"></div>

                                            </div>
                                        </div>
                                    </tbody>
                                </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
