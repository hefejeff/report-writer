<?php
namespace SiteGround_Optimizer\Config;

use SiteGround_Helper\Helper_Service;

/**
 * Config functions and main initialization class.
 */
class Config {
	/**
	 * The config filename.
	 *
	 * @since 7.3.0
	 */
	const SGO_CONFIG = \SiteGround_Optimizer\DIR . '/sg-config.json';

	/**
	 * List of all optimization that we want to keep in the config.
	 *
	 * @access public
	 *
	 * @since 7.3.0
	 * 
	 * @var array $config_options List of all options.
	 */
	public $config_options = array(
		'version',
		'enable_cache',
		'file_caching',
		'preheat_cache',
		'logged_in_cache',
		'enable_memcached',
		'autoflush_cache',
		'user_agent_header',
		'purge_rest_cache',
		'logged_in_cache',
		'ssl_enabled',
		'fix_insecure_content',
		'optimize_css',
		'combine_css',
		'preload_combined_css',
		'optimize_javascript',
		'combine_javascript',
		'optimize_javascript_async',
		'optimize_html',
		'optimize_web_fonts',
		'remove_query_strings',
		'disable_emojis',
		'lazyload_images',
		'webp_support',
		'backup_media',
	);

	/**
	 * Build the config file content using the option values from database.
	 *
	 * @since  7.3.0
	 *
	 * @return array The config content.
	 */
	public function build_config_content() {
		// Init the data array.
		$data = array();

		// Loop through all options and add the value to the data array.
		foreach ( $this->config_options as $option ) {
			// Get the option value.
			$value = get_option( 'siteground_optimizer_' . $option, 0 );
			// Add the value to database. Only the plugin version needs to be a string.
			$data[ $option ] = 'version' === $option ? $value : intval( $value );
		}

		// Return the data.
		return $data;
	}

	/**
	 * Update the config.
	 *
	 * @since 7.3.0
	 */
	public function update_config() {
		// Check for the helper service method.
		if ( ! method_exists( 'SiteGround_Helper\\Helper_Service', 'update_file' ) ) {
			return;
		}

		// Update the config file.
		Helper_Service::update_file( self::SGO_CONFIG, $this->build_config_content() );
	}
}
