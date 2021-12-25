@if (Session::has('success'))
    <div class="alert alert-success msg">{{ Session::get('success') }}</div>
@endif
@if (Session::has('error'))
    <div class="alert alert-danger msg">{{ Session::get('error') }}</div>
@endif

