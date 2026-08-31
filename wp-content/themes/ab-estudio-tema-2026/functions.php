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

function abe2026_login_styles() {
	wp_enqueue_style( 'abestudio2026-login-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap', array(), null );
	wp_enqueue_style( 'abestudio2026-login', get_template_directory_uri() . '/assets/css/login.css', array(), filemtime( get_template_directory() . '/assets/css/login.css' ) );
}
add_action( 'login_enqueue_scripts', 'abe2026_login_styles' );

function abe2026_login_logo_url() {
	return home_url( '/' );
}
add_filter( 'login_headerurl', 'abe2026_login_logo_url' );

function abe2026_login_logo_title() {
	return get_bloginfo( 'name' );
}
add_filter( 'login_headertext', 'abe2026_login_logo_title' );

/**
 * Traduz os textos padrão da tela de login pra português — o site não
 * tem pacote de idioma pt_BR instalado (arquivos .mo do core), então
 * essas strings vêm em inglês por padrão. Troca só as conhecidas, só
 * nessa tela (domain 'default' = strings do WordPress core). Mapa
 * compartilhado entre gettext e gettext_with_context porque o core
 * registra algumas dessas strings (botão "Log In", "Lost your
 * password?") com contexto de tradutor — só o filtro 'gettext' não
 * pega essas.
 */
function abe2026_login_strings_map() {
	return array(
		'Username or Email Address'                                    => 'Usuário ou E-mail',
		'Username'                                                     => 'Usuário',
		'Email Address'                                                => 'E-mail',
		'Password'                                                     => 'Senha',
		'Confirm Password'                                             => 'Confirmar senha',
		'Confirm new password'                                         => 'Confirme a nova senha',
		'New password'                                                 => 'Nova senha',
		'Remember Me'                                                  => 'Lembrar-me',
		'Log In'                                                       => 'Entrar',
		'Register'                                                     => 'Cadastrar',
		'Lost your password?'                                          => 'Esqueceu a senha?',
		'Reset Password'                                               => 'Redefinir senha',
		'Get New Password'                                             => 'Obter nova senha',
		'Registration confirmation will be emailed to you.'            => 'A confirmação do cadastro será enviada por e-mail.',
		'Please enter your username or email address. You will receive an email message with instructions on how to reset your password.' => 'Digite seu usuário ou e-mail. Você vai receber uma mensagem com instruções para redefinir sua senha.',
		'&larr; Go to %s'                                               => '&larr; Ir para %s',
		'Back to login'                                                => 'Voltar ao login',
		'Show password'                                                => 'Mostrar senha',
		'Hide password'                                                => 'Ocultar senha',
	);
}

function abe2026_translate_login_strings( $translated_text, $text, $domain ) {
	if ( 'default' !== $domain || 'wp-login.php' !== ( $GLOBALS['pagenow'] ?? '' ) ) {
		return $translated_text;
	}

	$strings = abe2026_login_strings_map();

	return $strings[ $text ] ?? $translated_text;
}
add_filter( 'gettext', 'abe2026_translate_login_strings', 20, 3 );

function abe2026_translate_login_strings_with_context( $translated_text, $text, $context, $domain ) {
	return abe2026_translate_login_strings( $translated_text, $text, $domain );
}
add_filter( 'gettext_with_context', 'abe2026_translate_login_strings_with_context', 20, 4 );
