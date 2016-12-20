<?php

/**
 * RESS-ee Add-On Setup file for EE3
 *
 * @package   ress
 * @author    John Faulds ~ <enquiries@tyssendesign.com.au>
 * @link      https://github.com/tyssen/RESS-ee
 * @license   http://creativecommons.org/licenses/by-sa/3.0/
 */

return array(
	'author'         => 'John Faulds',
	'author_url'     => 'https://github.com/tyssen/RESS-ee',
	'docs_url'       => 'https://github.com/tyssen/RESS-ee',
	'name'           => 'RESS-ee',
	'description'    => 'RESS (Responsive Design + Server Side Components) - detect screen resolution via javascript and then set a variable to access in your templates. Useful for creating Responsive layouts that adapt to users’ screen size. Based on https://github.com/jiolasa/Simple-RESS',
	'version'        => '1.0.6',
	'namespace'      => 'Tyssen\Ress',
	'settings_exist' => TRUE
);

/**
* Changelog
*
* Version 1.0.6 20161220
* --------------------
* Updated for EE3
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