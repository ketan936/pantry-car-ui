<!DOCTYPE html>
<html lang="en">
@include('meta')
<body>
@include('header')
 <div class="full-width-container-other">
 	 <div class="col-lg-10 col-lg-offset-1">
 	 	@if(!empty($breadcrumbParam))
 	 	 {!! Breadcrumbs::render('Choose Station',$breadcrumbParam) !!}
 	 	@endif 
 	 	@if($station_list !== "")
 	      <input type="hidden" name="_token" id="csrf_token" value="{{ csrf_token() }}">
 	      <div class="head-common-color" ><h4>SELECT STATION</h4></div>
 	      <div class="station-select-header-wrap">
 	      	 @foreach($station_header as $record)
                    <div class="floatleft station-select-header pr10 pb10 pt10 uppercase" >{!! $record !!}</div>
 	      	  @endforeach	
 	      </div>

		  <div id="station-select-wrap" class="station-select-wrap pagespan head-common-color" >
		  	         <div class="each-station-wrap heading">
		  	         	 <div class="each-station__inner-block textleft pl10">Train Name</div>
		  	         	 <div class="each-station__inner-block">Arrival</div>
		  	         	 <div class="each-station__inner-block">Halt</div>
		  	         	 <div class="each-station__inner-block">Day</div>
		  	         	 <div class="each-station__inner-block"></div>

		  	        </div> 	
					@foreach($station_list as $station => $eachStationDetail)
	                  <div class="each-station-wrap">
	                  	   <input type="hidden" name="station_code" value="{{ $station }}" />
                          	<div class="each-station__inner-block no-border-left textleft pl10 station-name">
                          		[ {{ $station}} ] {{ $eachStationDetail['STATION_NAME'] }}
                          	</div>
				            	<div class="each-station__inner-block train-detail">{{ $eachStationDetail['ARRIVAL_TIME'] }}</div>
				            	<div class="each-station__inner-block train-detail">{{ $eachStationDetail['HALT'] }}</div>
				            	<div class="each-station__inner-block train-detail">{{ $eachStationDetail['DAY'] }}</div>
				            	<div class="each-station__inner-block select-station-button">
				            		    <a  data-loading-text="GET MY FOOD<i class='fa-refresh fa-spin fa ml10'></i>" href="{{ $eachStationDetail['stationSeoUrl'] }}"  class="pc-btn loading-text-button">
					                        GET MY FOOD
					                    </a>
					            </div>
	                   </div> 
	                @endforeach
		</div>
		@else
		<div class="no-result-grid">
			 <div class="no-result-found">
			 	No station found against given input .Modify your search and try again.
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
