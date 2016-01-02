<div class="col-md-12 hidden" id="complete-journey-detail-popup">
	<form class="overflow-hidden" id="complete-journey-detail-popup-form">
		<div class="form-group col-md-12">
							<label class="col-md-4 control-label pt5">Train Name </label>
							<div class="col-md-4 pl0">
								
                                        <input type="text" id="train_num_" class="form-control input-class" data-autofirst ="true"  required="1"  placeholder="Enter Train Name/Code">
                                        <input type="hidden" id="train_num">
                                        <input type="hidden" id="train_name">
                                  
							</div>
		 </div>

		 <div class="form-group mb20 col-md-12">
							<label class="col-md-4 control-label p5">Station Name </label>
							<div class="col-md-4 pl0">
								<div class="select select-block ">
									<select id="station_name" class="">
										<option value="-1">Select Station</option>
										<option value="NDLS">New Delhi</option>
										<option value="LKO">Lucknow</option>
										<option value="CNB">Kanpur</option>
									</select>
								</div>
							</div>
		 </div>
		 <div class="form-group col-md-12">
							<label class="col-md-4 control-label pt5">Date Of journey </label>
                                        <div class='input-group date date-time-picker col-md-4 pl0' >
                                            <input type='text' class="form-control" name="journey_date" id="journey_date" required="1" placeholder="Enter Journey Date"/>
                                            <span class="input-group-addon cursor-hand">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
		 </div>
		 <div class="form-group buttons col-md-4 col-md-offset-8 ">
                         <button type="submit" class="btn btn-search" id="complete-journey-detail-popup" data-loading-text="Proceed<i class='fa-refresh fa-spin fa ml10'></i>">
                                             Proceed
                           </button>
        </div>
	</form>
</div>

