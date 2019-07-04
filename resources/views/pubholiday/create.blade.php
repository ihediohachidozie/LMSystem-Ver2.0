@extends('layouts.app')
@section('content')

  <a href="{{route('publicholiday.index')}}" class="btn btn-lg btn-primary">Back</a>
 

  <div class="row justify-content-center">

    <div class="col-lg-8">

      <!-- Circle Buttons -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary"></h6>
          <h2 class="h3 mb-4 text-gray-800">Add Public Holiday</h2>
        </div>
        <div class="card-body">
            
          <form method="post" action="{{route('publicholiday.store')}}" autocomplete="off" class="user">

            @include('pubholiday.form')

            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-user btn-block">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
    
@endsection
