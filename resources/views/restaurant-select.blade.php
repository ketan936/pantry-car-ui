
<!DOCTYPE html>
<html lang="en">
@include('meta')
<body>
@include('header')

 <div class="full-width-container-other" >
      <div class="container-grid">
        @if(!empty($breadcrumbParam))
          {!! Breadcrumbs::render('Choose Restaurant',$breadcrumbParam) !!}
        @endif  
 	      <div class="head-common-color"><h4>SELECT RESTAURANT</h4></div>
    @if(isset($restaurantsList) && $restaurantsList !== "")
       @if(isset($restaurant_header) && $restaurant_header !== "")
 	      <div class="station-select-header-wrap">
 	      	 @foreach($restaurant_header as $record)
                    <div class="floatleft station-select-header pr10 pb10 pt10" >{!! $record !!}</div>
 	      	  @endforeach	
 	      </div>
        @endif
         <div class="result-found">
            Total {{ count($restaurantsList) }} restaurants found
         </div> 
 	      
	 	   <div class="restaurant-selection-grid">
	 	      @foreach($restaurantsList as $restaurant)
            <a href="{{ $restaurant['restaurantUrl'] }}">
              <div class="restaurant-section">
  	 	      		<div class="restaurant-wrapper ">
                  <div class="res-content"></div> 
                   <div class="res-attributes">
  	 	      			  <div class="tag-restaurant" >
                       {{ $restaurant['restaurantName'] }}
                    </div>
                    <div class="tag-restaurant textright" >
                       08:00 AM - 10:00 PM
                    </div>
                    <div class="tag-restaurant" >
                       Min order Rs 300
                    </div>
                   </div> 
  	 	      		</div>
  	 	        </div>
          </a>
 	      	  @endforeach
 	       </div> 
            @else
         <div class="no-result-grid">
             <div class="no-result-found">
              No restaurant found against given station .Modify your search and then try again.
             </div> 
               <div class="form-group buttons">
                      <a href="{{ url('/') }} " class="pc-btn">
                          GO HOME
                      </a>
            </div>
          </div> 
      @endif
      </div>
</div>

@include('footer')

</body>
</html>
