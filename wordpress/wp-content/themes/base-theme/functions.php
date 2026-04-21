<?php
/**
 * Base Theme functions.
 *
 * @package Base_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Load Composer dependencies.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
} else {
	add_action(
		'admin_notices',
		function () {
			echo '<div class="error"><p>Composer autoload not found. Run <code>composer install</code> in the theme directory.</p></div>';
		}
	);
	return;
}

// Include function files.
require_once get_template_directory() . '/Functions/enqueue-scripts.php';
require_once get_template_directory() . '/Functions/theme-supports.php';

// Instantiate the classes.
new Base\Theme\EnqueueScripts();
new Base\Theme\ThemeSupports();
