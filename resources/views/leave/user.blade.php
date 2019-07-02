@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Leave Entries</h1>
       
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th colspan="2" class="text-center">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            {{--   @if (auth()->id() != 1) --}}
                                <tr>
                                    <td>{{$user->firstname}} {{ ' ' }} {{$user->lastname}}</td>                                   
                                    <td class="text-center"><a href="{{ route('leave.staffhistory',[$user->id]) }}" class="btn btn-primary btn-sm"> History</a></td>
                                    <td class="text-center"><a href="{{ route('leave.staffsummary',[$user->id]) }}" class="btn btn-primary btn-sm"> Summary</a></td>
                                </tr>
                            {{--  @endif    --}}                            
                        @endforeach  
                    </tbody>
                </table>
                {{ $users->render() }} 
            </div>
        </div>
    </div>


  
@endsection