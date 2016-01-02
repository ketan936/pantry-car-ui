<!DOCTYPE html>
<html lang="en">
@include('meta')
<body>
@include('header')

<body>
    <div class="container no-border">
        <section style="padding-bottom: 50px;">
            <div class="row">
                <div class="col-md-4">
                    <img src="img/default_avatar.png" class="img-rounded img-responsive" />
                    <br />
                    <br />
                    <ul class="nav nav-tabs nav-pills nav-stacked mvertical-navigation">
                        <li class="active"><a data-toggle="tab" href="#details">MY DETAILS</a></li>
                        <li><a data-toggle="tab" href="#orders">MY ORDERS</a></li>
                        <li><a data-toggle="tab" href="#coupons">My COUPONS</a></li>
                    </ul>
                </div>
                 <div class="tab-content form-group col-md-8">
                    <div id="details" class="tab-pane fade in active">
                        @include('edit-profile')
                        @yield('edit-profile-content')
                   </div>
                    <div id="orders" class="tab-pane fade">
                        @include('order-details-on-profile')
                        @yield('order-details-on-profile-content')
                    </div>
                    <div id="coupons" class="tab-pane fade">
                         @include('coupons-on-profile')
                         @yield('coupons-on-profile-content')
                    </div>
                </div>
        </div>
    </section>
        <!-- SECTION END -->
    </div>
    <!-- CONATINER END -->

@extends('footer')

</body>
</html>
