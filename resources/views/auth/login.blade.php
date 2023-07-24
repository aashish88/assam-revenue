<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login Page </title>
  <link rel="stylesheet" href="{{ asset('public/vendors/typicons/typicons.css') }}">
  <link rel="stylesheet" href="{{ asset('public/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('public/css/vertical-layout-light/style.css') }}">
  <!--<link rel="shortcut icon" href="{{ asset('public/images/favicon.png') }}" />-->

  <style>
    .brand-logo {
      /* background: #87CEEB; */
      background: white;
    }

    .brand-logo img {
      background: #87CEEB;
      margin: 17px 00 11px 87px;
      padding: 1px;
    }

    h5 {
      /*background: #75c9eb;*/
      text-align: center;
    }

    img {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    .brand-logo img{
        padding: 00px;

    }

    .auth .brand-logo img {
        margin: 00 00 00 48px;
        width: 322px;
    }

    .imglogocenter {
        margin: 00 00 00 16px;
        width: 250px;
        height: 220px;
    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            {{-- <div class="auth-form-light text-left py-5 px-4 px-sm-5"> --}}
            <div class="auth-form-light text-left">
              <div class="brand-logo">
                <div class="row">
                    <div class="col-sm-2">
                        <img class="imglogocenter" src="https://nenow.in/wp-content/uploads/2022/03/Assam-govt.jpg" alt="assam-logo">
                        {{-- <img src="{{ asset('public/images/assamlogo.png') }}" width="5px" height="25px"> --}}
                    </div>
                    <div class="col-sm-10">
                        {{-- <img src="{{ asset('public/images/parity.png') }}" alt="logo"> --}}
                    </div>


                </div>

              </div>
              <h5>Assam Land Record </br> Project Management System</h5>
              {{-- <h6 class="font-weight-light">Sign in to continue.</h6> --}}
        <form class="pt-3" action="{{ route('login.post') }}" method="POST">
          @csrf
          <div class="form-group">
            <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" name="email" placeholder="Username">
            @if ($errors->has('email'))
              <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
          </div>
          <div class="form-group">
            <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
            @if ($errors->has('password'))
              <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
          </div>
          <div class="mt-3">
            <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit" name="login" value="signin">SIGN IN </button>
            {{-- <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="#">SIGN IN <button type="submit" style="visibility: hidden;"></button></a> --}}
          </div>
          {{-- <div class="my-2 d-flex justify-content-between align-items-center">
            <div class="form-check">
              <label class="form-check-label text-muted">
              <input type="checkbox" class="form-check-input">Keep me signed in</label>
            </div>
            <a href="#" class="auth-link text-black">Forgot password?</a>
          </div>
          <div class="mb-2">
            <button type="button" class="btn btn-block btn-facebook auth-form-btn">
            <i class="typcn typcn-social-facebook mr-2"></i>Connect using facebook
            </button>
          </div>
          <div class="text-center mt-4 font-weight-light">Don't have an account? <a href="register.html" class="text-primary">Create</a>
          </div> --}}
        </form>
            </div>
            <br>
            <div class="row" style="margin: 00 00 00 5px;">
                <p>© Copyright,&nbsp;Parity InfoTech Solutions Pvt. Ltd. All rights reserved.</p>
            </div>

            <img src="https://parityinfotech.in/wp-content/uploads/2022/03/t2-1.png" alt="" width="60px" height="20px">

          </div>

        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="{{ asset('public/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{{ asset('public/js/off-canvas.js') }}"></script>
  <script src="{{ asset('public/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('public/js/template.js') }}"></script>
  <script src="{{ asset('public/js/settings.js') }}"></script>
  <script src="{{ asset('public/js/todolist.js') }}"></script>
  <!-- endinject -->
</body>

</html>
