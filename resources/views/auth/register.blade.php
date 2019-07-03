@include('layouts.inc.head')
<body class="bg-gradient-primary">
  <div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-signup-img"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="firstname" id="exampleFirstName" placeholder="First Name">
                    <div class="text-danger">{{ $errors->first('firstname') }}</div>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="lastname" id="exampleLastName" placeholder="Last Name">
                    <div class="text-danger">{{ $errors->first('lastname') }}</div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail" placeholder="Email Address">
                    <div class="text-danger">{{ $errors->first('email') }}</div>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="staff_id" id="exampleStaffId" placeholder="Staff Id">
                    <div class="text-danger">{{ $errors->first('staffid') }}</div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="username" id="exampleUserName" placeholder="Username">
                    <div class="text-danger">{{ $errors->first('username') }}</div>
                  </div>
                  <div class="col-sm-6">  
                    <select name="department_id" class="form-control">
                      <option selected>Department...</option>
                      @foreach ($departments as $department)
                        <option value="{{ $department->id}}">{{ $department->department}}</option>
                      @endforeach
                    </select>
                    <div class="text-danger">{{ $errors->first('department_id') ? 'Department is required' : '' }}</div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="Password">
                    <div class="text-danger">{{ $errors->first('password') }}</div>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" name="password_confirmation" id="exampleRepeatPassword" placeholder="Repeat Password">
                    <div class="text-danger">{{ $errors->first('password_confirmation') }}</div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Register Account
                </button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
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
</body>