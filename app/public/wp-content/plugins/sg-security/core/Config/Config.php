<?php
namespace SG_Security\Config;

use SiteGround_Helper\Helper_Service;

/**
 * Config functions and main initialization class.
 */
class Config {
	/**
	 * The config filename.
	 *
	 * @since 1.4.0
	 */
	const SGS_CONFIG = \SG_Security\DIR . '/sg-config.json';

	/**
	 * List of all optimization that we want to keep in the config.
	 *
	 * @access public
	 *
	 * @since 1.4.0
	 * 
	 * @var array $config_options List of all options.
	 */
	public $config_options = array(
		'version',
		'lock_system_folders',
		'wp_remove_version',
		'disable_file_edit',
		'disable_xml_rpc',
		'disable_feed',
		'xss_protection',
		'delete_readme',
		'sg2fa',
		'disable_usernames',
		'disable_activity_log',
	);

	/**
	 * Build the config file content using the option values from database.
	 *
	 * @since  1.4.0
	 *
	 * @return array The config content.
	 */
	public function build_config_content() {
		// Init the data array.
		$data = array();

		// Loop through all options and add the value to the data array.
		foreach ( $this->config_options as $option ) {
			// Get the option value.
			$value = get_option( 'sg_security_' . $option, 0 );
			// Add the value to database. Only the plugin version needs to be a string.
			$data[ $option ] = 'version' === $option ? $value : intval( $value );
		}

		// Return the data.
		return $data;
	}

	/**
	 * Update the config.
	 *
	 * @since 1.4.0
	 */
	public function update_config() {
		// Check for the helper service method.
		if ( ! method_exists( 'SiteGround_Helper\\Helper_Service', 'update_file' ) ) {
			return;
		}

		// Update the config file.
		Helper_Service::update_file( self::SGS_CONFIG, $this->build_config_content() );
	}
}
