@include('layouts.inc.head')
<body class="bg-gradient-primary">
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-img">
                <img src="{{ asset('theme/img/sign-in.jpg') }}" alt="" srcset="">
              </div>
                <div class="col-lg-6">
                  <div class="p-5">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                    </div>
                    <form class="user" method="POST" action="{{ route('login') }}">
                      @csrf
                      <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="username" id="exampleInputUsername" aria-describedby="emailHelp" placeholder="Enter Username..." autocomplete="off" autofocus>
                        <div class="text-danger">{{ $errors->first('username') }}</div>
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="Password">
                        <div class="text-danger">{{ $errors->first('password') }}</div>
                      </div>
                      <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                          <input type="checkbox" class="custom-control-input" id="customCheck">
                          <label class="custom-control-label" for="customCheck">Remember Me</label>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary btn-user btn-block">
                        Login
                      </button>
                    </form>
                    <hr>
                    <div class="text-center">
                      <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                    </div>
                    <div class="text-center">
                      <a class="small" href="{{route('register')}}">Create an Account!</a>
                    </div>
                    <div class="text-center">
                      <a class="small" href="www.ecmterminals.com/LMSystem">Back to Home</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

