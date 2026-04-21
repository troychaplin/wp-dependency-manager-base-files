<?php
/**
 * Plugin Paths
 *
 * @package Base_Plugin
 */

namespace Base\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class PluginPaths
 *
 * Provides methods to retrieve the plugin's URL and filesystem path.
 *
 * @package Base_Plugin
 */
class PluginPaths {

	/**
	 * Get the URL to the plugin directory.
	 *
	 * @return string The URL to the plugin directory.
	 */
	public static function plugin_url() {
		if ( ! defined( 'BASE_PLUGIN_URL' ) ) {
			return '';
		}
		return BASE_PLUGIN_URL;
	}

	/**
	 * Get the path to the plugin directory.
	 *
	 * @return string The path to the plugin directory.
	 */
	public static function plugin_path() {
		if ( ! defined( 'BASE_PLUGIN_PATH' ) ) {
			return '';
		}
		return BASE_PLUGIN_PATH;
	}
}
