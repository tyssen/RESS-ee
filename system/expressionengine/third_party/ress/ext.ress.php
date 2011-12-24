<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Registers the current last segment as a global variable
 *
 * @package		ress
 * @subpackage	ThirdParty
 * @category	Extension
 * @author		John Faulds
 * @link		https://github.com/tyssen/RESS-ee
 */
class Ress_ext {

	var $settings        = array();
	
	var $name            = 'RESS';
	var $version         = '1.0.0';
	var $description     = 'RESS (Responsive Design + Server Side Components) Extension - detect screen resolution via javascript and then set a variable to access in your templates. Useful for creating Responsive layouts that adapt to users’ screen size. Based on https://github.com/jiolasa/Simple-RESS';
	var $settings_exist  = 'y';
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
		$settings = array();

		$settings['fallback_size'] = array('i', '', "960");

		return $settings;
	
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
		
		if ($current < '1.0')
		{
			// Update to version 1.0
		}

		$this->EE->db->where('class', __CLASS__);
		$this->EE->db->update(
			'extensions',
			array('version' => $this->version)
		);
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
		$this->EE->db->where('class', __CLASS__);
		$this->EE->db->delete('extensions');	
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

		$this->settings = array(
			'fallback_size'   => 1024
		);
		
		$class_name = get_class($this);
		foreach($register_hooks as $hook => $method)
		{
			$data = array(                                        
				'class'        => $class_name,
				'method'       => $method,
				'hook'         => $hook,
				'settings'     => "serialize($this->settings)",
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
		$fallback_size = $this->settings['fallback_size'];
		$screensize = !empty($_COOKIE['screensize']) ? $_COOKIE['screensize'] : $fallback_size;
		$this->EE->config->_global_vars['ress'] = $screensize;
	}

}

/* End of file ext.openid.php */ 
/* Location: ./system/expressionengine/third_party/last_segment/ext.last_segment.php */ 