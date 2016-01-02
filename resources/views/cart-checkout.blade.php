<!DOCTYPE html>
<html lang="en">
@include('meta')
<body>
@include('header')
 <div class="full-width-container-other">
 	 <div class="col-lg-10 col-lg-offset-1">
 	 	  @if(!empty($breadcrumbParam))
        	{!! Breadcrumbs::render('Checkout',$breadcrumbParam) !!}
         @endif
 	      <div class="head-common-color" ><h4>Checkout</h4></div>
         <div class="col-md-12" id="view-hide-order-summary-container">
 	       <span><a data-toggle="collapse" id= "view-hide-order-summary" href="#cart-summary-container" aria-expanded="false" aria-controls="cart-summary-container" >View Order Details <span class="glyphicon glyphicon-chevron-down"></span></a></span>
 	        <span class="floatright">Rs 1180</span>
 	     </div>    	
         <div class="col-md-4 col-md-push-8 mb20" id="cart-summary-container">
          <div>
          	 <div class="restaurant-header-image-small">
          	 	  	 <h3 class="restaurant-name-small">Al Barista</h3>
 	      	         <div class="restaurant-address-small">New Delhi Railway Station</div>
          	 </div>
          	 <div id="cart-summary-panel">
          	 	<h5 class="textcenter">Order Summary</h5>
          	 	{!! $cartSummary !!}
          	 </div>
          </div>
        </div>

        <div class="col-md-8 col-md-pull-4 col-sm-12 col-xs-12 ml-negative-15" id="user-travel-details-container">
        	<ul class="booking-info-list">
        		 <li>
        		 	 <span>
        		 	 	 <p class="booking-info-component-label">Date of Journey</p>
        		 	 	 <p class="booking-info-component-value">{!! $bookingDetailHeader['DATE'] !!}</p>
        		 	 </span>	
                 </li>
                 <li>
        		 	 <span>
        		 	 	 <p class="booking-info-component-label">Train Number</p>
        		 	 	 <p class="booking-info-component-value">{!! $bookingDetailHeader['TRAIN_NUM'] !!}</p>
        		 	 </span>	
                 </li>
                 <li>
        		 	 <span>
        		 	 	 <p class="booking-info-component-label">Train Name</p>
        		 	 	 <p class="booking-info-component-value">{!! $bookingDetailHeader['TRAIN_NAME'] !!}</p>
        		 	 </span>	
                 </li>
                 <li>
        		 	 <span>
        		 	 	 <p class="booking-info-component-label">Station Selected</p>
        		 	 	 <p class="booking-info-component-value">{!! $bookingDetailHeader['STATION_SELECTED'] !!}</p>
        		 	 </span>	
                 </li>
	 	      </ul>
 	
         <h4 >Travel Details</h4>
         		 <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}" style="float:left;width:100%;">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Full Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ Auth::user()->id  }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Phone number</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="phone_number" value="{{ Auth::user()->contactNo  }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Status</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="address">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Coach No.</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="state">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Seat No.</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="pincode">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">PNR No.</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="pincode">
							</div>
						</div>
                       <div class="form-group">
                         <label class="col-md-12 control-label">Before proceeding ,please check all details are entered correctly .</label>
                       </div>
						<div class="form-group">
							<div class="col-md-12">
								<button type="submit" class="btn pc-btn" id="proceed-to-pay" >
									Proceed to pay
								</button>
							</div>
						</div>
					</form>
             </div>
	
	 </div>	
</div>

@include('footer')
</body>
</html>
