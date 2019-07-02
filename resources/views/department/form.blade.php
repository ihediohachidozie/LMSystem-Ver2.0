@csrf
<div class="form-group">
    
    <input type="text" name="department" id="input-name" class="form-control form-control-user" placeholder="{{ __('Department') }}" value="{{ old('department') ?? $department->department}}" autofocus>
    <div class="text-danger">{{ $errors->first('department') }}</div>
</div>