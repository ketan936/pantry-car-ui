<!DOCTYPE html>
<html lang="en">
@include('meta')
<body>
@include('header')

<div class="imagery-header">
    <h3>We would love to here from you</h3>
</div>

 <div class="col-md-12">
       	<div class=" col-md-offset-2 col-md-4 text-left">
       		 <h3>Contact Us</h3>
       		 <p class="contactus-subheading mt20">Call us at : +91-9911869145</p>
       		 <p class="contactus-subheading">Mailing Address</p>
       		  <p>112-A ,Kormangala ,<br> Bangalore ,<br> Karanataka
       		 </p>
           <p class="contactus-subheading">In case of any queries</p>
           <p><i class="glyphicon glyphicon-envelope pr10"></i>care@pantrycar.co.in</p>
       	</div>
       	<div class="col-md-4">
       		<h3 >Feedback</h3>

       		<form class="mt20"  method="POST" style="width:100%">
      						<input type="hidden" name="_token" value="{{ csrf_token() }}">
      						<div class="form-group">
      								<input type="text" class="form-control" name="name" placeholder="* Name">
      						</div>
      						<div class="form-group">
      								<input type="number" class="form-control" name="phonenumber" placeholder="* Phone No.">
      						</div>
      						<div class="form-group">
      								<input type="email" class="form-control" name="email" placeholder="* Email">
      						</div>
      						<div class="form-group">
      								<textarea class="form-control" name="message" placeholder="* Message" rows="4"></textarea>
      						</div>
      						 <div class="form-group buttons">
                                        <button type="submit" class="btn btn-search" id= "station-search-button" data-loading-text="SUBMIT<i class='fa-refresh fa-spin fa ml10'></i>">
                                             SUBMIT
                                        </button>
                  </div>
      	   </form>					
       	</div>
</div>
@include('footer')
</body>
</html>
