<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * RESS Plugin - Creates a cookie which contains the screen size detected by javascript
 *
 * @package		ExpressionEngine
 * @subpackage	Addons
 * @category	Plugin
 * @version		1.0.4
 * @author		John Faulds ~ <enquiries@tyssendesign.com.au>
 * @link		https://github.com/tyssen/RESS-ee
 * @license		http://creativecommons.org/licenses/by-sa/3.0/
 */

 /**
* Changelog
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
  'pi_version' =>'1.0.4',
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
						// Set a cookie to test if they're enabled
						document.cookie = 'testcookie=true';
						cookiesEnabled = (document.cookie.indexOf('testcookie')!=-1)? true : false;

						if (window.outerWidth) {
							document.cookie='screensize='+window.outerWidth+'; path=/';
						} else {
							document.cookie='screensize='+document.documentElement.clientWidth+'; path=/';
						}
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