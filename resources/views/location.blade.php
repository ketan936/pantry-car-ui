<!DOCTYPE html>
<html lang="en">
@include('meta')
<body>
@include('header')

<div class="col-md-12 text-center bottom-line-wrap ">
    <h3>We are currently serving at these locations</h3>
    <div class="bottom-line"></div>
    <img src="{{  asset('/img/svg/india-map-location.svg') }}" class="svg-map">
</div>

<div class="col-md-4 col-md-offset-4">
  <div class="pc-rectangle-block mb20 text-center p20">
        <h3><strong>Haven't found out your station ?</strong></h3>
        <h5 class="mb20">Use PantryCar feedback to get things working out .</h5>
        <a href="{{ url('/contact-us') }}" class="pc-btn">
              Write to us
            </a>
       </div>     
</div>
 
@include('footer')
</body>
</html>
