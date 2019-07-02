@extends('layouts.app')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit User</h1>
    <div class="row">

      <div class="col-lg-6">

        <!-- Circle Buttons -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User Info</h6>
          </div>
          <div class="card-body ">
            <form class="user ">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="exampleFirstName" value="{{ $user->firstname }}" disabled>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="exampleLastName" value="{{ $user->lastname }}" disabled>
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="exampleInputEmail" value="{{ $user->email }}" disabled>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="exampleInputEmail" value="{{ $user->department->department }}" disabled>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="exampleInputEmail" value="{{ $user->staff_id }}" disabled>
                  </div>
                </div>

              </form>
          </div>
        </div>

        </div>

      <div class="col-lg-6">

        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
          </div>
          <div class="card-body ">
         
            <form class="user" method="POST" action="{{ route('users.destroy', ['user'=>$user]) }}">
                @csrf
                @method('PATCH')
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                      <select name="category_id" class="form-control">
                            <option selected>Category...</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id}}" {{ $user->category ? $category->id == $user->category->id ? 'selected' : '' : '' }}>{{ $category->category}}</option>
                            @endforeach
                        </select>
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                        <div class="custom-control custom-checkbox">      
                            <input type="checkbox" class="custom-control-input" id="permission" name="permission" {{ $user->permission ? 'checked' : 'unchecked'}}>                                         
                            <label class="custom-control-label" for="permission">Approval Right</label>
                        </div>
                  </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-primary btn-user btn-block">Assign</button>
                <hr>
                <div class="text-center">
                    <a href="{{route('users.index')}}" class="btn btn-primary btn-user btn-block mb-2"><i class="fas fa-arrow-left fa-sm text-white-50"></i>Back</a>
                </div>
              </form>
          </div>
        </div>

      </div>

    </div>
  
  </div>
@endsection