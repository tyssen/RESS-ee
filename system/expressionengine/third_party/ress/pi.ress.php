<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$plugin_info = array(
  'pi_name' => 'RESS',
  'pi_version' =>'1.0.0',
  'pi_author' =>'John Faulds',
  'pi_author_url' => 'http://www.tyssendesign.com.au',
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
		if(!isset($_COOKIE['resolution'])) 
		{
			return "<script>document.cookie='resolution='+$(window).width()+'; path=/';location.reload(true);</script>";
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
	  function usage()
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

/* End of file pi.plugin_name.php */
/* Location: ./system/expressionengine/third_party/plugin_name/pi.plugin_name.php */