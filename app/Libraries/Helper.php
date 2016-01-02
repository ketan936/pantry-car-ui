<?php 
namespace App\Libraries;
use App\Config\Constants;
/*
* Contains all Utilities
*/

class Helper{
	

    const encodingType = PHP_QUERY_RFC3986;
   /* 
     @method Wrapper around http_build_query
     @param array
     @return http_build_query string
   */
  	public static function httpBuildQuery($data){
         if(!empty($data)){
         	  return http_build_query($data,null, "&", self::encodingType);
         }
  		return "";
  	}
  /*
  |----------------------------------------------
  | Custom implementation of http_build_url
  |----------------------------------------------
  */
   public static function  httpBuildUrl($url, $parts = array(), $flags = HTTP_URL_REPLACE, &$new_url = false){
           $keys = array('user','pass','port','path','query','fragment');
            if ($flags & HTTP_URL_STRIP_ALL)
            {
                $flags |= HTTP_URL_STRIP_USER;
                $flags |= HTTP_URL_STRIP_PASS;
                $flags |= HTTP_URL_STRIP_PORT;
                $flags |= HTTP_URL_STRIP_PATH;
                $flags |= HTTP_URL_STRIP_QUERY;
                $flags |= HTTP_URL_STRIP_FRAGMENT;
            }
            else if ($flags & HTTP_URL_STRIP_AUTH)
            {
                $flags |= HTTP_URL_STRIP_USER;
                $flags |= HTTP_URL_STRIP_PASS;
            }

            // Parse the original URL
            $parse_url = parse_url($url);

            // Scheme and Host are always replaced
            if (isset($parts['scheme']))
                $parse_url['scheme'] = $parts['scheme'];
            if (isset($parts['host']))
                $parse_url['host'] = $parts['host'];

            // (If applicable) Replace the original URL with it's new parts
            if ($flags & HTTP_URL_REPLACE)
            {
                foreach ($keys as $key)
                {
                    if (isset($parts[$key]))
                        $parse_url[$key] = $parts[$key];
                }
            }
            else
            {
                // Join the original URL path with the new path
                if (isset($parts['path']) && ($flags & HTTP_URL_JOIN_PATH))
                {
                    if (isset($parse_url['path']))
                        $parse_url['path'] = rtrim(str_replace(basename($parse_url['path']), '', $parse_url['path']), '/') . '/' . ltrim($parts['path'], '/');
                    else
                        $parse_url['path'] = $parts['path'];
                }

                // Join the original query string with the new query string
                if (isset($parts['query']) && ($flags & HTTP_URL_JOIN_QUERY))
                {
                    if (isset($parse_url['query']))
                        $parse_url['query'] .= '&' . $parts['query'];
                    else
                        $parse_url['query'] = $parts['query'];
                }
            }

            // Strips all the applicable sections of the URL
            // Note: Scheme and Host are never stripped
            foreach ($keys as $key)
            {
                if ($flags & (int)constant('HTTP_URL_STRIP_' . strtoupper($key)))
                    unset($parse_url[$key]);
            }


            $new_url = $parse_url;

            return 
                 ((isset($parse_url['scheme'])) ? $parse_url['scheme'] . '://' : '')
                .((isset($parse_url['user'])) ? $parse_url['user'] . ((isset($parse_url['pass'])) ? ':' . $parse_url['pass'] : '') .'@' : '')
                .((isset($parse_url['host'])) ? $parse_url['host'] : '')
                .((isset($parse_url['port'])) ? ':' . $parse_url['port'] : '')
                .((isset($parse_url['path'])) ? $parse_url['path'] : '')
                .((isset($parse_url['query'])) ? '?' . $parse_url['query'] : '')
                .((isset($parse_url['fragment'])) ? '#' . $parse_url['fragment'] : '')
            ;
  }

/*
|----------------------------------------------
| Remove any GET param from the URL passed
|----------------------------------------------
*/
  public static function removeKeyFromUrl($url,$varname){
        list($urlpart, $qspart) = array_pad(explode('?', $url), 2, '');
        parse_str($qspart, $qsvars);
        unset($qsvars[$varname]);
        $newqs = http_build_query($qsvars);
        return $urlpart . '?' . $newqs;
  }

}