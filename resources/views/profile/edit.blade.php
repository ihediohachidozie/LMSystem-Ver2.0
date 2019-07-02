@extends('layouts.app')
@section('content')
  <!-- Begin Page Content -->
  <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Profile</h1>
        <div class="col-12">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>

        <div class="row">

          <div class="col-lg-6">

            <!-- Circle Buttons -->
            <div class="card shadow mb-2">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">User Information</h6>
              </div>
              <div class="card-body">
                    <form class="user" action="{{ route('profile.update', [ 'id' => auth()->id()]) }}" method="post">

                      @csrf
                      @method('PATCH')
                      <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                          <input type="text" class="form-control form-control-user" id="exampleFirstName" name="firstname" value="{{old('firstname') ?? $user->firstname}}">
                          <div class="text-danger">{{ $errors->first('firstname') }}</div>
                        </div>
                        <div class="col-sm-6">
                          <input type="text" class="form-control form-control-user" id="exampleLastName"  name="lastname" value="{{old('lastname') ?? $user->lastname}}">
                          <div class="text-danger">{{ $errors->first('lastname') }}</div>
                        </div>
                      </div>
                      <div class="form-group">
                        <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email" value="{{old('email') ?? $user->email}}">
                        <div class="text-danger">{{ $errors->first('email') }}</div>
                      </div>
                      <div class="form-group"> 
                        <select name="department_id" class="form-control">
                            <option selected>Department...</option>

                             @foreach ($departments as $department)
                                <option value="{{ $department->id}}" {{ $user->department_id == $department->id ? 'selected' : '' }}>{{ $department->department}}</option>
                            @endforeach 
                        </select>
                        <div class="text-danger">{{ $errors->first('department_id') ? 'Department is required' : '' }}</div>
                      </div>
                      <input type="hidden" name="profile" value="info">
                      <button type="submit" class="btn btn-primary btn-user btn-block">
                        Change Info
                      </button>
                    </form>
              </div>
            </div>

            <!-- Brand Buttons -->
            <div class="card shadow mb-2">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Change Password</h6>
              </div>
              <div class="card-body">
                  <form class="user" action="{{ route('profile.update', [ 'id' => auth()->id()]) }}" method="post">

                      @csrf
                      @method('PATCH')
                      <div class="form-group">
                        <input type="password" class="form-control form-control-user" name="current_password" id="exampleInputEmail" placeholder="Current Password">
                        <div class="text-danger"> <small> {{ $errors->first('current_password') }} </small> </div>
                      </div>
                       <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                          <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="New Password">
                          <div class="text-danger"> <small> {{ $errors->first('password') }} </small></div>
                        </div>
                        <div class="col-sm-6">
                          <input type="password" class="form-control form-control-user" name="password_confirmation" id="exampleRepeatPassword" placeholder="Repeat New Password">
                          <div class="text-danger"> <small> {{ $errors->first('password_confirmation') }} </small></div>
                        </div>
                      </div>
                      <input type="hidden" name="profile" value="password">
                      <button type="submit" class="btn btn-primary btn-user btn-block">
                        Change Password
                      </button>
                  </form>
              </div>
            </div>



          </div>

          <div class="col-lg-6">

            <div class="card shadow mb-2 ">
              <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">{{$user->firstname }} {{' '}} {{$user->lastname}}</h6>
              </div>
              <div class="card-body text-center">
                @if ($user->image)
                <img class="card-img-top rounded-circle mb-2" src="{{ asset('storage/'. $user->image) }}" alt="Profile image"  style="width:50%">
                @else
                  <img class="card-img-top rounded-circle mb-2" src="{{ asset('theme/img/default.jpg')}}" alt="Profile image"  style="width:50%">
                @endif
                  
                <h5 class="card-title text-gray"></h5>
                <div class="row card-text">
                  <div class="col text-md font-weight-bold">Department <br> <span class="text-sm text-danger">{{ $user->department ? $user->department->department : 'N/A'}}</span> </div>
                  <div class="col text-md font-weight-bold">Category <br> <span class="text-sm text-danger">{{ $user->category ? $user->category->category : 'N/A'}}</span> </div>
                  <div class="col text-md font-weight-bold">Staff Id <br> <span class="text-sm text-danger">{{ $user->staff_id }}</span> </div>
                </div>
                
              </div>
            </div>
            <div class="my-2"></div>
            <div class="card shadow mb-2">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Change Image</h6>
                </div>
                <div class="card-body">
                    <form class="user" action="{{ route('profile.update', [ 'id' => auth()->id()]) }}" method="post" enctype="multipart/form-data">

                        @csrf
                        @method('PATCH')
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                      </div>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image" aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                      </div>
                    </div>
                    <input type="hidden" name="profile" value="image">
                    <div class="my-2"></div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-user btn-block">Change Image</button>
                    </div>
                  </form>
                </div>
              </div>

          </div>

        </div>

      </div>
      <!-- /.container-fluid -->


@endsection