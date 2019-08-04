@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Leave Summary</h1>
        <a href="{{route('leave.create')}}" class="d-none d-sm-inline-block btn btn-lg btn-primary shadow-sm">Apply</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>Year</th>
                            <th>Days Utilized</th>
                            <th>Days Outstanding</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaveSummaries as $key => $value)

                            <tr class="text-center">
                                <td>{{$key}} </td>
                                <td>{{$value}}</td>
                                <td>@include('leave.outs')</td>
                            </tr>  
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 
@endsection