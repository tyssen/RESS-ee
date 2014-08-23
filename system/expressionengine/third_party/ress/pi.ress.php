<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * RESS Plugin - Creates a cookie which contains the screen size detected by javascript
 *
 * @package		ExpressionEngine
 * @subpackage	Addons
 * @category	Plugin
 * @version		1.0.5
 * @author		John Faulds ~ <enquiries@tyssendesign.com.au>
 * @link		https://github.com/tyssen/RESS-ee
 * @license		http://creativecommons.org/licenses/by-sa/3.0/
 */

 /**
* Changelog
*
* Version 1.0.5 20140823
* --------------------
* Replaced window.outerWidth with Verge viewportW (https://github.com/ryanve/verge#viewportw) for more accurate viewport width reporting
*
* Version 1.0.4 20120921
* --------------------
* Added check to see if cookies are enabled before doing location.reload(true);
*
* Version 1.0.3 20120419
* --------------------
* Added conditional to check if window.outerWidth is supported as it was reported that the cookie had a value of undefined in IE.
*
* Version 1.0.2 20120109
* --------------------
* Changed Math.max(screen.width,screen.height) to window.outerWidth to measure width width instead of screen width again. Reasons why jQuery's (window).width() and window.innerWidth weren't working on iOS explained in http://tripleodeon.com/2011/12/first-understand-your-screen/
*
* Version 1.0.1 20120109
* --------------------
* Changed (window).width() which requires jQuery to Math.max(screen.width,screen.height) because it was reporting an incorrect size on iOS.
*
* Version 1.0.0 20120109
* --------------------
* Initial public release
*
*/

$plugin_info = array(
  'pi_name' => 'RESS',
  'pi_version' =>'1.0.5',
  'pi_author' =>'John Faulds',
  'pi_author_url' => 'https://github.com/tyssen/RESS-ee',
  'pi_description' => 'RESS (Responsive Design + Server Side Components) plugin - detect screen resolution via javascript and then set a variable to access in your templates. Useful for creating Responsive layouts that adapt to users’ screen size. Based on https://github.com/jiolasa/Simple-RESS',
  'pi_usage' => Ress::usage()
  );

class Ress {

	public function __construct()
	{
		$this->EE =& get_instance();
	}

	public function cookie()
  {
		if(!isset($_COOKIE['screensize']))
		{
			return "<script>
				/*!
				 * verge 1.9.1+201402130803
				 * https://github.com/ryanve/verge
				 * MIT License 2013 Ryan Van Etten
				 */
				!function(a,b,c){'undefined'!=typeof module&&module.exports?module.exports=c():a[b]=c()}(this,'verge',function(){function a(){return{width:k(),height:l()}}function b(a,b){var c={};return b=+b||0,c.width=(c.right=a.right+b)-(c.left=a.left-b),c.height=(c.bottom=a.bottom+b)-(c.top=a.top-b),c}function c(a,c){return a=a&&!a.nodeType?a[0]:a,a&&1===a.nodeType?b(a.getBoundingClientRect(),c):!1}function d(b){b=null==b?a():1===b.nodeType?c(b):b;var d=b.height,e=b.width;return d='function'==typeof d?d.call(b):d,e='function'==typeof e?e.call(b):e,e/d}var e={},f='undefined'!=typeof window&&window,g='undefined'!=typeof document&&document,h=g&&g.documentElement,i=f.matchMedia||f.msMatchMedia,j=i?function(a){return!!i.call(f,a).matches}:function(){return!1},k=e.viewportW=function(){var a=h.clientWidth,b=f.innerWidth;return b>a?b:a},l=e.viewportH=function(){var a=h.clientHeight,b=f.innerHeight;return b>a?b:a};return e.mq=j,e.matchMedia=i?function(){return i.apply(f,arguments)}:function(){return{}},e.viewport=a,e.scrollX=function(){return f.pageXOffset||h.scrollLeft},e.scrollY=function(){return f.pageYOffset||h.scrollTop},e.rectangle=c,e.aspect=d,e.inX=function(a,b){var d=c(a,b);return!!d&&d.right>=0&&d.left<=k()},e.inY=function(a,b){var d=c(a,b);return!!d&&d.bottom>=0&&d.top<=l()},e.inViewport=function(a,b){var d=c(a,b);return!!d&&d.bottom>=0&&d.right>=0&&d.top<=l()&&d.left<=k()},e});

				// Set a cookie to test if they're enabled
				document.cookie = 'testcookie=true';
				cookiesEnabled = (document.cookie.indexOf('testcookie')!=-1)? true : false;

				document.cookie='screensize='+verge.viewportW()+'; path=/';

				// Only reload if cookies are enabled
				if (cookiesEnabled)
				{
					date = new Date();
						date.setDate(date.getDate() -1);
						// Delete test cookie
						document.cookie = 'testcookie=;expires=' + date;
					location.reload(true);
				}
			</script>";
		}
	}

	// --------------------------------------------------------------------
	/**
	 * Usage
	 *
	 * This function describes how the plugin is used.
	 *
	 * @access	public
	 * @return	string
	 */
	  public static function usage()
	  {
	  ob_start();
	  ?>
		Usage example:

		Place {exp:ress:cookie} somewhere in the head of your template to set a cookie based on your window's width.

		The screen width will then be available as an ExpressionEngine variable {ress} which you can use anywhere in your templates.

		Possible scenarios include hiding or showing certain content based on screen size, e.g.: {if {ress} > 480} show larger screen content {/if}

	  <?php
	  $buffer = ob_get_contents();

	  ob_end_clean();

	  return $buffer;
	  }
	  // END

}

/* End of file pi.ress.php */
/* Location: ./system/expressionengine/third_party/ress/pi.ress.php */
