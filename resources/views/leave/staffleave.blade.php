@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Approved Leave Entries</h1>
        
    </div>

    <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Days</th>
                                <th>Leave Type</th>
                                <th>Year</th>
                                <th>Duty Reliever</th>
                                <th>Approval</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leaves as $leave)
                                    
                            <tr>
                                    <td>{{$leave->user->firstname}}</td>
                                    <td>{{ $leave->start_date }}</td>
                                    <td>  
                                        @include('leave.resume')
                                    </td>
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
                                    
                                </tr>
                        @endforeach 
                        </tbody>
                    </table>
                  {{ $leaves->render() }} 
                </div>
            </div>
        </div>
@endsection