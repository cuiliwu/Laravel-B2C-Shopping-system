@if($errors->has($field))
    @foreach ($errors->get($field) as $error)
        <span id="name-error" class="help-block m-b-none" style="color:#ed5565;">{{ $error }}</span>
    @endforeach
@endif