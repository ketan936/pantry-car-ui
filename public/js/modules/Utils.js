var Utils = {

		getElementInsideContainer : function(containerName, childId,isContainerClassOrId) {
		    var elm ;
		    var elms;
		    if(isContainerClassOrId == "id"){
		    	if(document.getElementById(containerName)){
		    	    elms = document.getElementById(containerName).getElementsByTagName("*");
		    	}
		    	else{
		    			return elm;
		    	}
		    }
		    else if(isContainerClassOrId == "class"){
		    	if(document.getElementsByClassName(containerName) && document.getElementsByClassName(containerName)[0]){
 						 elms = document.getElementsByClassName(containerName)[0].getElementsByTagName("*");
		    	}
		    	else{
 					return elm;
		    	}	
		    }
		    
		    for (var i = 0; i < elms.length; i++) {
		        if (elms[i].id === childId) {
		            elm = elms[i];
		            break;
		        }
		    }
		    return elm;
		},
		getParameterByName : function(name) {
				    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
				    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
				        results = regex.exec(location.search);
				    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	    },
	    updateQueryStringParameter : function(uri, key, value) {
				  var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
				  var separator = uri.indexOf('?') !== -1 ? "&" : "?";
				  if (uri.match(re)) {
				    return uri.replace(re, '$1' + key + "=" + value + '$2');
				  }
				  else {
				    return uri + separator + key + "=" + value;
				  }
	   },
	   removeParam :function(key, sourceURL) {
			    var rtn = sourceURL.split("?")[0],
			        param,
			        params_arr = [],
			        queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
			    if (queryString !== "") {
			        params_arr = queryString.split("&");
			        for (var i = params_arr.length - 1; i >= 0; i -= 1) {
			            param = params_arr[i].split("=")[0];
			            if (param === key) {
			                params_arr.splice(i, 1);
			            }
			        }
			        if(params_arr.length){
			          rtn = rtn + "?" + params_arr.join("&");
			        }
			    }
			    return rtn;
	   },
	  isElementInViewport : function(elem) {
			    var $elem = $(elem);
			    var scrollElem = ((navigator.userAgent.toLowerCase().indexOf('webkit') != -1) ? 'body' : 'html');
			    var viewportTop = $(scrollElem).scrollTop();
			    var viewportBottom = viewportTop + $(window).height();
			    var elemTop = Math.round($elem.offset().top);
			    var elemBottom = elemTop + $elem.height();
			    return ((elemTop < viewportBottom) && (elemBottom > viewportTop));
	    }, 
      startAnimation : function(elem) {
			    if (!elem.length) {
			      return;
			    }
			    if (elem.hasClass('animated')) {
			      return;
			    }
			    if (this.isElementInViewport(elem)) {
			      elem.addClass('animated fadeInUp');
			    }
      }
};