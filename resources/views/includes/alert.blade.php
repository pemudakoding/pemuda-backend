@if (Session::has('alert'))
    @if (Session::get('alert')['type'] == 'success')
        <div class="alert alert-success" role="alert">
            {!! Session::get('alert')['message'] !!}
        </div>
    @endif
    @if (Session::get('alert')['type'] == 'error')
        <div class="alert alert-danger" role="alert">
            {!! Session::get('alert')['message'] !!}
        </div>
    @endif
@endif
