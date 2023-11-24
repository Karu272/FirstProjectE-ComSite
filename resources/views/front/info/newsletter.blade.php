<!-- newsletter -->
<div class="newsletter">
    <form action="{{ url('newsletter') }}" method="post"> @csrf
        <div class="col-md-6 w3agile_newsletter_left">
            <h3>Newsletter</h3>
            <p>Always be update with our latest news and products.</p>
        </div>
        <div class="col-md-6 w3agile_newsletter_right">
            <input type="email" name="email" value="Email" required>
            <input type="submit" value="">
        </div>
        <div class="clearfix"></div>
    </form>
    <!-- Success/error msg -->
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
</div>
{{ Session::forget('success') }}
{{ Session::forget('error') }}
<!-- //newsletter -->
