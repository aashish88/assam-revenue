<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ session('title') }}</title>
    <link rel="stylesheet" href="{{ asset('public/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('public/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('public/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/vertical-layout-light/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />

    <link rel="stylesheet" href="{{ asset('public/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('public/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
    {{-- <script src="https://code.jquery.com/jquery-3.6.4.js"></script> --}}

    <script src="{{ asset('public/jquery3.js') }}"></script>
    <style>
        thead,
        tbody,
        .content-center {
            text-align: center;
        }

        .navbar {
            border-bottom: 0px solid #ffffff;
        }

        .navbar .navbar-brand-wrapper {
            background: #32c0c0;

        }

        .brand-logo-mini {
            width: 300px;
        }

        /* .text-center p {
      display: contents;
    } */

        .sub-menu .nav-item {
            margin: -15px 0px 0px 15px;
        }

        .row .col-sm-4 h4 {
            font-size: 24px;
            margin: 00 00 00;
            border: 0px;
            display: contents;
        }

        .headertext {
            font-size: 35px;
            background: aliceblue;
            text-decoration: underline;
            text-decoration-color: #087f5b;
            text-shadow: 2px 2px #dacfcf;
        }

        .table th,
        .table tr .ask_td {
            white-space: inherit;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex justify-content-center sucess">
                <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
                    <a class="navbar-brand brand-logo" href="#"><img
                            src="{{ asset('public/images/parity.png') }}" alt="logo" /></a>
                    <a class="navbar-brand brand-logo-mini" href="#"><img
                            src="{{ asset('public/images/logo-mini.svg') }}" alt="logo" /></a>
                    {{-- <a class="navbar-brand brand-logo-mini" href="#"><img src="{{ asset('images/logo-mini.svg') }}" alt="logo"/></a> --}}
                    {{-- <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="typcn typcn-th-menu"></span>
                  </button> --}}
                </div>
            </div>

            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
                            <img src="{{ asset('public/profile.jpg') }} " alt="profile" />
                            <span class="nav-profile-name">{{ session('user_name') }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <a class="dropdown-item">
                                <i class="typcn typcn-cog-outline text-primary"></i>
                                Settings
                            </a>
                            <a class="dropdown-item">
                                <i class="typcn typcn-eject text-primary"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                    <li class="nav-item nav-user-status dropdown">
                        <p class="mb-0">Last login was {{ session('login_id') }} ago.</p>
                    </li>
                </ul>

                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-date dropdown">
                        <a class="nav-link d-flex justify-content-center align-items-center" href="javascript:;">
                            <h6 class="date mb-0">Today : {{ session('date_today') }} </h6>
                            <i class="typcn typcn-calendar"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center"
                            id="messageDropdown" href="#" data-toggle="dropdown">
                            <i class="typcn typcn-cog-outline mx-0"></i>
                            <span class="count"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                            aria-labelledby="messageDropdown">
                            {{-- <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p> --}}
                            <a class="dropdown-item preview-item" href="{{ route('logout') }}">
                                <div class="preview-thumbnail">

                                    <img src="{{ asset('public/logout_icon.png') }}" alt="image"
                                        class="profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow">
                                    <h6 class="preview-subject ellipsis font-weight-normal"> Logout
                                    </h6>
                                    <p class="font-weight-light small-text text-muted mb-0">

                                    </p>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown mr-0">
                        <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center"
                            id="notificationDropdown" href="#" data-toggle="dropdown">
                            <i class="typcn typcn-bell mx-0"></i>
                            <span class="count"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                            aria-labelledby="notificationDropdown">
                            <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-success">
                                        <i class="typcn typcn-info mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">Application Error</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        Just now
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-warning">
                                        <i class="typcn typcn-cog-outline mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">Settings</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        Private message
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-info">
                                        <i class="typcn typcn-user mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">New user registration</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        2 days ago
                                    </p>
                                </div>
                            </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="typcn typcn-th-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        {{-- <nav class="navbar-breadcrumb col-xl-12 col-12 d-flex flex-row p-0">
                <div class="navbar-links-wrapper d-flex align-items-stretch">
                    <div class="nav-link">
                        <a href="javascript:;"><i class="typcn typcn-calendar-outline"></i></a>
                    </div>
                    <div class="nav-link">
                        <a href="javascript:;"><i class="typcn typcn-mail"></i></a>
                    </div>
                    <div class="nav-link">
                        <a href="javascript:;"><i class="typcn typcn-folder"></i></a>
                    </div>
                    <div class="nav-link">
                        <a href="javascript:;"><i class="typcn typcn-document-text"></i></a>
                    </div>
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                    <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item ml-0">
                        <h4 class="mb-0">{{ __('Dashboard') }}</h4>
                    </li>
                    <li class="nav-item">
                        <div class="d-flex align-items-baseline">
                        <p class="mb-0">{{ __('Home') }}</p>
                        <i class="typcn typcn-chevron-right"></i>
                        <p class="mb-0">
                        @if (session('title') == 'Admin')
                        {{ __('Admin Dashboard') }}
                        @elseif(session('title') == 'Officer')
                        {{ __('Officer Dashboard') }}
                        @elseif(session('title') == 'Vendor')
                        {{ __('Vendor Dashboard') }}
                        @elseif(session('title') == 'Engineer')
                        {{ __('Engineer Dashboard') }}
                        @elseif(session('title') == 'Site Officer')
                        {{ __('Site Officer Dashboard') }}
                        @endif
                        </p>
                        </div>
                    </li>
                    </ul>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item nav-search d-none d-md-block mr-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search..." aria-label="search" aria-describedby="search">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="search">
                                    <i class="typcn typcn-zoom"></i>
                                    </span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav> --}}

        <div class="container-fluid page-body-wrapper">

            @if (session('title') == 'Admin')
                <div class="theme-setting-wrapper">
                    <div id="settings-trigger"><i class="typcn typcn-cog-outline"></i></div>
                    <div id="theme-settings" class="settings-panel">
                        <i class="settings-close typcn typcn-times"></i>
                        <p class="settings-heading">SIDEBAR SKINS</p>
                        <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                            <div class="img-ss rounded-circle bg-light border mr-3">
                            </div>Light
                        </div>
                        <div class="sidebar-bg-options" id="sidebar-dark-theme">
                            <div class="img-ss rounded-circle bg-dark border mr-3">
                            </div>Dark
                        </div>
                        <p class="settings-heading mt-2">HEADER SKINS</p>
                        <div class="color-tiles mx-0 px-4">
                            <div class="tiles success"></div>
                            <div class="tiles warning"></div>
                            <div class="tiles danger"></div>
                            <div class="tiles info"></div>
                            <div class="tiles dark"></div>
                            <div class="tiles default"></div>
                        </div>
                    </div>
                </div>
            @endif


            <div id="right-sidebar" class="settings-panel">
                <i class="settings-close typcn typcn-times"></i>
                <ul class="nav nav-tabs" id="setting-panel" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section"
                            role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab"
                            aria-controls="chats-section">CHATS</a>
                    </li>
                </ul>
                <div class="tab-content" id="setting-content">
                    <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel"
                        aria-labelledby="todo-section">
                        <div class="add-items d-flex px-3 mb-0">
                            <form class="form w-100">
                                <div class="form-group d-flex">
                                    <input type="text" class="form-control todo-list-input"
                                        placeholder="Add To-do">
                                    <button type="submit" class="add btn btn-primary todo-list-add-btn"
                                        id="add-task">Add</button>
                                </div>
                            </form>
                        </div>

                    </div>
                    <!-- To do section tab ends -->
                    <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
                        <div class="d-flex align-items-center justify-content-between border-bottom">
                            <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
                            <small
                                class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See
                                All</small>
                        </div>
                        <ul class="chat-list">
                            <li class="list active">
                                <div class="profile"><img src="{{ asset('images/faces/face1.jpg') }}"
                                        alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Thomas Douglas</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">19 min</small>
                            </li>
                            {{-- <li class="list">
                      <div class="profile"><img src="{{ asset('images/faces/face2.jpg') }}" alt="image"><span class="offline"></span></div>
                      <div class="info">
                        <div class="wrapper d-flex">
                          <p>Catherine</p>
                        </div>
                        <p>Away</p>
                      </div>
                      <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                      <small class="text-muted my-auto">23 min</small>
                    </li> --}}
                            <li class="list">
                                <div class="profile"><img src="{{ asset('images/faces/face3.jpg') }}"
                                        alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Daniel Russell</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">14 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="{{ asset('images/faces/face4.jpg') }}"
                                        alt="image"><span class="offline"></span></div>
                                <div class="info">
                                    <p>James Richardson</p>
                                    <p>Away</p>
                                </div>
                                <small class="text-muted my-auto">2 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="{{ asset('images/faces/face5.jpg') }}"
                                        alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Madeline Kennedy</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">5 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="{{ asset('images/faces/face6.jpg') }}"
                                        alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Sarah Graves</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">47 min</small>
                            </li>
                        </ul>
                    </div>
                    <!-- chat tab ends -->
                </div>
            </div>
            <!-- partial -->
            {{-- Admin Dashboard Start --}}
            @if (session('title') == 'Admin')
                <!--Admin sidebar start-->
                <nav class="sidebar sidebar-offcanvas" id="sidebar">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="typcn typcn-device-desktop menu-icon"></i>
                                <span class="menu-title">{{ __('Admin Dashboard') }}</span>
                                {{-- <div class="badge badge-danger">{{ __('new') }}</div> --}}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                                aria-controls="ui-basic">
                                <i class="menu-icon mdi mdi-account-multiple"></i>
                                <span class="menu-title">{{ __('User Creation') }}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-basic">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('user.list') }}">{{ __('User List') }}</a></li>
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('create-user') }}">{{ __('Create User') }} <div
                                                class="badge badge-success">{{ __('new') }}</div></a></li>

                                    {{-- <li class="nav-item"> <a class="nav-link" href="">{{ __('Inventory') }} <div class="badge badge-danger">{{ __('new') }}</div></a></li> --}}
                                </ul>
                            </div>
                        </li>
                        {{-- <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                      <i class="typcn typcn-document-text menu-icon"></i>
                      <span class="menu-title">{{ $sidebar_btn[0] }}</span>
                      <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic">
                      <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ route('create_user') }}">{{ __('Create User') }} <div class="badge badge-success">{{ __('new') }}</div></a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('vendor_list') }}">{{ __('Vendor') }}</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('inventory_list') }}">{{ __('Inventory') }} <div class="badge badge-danger">{{ __('new') }}</div></a></li>
                      </ul>
                    </div>
                  </li> --}}
                        {{-- <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                      <i class="typcn typcn-film menu-icon"></i>
                      <span class="menu-title">{{ $sidebar_btn[1] }}</span>
                      <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="form-elements">
                      <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="{{ route('user_list') }}">User List</a></li>
                      </ul>
                    </div>
                    <div class="collapse" id="form-elements">
                      <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="{{ route('vendor_list') }}">Vendor List</a></li>
                      </ul>
                    </div>
                    <div class="collapse" id="form-elements">
                      <ul class="nav flex-column sub-menu">
                       <li class="nav-item"><a class="nav-link" href="{{ route('officer_list') }}">Officer List</a></li>
                      </ul>
                    </div>
                  </li> --}}



                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#product-batch_boq-elements"
                                aria-expanded="false" aria-controls="product-batch_boq-elements">
                                <i class="menu-icon mdi mdi-format-list-numbers"></i>
                                <span class="menu-title">Bill Details(BOQ)</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="product-batch_boq-elements">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" href="{{ route('batch_list') }}">Order
                                            List</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#product-batch-elements"
                                aria-expanded="false" aria-controls="product-batch-elements">
                                <i class="menu-icon mdi mdi-format-list-numbers"></i>
                                <span class="menu-title">BOQ Management</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="product-batch-elements">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" href="{{ route('boq.list') }}">BOQ
                                            List</a></li>
                                </ul>
                            </div>
                        </li>




                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#product-elements"
                                aria-expanded="false" aria-controls="product-elements">
                                <i class="typcn typcn-film menu-icon"></i>
                                <span class="menu-title">{{ $sidebar_btn[2] }}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="product-elements">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('site.list') }}">{{ $childSidebar['sl'] }}</a></li>
                                </ul>
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('site.add') }}">{{ $childSidebar['sa'] }}</a></li>
                                </ul>

                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#vsitemapping-elements"
                                aria-expanded="false" aria-controls="vsitemapping-elements">
                                <i class="typcn typcn-film menu-icon"></i>
                                <span class="menu-title">{{ __('Site Allocation') }}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="vsitemapping-elements">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('vendor-site-mapping') }}">{{ __('Vendor Site Allocation') }}</a>
                                    </li>
                                </ul>

                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('vendor.site') }}">{{ __('List of Allocated Site') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        {{-- <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#mapping-elements" aria-expanded="false" aria-controls="mapping-elements">
                        <i class="typcn typcn-film menu-icon"></i>
                            <span class="menu-title">{{ __('Mapping') }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="mapping-elements">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">  <a class="nav-link" href="{{ route('vendor.site') }}">{{ __('Vendor Site') }}</a></li>
                        </ul>
                    </div>
                  </li> --}}

                    </ul>
                </nav>
                <!-- Admin sidebar end-->
            @elseif(session('title') == 'Officer')
                <!--Officer sidebar start-->
                <nav class="sidebar sidebar-offcanvas" id="sidebar">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="typcn typcn-device-desktop menu-icon"></i>
                                <span class="menu-title">{{ __('Officer Dashboard') }}</span>
                                {{-- <div class="badge badge-danger">{{ __('new') }}</div> --}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                                aria-controls="ui-basic">
                                <i class="typcn typcn-document-text menu-icon"></i>
                                <span class="menu-title">{{ __('Bill Details(BOQ)') }}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-basic">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('batch_list_officer') }}">{{ __('Order List') }} <div
                                                class="badge badge-success">{{ __('new') }}</div></a></li>
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('approve-batch_list_officer') }}">{{ __('Approve for Recived Order') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#uivendor-basic" aria-expanded="false"
                                aria-controls="uivendor-basic">
                                <i class="typcn typcn-document-text menu-icon"></i>
                                <span class="menu-title"
                                    style="font-size: 12px;">{{ __('Issue Item to Vendor') }}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="uivendor-basic">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" style="font-size: 12px;"
                                            href="{{ route('issue_vendor') }}">{{ __(' Issue Material to Vendor') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#inventrym-basic" aria-expanded="false"
                                aria-controls="inventrym-basic">
                                <i class="typcn typcn-document-text menu-icon"></i>
                                <span class="menu-title"
                                    style="font-size: 12px;">{{ __('Inventory Management') }}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="inventrym-basic">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" style="font-size: 12px;"
                                            href="{{ route('inv_mgmt_sta') }}">{{ __('Inventory Status') }}</a></li>
                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#sites-basic" aria-expanded="false"
                                aria-controls="sites-basic">
                                <i class="typcn typcn-document-text menu-icon"></i>
                                <span class="menu-title" style="font-size: 12px;">{{ __('Site Management') }}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="sites-basic">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" style="font-size: 12px;"
                                            href="{{ route('site_alloc_wrk_sta') }}">{{ __('Site Allocation') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </li>



                    </ul>
                </nav>
                <!-- Officer sidebar end-->
            @elseif(session('title') == 'Vendor')
                <!--Vendor sidebar start-->
                <nav class="sidebar sidebar-offcanvas" id="sidebar">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="typcn typcn-device-desktop menu-icon"></i>
                                <span class="menu-title">{{ __('Vendor Dashboard') }}</span>
                                {{-- <div class="badge badge-danger">{{ __('new') }}</div> --}}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#product-elements"
                                aria-expanded="false" aria-controls="product-elements">
                                <i class="typcn typcn-film menu-icon mdi mdi-library-books"></i>
                                <span class="menu-title">Inventory Request</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="product-elements">
                                <ul class="nav flex-column sub-menu">
                                    {{-- <img src="{{asset('images/product.png')}}" alt=""> --}}
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('product-list') }}">Request List</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false"
                                aria-controls="form-elements">
                                <i class="typcn typcn-film menu-icon mdi mdi-format-list-numbers"></i>
                                <span class="menu-title">Site Management</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="form-elements">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"><a class="nav-link" href="">Allocated Site List</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#usitedata-elements"
                                aria-expanded="false" aria-controls="usitedata-elements">
                                <i class="typcn typcn-film menu-icon mdi mdi-format-list-numbers"></i>
                                <span class="menu-title">Update Site Data</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="usitedata-elements">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"><a class="nav-link" href="">Allocated Site List</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="">Allocated Site
                                            Enggineer</a></li>
                                    <li class="nav-item"><a class="nav-link" href="">Update Site</a></li>
                                </ul>
                            </div>
                        </li>


                    </ul>
                </nav>
                <!-- Vendor sidebar end-->
            @elseif(session('title') == 'Engineer')
                <!--Engineer sidebar start-->
                <nav class="sidebar sidebar-offcanvas" id="sidebar">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="typcn typcn-device-desktop menu-icon"></i>
                                <span class="menu-title">{{ __('Engineer Dashboard') }}</span>
                                {{-- <div class="badge badge-danger">{{ __('new') }}</div> --}}
                            </a>
                        </li>

                        {{-- <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#product-elements"
                                aria-expanded="false" aria-controls="product-elements">
                                <i class="typcn typcn-film menu-icon mdi mdi-library-books"></i>
                                <span class="menu-title" style="font-size: 12px;">Sites allocated</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="product-elements">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"><a class="nav-link"style="font-size: 12px;"
                                            href="{{ route('site_all_eng') }}">{{ __('Allocated to Engineer') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </li> --}}


                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#sitesone-basic" aria-expanded="false"
                                aria-controls="sitesone-basic">
                                <i class="typcn typcn-document-text menu-icon"></i>
                                <span class="menu-title"
                                    style="font-size: 12px;">{{ __('Site Activity Work') }}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="sitesone-basic">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" style="font-size: 12px;"
                                            href="{{ route('site_active_wrk') }}">{{ __('List of Site Allocated') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#siteslist-basic" aria-expanded="false"
                                aria-controls="siteslist-basic">
                                <i class="typcn typcn-document-text menu-icon"></i>
                                <span class="menu-title" style="font-size: 12px;">{{ __('Site Completion') }}</span>
                                <i class="menu-arrow"></i>
                            </a>

                            <div class="collapse" id="siteslist-basic">
                                {{-- <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" style="font-size: 12px;"
                                            href="{{ route('site_com_list') }}">{{ __('List Site Completion') }}</a></li>
                                </ul> --}}

                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" style="font-size: 12px;"
                                            href="{{ route('update_site_officer') }}">{{ __('Update Site Activity') }}</a></li>
                                </ul>
                            </div>
                        </li>



                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#sitessecond-basic"
                                aria-expanded="false" aria-controls="sitessecond-basic">
                                <i class="typcn typcn-document-text menu-icon"></i>
                                <span class="menu-title" style="font-size: 12px;">{{ __('Sites Approval') }}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="sitessecond-basic">
                                {{-- <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" style="font-size: 12px;"
                                            href="{{ route('upload_rep_test') }}">{{ __('Upload Test Report') }}</a></li>
                                </ul> --}}
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" style="font-size: 12px;"
                                            href="{{ route('site_rep_lst') }}">{{ __('List for Site Approval') }}</a></li>
                                </ul>
                            </div>
                        </li>




                    </ul>
                </nav>
                <!-- Engineer sidebar end-->
            @elseif(session('title') == 'Site Officer')
                <!--Start Site Officer sidebar-->
                <nav class="sidebar sidebar-offcanvas" id="sidebar">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="typcn typcn-device-desktop menu-icon"></i>
                                <span class="menu-title">{{ __('Site Officer Dashboard') }}</span>
                                {{-- <div class="badge badge-danger">{{ __('new') }}</div> --}}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#product-elements"
                                aria-expanded="false" aria-controls="product-elements">
                                <i class="typcn typcn-film menu-icon mdi mdi-library-books"></i>
                                <span class="menu-title" style="font-size: 12px;">{{ __('Sites allocated') }}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="product-elements">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"><a class="nav-link"style="font-size: 12px;"
                                            href="{{ route('site_all_eng') }}">{{ __('Site Allocated Work') }}</a>
                                    </li>
                                </ul>
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"><a class="nav-link"style="font-size: 12px;"
                                            href="{{ route('site_all_eng') }}">{{ __('Site Allocated View') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#siteslist-basic" aria-expanded="false"
                                aria-controls="siteslist-basic">
                                <i class="typcn typcn-document-text menu-icon"></i>
                                <span class="menu-title" style="font-size: 12px;">{{ __('Site Activity') }}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="siteslist-basic">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" style="font-size: 12px;"
                                            href="{{ route('site_com_list') }}">{{ __('Site Activity List') }}</a>
                                    </li>
                                </ul>
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" style="font-size: 12px;"
                                            href="{{ route('site_com_list') }}">{{ __('Site Work Status') }}</a></li>
                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#sitesapprovework-basic"
                                aria-expanded="false" aria-controls="sitesapprovework-basic">
                                <i class="typcn typcn-document-text menu-icon"></i>
                                <span class="menu-title" style="font-size: 12px;">{{ __('Site Approve') }}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="sitesapprovework-basic">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" style="font-size: 12px;"
                                            href="{{ route('site_app_list') }}">{{ __('Site Approve List') }}</a>
                                    </li>
                                </ul>
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" style="font-size: 12px;"
                                            href="{{ route('app_site_com_work') }}">{{ __('Approve Site Completion Work') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                    </ul>
                </nav>
                <!--End Site Officer sidebar-->
            @endif






            <div class="main-panel">

                @yield('content')


                <!-- footer start -->
                <footer class="footer">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright ©
                                    2023 <a href="#" class="text-muted" target="_blank"></a>. Parity InfoTech
                                    Solutions. All rights reserved.</span>
                                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center text-muted"> <a
                                        href="#" class="text-muted" target="_blank"></a>paritysystem.in</span>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- footer end -->


            </div>

        </div>





        <!-- partial -->



    </div>
    <iframe id="dummyFrame" style="display:none"></iframe>




    <script src="{{ asset('public/vendors/js/vendor.bundle.base.js') }}"></script>
    {{-- <script src="{{ asset('public/vendors/chart.js/Chart.min.js') }}"></script> --}}
    <script src="{{ asset('public/js/off-canvas.js') }}"></script>
    <script src="{{ asset('public/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('public/js/template.js') }}"></script>
    <script src="{{ asset('public/js/settings.js') }}"></script>
    <script src="{{ asset('public/js/todolist.js') }}"></script>
    <script src="{{ asset('public/js/dashboard.js') }}"></script>
    <script src="{{ asset('public/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('public/js/chart.js') }}"></script>


    <script src="{{ asset('public/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('public/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('public/js/file-upload.js') }}"></script>
    <script src="{{ asset('public/js/typeahead.js') }}"></script>
    <script src="{{ asset('public/js/select2.js') }}"></script>


    <script>
        // $(document).ready(function () {
        //     $('#example').DataTable();
        // });

        // $(document).ready(function() {
        //     $('#example').DataTable( {
        //         dom: 'Bfrtip',
        //         buttons: [
        //             'copy', 'csv', 'excel', 'pdf', 'print'
        //         ]
        //     } );
        // } );


        var current_url = window.location.href;

        //$('#hideDivAlert').hide();
        $(document).ready(function() {
            var tex = $('#hideDivAlert div p').html();

            $('#hideDivAlert').show();
            setTimeout(function() {
                $('#hideDivAlert').hide();
            }, 5000);

        });

        function fnExcelReport() {
            var table = document.getElementById('theTable'); // id of table
            var tableHTML = table.outerHTML;
            var fileName = 'download.xls';

            var msie = window.navigator.userAgent.indexOf("MSIE ");

            // If Internet Explorer
            if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
                dummyFrame.document.open('txt/html', 'replace');
                dummyFrame.document.write(tableHTML);
                dummyFrame.document.close();
                dummyFrame.focus();
                return dummyFrame.document.execCommand('SaveAs', true, fileName);
            }
            //other browsers
            else {
                var a = document.createElement('a');
                tableHTML = tableHTML.replace(/  /g, '').replace(/ /g, '%20'); // replaces spaces
                a.href = 'data:application/vnd.ms-excel,' + tableHTML;
                a.setAttribute('download', fileName);
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            }
        }

        if (current_url == 'http://localhost/laravel/parity-product/public/item_list') {
            $('body').on('click', '#show-value', function(e) {
                e.preventDefault();
                console.log(
                    "ask.. send message vendor & store Manager/Officer with PDF formate or Link own website this pdf.."
                    )
                var inputs = $(".user_values");
                var siteinp = $(".site_values");
                var site_array = [];
                var splash_array = [];
                for (let i = 0; i < inputs.length; i++) {
                    var first_num = $(inputs[0]).val();
                    splash_array.push($(inputs[i]).val());
                    site_array.push($(siteinp[i]).val());
                }
                console.log(splash_array);
                console.log(site_array);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: 'ajax-store-masters',
                    dataType: 'json',
                    data: {
                        'all_qty': splash_array,
                        'all_site': site_array,
                    },
                    success: function(data) {
                        $("#msg").html(data.msg);
                    }
                });
            });
        }

        if (current_url == "http://localhost/laravel/assam-revenue-product/public/batch_list") {
            //     $(function getfunction(){
            //         var select = $('#dropdownMenuSizeButton3');
            //         $('tbody').empty();
            //         //var selected = $('#selected');
            //         select.on('change', function(){
            //             var selectedOptionText = $(this).children(':selected').text();
            //             alert(selectedOptionText);
            //             $('.modifyDatabatchIdGet').empty();
            //             $.ajax({
            //                 type: "POST",
            //                 url: 'ajaxgetbatchlist',
            //                 data: { "batch_id": selectedOptionText , _token: '{{ csrf_token() }}' },
            //                 success: function (data) {
            //                 $('tbody').empty();
            //                 for (let i = 0; i < data.length; i++) {
            //                     var res = data[i];
            //                     var id = res.id;
            //                     var resstr = res.item_title;
            //                     console.log(res);
            //                     $('.tbody').append('<tr><td>'+id+'</td><td>'+resstr.substring(0,10)+'</td><td>'+resstr.substring(0,70)+'</td><td>'+res.item+'</td><td>'+res.qty+'</td><td><i class="mdi mdi-rename-box"></i> | <i class="mdi mdi-delete"></i></tr>')
            //                 }
            //                 $('.modifyDatabatchIdGet').html('<p id="getInputll" batch_id='+selectedOptionText+' name="batch_id" class="btn btn-primary mr-2">Create New</p>');
            //                 },
            //                 error: function (data, textStatus, errorThrown) {
            //                     // $('.modifyDatabatchIdGet').empty();
            //                     $('.modifyDatabatchIdGet').html('<p id="getInputll" batch_id="0" name="batch_id" class="btn btn-primary mr-2">Create New</p>');

            //                     $('tbody').empty();
            //                     console.log(data);
            //                 },
            //             });
            //         // selected.text(selectedOptionText + 'ashsfsdkjj');
            //         });
            //     });
            //     $('body').on('click','#getInputll',function(){
            //         var batch_id = $(this).attr('batch_id');
            //         $.ajax({
            //             type: "POST",
            //             url: 'adminbatch-send-officer',
            //             data: { "batch_id": batch_id , _token: '{{ csrf_token() }}' },
            //             success: function (data) {
            //             }
            //         });
            //     });
        }

        if (current_url == "http://localhost/laravel/assam-revenue-product/public/batch_list_officer") {
            console.log('quantity approve by Store Manager');
            // $('.modifyDatabatchIdGet').html('<p id="getInputll" batch_id="0" name="batch_id" class="btn btn-success mr-2">Approved</p><p id="getInputll" batch_id="0" name="batch_id" class="btn btn-danger mr-2">Dispproved</p>');
            $(function getfunction() {
                var select = $('#dropdownMenuSizeButton3');

                $('tbody').empty();
                //var selected = $('#selected');
                select.on('change', function() {
                    var selectedOptionText = $(this).children(':selected').text();
                    //alert(selectedOptionText);
                    $('.modifyDatabatchIdGet').empty();

                    $.ajax({
                        type: "POST",
                        url: 'ajaxgetbatchlist',
                        data: {
                            "batch_id": selectedOptionText,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            $('tbody').empty();

                            for (let i = 0; i < data.length; i++) {
                                var res = data[i];
                                var id = res.id;
                                var resstr = res.item_title;
                                console.log(res);
                                $('.tbody').append('<tr><td>' + id + '</td><td>' + resstr
                                    .substring(0, 10) + '</td><td>' + resstr.substring(0,
                                        70) + '</td><td>' + res.item + '</td><td>' + res
                                    .qty +
                                    '</td><td><i class="mdi mdi-rename-box"></i> | <i class="mdi mdi-delete"></i></tr>'
                                    )
                            }
                            //$('.modifyDatabatchIdGet').html('<a href="{{ route('adminbatch-send-officer') }}" id="getInputll" batch_id='+selectedOptionText+' name="batch_id" class="btn btn-success mr-2">Approved</a><p id="getInputll" batch_id='+selectedOptionText+' name="batch_id" class="btn btn-danger mr-2">Dispproved</p>');
                        },
                        error: function(data, textStatus, errorThrown) {
                            //$('.modifyDatabatchIdGet').empty();
                            //$('.modifyDatabatchIdGet').html('<a href="{{ route('adminbatch-send-officer') }}" id="getInputll" batch_id='+selectedOptionText+' name="batch_id" class="btn btn-success mr-2">Approved</a><p id="getInputll" batch_id='+selectedOptionText+' name="batch_id" class="btn btn-danger mr-2">Dispproved</p>');

                            $('tbody').empty();
                            console.log(data);
                        },
                    });

                    // selected.text(selectedOptionText + 'ashsfsdkjj');
                });
            });
        }
    </script>


</body>

</html>


{{-- BOQ Management --}}
