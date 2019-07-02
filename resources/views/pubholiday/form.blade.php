@csrf
<div class="form-group">   
    <input type="text" name="description" id="input-description" class="form-control form-control-user" placeholder="{{ __('Description') }}" value="{{ old('description') ?? $publicholiday->description}}" autofocus>
    <div class="text-danger">{{ $errors->first('description') }}</div>
</div>

<div class="form-group">   
    <input type="date" name="date" id="input-date" class="form-control form-control-user" placeholder="{{ __('Date') }}" value="{{ old('date') ?? $publicholiday->date}}">
    <div class="text-danger">{{ $errors->first('days') }}</div>
</div>