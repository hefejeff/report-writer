<?php
namespace SiteGround_Optimizer\Install_Service;

use SiteGround_Helper\Helper_Service;
use SiteGround_Optimizer\Config\Config;

class Install_7_3_0 extends Install {
	/**
	 * The default install version. Overridden by the installation packages.
	 *
	 * @since 7.3.0
	 *
	 * @access protected
	 *
	 * @var string $version The install version.
	 */
	protected static $version = '7.3.0';

	/**
	 * Run the install procedure.
	 *
	 * @since 7.3.0
	 */
	public function install() {
		// Update config.
		$this->update_config();

		// Update install service option.
		update_option( 'sgo_install_service_7_3_0', 1 );
	}

	/**
	 * Update the config file.
	 *
	 * @since 7.3.0
	 */
	public function update_config() {
		// Only for SiteGround servers.
		if ( ! Helper_Service::is_siteground() ) {
			return;
		}

		$this->config = new Config();
		$this->config->update_config();
	}
}
