<?php
/**
 * AB Estúdio theme functions and definitions.
 *
 * @package ABEStudio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ABE_THEME_VERSION', '1.0.0' );

/**
 * Theme setup.
 */
function abe_setup() {
	load_theme_textdomain( 'abestudio', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'responsive-embeds' );

	set_post_thumbnail_size( 1200, 800, true );
	add_image_size( 'abe-portfolio-card', 640, 480, true );

	register_nav_menus(
		array(
			'primary' => __( 'Menu Principal', 'abestudio' ),
			'footer'  => __( 'Menu do Rodapé', 'abestudio' ),
		)
	);
}
add_action( 'after_setup_theme', 'abe_setup' );

/**
 * Enqueue theme styles and scripts.
 */
function abe_scripts() {
	wp_enqueue_style( 'abestudio-style', get_stylesheet_uri(), array(), ABE_THEME_VERSION );
	wp_enqueue_script( 'abestudio-main', get_template_directory_uri() . '/assets/js/main.js', array(), ABE_THEME_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'abe_scripts' );

/**
 * Register widget areas.
 */
function abe_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Rodapé', 'abestudio' ),
			'id'            => 'footer-1',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'abe_widgets_init' );

require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/custom-post-types.php';
