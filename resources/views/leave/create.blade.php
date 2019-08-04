@extends('layouts.app')

@section('content')

    <div class="col-lg-12">
        <a href="{{route('leave.index')}}" class="btn btn-lg btn-primary mb-2">Back</a>
        <!-- Circle Buttons -->
     <div class="card shadow mb-4">
       <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
            <h2 class="h3 mb-4 text-gray-800">Leave Form</h2>
       </div>
       <div class="card-body">
            
            <form method="post" action="{{route('leave.store')}}" autocomplete="off" class="user">

                @include('leave.form')

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-user btn-block">Save</button>
                </div>
            </form>
       </div>
    </div>
  
@endsection