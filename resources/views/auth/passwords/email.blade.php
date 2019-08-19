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
              <div class="col-lg-6 d-none d-lg-block bg-f-img"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                    <p class="mb-4">We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!</p>
                  </div>
                  <div class="text-success">{{ session('status') ? session('status'): ''}}</div>
                  <form class="user" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                      <div class="text-danger">{{ $errors->first('email') }}</div>
                      
                    </div>
                    <button class="btn btn-primary btn-user btn-block">
                      Send Password Reset Link
                    </button>
                  </form>
                   <hr>
                  <div class="text-center">
                    <a class="small" href="{{route('register')}}">Create an Account!</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="{{route('login')}}">Already have an account? Login!</a>
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
</body>