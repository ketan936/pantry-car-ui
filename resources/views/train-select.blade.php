@if($train_list !== "")
		  <div class="station-select-wrap pagespan head-common-color" >
            					
					@foreach($train_list as $train => $eachTrainDetail)
	                  <div class="each-train-wrap">
                          	<div class="each-train__inner-block no-border-left train-name">
                          		[ {{ $train }} ] {{ $eachTrainDetail['TRAIN_NAME'] }}
                          	</div>
				         	    <div class="each-train__inner-block train-timing">{{ $eachTrainDetail['ARRIVAL_TIME_AT_SOURCE'] }}<i class='fa fa-arrow-right pr10 pl10'></i> {{ $eachTrainDetail['ARRIVAL_TIME_AT_DESTINATION'] }} </div>
				            	<div class="each-train__inner-block select-train-button">
				            		 <a data-loading-text="GET MY FOOD<i class='fa-refresh fa-spin fa ml10'></i>" data-train-code = "{{ $train }}" data-source-station = "{{ strip_tags($train_list_header['SRC_STATION']) }}" data-destination-station = "{{ strip_tags($train_list_header['DESTINATION_STATION']) }}" data-doj ="{{ strip_tags($train_list_header['DATE']) }}"  href="#" class="pc-btn loading-text-button">
					                        SELECT
					                  </a>
					            </div>
	                   </div> 
	                @endforeach
		</div>
@else
		<div class="no-result-grid">
			 <div class="no-result-found">
			 	No Train found against your inputs .Modify your search and then try again .
			 </div>	
			 <div class="form-group buttons">
	                    <a href="#" class="pc-btn bootbox-close-button" data-dismiss="modal">
	                        Close
	                    </a>
	          </div>
          </div> 
		@endif



