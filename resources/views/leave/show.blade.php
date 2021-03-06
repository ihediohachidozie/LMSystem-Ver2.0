@extends('layouts.app')


@section('content')
    <div class="col-lg-12">
        @if (auth()->id() == 1)
            <a href="{{route('staffleaveentry')}}" class="btn btn-lg btn-primary mb-2">Back</a>
        @else
            <a href="{{route('leave.approval')}}" class="btn btn-lg btn-primary mb-2">Back</a>
        @endif
       
    </div>
    <div class="row">         
        <div class="col-lg-6">
          <!-- Circle Buttons -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Leave Info for : {{ $leave->user->firstname }}</h6>
            </div>
            <div class="card-body ">
              <form class="user ">
                    <div class="row align-items-center mb-2 mt-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="date" name="start_date" id="input-start-date" class="form-control form-control-user" placeholder="{{ __('Start Date') }}" value="{{ old('start_date') ?? $leave->start_date}}" disabled>
                                <div class="text-danger">{{ $errors->first('start_date') }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="number" name="days" id="input-days" class="form-control form-control-user" placeholder="{{ __('Days') }}" max="30" min="1" value="{{ old('days') ?? $leave->days}}" disabled>
                                <div class="text-danger">{{ $errors->first('days') }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="year" id="year" class="form-control" disabled>
                                    <option value="">Leave Year..</option>
                                    @for ($i = 2006; $i < 2051; $i++)
                                        <option value="{{$i}}" {{ $leave->year == $i ? 'selected' : ''}}>{{ $i}}</option>       
                                    @endfor
                                </select>
                                <div class="text-danger">{{ $errors->first('year') }}</div>
                            </div>
                    
                        </div>    
                    </div>
                    <div class="row align-items-center  mb-2 mt-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="leave_type" id="" class="form-control" disabled> 
                                    <option value="">Leave Type</option>
                                    @foreach ($leaveTypes as $key => $value)
                                        <option value="{{$key}}" {{ $leave->leave_type != null ? $key == $leave->leave_type ? 'selected' : '' : ''}}>{{$value}}</option>                      
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('leave_type') }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="duty_reliever" id="" class="form-control" disabled>
                                    <option value="">Duty Reliever...</option>
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}" {{ $leave->duty_reliever == $user->id ? 'selected' : ''}}>{{ $user->firstname }}</option>
                                    @endforeach    
                                </select>
                                <div class="text-danger">{{ $errors->first('duty_reliever') }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="approval_id" id="" class="form-control" disabled>                     
                                    @foreach ($users as $user)       
                                        <option value="{{$user->id}}" {{ $leave->approval_id == $user->id ? 'selected' : ''}}>{{ $user->firstname }}</option>
                                    @endforeach    
                                </select>
                                <div class="text-danger">{{ $errors->first('approval_id') }}</div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div> <!-- break the sections -->
        <div class="col-lg-6">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Action</h6>
            </div>
            <div class="card-body ">
           
                <form method="post" action="{{route('leave.approveleave',  $leave->id)}}">
                    @csrf
                    @method('PUT')                                         
                
                        @if(auth()->id() == 1)
                            <div class="row align-items-center mb-5">
                                <div class="col-md-4">
                                    <div class="custom-control custom-radio mb-3">
                                        <input name="status" class="custom-control-input" id="customRadio6" type="radio" value="3" disabled>
                                        <label class="custom-control-label" for="customRadio6">Approve</label>
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-radio mb-3">
                                        <input name="status" class="custom-control-input" id="customRadio5" type="radio" value="2" disabled>
                                        <label class="custom-control-label" for="customRadio5">Reject</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-radio mb-3">
                                        <input name="status" class="custom-control-input" id="customRadio7" type="radio" value="0" >
                                        <label class="custom-control-label" for="customRadio7">Open</label>
                                    </div>
                                </div>
                            </div>
                        
                        @else
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="custom-control custom-radio mb-3">
                                        <input name="status" class="custom-control-input" id="customRadio6" checked="" type="radio" value="3">
                                        <label class="custom-control-label" for="customRadio6">Approve</label>
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <div class="custom-control custom-radio mb-3">
                                        <input name="status" class="custom-control-input" id="customRadio5" type="radio" value="2">
                                        <label class="custom-control-label" for="customRadio5">Reject</label>
                                    </div>
                                </div> 
                            </div>
                            <div class="form-group">
                                <textarea name="comment" placeholder="Comment..." class="form-control form-control-user"></textarea>                
                            </div>                    
                        @endif   
                                 
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-user btn-block">Save</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div> 
@endsection