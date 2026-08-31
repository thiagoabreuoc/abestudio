<?php
/**
 * AB Estúdio Tema 2026 — functions and definitions.
 *
 * Work in progress: header + hero banner only for now.
 *
 * @package ABEstudio2026
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ABE2026_THEME_VERSION', '0.1.0' );

/**
 * Theme setup.
 */
function abe2026_setup() {
	load_theme_textdomain( 'abestudio2026', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );

	register_nav_menus(
		array(
			'primary' => __( 'Menu Principal', 'abestudio2026' ),
		)
	);

	// Lets the user upload their own hero photo via Appearance > Customize > Header Image —
	// no baked-in stock photo, no licensing question.
	add_theme_support(
		'custom-header',
		array(
			'width'                 => 1000,
			'height'                => 1300,
			'flex-width'            => true,
			'flex-height'           => true,
			'header-text'           => false,
			'uploads'               => true,
			'default-image'         => '',
		)
	);
}
add_action( 'after_setup_theme', 'abe2026_setup' );

/**
 * Desativa o Speculative Loading do core (WP 7.1+): nesta versão,
 * wp_get_speculative_loading_override() pode retornar null e é repassado
 * sem checagem para WP_Speculation_Rules::is_valid_mode(), que exige uma
 * string — TypeError fatal em toda página, com strict_types ativo.
 */
add_filter( 'wp_speculation_rules_configuration', '__return_null' );

/**
 * Enqueue theme styles and scripts.
 */
function abe2026_scripts() {
	wp_enqueue_style( 'abestudio2026-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap', array(), null );
	wp_enqueue_style( 'abestudio2026-style', get_stylesheet_uri(), array( 'abestudio2026-fonts' ), filemtime( get_stylesheet_directory() . '/style.css' ) );
	wp_enqueue_script( 'abestudio2026-main', get_template_directory_uri() . '/assets/js/main.js', array(), filemtime( get_template_directory() . '/assets/js/main.js' ), true );
}
add_action( 'wp_enqueue_scripts', 'abe2026_scripts' );

/**
 * WordPress marks any custom link that resolves to the front page as
 * "current" — including in-page anchor links like "/#servicos", since the
 * URL fragment never reaches the server and the path alone matches the
 * home URL. Clear the current-item flags (which drive both the printed
 * classes and the aria-current attribute) on anchor links so only the
 * real current page is highlighted in the nav.
 */
function abe2026_fix_anchor_current_item( $items ) {
	foreach ( $items as $item ) {
		if ( false !== strpos( $item->url, '#' ) ) {
			$item->current               = false;
			$item->current_item_ancestor = false;
			$item->current_item_parent   = false;
			$item->classes                = array_diff(
				(array) $item->classes,
				array( 'current-menu-item', 'current_page_item', 'current-menu-parent', 'current_page_parent', 'menu-item-home' )
			);
		}
	}
	return $items;
}
add_filter( 'wp_nav_menu_objects', 'abe2026_fix_anchor_current_item' );

/**
 * Remove o item "Galeria de APPs" ("NOSSOS APPS") do menu do drawer.
 */
function abe2026_remove_gallery_apps_item( $items ) {
	return array_filter(
		$items,
		function ( $item ) {
			return ! in_array( 'nav-menu-gallery-apps', (array) $item->classes, true );
		}
	);
}
add_filter( 'wp_nav_menu_objects', 'abe2026_remove_gallery_apps_item' );

/**
 * DIAGNÓSTICO TEMPORÁRIO: as três funções de customização do login
 * abaixo (estilos, URL do logo, título do logo) estão desativadas
 * pra isolar a causa da tela de login quebrando em produção (render
 * corta logo após "Lembrar-me", sem botão nem link de senha) — já
 * confirmado que NÃO é o filtro de tradução gettext (removido antes
 * e o bug persistiu). Reativar uma de cada vez depois de identificar
 * qual está causando o problema.
 */
// function abe2026_login_styles() {
// wp_enqueue_style( 'abestudio2026-login-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap', array(), null );
// wp_enqueue_style( 'abestudio2026-login', get_template_directory_uri() . '/assets/css/login.css', array(), filemtime( get_template_directory() . '/assets/css/login.css' ) );
// }
// add_action( 'login_enqueue_scripts', 'abe2026_login_styles' );

// function abe2026_login_logo_url() {
// return home_url( '/' );
// }
// add_filter( 'login_headerurl', 'abe2026_login_logo_url' );

// function abe2026_login_logo_title() {
// return get_bloginfo( 'name' );
// }
// add_filter( 'login_headertext', 'abe2026_login_logo_title' );

/**
 * TEMPORARIAMENTE DESATIVADO: o filtro de tradução via gettext/
 * gettext_with_context quebrava a tela de login em produção (render
 * cortava logo após "Lembrar-me", sem botão "Entrar" nem "Esqueceu a
 * senha?"). Produção roda WordPress 7.1, o ambiente local 7.0.3 — o
 * bug não reproduz localmente, provavelmente uma diferença de
 * comportamento do core entre as duas versões. Precisa investigar com
 * mais segurança (log de erro do servidor) antes de reativar.
 */
