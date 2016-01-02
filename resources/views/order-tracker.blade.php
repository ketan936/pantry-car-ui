<!DOCTYPE html>
<html lang="en">
@include('meta')
<body>
@include('header')

<div class="imagery-header">
</div>
 <div class="col-md-8 col-md-offset-2">
               <h3 class="pc-heading">Track Your order</h3>
       		<form class="mt20"  id="order-tracking-form" method="POST">
      						<input type="hidden" name="_token" value="{{ csrf_token() }}">
      						<div class="col-md-6">
		      						<div class="form-group">
		      								<label class="control-label">ENTER YOUR ORDER ID</label>
		      						</div>

		      						<div class="form-group">
		      								<input type="text" class="form-control" name="name">
		      						</div>
                           </div>
                            <div class="col-md-6">
	      						<div class="form-group">
	      								<label class="control-label">ENTER YOUR EMAIL ID</label>
	      						</div>

	      						<div class="form-group">
	      								<input type="email" class="form-control" name="email">
	      						</div>
      					    </div>
      						 <div class="form-group buttons col-md-6 col-md-offset-3">
                                        <button type="submit" class="btn btn-search" id= "station-search-button" data-loading-text="SUBMIT<i class='fa-refresh fa-spin fa ml10'></i>">
                                             SUBMIT
                                        </button>
                           </div>
      	   </form>	
 </div>
@include('footer')
</body>
</html>
