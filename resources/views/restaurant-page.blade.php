<!DOCTYPE html>
<html lang="en">
@include('meta')
<body>
@include('header')

 <div class="full-width-container-other" >
        <div class="col-md-10 col-md-offset-1">
        	@if(!empty($breadcrumbParam))
        	{!! Breadcrumbs::render('Choose Menu',$breadcrumbParam) !!}
        	<?php  $fixMargin = ""; ?>
        	@else
        	  <?php $fixMargin = "mt-negative-32"; ?>
        	@endif

 	      <div class="restaurant-header-image {{ $fixMargin }} ">
 	      	  <h3 class="restaurant-name">Al Barista</h3>
 	      	  <div class="restaurant-address">New Delhi Railway Station</div>
 	      </div>
          @if(isset($restaurant_header) && $restaurant_header !== "")
	 	      <div class="station-select-header-wrap mt10">
	 	      	 @foreach($restaurant_header as $record)
	                    <div class="floatleft station-select-header pr10 pb10 pt10" >{!! $record !!}</div>
	 	      	  @endforeach	
	 	      </div>
 	      @endif

 	      <div class="restaurant-content-wrapper">
 	      	<div class="restaurant-menu-details-wrap">
 	      		<div class="restaurant-attributes">
	               <div class="each-restaurant-attributes"><i class="glyphicon glyphicon-ok _icon" ></i>Cash On Delivery Availiable</div>
	               <div class="each-restaurant-attributes"><i class="glyphicon glyphicon-tags _icon"></i>Min Booking Amount : Rs 200</div>
	               <div class="each-restaurant-attributes no-border-right"><i class="glyphicon glyphicon-ok _icon" ></i>Delivery Charges : Free</div>
 	           </div>	
 	      	  <div class="restaurant-menu-label"><i class="fa fa-cutlery _icon"></i>Menu</div>
 	      	  <div id="restaurant-menu-grid-large"> 
 	      	   <div class="floatleft" id="res-category-container">
 	      	     <ul class="res-category">
 	      	     	   <li class="active all" >
			                <a href="#" >All<i class="fa fa-angle-right floatright res-category-arrow pr10"></i></a>
			            </li>
			            <li >
			                <a href="#veg" data-toggle="tab" >Veg<i class="fa fa-angle-right floatright res-category-arrow pr10"></i></a>
			            </li>
			            <li>
			                <a href="#nonveg" data-toggle="tab" >Non - Veg<i class="fa fa-angle-right floatright res-category-arrow pr10"></i></a>
			            </li>
			            <li >
			                <a href="#beverages" data-toggle="tab">Beverages<i class="fa fa-angle-right floatright res-category-arrow pr10"></i></a>
			            </li>
                  </ul>
                </div> 
                 <div class="floatleft tab-content" id="res-menu-item-container">
		 	      		<div class="tab-pane active each-menu-category-wrap" id="veg">
		 	      		  <div class="menu-category">Veg</div>
		 	      		    <div class="each-category-menu-item"><span class="item-name" data-product-id="1" data-product-title="Veg Thali" data-product-price="160">Veg Thali</span><span class="item-price">Rs 160</span></div>
		 	      		   <div class="each-category-menu-item"><span class="item-name" data-product-id="2" data-product-title="Chole Bhature" data-product-price="200">Chole Bhature</span><span class="item-price">Rs 200</span></div>
		 	      		</div> 

		 	      		<div class="tab-pane active each-menu-category-wrap" id="nonveg">
		 	      		  <div class="menu-category">Non - Veg</div>
		 	      		  <div class="each-category-menu-item"><span class="item-name" data-product-id="3" data-product-title="Non -Veg Thali" data-product-price="160">Non - Veg Thali</span><span class="item-price">Rs 240</span></div>
		 	      		  <div class="each-category-menu-item "><span class="item-name" data-product-id="4" data-product-title="Chicken Changezi" data-product-price="160">Chicken Changezi</span><span class="item-price">Rs 200</span></div>
		 	      		  <div class="each-category-menu-item"><span class="item-name" data-product-id="5" data-product-title="Butter Chicken" data-product-price="160">Butter Chicken</span><span class="item-price">Rs 180</span></div>
		 	      		  <div class="each-category-menu-item"><span class="item-name" data-product-id="6" data-product-title="Chicken Afgani" data-product-price="160">Chicken Afgani</span><span class="item-price">Rs 280</span></div>
		 	      		</div>  


		               <div class="tab-pane active each-menu-category-wrap" id="beverages">
		 	      		  <div class="menu-category"  >Beverages</div>
		 	      		  <div class="each-category-menu-item"><span class="item-name" data-product-id="7" data-product-title="Cold Drink" data-product-price="160">Cold Drink</span><span class="item-price">Rs 20</span></div>
		 	      		  <div class="each-category-menu-item "><span class="item-name" data-product-id="8" data-product-title="Lemonade" data-product-price="160">Lemonade</span><span class="item-price">Rs 30</span></div>
		 	      		  <div class="each-category-menu-item"><span class="item-name" data-product-id="9" data-product-title="Apple Juice" data-product-price="160">Apple Juice</span><span class="item-price">Rs 30</span></div>
		 	      		</div>  
 	         	</div>
 	         </div>

 	         	<!-- Mobile -->
            <div class="panel-group accordion mt20" id="restaurant-menu-grid-small">
 	         	<div class="panel panel-default">
 	         		 <div class="panel-heading">
 	         		 	  <h4 class="panel-title">
 	         		 	  	   <a data-toggle="collapse"  href="#veg1" data-parent="#restaurant-menu-grid-small" aria-expanded="false" aria-controls="veg1" >Veg</a>
 	         		 	  	</h4>
 	         		   </div>
 	         		   <div class="panel-collapse collapse in each-menu-category-wrap" id="veg1">
		 	      		    <div class="each-category-menu-item"><span class="item-name" data-product-id="1" data-product-title="Veg Thali" data-product-price="160">Veg Thali</span><span class="item-price">Rs 160</span></div>
		 	      		   <div class="each-category-menu-item"><span class="item-name" data-product-id="2" data-product-title="Chole Bhature" data-product-price="200">Chole Bhature</span><span class="item-price">Rs 200</span></div>
		 	      		</div> 
 	           </div>
 	            <div class="panel panel-default">
 	         		 <div class="panel-heading">
 	         		 	  <h4 class="panel-title">
 	         		 	  	   <a data-toggle="collapse" data-parent="#restaurant-menu-grid-small"  href="#nonveg1" aria-expanded="false" aria-controls="nonveg1" >Non Veg</a>
 	         		 	  	</h4>
 	         		   </div>
 	         		   		 	      		<div class="panel-collapse collapse each-menu-category-wrap" id="nonveg1">
		 	      		  <div class="each-category-menu-item"><span class="item-name" data-product-id="3" data-product-title="Non -Veg Thali" data-product-price="160">Non - Veg Thali</span><span class="item-price">Rs 240</span></div>
		 	      		  <div class="each-category-menu-item "><span class="item-name" data-product-id="4" data-product-title="Chicken Changezi" data-product-price="160">Chicken Changezi</span><span class="item-price">Rs 200</span></div>
		 	      		  <div class="each-category-menu-item"><span class="item-name" data-product-id="5" data-product-title="Butter Chicken" data-product-price="160">Butter Chicken</span><span class="item-price">Rs 180</span></div>
		 	      		  <div class="each-category-menu-item"><span class="item-name" data-product-id="6" data-product-title="Chicken Afgani" data-product-price="160">Chicken Afgani</span><span class="item-price">Rs 280</span></div>
		 	      		</div>  
 	           </div>	


 	           <div class="panel panel-default">
 	         		 <div class="panel-heading">
 	         		 	  <h4 class="panel-title">
 	         		 	  	   <a data-toggle="collapse"  href="#beverages1" data-parent="#restaurant-menu-grid-small" aria-expanded="false" aria-controls="beverages1">Bevrages</a>
 	         		 	  	</h4>
 	         		   </div>
 	         		   	<div class="panel-collapse collapse each-menu-category-wrap" id="beverages1">
		 	      		  <div class="each-category-menu-item"><span class="item-name" data-product-id="7" data-product-title="Cold Drink" data-product-price="160">Cold Drink</span><span class="item-price">Rs 20</span></div>
		 	      		  <div class="each-category-menu-item "><span class="item-name" data-product-id="8" data-product-title="Lemonade" data-product-price="160">Lemonade</span><span class="item-price">Rs 30</span></div>
		 	      		  <div class="each-category-menu-item"><span class="item-name" data-product-id="9" data-product-title="Apple Juice" data-product-price="160">Apple Juice</span><span class="item-price">Rs 30</span></div>
		 	      		</div>  
 	           </div>			   
 	        </div> 		

 	       </div>
 	       <!-- Desktop Cart starts -->
 	      	<div class="user-cart-large-wrap">
 	          <div class="user-cart">
	            <h4>Your Orders</h4>
	             {!! $cartContent !!}
 	         </div>
 	     </div>
 	     <!-- Desktop cart ends -->
 	     <!-- Mobile Cart starts -->
 	      <div class="cart-mobile-footer omit">
 	      	<div class="cart-mobile-summary">
 	      		<i class="icon-shopping-cart shopping-cart-icon-mobile"></i> 
 	      		   @if(Cart::total() > 0)
 	      		    <span class="cd-cart-total"><p>Total Rs <span>{{ Cart::total() }}</span></p></span>
 	      		    @else
 	      		    <span class='mobile-cart-empty'>Your cart is empty .</span>
 	      		    @endif
 	        </div>
 	         @if(Cart::total() > 0)
 	            <a href="" class="checkout-btn">Checkout</a>
 	          @endif	
 	      </div>	
 	       <!-- Mobile Cart ends -->
      </div>
