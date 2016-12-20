<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * RESS Plugin - Creates a cookie which contains the screen size detected by javascript
 *
 * @package		ress
 * @author		John Faulds ~ <enquiries@tyssendesign.com.au>
 * @link			https://github.com/tyssen/RESS-ee
 * @license		http://creativecommons.org/licenses/by-sa/3.0/
 */

class Ress {

	public function __construct()
	{
		$this->EE = get_instance();
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
/* Location: ./system/user/addons/ress/pi.ress.php */