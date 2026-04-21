<?php
/**
 * Register Blocks
 *
 * @package Base_Plugin
 */

namespace Base\Plugin;

use Base\Plugin\PluginPaths;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class RegisterBlocks
 *
 * Registers custom Gutenberg blocks for the plugin.
 *
 * @package Base_Plugin
 */
class RegisterBlocks {

	/**
	 * Constructor for the class.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_blocks' ) );
	}

	/**
	 * Registers custom Gutenberg blocks for the plugin.
	 *
	 * @return void
	 */
	public function register_blocks() {
		global $wp_filesystem;

		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
			WP_Filesystem();
		}

		$blocks_dirs = array(
			PluginPaths::plugin_path() . 'build/blocks/dynamic/',
			PluginPaths::plugin_path() . 'build/blocks/interactive/',
			PluginPaths::plugin_path() . 'build/blocks/static/',
		);

		foreach ( $blocks_dirs as $blocks_dir ) {
			$block_folders = glob( $blocks_dir . '*', GLOB_ONLYDIR );

			if ( function_exists( 'wp_register_block_metadata_collection' ) ) {
				wp_register_block_metadata_collection(
					$blocks_dir,
					PluginPaths::plugin_path() . 'src/blocks-manifest.php'
				);
			}

			foreach ( $block_folders as $block_path ) {
				$block_json = $block_path . '/block.json';

				if ( $wp_filesystem->exists( $block_json ) ) {
					$block_json_content = $wp_filesystem->get_contents( $block_json );

					if ( false === $block_json_content ) {
						continue;
					}

					$metadata = json_decode( $block_json_content, true );

					if ( json_last_error() !== JSON_ERROR_NONE ) {
						continue;
					}

					if ( isset( $metadata['viewScriptModule'] ) ) {
						add_filter( 'should_load_separate_core_block_assets', '__return_true' );
					}

					register_block_type( $block_path );
				}
			}
		}
	}
}
