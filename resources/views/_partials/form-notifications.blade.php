<!-- Notification -->
@if (Session::has('response.success'))
    <div class="notification success">
        <h3>Successful</h3>
        <p>{!! Session::get('response.success.message') !!}</p>
    </div>
@endif
@if (Session::has('response.error'))
    <div class="notification success">
        <h3>Oops</h3>
        <p>{!! Session::get('response.error.message') !!}</p>
    </div>
@endif
<!-- END Notification -->