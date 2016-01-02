<div class="col-md-12" id="footer" >
    <div class="pt20">
      <div class="row">
           <div class="col-md-offset-1 col-md-3 col-lg-3 footer-content">
              <h5>PantryCar</h5>
              <p>Pantry Car is an online food delivery network in Trains </p>
              <h5 class="mt20 pt20">Restaurant owner ?</h5>
              <p>Join our network to boost up your sales and reach out more and more loyal customers .</p>
              <a class="btn btn-primary" href="{{ url('/merchants') }}">Join Now</a>
           </div>
           <div class="col-md-offset-1 col-lg-3 col-md-3 footer-content">
              <h5>Contact Us </h5>
              <p>
                 <i class="glyphicon glyphicon-map-marker pr10"></i><span>Kormangla ,Bangalore ,Karnataka</span>
              </p>
              <p>
                 <i class="fa fa-phone pr10"></i><span>+91 - 9911869145</span>
              </p>
              <p>
                 <i class="glyphicon glyphicon-envelope pr10"></i><span>care@pantrycar.co.in</span>
              </p>
           </div>
           <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 footer-content">
              <h5>News Letter</h5>
              <p>Type your email address below and subscribe to our newsletter</p>
              <p><form role="form">
                    <div class="input-group">
                        <input class="form-control input-class" id="news_letter_subscribe_email" required="1" name="news_letter_subscribe_email" type="text" placeholder="Email Address">
                        <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" id="go">Go!</button>
                       </span> 
                    </div>
                  </form>              
              </p>
           </div>
           <div class="col-md-12 col-sm-12 col-xs-12  center mt35 mb20">
            <ul>
             <li class="floatleft pr10"><a href="#"><img class="tool" title="Facebook" src="{{ asset('/img/facebook.png') }}" alt=""></a></li>
              <li class="floatleft pr10"><a href="#"><img class="tool" title="Twitter" src="{{ asset('/img/twitter.png') }}" alt="" ></a></li>
              <li class="floatleft"><a href="#"><img class="tool" title="Google+" src="{{ asset('/img/google.png') }}" alt="" ></a></li>
             </ul>
         </div>
      </div>
      
      <div class="border"></div>

      <div class="row pt10">
          <div class="col-lg-12 col-md-12 footer-content">
              <div class="col-lg-6 col-md-6">
                <p class="grey" >
                  &copy; 2015 pantrycar.co.in . All rights reserved
                </p>
                  <img src="{{ asset('/img/cod.png') }}" class="img-responsive"><br>
              </div>
              <div class="col-lg-6 col-lg-6 linkset pt20">
                 <a>Terms and Conditions</a>
                 <a>Privacy Policy</a>    
                 <a>Disclaimer</a> 
                 <a href="{{ url('/contact-us') }}">Contact us</a>
                 <a href="{{ url('/about-us') }}">About us</a>
                 <a href="{{ url('/locations') }}">Locations</a>
              </div>
          </div>
      </div>
      </div>  
   </div>  

     <!-- Scripts -->
     <script>window.BASE_PATH = "<?php echo url() ;?>"; </script>
     <script>window.X_ACCESS_TOKEN = "<?php echo Session::token(); ?>"</script>
     <script src="{{ asset('/js/build/vendors.min.js') }} "></script>
     <script src="{{ asset('/js/build/bundle.min.js') }} "></script>
