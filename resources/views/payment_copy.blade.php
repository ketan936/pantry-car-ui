<!DOCTYPE html>
<html lang="en">
@include('meta')
<body>
@include('header')
<div class="full-width-container-other">
    <div class="col-lg-10 col-lg-offset-1">
        <div class="head-common-color border-bottom " ><h4>Payment</h4></div>
        <!-- responsive mobile view hide order header starts -->
        <div class="col-md-12" id="view-hide-order-summary-container">
            <span><a data-toggle="collapse" id= "view-hide-order-summary" href="#cart-summary-container" aria-expanded="false" aria-controls="cart-summary-container" >View Order Details <span class="glyphicon glyphicon-chevron-down"></span></a></span>
            <span class="floatright">Rs 1180</span>
        </div>
        <!-- responsive mobile view hide order header ends -->
        <!--  Order summary starts -->
        <div class="col-md-4 col-md-push-8 mt20 mb20" id="cart-summary-container">
            <div>
                <div class="restaurant-header-image-small">
                    <h3 class="restaurant-name-small">Al Barista</h3>
                    <div class="restaurant-address-small">New Delhi Railway Station</div>
                </div>
                <div id="cart-summary-panel">
                    <h5 class="textcenter">Order Summary</h5>
                    {!! $cartSummary !!}
                </div>
            </div>
        </div>
        <!--  Order summary ends -->
        <!-- payment grid starts -->
        <div class="col-md-8 mt20 ml-negative-15 col-md-pull-4"  id="payment-grid-wrapper">
            <ul class="nav nav-tabs nav-stacked col-md-2 pr0">
                <li class="active"><a href="#dc-card" data-toggle="tab">Debit Card</a></li>
                <li><a href="#cc-card" data-toggle="tab">Credit Card</a></li>
                <li><a href="#netbanking" data-toggle="tab">NetBanking</a></li>
                <li><a href="#cod" data-toggle="tab">COD</a></li>
            </ul>
            <!-- tabe content starts -->
            <div class="tab-content col-md-10 payment-grid-right-container" >
                <!-- Debit Cart starts -->
                <div class="tab-pane active payment-grid-right pl20 pt20" id="dc-card">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}" style="float:left;width:100%;">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-12 control-label">DEBIT CARD NUMBER</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="name" value="">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 overflow-hidden">
                                <label class="col-md-12 control-label  ml-negative-15">Expiry Date</label>
                                <div class="select-year-month floatleft">
                                    <div class="select select-block">
                                        <select>
                                            <option value="0">MM</option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                            <option value="06">06</option>
                                            <option value="07">07</option>
                                            <option value="08">08</option>
                                            <option value="09">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="select-year-month floatleft">
                                    <div class="select select-block">
                                        <select>
                                            <option value="0">YY</option>
                                            <option value="2015">2015</option>
                                            <option value="2016">2016</option>
                                            <option value="2017">2017</option>
                                            <option value="2018">2018</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 cvv-wrapper">
                                <label class="control-label">CVV</label>
                                <input type="text" class="form-control" name="name" value="">
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-md-12" id="pay-now-button">
                                <button type="submit" class="btn pc-btn" >
                                    Pay Now
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Debit Cart starts -->
                <!-- Credit Cart start -->
                <div class="tab-pane payment-grid-right pl20 pt20" id="cc-card">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}" style="float:left;width:100%;">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-12 control-label">CREDIT CARD NUMBER</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="name" value="">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="col-md-12 control-label  ml-negative-15">Expiry Date</label>
                                <div class="select-year-month floatleft pr10">
                                    <div class="select select-block">
                                        <select>
                                            <option value="0">MM</option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                            <option value="06">06</option>
                                            <option value="07">07</option>
                                            <option value="08">08</option>
                                            <option value="09">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="select-year-month floatleft">
                                    <div class="select select-block">
                                        <select>
                                            <option value="0">YY</option>
                                            <option value="2015">2015</option>
                                            <option value="2016">2016</option>
                                            <option value="2017">2017</option>
                                            <option value="2018">2018</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">CVV</label>
                                <input type="text" class="form-control" name="name" value="">
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-md-12" id="pay-now-button">
                                <button type="submit" class="btn pc-btn" >
                                    Pay Now
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Credit Cart ends -->
                <!-- Netbanking starts -->
                <div class="tab-pane payment-grid-right pl20 pt20" id="netbanking">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}" style="float:left;width:100%;">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <label class="col-md-12 mb20">SELECT FROM POPULAR BANKS</label>
                        <ul class="bank-list netbanking clearfix pl15">
                            <li> <label class="bankOption">
                                    <input type="radio" class="rdoIn" name="paymentoption" value="SBIN" checked="checked">
                                    <span></span>
                                    <img class="img-responsive" src="{{ asset('/img/statbank.png') }}" alt="SBI" title="SBI" width="98" height="28">
                                </label>
                            </li>
                            <li>
                                <label class="bankOption">
                                    <input type="radio" class="rdoIn" name="paymentoption" value="HDFC">
                                    <span></span>
                                    <img class="img-responsive" src="{{ asset('/img/hdfcbank.png') }}" alt="HDFC" title="HDFC" width="98" height="28">
                                </label>
                            </li>
                            <li> <label class="bankOption">
                                    <input type="radio" class="rdoIn" name="paymentoption" value="ICIC">
                                    <span></span>
                                    <img class="img-responsive" src="{{ asset('/img/icicibank.png') }}" alt="ICICI" title="ICICI" width="98" height="28">
                                </label>
                            </li>
                            <li> <label class="bankOption">
                                    <input type="radio" class="rdoIn" name="paymentoption" value="AXIS">
                                    <span></span>
                                    <img class="img-responsive" src="{{ asset('/img/axisbank.png') }}" alt="AXIS" title="AXIS" width="98" height="28">
                                </label>
                            </li>
                            <li> <label class="bankOption">
                                    <input type="radio" class="rdoIn" name="paymentoption" value="CITA">
                                    <span></span>
                                    <img class="img-responsive" src="{{ asset('/img/citibank.png') }}" alt="CITIBANK" title="CITIBANK" width="98" height="28">
                                </label>
                            </li>
                            <li> <label class="bankOption">
                                    <input type="radio" class="rdoIn" name="paymentoption" value="PNB">
                                    <span></span>
                                    <img class="img-responsive" src="{{ asset('/img/pnb.png') }}" alt="PNB" title="PNB" width="98" height="28">
                                </label>
                            </li>
                        </ul>
                        <label class="col-md-12 mb20">OR CHOOSE FROM OTHER BANK</label>
                        <div class="select-year-month floatleft pl15 mb20">
                            <div class="select select-block">
                                <select>
                                    <option value="0">Select</option>
                                    <option value="PNB">PUNJAB NATIONAL BANK</option>
                                    <option value="HDFC">HDFC</option>
                                    <option value="CITI">CITI</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12" id="pay-now-button">
                                <button type="submit" class="btn pc-btn" >
                                    Pay Now
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
                <!-- Netbanking ends -->
                <!-- COD starts -->
                <div class="tab-pane payment-grid-right pl20 pt20" id="cod">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}" style="float:left;width:100%;">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <label class="col-md-12 mb20 pl0">PAY USING CASH ON DELIVERY</label>
                        <div class="col-md-11 otp-verification-container mb20">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="phone_num" value="9911869145">
                            </div>
                            <div class="col-md-6"><button type="button" id="send-otp-button" class="btn pc-btn pc-grey" >Send OTP</button></div>
                            <div class="col-md-12 mt20">
                                <input type="text" class="form-control" name="otp" value="" placeholder="Enter OTP Recieved">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12" id="pay-now-button">
                                <button type="submit" class="btn pc-btn" >
                                    Confirm Order
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
                <!-- COD ends  -->
            </div>
            <!-- tab content starts -->
            <div class="col-md-12 mt20 ml-negative-15">
                <div class="payment-safe">We encrypt your payment information for secure processing </div>
            </div>
        </div>
        <!-- payment grid ends -->
    </div>
</div>

@include('footer')
</body>
</html>