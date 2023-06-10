@if ($errors->any())
    <div id="error-alert" class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('error'))
    <div id="session-error-alert" class="alert alert-danger">
        {{Session::get('error')}}
    </div>
@endif

@if(Session::has('success'))
    <div id="session-success-alert" class="alert alert-success">
        {{Session::get('success')}}
    </div>
@endif
