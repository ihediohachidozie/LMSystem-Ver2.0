@extends('layouts.app')
@section('content')

  <div>
    <a href="{{route('department.index')}}" class="btn btn-lg btn-primary"><i class="fas fa-arrow-left fa-sm text-white-50"></i>Back</a>
  </div>
 
  <div class="row justify-content-center">

    <div class="col-lg-8">

     <!-- Circle Buttons -->
     <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
            <h1 class="h3 mb-4 text-gray-800">Edit Department</h1>
        </div>
        <div class="card-body">       
        <form method="post" class="user" action="{{route('department.update', ['department' => $department])}}" autocomplete="off">
          @include('department.form')

          @method('PATCH')

          <div class="text-center">
              <button type="submit" class="btn btn-primary btn-user btn-block">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
