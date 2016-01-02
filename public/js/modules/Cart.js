/*
 *  Cart Model and related events
 */
var Cart = {
    settings: {
        cartTriggerSummary: ('.cart-mobile-summary'),
        lateralCart: $('#cd-cart'),
        shadowLayer: $('#cd-shadow-layer'),
        shadowLayerElement: ('#cd-shadow-layer'),
        eachCategoryMenuItem: (".each-category-menu-item"),
        cartItemRemoveButton: ('.cd-item-remove'),
        cartIncButton: ('.inc-button'),
        cartDecButton: ('.dec-button'),
        cartUserQty: ('.user-cart-qty'),
        cartCheckoutButton: ('.checkout-btn'),
        cartTrigger: $('#cart-trigger'),
        cartTotal: (".cd-cart-total"),
        checkoutForm :$("#checkout-form")

    },
    init: function() {
        this.bindUIActions();
    },
    addItemToCart: function(productToBeAddedInCart, itemSelector) {
        $.ajax({
            cache: false,
            url: BASE_PATH + '/cartHandler',
            data: {
                '_token': X_ACCESS_TOKEN,
                "productDetail": productToBeAddedInCart,
                "case": "ADD_ITEM"
            },
            method: 'POST',
            success: function(data) {
                /* Clear previous cart state */
                if (data.status !== 'undefined' && data.status === 'true') {
                    Cart.settings.cartTrigger.find('#label-cart-item-count').remove();
                    Cart.settings.cartTrigger.append(data.cartItemCount);
                    Cart.appendItemToCart(data.cartItem, itemSelector, data.itemIndex);
                    Cart.checkIfTheItemTobeAddedIsFirstItem();
                    $(Cart.settings.cartTotal).html(data.totalPrice);
                }
            },
            error: function() {}
        });
    },

    showItemInCart: function() {
        $.ajax({
            cache: false,
            url: BASE_PATH + '/getCartMobile',
            method: 'GET',
            success: function(data) {
                $('#cd-cart #cd-cart-items-wrap').html(data);
                $('#cd-cart .horizontal-loader').addClass('hidden');
            },
            error: function() {
                $('#cd-cart .horizontal-loader').addClass('hidden');
            }
        });
    },

    removeItemFromCart: function(productToBeRemoved, itemSelector) {
        $.ajax({
            cache: false,
            url: BASE_PATH + '/cartHandler',
            data: {
                '_token': X_ACCESS_TOKEN,
                "productDetail": productToBeRemoved,
                "case": "REMOVE_ITEM"
            },
            method: 'POST',
            success: function(data) {
                if (data.status !== 'undefined' && data.status == 'true') {
                    Cart.settings.cartTrigger.find('#label-cart-item-count').remove();
                    Cart.settings.cartTrigger.append(data.cartItemCount);
                    $(Cart.settings.cartTotal).html(data.totalPrice);
                    Cart.checkIfTheItemToBeRemovedIsLastItem();
                    Cart.detachItemFromCart(itemSelector);
                }
            },
            error: function() {}
        });
    },

    decrementItemCountFromCart: function(productToBeUpdated, itemSelector) {
        $.ajax({
            cache: false,
            url: BASE_PATH + '/cartHandler',
            data: {
                '_token': X_ACCESS_TOKEN,
                "productDetail": productToBeUpdated,
                "case": "DEC_ITEM"
            },
            method: 'POST',
            success: function(data) {
                if (data.status !== 'undefined' && data.status == 'true') {
                    Cart.settings.cartTrigger.find('#label-cart-item-count').remove();
                    Cart.settings.cartTrigger.append(data.cartItemCount);
                    $(Cart.settings.cartTotal).html(data.totalPrice);
                    $(itemSelector).siblings('.user-cart-qty').val(data.newQty);
                    $(itemSelector).parent().siblings('.cd-price').html(data.itemSubtotal);
                }

            },
            error: function() {}
        });
    },

    incrementItemCountFromCart: function(productToBeUpdated, itemSelector) {
        $.ajax({
            cache: false,
            url: BASE_PATH + '/cartHandler',
            data: {
                '_token': X_ACCESS_TOKEN,
                "productDetail": productToBeUpdated,
                "case": "INC_ITEM"
            },
            method: 'POST',
            success: function(data) {
                if (data.status !== 'undefined' && data.status == 'true') {
                    Cart.settings.cartTrigger.find('#label-cart-item-count').remove();
                    Cart.settings.cartTrigger.append(data.cartItemCount);
                    $(Cart.settings.cartTotal).html(data.totalPrice);
                    $(itemSelector).siblings('.user-cart-qty').val(data.newQty);
                    $(itemSelector).parent().siblings('.cd-price').html(data.itemSubtotal);
                }
            },
            error: function() {}
        });
    },

    updateItemQty: function(productToBeUpdated, itemSelector) {
        $.ajax({
            cache: false,
            url: BASE_PATH + '/cartHandler',
            data: {
                '_token': X_ACCESS_TOKEN,
                "productDetail": productToBeUpdated,
                "case": "UPDATE_ITEM"
            },
            method: 'POST',
            success: function(data) {
                if (data.status !== 'undefined' && data.status == 'true') {
                    Cart.settings.cartTrigger.find('#label-cart-item-count').remove();
                    Cart.settings.cartTrigger.append(data.cartItemCount);
                    $(Cart.settings.cartTotal).html(data.totalPrice);
                    $(itemSelector).siblings('.user-cart-qty').val(data.newQty);
                    $(itemSelector).parent().siblings('.cd-price').html(data.itemSubtotal);
                }
            },
            error: function() {}
        });
    },

    cartCheckout: function() {
       this.settings.checkoutForm.submit();
    },

    checkIfTheItemToBeRemovedIsLastItem: function() {

        if ($('#cd-cart-items-wrap .cd-cart-items').children().length === 0) {
            $('.cart-mobile-summary').append("<span class='mobile-cart-empty'>Your cart is empty .</span>");
            $('#cd-cart-items-wrap .cd-cart-items').append("<span class='cart-empty'>Your cart is empty .</span>");
            $(".cart-mobile-summary .cd-cart-total").remove();
            $(".cart-mobile-footer .checkout-btn").remove();
        }

        if ($('.user-cart .cd-cart-items').children().length === 0) {
            $('.cd-cart-items').html("<span class='cart-empty'>Your cart is empty .</span>");
            $(".user-cart .cd-cart-total").remove();
            $(".user-cart .checkout-btn").remove();
        }
    },

    checkIfTheItemTobeAddedIsFirstItem: function() {
        if ($(".cart-empty").length > 0) {
            $(".cart-empty").remove();
            $('.user-cart').append('<div class="cd-cart-total"></div>');
            $('.user-cart').append('<a href="" class="checkout-btn">Checkout</a>');
        }
        if ($(".mobile-cart-empty").length > 0) {
            $(".mobile-cart-empty").remove();
            $('.cart-mobile-summary').append('<div class="cd-cart-total"></div>');
            $(".cart-mobile-footer").append('<a href="" class="checkout-btn">Checkout</a>');
        }
    },

    appendItemToCart: function(cartItem, itemSelector, target) {
        var cart = $('.cd-cart-items');
        target = $("li[data-index=" + target + "]");
        var imgtodrag = $(itemSelector).find('.item-name');
        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                .offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            })
                .css({
                'opacity': '1',
                'position': 'absolute',
                'height': '150px',
                'width': '150px',
                'z-index': '100'
            });

            if (target !== "undefined" && target.length > 0) {
                $(cartItem).insertAfter(target);
                target.remove();
            } else {
                $(cartItem).appendTo(cart);
            }
        }
        /* trigger this event to cause sticky elements to be recalculated */
        $(".user-cart-large-wrap").trigger("sticky_kit:recalc");
    },

    detachItemFromCart : function(itemSelector){
       $(itemSelector).closest('li').remove();
       /* trigger this event to cause sticky elements to be recalculated */
       $(".user-cart-large-wrap").trigger("sticky_kit:recalc");
    },

    togglePanelVisibility: function(lateralPanel, backgroundLayer, body) {
        if (lateralPanel.hasClass('speed-in')) {
            // firefox transitions break when parent overflow is changed, so we need to wait for the end of the trasition to give the body an overflow hidden
            lateralPanel.removeClass('speed-in').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function() {
                body.removeClass('overflow-hidden');
            });
            backgroundLayer.removeClass('is-visible');
            return "CLOSING_CART";

        } else {
            lateralPanel.addClass('speed-in').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function() {
                body.addClass('overflow-hidden');
            });
            backgroundLayer.addClass('is-visible');
            return "OPENING_CART";
        }
    },
    bindUIActions: function() {

        $('body').on('click', Cart.settings.cartTriggerSummary, function(event) {
            event.preventDefault();
            var returnStatus = Cart.togglePanelVisibility(Cart.settings.lateralCart, Cart.settings.shadowLayer, $('body'));
            $('#cd-cart .horizontal-loader').removeClass('hidden');
            if (returnStatus == "OPENING_CART") {
                Cart.showItemInCart();
            }
        });

        $('body').on('click', Cart.settings.eachCategoryMenuItem, function(event) {
            var productToBeAddedInCart = {
                "productId": $(this).find('.item-name').attr('data-product-id'),
                "productTitle": $(this).find('.item-name').attr('data-product-title'),
                "productPrice": $(this).find('.item-name').attr('data-product-price')
            };
            Cart.addItemToCart(productToBeAddedInCart, $(this));
        });

        $('body').on('click', Cart.settings.shadowLayerElement, function(event) {
            $(this).removeClass('is-visible');
            // firefox transitions break when parent overflow is changed, so we need to wait for the end of the trasition to give the body an overflow hidden
            if (Cart.settings.lateralCart.hasClass('speed-in')) {
                Cart.settings.lateralCart.removeClass('speed-in').on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function() {
                    $('body').removeClass('overflow-hidden');
                });
            } else {
                Cart.settings.lateralCart.removeClass('speed-in');
            }
        });

        $('body').on('click', Cart.settings.cartItemRemoveButton, function(event) {
            event.preventDefault();
            var productId = $(this).attr('data-product-id');
            $('#cd-cart .horizontal-loader').removeClass('hidden');
            Cart.removeItemFromCart(productId);
        });
        $('body').on('click', Cart.settings.cartIncButton, function(event) {
            event.preventDefault();
            var productId = $(this).parent().attr('data-product-id');
            var productToBeAddedInCart = {
                "productId": productId
            };
            Cart.incrementItemCountFromCart(productToBeAddedInCart, $(this));
        });
        $('body').on('click', Cart.settings.cartDecButton, function(event) {
            event.preventDefault();
            var productId = $(this).parent().attr('data-product-id');
            var productDetail = {
                "productId": productId
            };
            var qty = $(this).siblings('.user-cart-qty').val();
            if (parseInt(qty, 10) === 1) {
                if (confirm("Do you want to remove this item from your order ?")) {
                    Cart.removeItemFromCart(productDetail, $(this));
                }

            } else {
                Cart.decrementItemCountFromCart(productDetail, $(this));
            }
        });
        $('body').on('click', Cart.settings.cartUserQty, function(event) {
            var qty = parseInt($(this).val(), 10);
            var productId = $(this).parent().attr('data-product-id');
            var productDetail = {
                "productId": productId,
                "newQty": qty
            };
            if (qty === 0) {
                if (confirm("Do you want to remove this item from your order ?")) {
                    Cart.removeItemFromCart(productDetail, $(this));
                }
            } else if (!qty) { /* pass */
            } else {
                Cart.updateItemQty(productDetail, $(this));
            }
        });
        $('body').on('click', Cart.settings.cartCheckoutButton, function(event) {
            event.preventDefault();
            Cart.cartCheckout();
        });

        $('body').on('click','.bootbox #complete-journey-detail-popup',function(event){

              var trainNum  = $('.bootbox #complete-journey-detail-popup-form #train_num').val();
              var trainName = $('.bootbox #complete-journey-detail-popup-form #train_name').val();
              var stationCode = $('.bootbox #complete-journey-detail-popup-form #station_name').val();
              var journeyDate = $('.bootbox #complete-journey-detail-popup-form #journey_date').val();

              $('#checkout-form input[name="train_num"]').val(trainNum);
              $('#checkout-form input[name="train_name"]').val(trainNum);
              $('#checkout-form input[name="station_code"]').val(stationCode);
              $('#checkout-form input[name="journey_date"]').val(journeyDate);

              if ($('.bootbox #complete-journey-detail-popup-form')[0].checkValidity() === true) { 
                  var currentUrl = window.location.href;
                  currentUrl     = Utils.removeParam("completeDetails",currentUrl);
                  var url = Utils.updateQueryStringParameter(currentUrl,"train_num",trainNum);
                  url = Utils.updateQueryStringParameter(url,"train_name",trainName);
                  url = Utils.updateQueryStringParameter(url,"station_code",stationCode);
                  url = Utils.updateQueryStringParameter(url,"journey_date",journeyDate);
                  url = Utils.updateQueryStringParameter(url,"checkout",1);
                  window.location.href = url;
              }
        });
       
       if(Utils.getParameterByName('checkout') == 1){
          Cart.cartCheckout();
       }

       $('.bootbox #complete-journey-detail-popup-form').submit(function(event) {
            event.preventDefault();
        });

        /* sticky elements */
        $(".user-cart-large-wrap").stick_in_parent(); 
        $('#res-category-container').stick_in_parent({'parent':$('.restaurant-content-wrapper')}); 
        
        /* animate scroll on click of menu category */
        $('#res-category-container .res-category').find('a').each(function() {
            $(this).click(function(){
                var $href = $(this).attr('href');
                var $anchor = $($href).offset();
                $('body').animate({ scrollTop: $anchor.top });
                return false;
            });
        });
    }

};

$(document).ready(function() {

    Cart.init();

});