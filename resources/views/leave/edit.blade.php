@extends('layouts.app')

@section('content')
    <a href="{{route('leave.index')}}" class="btn btn-lg btn-primary">Back</a>
 
    <div class="col-lg-12">

            <!-- Circle Buttons -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"></h6>
                <h2 class="h3 mb-4 text-gray-800">Leave Form</h2>
            </div>
            <div class="card-body">
                    
                <form method="post" action="{{route('leave.update', ['leave' => $leave])}}" autocomplete="off" class="user">

                    @include('leave.form')

                    <input type="hidden" name="oldday" id="olday" value="{{ $leave->days}}"> 
                    
                    <input type="hidden" name="oldstartdate" value="{{ $leave->start_date }}">   
                    @method('PATCH')
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-user btn-block">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>     
 
@endsection