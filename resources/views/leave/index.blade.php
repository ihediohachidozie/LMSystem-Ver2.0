@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Leave Entries</h1>
        @if (auth()->id() != 1)
            <a href="{{route('leave.create')}}" class="d-none d-sm-inline-block btn btn-lg btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Apply</a>
        @endif   
    </div>

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

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Days</th>
                            <th>Leave Type</th>
                            <th>Year</th>
                            <th>Duty Reliever</th>
                            <th>Approval</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaves as $leave)
                            @if ($leave->user_id == auth()->id())
                                <tr>
                                    <td>
                                        @if ($leave->status == 'Approved' or $leave->status == 'Pending')
                                            {{ $leave->start_date }}
                                            
                                        @else
                                            
                                            <a href="{{ route('leave.edit', ['leave' =>$leave ]) }}" > {{ $leave->start_date }} </a>
                                            
                                        @endif

                                        
                                    </td>
                                    <td> @include('leave.resume') </td>
                                    <td>{{ $leave->days }}</td>
                                    <td>
                                        @foreach ($leaveTypes as $key => $value)
                                            @if ($key == $leave->leave_type)
                                                {{ $value }}
                                            @endif
                                        @endforeach                                           
                                    </td>
                                    <td>{{ $leave->year}}</td>
                                    <td>
                                        @foreach ($users as $user)
                                            @if ($user->id == $leave->duty_reliever)
                                                {{ $user->firstname }}
                                            @endif
                                        @endforeach                       
                                    </td>
                                    <td>
                                        @foreach ($users as $user)
                                            @if ($user->id == $leave->approval_id)
                                                {{ $user->firstname }}
                                            @endif
                                        @endforeach                                         
                                    </td>
                                    <td>{{$leave->status}}</td>
                                </tr>
                            @else
                                
                            @endif

                        @endforeach  
                    </tbody>
                </table>
              {{ $leaves->render() }} 
            </div>
        </div>
    </div>

@endsection