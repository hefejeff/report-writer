<?php
namespace SG_Security\Install_Service;

use SiteGround_Helper\Helper_Service;
use SG_Security\Config\Config;

class Install_1_4_0 extends Install {
	/**
	 * The default install version. Overridden by the installation packages.
	 *
	 * @since 1.4.0
	 *
	 * @access protected
	 *
	 * @var string $version The install version.
	 */
	protected static $version = '1.4.0';

	/**
	 * Run the install procedure.
	 *
	 * @since 1.4.0
	 */
	public function install() {
		// Only for SiteGround servers.
		if ( ! Helper_Service::is_siteground() ) {
			return;
		}

		// Update config.
		$this->update_config();
	}

	/**
	 * Update the config file.
	 *
	 * @since 1.4.0
	 */
	public function update_config() {
		$this->config = new Config();
		$this->config->update_config();
	}
}
