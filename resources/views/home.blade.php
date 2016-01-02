<!DOCTYPE html>
<html lang="en">
@include('meta')
<body>
@include('header')

<div class="full-width-container-home landing-background ">
  @if(null != Session::get('error_message')) 
  <div class="alert alert-info">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <p> {{ Session::get('error_message') }} </p>
  </div>
  @endif
  @if(null != Session::get('success_message')) 
  <div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <p> {{ Session::get('success_message') }} </p>
  </div>
  @endif
  <div class="col-md-12 col-md-offset-3 mt20">
  	<div class="subheading"> BOOK YOUR MEAL ON THE GO </div>
        <div class="home-paging-landing-search-form">
                                <form role="form" class="home-page-search-form" id= "pnr-search-form" method="get" action="{{ url ('/selectStation') }}">
                                    <input name="search_type" type="hidden" value="pnr_search">

                                    <div class="form-group">
                                        <input class="form-control input-class" id="pnr_number" required="1" pattern=".{10,10}" title="Only 10 characters" name="pnr_number" type="text" placeholder="Enter PNR">
                                    </div>
                                    <div class="pnr-type-ahead">
                                      <div class="horizontal-loader hidden"></div>
                                      <div class="col-md-12" id="pnr-search-result-container">
                                        <div class="right-arrow-icon__pnr_result hidden"></div>
                                        <div id="pnr_result_message_any" class="hidden"></div>
                                         <div id="pnr_date"></div>
                                         <div class="floatleft textleft">
                                                <div id="pnr_train_num"></div>
                                                <div id="pnr_src_station_name"></div>
                                                <div id="pnr_src_station_code"></div>
                                                <div id="pnr_status"></div>
                                         </div>
                                         <div class="floatright textleft">
                                                <div id="pnr_train_name"></div>
                                                <div id="pnr_dest_station_name"></div>
                                                <div id="pnr_dest_station_code"></div>
                                                <div id="pnr_seat"></div>
                                         </div> 
                                      </div> 
                                    </div>

                                    <div class="form-group buttons">
                                        <button type="submit" class="btn btn-search" id="pnr-form-submit"
                                          data-loading-text="GET YOUR FOOD<i class='fa-refresh fa-spin fa ml10'></i>">
                                              <span>GET YOUR FOOD</span>
                                        </button>
                                    </div>
                                </form>

                        <div class="divider-wrap">
                            <div class="divider"></div>
                            <span class="or-text">OR</span>        
                            <div class="divider"></div>
                        </div>

                       <form role="form" id= "station-search-form" class="home-page-search-form" >

                                    <div class="form-group">
                                        <input class="form-control input-class" id="source_station_name" val="{{  Input::old('source_station_name') }}" data-autofirst ="true" required="1" type="text" placeholder="Enter Source Station">
                                        <input class="hidden" id="source_station" name="source_station" >
                                    </div>

                                    <div class="form-group">
                                        <input type="text" id="destination_station_name" data-autofirst ="true"  class="form-control input-class" required="1" placeholder="Enter Destination Station">
                                         <input class="hidden" id="destination_station" name="destination_station" >
                                    </div>

                                    <div class="form-group">
                                        <input type="text" id="train_num_" class="form-control input-class" data-autofirst ="true"   placeholder="Enter Train Name/Code (optional)">
                                         <input class="hidden" id="train_num" name="train_num" >
                                    </div>

                                    <div class="form-group">
                                        <div class='input-group date date-time-picker' >
                                            <input type='text' class="form-control" name="journey_date" id="journey_date" required="1" placeholder="Enter Journey Date"/>
                                            <span class="input-group-addon cursor-hand">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div> 

                                    <div class="form-group buttons">
                                        <button type="submit" class="btn btn-search" id= "station-search-button" data-loading-text="GET YOUR FOOD<i class='fa-refresh fa-spin fa ml10'></i>">
                                             GET YOUR FOOD
                                        </button>
                                    </div>
                                </form>
                </div>
  </div>
</div>
<!-- How it works section -->
  <section class="col-md-12 how-it-works-grid">
    <div class="col-md-12 how-it-works-wrap">
       <div class="center pc-heading-home pb20">How it works</div>
        <div class="col-md-4 col-sm-12 col-xs-12 each-how-it-works-block">
          <div class="center">
            <img src="{{ asset ('/img/how_it_works_icon.png') }}" alt="">
          </div>
          <div class="center">
            <h4>Enter PNR/Train Details</h4>
          </div>
        </div>
        <div class="col-md-4 col-sm-12 col-xs-12 each-how-it-works-block">
          <div class="center">
            <img src="{{ asset ('/img/how_it_works_icon.png') }}" alt="">
          </div>
          <div class="center">
            <h4>Choose your favorite menu</h4>
          </div>
        </div>
        <div class="col-md-4 col-sm-12 col-xs-12 each-how-it-works-block" >
          <div class="center">
            <img src="{{ asset ('/img/how_it_works_icon.png') }}" alt="">
          </div>
          <div class="center">
            <h4>Pay and enjoy your meal</h4>
          </div>
        </div>
    </div>
</section>    

<div id="select-train-container">
</div> 

@include('footer')
<script src="{{ asset('/js/build/autosuggest.js') }} "></script>

</body>
</html>
