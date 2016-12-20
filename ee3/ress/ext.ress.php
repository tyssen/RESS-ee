<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * RESS Extension - Registers the screensize as a global variable
 *
 * @package		ress
 * @author		John Faulds ~ <enquiries@tyssendesign.com.au>
 * @link			https://github.com/tyssen/RESS-ee
 * @license		http://creativecommons.org/licenses/by-sa/3.0/
 */

class Ress_ext {

	public $version = TEMPLATE_SYNC_VER;
	var $settings = array();

	/**
	 * Constructor
	 */
	function __construct($settings='')
	{
		$this->settings = $settings;
		$this->EE = get_instance();    	// Make a local reference to the ExpressionEngine super object
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
	 * Activate the extension
	 *
	 * This function is run on install and will register all hooks
	 *
	 */
	public function activate_extension()
	{
		// Setup custom settings in this array.
		$this->settings = array(
			'fallback_size'   => 960
		);

		$data = array(
			'class'		=> __CLASS__,
			'method'	=> 'on_sessions_start',
			'hook'		=> 'sessions_start',
			'settings'	=> serialize($this->settings),
			'version'	=> $this->version,
			'enabled'	=> 'y'
		);

		$this->EE->db->insert('extensions', $data);

	}

	// ----------------------------------------------------------------------

	/**
	 * on_sessions_start
	 *
	 * @param
	 * @return
	 */

	function on_sessions_start($ref)
	{
		$fallback_size = $this->settings['fallback_size'];
		$screensize = !empty($_COOKIE['screensize']) ? $_COOKIE['screensize'] : $fallback_size;
		$this->EE->config->_global_vars['ress'] = $screensize;
	}

// ----------------------------------------------------------------------

	/**
	 * Disable Extension
	 *
	 * This method removes information from the exp_extensions table
	 *
	 * @return void
	 */
	function disable_extension()
	{
		$this->EE->db->where('class', __CLASS__);
		$this->EE->db->delete('extensions');
	}

	// ----------------------------------------------------------------------

	/**
	 * Update Extension
	 *
	 * This function performs any necessary db updates when the extension
	 * page is visited
	 *
	 * @return 	mixed	void on update / false if none
	 */
	function update_extension($current = '')
	{
		if ($current == '' OR $current == $this->version)
		{
			return FALSE;
		}
	}

	// ----------------------------------------------------------------------
}

/* End of file ext.ress.php */
/* Location: ./system/user/addons/ress/ext.ress.php */