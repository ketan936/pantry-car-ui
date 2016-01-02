<?php

use Cocur\Slugify\Slugify;
$slugify    = new Slugify();
// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Home', URL::to('/'));
});

Breadcrumbs::register('Choose Station', function($breadcrumbs,$param)
{   
	$appendParamurl = "";
    if(isset($param['search_type']) && $param['search_type'] == 'pnr_search' && !empty($param['pnr_number'])){
    	 $breadcrumbs->parent('home');
    	 $appendParamurl = Helper::httpBuildQuery(array("search_type" => "pnr_search","pnr_number" => $param['pnr_number']));
    }	
    else if(isset($param['search_type']) && $param['search_type'] == 'train_search'){
    	 $appendParamurl = Helper::httpBuildQuery($param);
         $breadcrumbs->parent('home');
   }
   if(!empty($appendParamurl)){
      $breadcrumbs->push('Choose Station', URL::to('/selectStation')."?".$appendParamurl);
   }
});

Breadcrumbs::register('Choose Restaurant', function($breadcrumbs,$param) use ($slugify)
{
    $appendParamurl = Helper::httpBuildQuery($param);
    $resUrl = \URL::to("/")."/restaurants/".$param['station_code']."/".$slugify->slugify("restaurants near by new delhi railway station ")."?".$appendParamurl;
    $breadcrumbs->parent('Choose Station',$param);
    $breadcrumbs->push('Choose Restaurant', $resUrl);
});

Breadcrumbs::register('Choose Menu', function($breadcrumbs,$param)
{
    if(!empty($param['restaurant_id'])){
        $restaurantsUrl = $param['restaurant_id'];
        unset($param['restaurant_id']);
        $appendParamurl = Helper::httpBuildQuery($param);
        if(!empty($appendParamurl)){
            $restaurantsUrl = URL::to('/').'/restaurant/'.$restaurantsUrl."?".$appendParamurl;
        }
        else{
            $restaurantsUrl = URL::to('/').'/restaurant/'.$restaurantsUrl;
        }
    }
    else{
        $restaurantsUrl = '#';
    }
    $breadcrumbs->parent('Choose Restaurant',$param);
    $breadcrumbs->push('Choose Menu', $restaurantsUrl );
});

Breadcrumbs::register('Checkout', function($breadcrumbs,$param)
{
    $breadcrumbs->parent('Choose Menu',$param);
    $breadcrumbs->push('Checkout', '#');
});

