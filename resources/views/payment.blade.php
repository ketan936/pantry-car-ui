<!DOCTYPE html>
<html lang="en">
@include('meta')
<body>
@include('header')
<div class="full-width-container-other">
    <div class="col-lg-10 col-lg-offset-1">
        <div class="head-common-color border-bottom "><h4>Order Summary</h4></div>
        <!-- responsive mobile view hide order header starts -->
        <div class="col-md-12" id="view-hide-order-summary-container">
            <span><a data-toggle="collapse" id="view-hide-order-summary" href="#cart-summary-container"
                     aria-expanded="false" aria-controls="cart-summary-container">View Order Details <span
                            class="glyphicon glyphicon-chevron-down"></span></a></span>
            <span class="floatright">Rs 1180</span>
        </div>
        <!-- responsive mobile view hide order header ends -->
        <!--  Order summary starts -->
        <div class="col-md-4 col-md-push-8 mt20 mb20" id="cart-summary-container">
            <div>
                <div class="restaurant-header-image-small">
                    <h3 class="restaurant-name-small">{{  $orderDetail["restaurant_detail"]["name"] }}</h3>
                    <div class="restaurant-address-small">{{  ucwords($orderDetail["restaurant_detail"]["stationDetails"]["stationFullName"]) }}</div>
                </div>
                <div id="cart-summary-panel">
                    <h5 class="textcenter">Order Summary</h5>
                    {!! $cartSummary !!}
                </div>
            </div>
        </div>
        <!--  Order summary ends -->
        <!-- payment grid starts -->
        <div class="col-md-8 mt20 ml-negative-15 col-md-pull-4" id="payment-grid-wrapper">
            <h1> Order
                Status: {{  str_replace(' ', ' ', ucwords(str_replace('_', '  ', $orderDetail["status"]))) }}</h1>
            <div class="text-primary text-uppercase"><span> Payment Mode: {{ $orderDetail["mode_of_payment"] }}</span></div>
            <ul class="list-unstyled mt20">
                <li>Here are some helpful links instead:</li>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/contact-us') }}">Contact us</a></li>
                <li><a href="{{ url('/merchants') }}">Merchants</a></li>
                <li><a href="{{ url('/locations') }}">Locations</a></li>
                <li><a href="{{ url('/privacy-policy') }}">Privacy Policies</a></li>
            </ul>
        </div>
        <!-- payment grid ends -->
    </div>
</div>

@include('footer')
</body>
</html>		