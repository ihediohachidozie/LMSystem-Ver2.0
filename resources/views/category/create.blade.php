@extends('layouts.app')
@section('content')

<a href="{{route('category.index')}}" class="btn btn-lg btn-primary"><i class="fas fa-arrow-left fa-sm text-white-50"></i>Back</a>
 

 <div class="row justify-content-center">

   <div class="col-lg-8">

     <!-- Circle Buttons -->
     <div class="card shadow mb-4">
       <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
            <h2 class="h3 mb-4 text-gray-800">Add Category</h2>
       </div>
       <div class="card-body">
            
            <form method="post" action="{{route('category.store')}}" autocomplete="off" class="user">

                    @include('category.form')

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-user btn-block">Save</button>
                    </div>
                </div>
            </form>
       </div>
    </div>
@endsection
