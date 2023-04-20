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
                        <h4 class="card-title">Site Create</h4>

                        <form class="form-sample" action="{{ route('site.add') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <p class="card-description">
                                Site Create
                            </p>
                            <div class="row">
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
                                      <label class="col-sm-3 col-form-label">Item Name</label>
                                      <div class="col-sm-9">

                                        <select class="form-control" value="{{ old('item_id') }}" name="item_id">
                                          <option value="">---Select Staff---</option>
                                          <option value="1" <?php if(old('item_id') == 1){ echo 'selected'; } ?>>fasd</option>
                                          <option value="2" <?php if(old('item_id') == 2){ echo 'selected'; } ?>>fadsf</option>
                                          <option value="3" <?php if(old('item_id') == 3){ echo 'selected'; } ?>>fads</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">Batch Name</label>
                                      <div class="col-sm-9">

                                        <select class="form-control" value="{{ old('batch_id') }}" name="batch_id">
                                          <option value="">---Select Staff---</option>
                                          <option value="1" <?php if(old('batch_id') == 1){ echo 'selected'; } ?>>B-001</option>
                                          <option value="2" <?php if(old('batch_id') == 2){ echo 'selected'; } ?>>B-002</option>
                                          <option value="3" <?php if(old('batch_id') == 3){ echo 'selected'; } ?>>B-003</option>
                                        </select>
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

