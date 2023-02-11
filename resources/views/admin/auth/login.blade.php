<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <title> Admin Login</title>

  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/frontend/img/logo/favicon.png') }}">


  <link href="{{ asset('assets/admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets/admin/css/icons.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet" type="text/css">


</head>
<body class="fixed-left">
<!-- Loader -->
<div id="preloader"><div id="status"><div class="spinner"></div></div></div>
<!-- Begin page -->
<div class="accountbg"></div>
<div class="wrapper-page">
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-12 text-center"><a href="{{ route('home') }}" class="logo logo-admin">
            <img src="{{ asset('assets/logo-1.jpg') }}" height="100" alt="logo">
          </a></div>
      </div>
      <div class="pl-3 pr-3 pb-3">
        <div class="row">
          <div class="col-12 text-center">
            <h3 class="m-0">Login</h3>
          </div>
        </div>
        @if(session()->has('status'))
          {!! session()->get('status') !!}
        @endif
        <form class="form-horizontal" action="{{ route('login')}}" method="post">
          @csrf
{{--          <div class="form-group">--}}
{{--            <label for="email">Email</label>--}}
{{--            <input type="email" name="email" id="email" placeholder="Enter Your email"--}}
{{--                   class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>--}}
{{--            <span class="spin"></span>--}}
{{--            @error('email')--}}
{{--            <strong class="text-danger">{{ $errors->first('email') }}</strong>--}}
{{--            @enderror--}}
{{--          </div>--}}
          <div class="form-group">
            <label for="user_id">User ID</label>
            <input type="text" name="user_id" id="user_id" placeholder="Enter Your user_id"
                   class="form-control @error('user_id') is-invalid @enderror" value="{{ old('user_id') }}" required>
            <span class="spin"></span>
            @error('user_id')
            <strong class="text-danger">{{ $errors->first('user_id') }}</strong>
            @enderror
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter Your Password" autocomplete="off"
                   class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" required>
            <span class="spin"></span>
            @error('password')
            <strong class="text-danger">{{ $errors->first('password') }}</strong>
            @enderror
          </div>

          <div class="form-group row m-t-20">
            <div class="col-sm-12 text-right">
              <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>

  <div class="m-t-40 text-center">
  </div>

</div>
<script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/modernizr.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/admin/js/waves.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery.scrollTo.min.js') }}"></script>


<!-- App js -->
<script src="{{ asset('assets/admin/js/app.js') }}"></script>

@include('sweetalert::alert')

</body>
</html>
