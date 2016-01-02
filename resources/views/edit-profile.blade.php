@section('edit-profile-content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h3 class="head-common-color">Your Profile</h3>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="alert alert-danger hidden"></div>
                   
					<form class="form-horizontal col-md-8" role="form" method="POST" action="{{ url('/auth/register') }}" style="float:left">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Full Name</label>
							<div class="col-md-8">
								<input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-8">
								<input type="email" class="form-control" name="email" value="{{ Auth::user()->id  }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Phone number</label>
							<div class="col-md-8">
								<input type="text" class="form-control" name="phone_number" value="{{ Auth::user()->contactNo  }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Address</label>
							<div class="col-md-8">
								<input type="text" class="form-control" name="address">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">State</label>
							<div class="col-md-8">
								<input type="text" class="form-control" name="state">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Pincode</label>
							<div class="col-md-8">
								<input type="text" class="form-control" name="pincode">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-8 col-md-offset-4">
								<button type="submit" class="btn pc-btn" >
									Save Changes
								</button>
								<button type="submit" class="btn pc-btn" >
									Cancel
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="ajax_loader__wrapper hidden"></div>
	</div>
</div>

@endsection