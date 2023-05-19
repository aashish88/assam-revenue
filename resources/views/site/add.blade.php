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
                        <h4 class="card-title">{{ __('Site Create') }}</h4>
                        <p class="card-description">
                            {{ __('Site Create') }}
                        </p>


                        <form class="form-sample" action="{{ route('site.add') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Site ID</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="site_ID" value="{{ old('site_ID') }}" placeholder="Enter Site Name" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Site Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="site_name" value="{{ old('site_name') }}" placeholder="Enter Site Name" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Site Address</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="site_address" value="{{ old('site_address') }}" placeholder="Enter Site Name" />
                                        </div>
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">Site Officer</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" name="site_officer" value="{{ old('site_officer') }}" placeholder="Enter Site Name" />
                                        </div>
                                    </div>
                                  </div>
                                </div>






                                <div class="row">


                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">{{ __(' Site Engineer') }}</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="site_engineer" value="{{ old('site_engineer') }}" placeholder="Enter Site Name" />
                                            </div>
                                        </div>
                                    </div>





                                  <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">{{ __('Priority') }}</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="priority" value="{{ old('priority') }}" placeholder="Enter Site Name" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">Status</label>
                                      <div class="col-sm-9">
                                        <select class="form-control" name="status" id="status">
                                          <option value="">---Select Status---</option>
                                          <option value="1" <?php if(old('status') == 1){ echo 'selected'; } ?>>Active</option>
                                          <option value="2" <?php if(old('status') == 2){ echo 'selected'; } ?>>Deactive</option>
                                          {{-- <option value="3">Delete</option> --}}
                                        </select>
                                      </div>
                                    </div>
                                  </div>

                                </div>
                                <button type="submit" name="submit" value="site_add" class="btn btn-primary mr-2">Submit</button>
                              <button class="btn btn-light">Cancel</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

