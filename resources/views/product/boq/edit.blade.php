@extends('layouts.app')
@section('content')
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
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">BOQ EDIT:</h4>

                        <form class="form-sample" action="{{ route('boq.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$id}}">
                            <p class="card-description">
                                BOQ Edit
                            </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Item Title</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="item_title" value="{{$product_data->item_title}}" placeholder="Enter Site Name" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Item</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="item" value="{{$product_data->item}}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Quantity</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="qty" value="{{$product_data->qty}}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">UOM</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="uom" value="{{$product_data->uom}}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">OEM</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="oem" value="{{$product_data->oem}}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Batch</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="batch_id" value="{{$product_data->batch_id}}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Site ID</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="site_id" value="{{$product_data->site_id}}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Store Manager</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="store_manager" value="{{$product_data->store_manager}}" />
                                        </div>
                                    </div>
                                </div>




                                <button type="submit" name="submit" value="boq_update" class="btn btn-primary mr-2">Submit</button>
                              <button class="btn btn-light">Cancel</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

