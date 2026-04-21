<?php
/**
 * Theme supports.
 *
 * @package Base_Theme
 */

namespace Base\Theme;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThemeSupports
 *
 * Registers theme feature supports.
 *
 * @package Base_Theme
 */
class ThemeSupports {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'set_theme_supports' ) );
	}

	/**
	 * Register theme supports.
	 */
	public function set_theme_supports() {
		add_theme_support( 'editor-styles' );
		add_editor_style( 'build/editor-styles.css' );

		add_theme_support( 'post-thumbnails' );

		remove_theme_support( 'core-block-patterns' );

		add_theme_support( 'title-tag' );

		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);
	}
}
