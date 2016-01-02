<!DOCTYPE html>
<html lang="en">
@include('meta')
<body>
@include('header')

<!-- intermediate page for redirecting post social login -->
<?php
  $redirect_param = \Session::get("socialAuthRedirectParam");
  \Session::forget("socialAuthRedirectParam");
?>
 <form action="{{ $redirect_param['redirect_route'] }}" method="{{ $redirect_param['redirect_method'] }}" id="redirectFrom">
	 	<?php 
	 	   unset($redirect_param['redirect_route']); 
	       unset($redirect_param['redirect_method']);
	 	?>
	 @foreach($redirect_param as $key => $val)
	   <input type ="hidden" name="{{ $key }}" value = "{{ $val }}" >
	 @endforeach
 </form>

<!-- on load submit form -->
<script>
   function submitForm(){
	    var form =  document.getElementById("redirectFrom");
	    form.submit();
   }
  window.onload = submitForm();
</script>


</body>
</html>
