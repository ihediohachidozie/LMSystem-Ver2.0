@csrf
<div class="form-group">   
    <input type="text" name="category" id="input-name" class="form-control form-control-user" placeholder="{{ __('Category') }}" value="{{ old('category') ?? $category->category}}" autofocus>
    <div class="text-danger">{{ $errors->first('category') }}</div>
</div>

<div class="form-group">   
    <input type="number" name="days" id="input-days" max="30" min="1" class="form-control form-control-user" placeholder="{{ __('Approved Days') }}" value="{{ old('days') ?? $category->days}}">
    <div class="text-danger">{{ $errors->first('days') }}</div>
</div>