@extends('layouts.app')
@section('content')
{{-- <style>
    .item-list-batch {
        margin: 10px 00px 00px 12px;
    }
    .card-title{
        /*background: rgb(119, 185, 216);*/
    align-content: center;
    margin: 15px 1px 1px 143px;
    }

    .ajaxitemheader{
        text-align: justify;
        font-size: 18px;
    }
</style> --}}
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
            <h4 class="card-title">Upload Test Report</h4>
            <form class="form-sample" action="{{ route('post-vendor-site') }}" method="POST" enctype="multipart/form-data">
              @csrf
              {{-- <p class="card-description">
                Personal Info
              </p> --}}
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Vendor Name</label>
                    <div class="col-sm-9">
                        <select class="form-control" value="{{ old('vendor_name') }}" name="vendor_name">
                            <option value="">---Select Vendor---</option>
                            @foreach ($vendors as $res)
                            <option value="{{ $res->id }}" <?php if(old('vendor_name') == 1){ echo 'selected'; } ?>>{{ $res->name }}</option>
                            @endforeach

                        </select>
                    </div>
                  </div>
                </div>
                    <div class="col-md-6">

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Site ID <i style="color: red; font-size: 20px">*</i></label>
                            <div class="col-sm-9">
                                {{-- <select class="form-control js-example-basic-multiple" value="{{ old('site_id') }}" name="site_id[]" multiple="multiple">
                                    <option value="">---Select Site---</option>
                                    @foreach ($siteData as $res)
                                    <option value="{{$res->id}}" <?php if(old('site_id') == 1){ echo 'selected'; } ?>>{{$res->name}}</option>
                                    @endforeach

                                </select> --}}
                            </div>
                        </div>
                    </div>
              </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Start Date</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="date" value="{{ old('date') }}" placeholder="01/01/1900" />
                            </div>
                        </div>
                    </div>



                    <div class="col-md-6">
                        <div class="form-group row">
                        <label class="col-sm-3 col-form-label">End Date</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="end_date" value="{{ old('end_date') }}" placeholder="01/01/1900" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Priority</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="priority">
                                    <option value="">---Select Role---</option>
                                    <option value="2" <?php if(old('priority') == 1){ echo 'selected'; } ?>>1</option>
                                    <option value="3" <?php if(old('priority') == 2){ echo 'selected'; } ?>>2</option>
                                    <option value="1" <?php if(old('priority') == 3){ echo 'selected'; } ?>>3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" name="submit" value="vendor-site" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
          </div>
        </div>
      </div>
    </div>


@endsection
