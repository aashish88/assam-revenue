@extends('layouts.app')
@section('content')

<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body,
button {
  font-family: "Inter", sans-serif;
  color: #343a40;
  line-height: 1;
}

.pagination,
.page-numbers {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
}

.pagination {
  margin-top: 5px;
}

.btn-nav,
.btn-page {
  border-radius: 50%;
  background-color: #fff;
  cursor: pointer;
}

.btn-nav {
  padding: 5px;
}

.btn-nav {
  width: 42px;
  height: 42px;
  border: 1.5px solid #087f5b;
  color: #087f5b;
}

.btn-nav:hover,
.btn-page:hover {
  background-color: #087f5b;
  color: #fff;
}

.btn-page {
  border: none;
  width: 36px;
  height: 36px;
  font-size: 16px;
}

.btn-selected {
  background-color: #087f5b;
  color: #fff;
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
                    <div class="card-body">
                        <h4>Site List:</h4>
                        <div class="row">
                            <table class="table table-striped">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Site Name') }}</th>
                                    <th>Site Address</th>
                                    <th>Site Officer</th>
                                    <th>{{ __('Site Engineer') }}</th>
                                    <th>Work Start Date</th>
                                    <th>Work End Date</th>
                                    <th>Priority</th>
                                    {{-- <th>Allocated Engineer</th> --}}
                                    <th>Status</th>
                                </tr>
                                @php
                                    $i = 0;
                                @endphp
                            @foreach ($sitedata as $res)
                            @php
                                $i++;
                            @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{$res->site_id }}</td>
                                    <td>{{ $res->dst_head_quert}}</td>
                                    <td>{{$res->id }}</td>
                                    <td></td>
                                    <td></td>
                                    <td>{{$res->priority }}</td>
                                    <td>{{ $res->status }}</td>

                                    {{-- <td style="font-size: 30px;">
                                        <a href="{{ url('site-edit') }}/{{$res->id }}" style="color: hsl(207, 78%, 53%);"><i class="mdi mdi-tooltip-edit"></i></a> | <a href="{{ url('site-delete') }}/{{$res->id }}" style="color: #DC3545;"><i class="mdi mdi-delete-forever"></i></a>
                                    </td> --}}
                                </tr>
                            @endforeach


                            </table>

{{-- pagination --}}
<!--
<div class="pagination">
    <button class="btn-nav left-btn">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="left-icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
        </svg>
    </button>
    <div class="page-numbers">
        <button class="btn-page">1</button>
        <button class="btn-page">2</button>
        <button class="btn-page btn-selected">3</button>
        {{-- <button class="btn-page">4</button>
        <button class="btn-page">5</button>
        <button class="btn-page">6</button>
        <span class="dots">...</span>
        <button class="btn-page">23</button> --}}
    </div>
    <button class="btn-nav right-btn">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="right-icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
        </svg>
    </button>
</div> -->
{{-- end pagination --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

