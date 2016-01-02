@section('login-content')
<div class="container-fluid omit" id="pc-signin-signup-form">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-md-7">
						<div class="alert alert-danger hidden"></div>
					<form class="form-horizontal form-signin-email-passwd"  method="POST" style="float:left">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-7">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-7">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-10 col-md-offset-2">
								<button type="submit" class="btn btn-primary" id = "login-button">Login</button>

								<a class="btn btn-link" href="{{ url('/forgotPassword') }}">Forgot Your Password?</a>
							</div>
						</div>
					</form>
					<form class="form-horizontal form-signup-email-passwd hidden" role="form" method="POST" action="{{ url('/auth/register') }}" style="float:left">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-7">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-7">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Phone number</label>
							<div class="col-md-7">
								<input type="text" class="form-control" name="phone-number" value="">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-7">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-7">
								<input type="password" class="form-control" name="cpassword">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary" id="signup-button">
									Register
								</button>
							</div>
						</div>
					</form>

                    </div>
                    <div class="col-md-5">
					 <div class="social-login-links">
					     <button class="btn-social btn-fb" id="fb-login-button" onclick='location.href= "{{ url("/facebook") }}" ;'>Sign in with Facebook</button>
						 <button class="btn-social btn-google" id="google-login-button" onclick='location.href="{{ url("/google") }}" ;'>Sign in with Google</button>
					 </div>
				  </div>
				  <div class="col-md-12 center login-links"><p> Don't have pantrycar account ? <a href="#" id="loadSignup">Click here </a> to create one<p> </div>
				   <div class="col-md-12 center hidden signup-links"><p>Already have pantrycar account ? <a href="#" id="loadSignin">Click here </a> to login<p> </div>		
				</div>
			</div>
		</div>
		<div class="ajax_loader__wrapper hidden"></div>
     		 @if(Session::get('login') === true && Session::get('redirect_param_availiable') === true)
               <input type="hidden" name="redirect_url"  value="{{ Session::get('redirect_url') }}" >
               <input type="hidden" name="redirect_method"  value="{{ Session::get('redirect_method') }}" >
               <input type="hidden" name="redirect_controller"  value="{{ Session::get('redirect_controller')  }}" >
		     @endif
	</div>
</div>


@endsection
