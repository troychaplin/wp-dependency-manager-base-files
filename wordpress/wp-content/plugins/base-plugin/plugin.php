<?php
/**
 * Plugin Name:       Base Plugin
 * Description:       A starter plugin for a monorepo WordPress project
 * Requires at least: 6.6
 * Requires PHP:      8.2
 * Version:           0.0.1
 * Author:            Troy Chaplin
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       base-plugin
 *
 * @package Base_Plugin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Plugin Version.
if ( ! defined( 'BASE_PLUGIN_VERSION' ) ) {
	define( 'BASE_PLUGIN_VERSION', '0.0.1' );
}

// Define plugin constants.
define( 'BASE_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'BASE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Include Composer's autoload file.
require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

// Instantiate the classes.
$base_plugin_classes = array(
	\Base\Plugin\PluginPaths::class,
	\Base\Plugin\Enqueues::class,
	\Base\Plugin\RegisterBlocks::class,
);

foreach ( $base_plugin_classes as $base_plugin_class ) {
	new $base_plugin_class();
}
