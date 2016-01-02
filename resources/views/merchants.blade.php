<!DOCTYPE html>
<html lang="en">
@include('meta')
<body>
@include('header')

<div class="merchant-header">
    <h3>Take your business a step above by joining Pantry<span class="color-orange">Car</span></h3>
</div>

<!-- How it works section -->
  <section class="col-md-12 how-it-works-grid">
    <div class="col-md-12 how-it-works-wrap">
        <div class="col-md-4 each-how-it-works-block">
          <div class="center">
            <img src="{{ asset ('/img/how_it_works_icon.png') }}" alt="">
          </div>
          <div class="center">
            <h4>Reach new customers</h4>
            <h5 class="col-md-8 col-md-offset-2">Acquire new ,loyal customers from our community users</h5>
          </div>
        </div>
        <div class="col-md-4 each-how-it-works-block">
          <div class="center">
            <img src="{{ asset ('/img/how_it_works_icon.png') }}" alt="">
          </div>
          <div class="center">
            <h4>Online marketplace</h4>
            <h5 class="col-md-8 col-md-offset-2">It's free to join, and you only pay for the orders we send you</h5>
          </div>
        </div>
        <div class="col-md-4 each-how-it-works-block" >
          <div class="center">
            <img src="{{ asset ('/img/how_it_works_icon.png') }}" alt="">
          </div>
          <div class="center">
            <h4>Increase order volume</h4>
            <h5 class="col-md-8 col-md-offset-2">Supplement your sales with additional takeout orders</h5>
          </div>
        </div>
    </div>
</section>   

 <div class="col-md-8 col-md-offset-2">
       		<h3 class="pc-heading">You are just one step away . Join us by filling out below details</h3>

       		<form class="mt20 mb20" id="merchant-listing-form"  method="POST" >
      						<input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="station_name" placeholder="* Station Name">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="restaurant_name" placeholder="* Restaurant Name">
                        </div>
                  </div>

                  <div class="col-md-6">
                        <div class="form-group">
                            <input type="number" class="form-control" name="phonenumber" placeholder="* Phone No.">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="manager_name" placeholder="* Manager Name">
                        </div>
                  </div>

                  <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="minimum_order" placeholder="* Minimum Order">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="* Email id">
                        </div>
                  </div>

                  <div class="col-md-6">
                        <div class="form-group">
                            <textarea class="form-control" name="address"  rows="4" placeholder="* Address"></textarea>
                        </div>
                  </div>

      						 <div class="form-group buttons col-md-6 col-md-offset-3">
                                        <button type="submit" class="btn btn-search" id= "" data-loading-text="SUBMIT<i class='fa-refresh fa-spin fa ml10'></i>">
                                             SUBMIT
                                        </button>
                  </div>
      	   </form>	
    </div>
</div>
@include('footer')
</body>
</html>
