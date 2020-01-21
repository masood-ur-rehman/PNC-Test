@if(session('success'))
    <div class="alert alert-success" style="display: block; margin-bottom: 7px">
        {{session('success')}}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-error" style="display: block; margin-bottom: 7px">
        {{session('error')}}
    </div>
@endif