</div>

<div id="cd-shadow-layer"></div>

<!-- Mobile cart content starts -->
<div id="cd-cart">
	 <h2>Cart</h2>
	 <div class="horizontal-loader hidden"></div>
	 <div id="cd-cart-items-wrap"></div>
</div> 	 
</div>
<!-- Mobile cart content ends -->

<form id="checkout-form" method="POST" action="{{ url('/checkout') }}">
	<input type="hidden" value="{{ csrf_token() }}" name="_token" >
	<input type="hidden" value="{{ \Input::get('journey_date') }}" name="journey_date" />
	<input type="hidden" value="{{ \Input::get('train_num') }}" name="train_num">
	<input type="hidden" value="{{ \Input::get('train_name') }}" name="train_name">
	<input type="hidden" value="{{ \Input::get('station_code') }}" name="station_code">
	<input type="hidden" value="{{ \Input::get('search_type') }}" name="search_type">
	<input type="hidden" value="{{ \Input::get('source_station') }}" name="source_station">
	<input type="hidden" value="{{ \Input::get('destination_station') }}" name="destination_station">
	<input type="hidden" value="al-barista-16" name="restaurant_id" >
</form>

@include('partials/complete-journey-details-popup')

@include('footer')
<script src="{{ asset('/js/build/cart.min.js') }} "></script>
<script src="{{ asset('/js/build/autosuggest.js') }} "></script>
</body>
</html>