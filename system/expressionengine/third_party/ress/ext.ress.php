<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Registers the current last segment as a global variable
 *
 * @package		ress
 * @subpackage	ThirdParty
 * @category	Extension
 * @author		John Faulds
 * @link		http://www.tyssendesign.com.au/
 */
class Ress_ext {

    var $settings        = array();
    
    var $name            = 'RESS';
    var $version         = '1.0.0';
    var $description     = 'RESS (Responsive Design + Server Side Components) Extension - detect screen resolution via javascript and then set a variable to access in your templates. Useful for creating Responsive layouts that adapt to users’ screen size. Based on https://github.com/jiolasa/Simple-RESS';
    var $settings_exist  = 'n';
    var $docs_url        = '';

    /**
     * Constructor 
     * 
     * @paramarray of settings
     */
    function Ress_ext($settings='')
    {
		$this->settings = $settings;						
		$this->EE =& get_instance();    	// Make a local reference to the ExpressionEngine super object							
    }
    
    
    
	/**
	 * Settings
	 */
	function settings()
	{

	}

    
	
	/**
	 * Update the extension
	 * 
	 * @param $current current version number
	 * @return boolean indicating whether or not the extension was updated 
	 */
	function update_extension($current='')
	{    
	    if ($current == '' OR $current == $this->version)
	    {
	        return FALSE;
	    }
	    
	    return FALSE;
	    // update code if version differs here
	}
		
	/**
	 * Disable the extention
	 * 
	 * @return unknown_type
	 */    
	function disable_extension()
	{		
		//
		// Remove added hooks
		//
		$this->EE->db->delete('extensions', array('class'=>get_class($this)));
			
	}

    /**
     * Activate the extension
     * 
     * This function is run on install and will register all hooks
     * 
     */
	function activate_extension()
	{
		
		 // -------------------------------------------------
		 // Register the hooks needed for this extension 
		 // -------------------------------------------------
		 
		$register_hooks = array(			
			'sessions_start' => 'on_sessions_start',				
		);
		
		$class_name = get_class($this);
		foreach($register_hooks as $hook => $method)
		{
			$data = array(                                        
				'class'        => $class_name,
				'method'       => $method,
				'hook'         => $hook,
				'settings'     => "",
				'priority'     => 10,
				'version'      => $this->version,
				'enabled'      => "y"
			);
			$this->EE->db->insert('extensions', $data); 	
		}
		
	}

	//
	// HOOKS
	//

	function on_sessions_start($ref)
	{
		$fallback_resolution = 480;
		$res = !empty($_COOKIE['resolution']) ? $_COOKIE['resolution'] : $fallback_resolution;
		$this->EE->config->_global_vars['ress'] = $res;
	}

}

/* End of file ext.openid.php */ 
/* Location: ./system/expressionengine/third_party/last_segment/ext.last_segment.php */ 