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

    <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Create New User</h4>
            <form class="form-sample" action="{{ route('create-user') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <p class="card-description">
                Personal Info
              </p>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">User Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="user_name" value="{{ old('user_name') }}" placeholder="Enter User Name" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Type of Staff</label>
                    <div class="col-sm-9">

                      <select class="form-control" value="{{ old('staff_type') }}" name="staff_type">
                        <option value="">---Select Staff---</option>
                        <option value="1" <?php if(old('staff_type') == 1){ echo 'selected'; } ?>>Admin</option>
                        <option value="2" <?php if(old('staff_type') == 3){ echo 'selected'; } ?>>Vendor</option>
                        <option value="3" <?php if(old('staff_type') == 2){ echo 'selected'; } ?>>Officer</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Id Number</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="id_no" value="{{ old('id_no') }}" placeholder="Enter Id Number" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Role</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="role_type">
                        <option value="">---Select Role---</option>
                        <option value="2" <?php if(old('role_type') == 2){ echo 'selected'; } ?>>View</option>
                        <option value="3" <?php if(old('role_type') == 3){ echo 'selected'; } ?>>Update</option>
                        <option value="1" <?php if(old('role_type') == 1){ echo 'selected'; } ?>>Admin</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="exampleInputEmail1" class="col-sm-3 col-form-label">Email address</label>
                    <div class="col-sm-9">
                      <input type="email" class="form-control" name="user_email" value="{{ old('user_email') }}" id="exampleInputEmail1" placeholder="Enter Email" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="exampleInputEmail1" class="col-sm-3 col-form-label">Contact No</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" name="user_no" value="{{ old('user_no') }}" id="exampleInputEmail1" placeholder="Enter Email" />
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
              <button type="submit" name="submit" value="user" class="btn btn-primary mr-2">Submit</button>
            <button class="btn btn-light">Cancel</button>
            </form>
          </div>
        </div>
      </div>
    </div>


@endsection

