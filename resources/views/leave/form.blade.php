@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@csrf

<div class="row align-items-center">
    <div class="col-md-4">
        <div class="form-group">
            <input type="date" name="start_date" id="input-start-date" class="form-control form-control-user" placeholder="{{ __('Start Date') }}" value="{{ old('start_date') ?? $leave->start_date}}">
            <div class="text-danger">{{ $errors->first('start_date') }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <input type="number" name="days" id="input-days" class="form-control form-control-user" placeholder="{{ __('Days') }}" max="30" min="1" value="{{ old('days') ?? $leave->days}}">
            <div class="text-danger">{{ $errors->first('days') }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <select name="year" id="year" class="form-control">
                <option value="">Leave Year..</option>
                @for ($i = 2006; $i < 2051; $i++)
                    <option value="{{$i}}" {{ $leave->year == $i ? 'selected' : ''}}>{{ $i}}</option>       
                @endfor
            </select>
            <div class="text-danger">{{ $errors->first('year') }}</div>
        </div>

    </div>    
</div>
<div class="row align-items-center">
    <div class="col-md-4">
        <div class="form-group">
            <select name="leave_type" id="" class="form-control"> 
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
            <select name="duty_reliever" id="" class="form-control">
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
            <select name="approval_id" id="" class="form-control">
                <option value="">Approval..</option>
                @foreach ($approvals as $approval)
                    <option value="{{$approval->id}}" {{ $leave->approval_id == $approval->id ? 'selected' : ''}}>{{ $approval->firstname }}</option>
                @endforeach    
            </select>
            <div class="text-danger">{{ $errors->first('approval_id') }}</div>
        </div>

    </div> 
    <input type="hidden" name="status" id="status" value="{{$leave->stautus == null ? 1 : $leave->stautus }}"> 
    <input type="hidden" name="user_id" id="user_id" value="{{ auth()->id() }}">
    <input type="hidden" name="outsdays" id="outsdays" >
</div>