<!DOCTYPE html>
<html lang="en">
@include('meta')
<body>
@include('header')
		<div class="col-md-10 col-md-offset-1">
			<div class="col-md-8">
				 <h1 class="error-text-jumbo">Oops</h1>
				 <div class="error-msg">Either page doesn't exist at this URL or you typed wrong URL</div>
				 <div class="error-code">Error code : 404</div>
				 <ul class="list-unstyled mt20">
				        <li>Here are some helpful links instead:</li>
				        <li><a href="{{ url('/') }}">Home</a></li>
				        <li><a href="{{ url('/contact-us') }}">Contact us</a></li>
				        <li><a href="{{ url('/merchants') }}">Merchants</a></li>
				        <li><a href="{{ url('/locations') }}">Locations</a></li>
				        <li><a href="{{ url('/privacy-policy') }}">Privacy Policies</a></li>
              </ul>
			</div>
			<div class="col-md-4">
				 	<img src="{{ asset('/img/error-icon.gif') }}" width="313" height="428">
			</div>
		</div>
@include('footer')		
	</body>
</html>
