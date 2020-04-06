@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Leave Summary</h1>
      
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Users Leave Summary</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example3" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th class="text-center">Year</th>
                            <th class="text-center">Days Utilized</th>
                            <th class="text-center">Days Outstanding</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaves as $leave)
                            @if ($leave->approval_id == auth()->user()->id or auth()->id() == 1)
                                <tr>
                                    <td>{{$leave->firstname}}</td>                                   
                                    <td class="text-center">{{$leave->year}}</td> 
                                    <td class="text-center">{{$leave->days}}</td>
                                    <td class="text-center"> @include('leave.outs2')</td>  
                                </tr>
                                
                            @endif

                        @endforeach 
                        <tfoot>
                            <tr>
                                <th class="text-center" >Name</th>
                                <th class="text-center">Year</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot> 
                    </tbody>
                </table>
                {{ $leaves->render() }} 
            </div>
        </div>
    </div>  
@endsection