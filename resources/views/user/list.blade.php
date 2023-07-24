@extends('layouts.app')
@section('content')
    <div class="content-wrapper">

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Table User List</h4>
                    <p class="card-description">
                        Table <code>User List</code>
                    </p>
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact No.</th>
                                    <th>Status</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>

                                @php $i = 0; @endphp
                                @foreach ($userData as $res)
                                    @php $i++; @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $res->name }}</td>
                                        <td> {{ $res->email }}</td>
                                        <td>{{ $res->contect_no }}</td>
                                        <td><a href="{{ url('change-role') }}\{{ $res->id }}">
                                                @if ($res->status == 1)
                                                    Active
                                                @elseif ($res->status == 0)
                                                    Deactive
                                                @else
                                                    Active
                                                @endif
                                            </a></td>
                                        {{-- <td><i class="mdi mdi-rename-box"></i> | <i class="mdi mdi-delete"></i>

                    </td> --}}
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- end --}}

        <!-- Trigger the modal with a button -->
        @if ($title == 'model')
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
        @endif

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Modal Header</h4>
                        {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
                    </div>
                    <div class="modal-body">
                        <p>Some text in the modal.</p>
                    </div>
                    @if ($title == 'testing')
                        <form action="{{ route('create_modal') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-8">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="status" id="status">
                                            <option value="">---Select Status---</option>
                                            <option value="1" <?php //if(old('status') == 1){ echo 'selected'; }
                                            ?>>Active</option>
                                            <option value="2" <?php// if(old('status') == 2){ echo 'selected'; } ?> ?>>Deactive</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="submit" value="submit"
                                    class="btn btn-primary mr-2">Submit</button>

                            </div>
                        </form>
                    @endif
                </div>

            </div>
        </div>

    </div>
@endsection
