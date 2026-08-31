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
		// Formulário de login.
		'Username or Email Address'                                    => 'Usuário ou E-mail',
		'Username'                                                     => 'Usuário',
		'Email'                                                        => 'E-mail',
		'Email Address'                                                => 'E-mail',
		'Password'                                                     => 'Senha',
		'Remember Me'                                                  => 'Lembrar-me',
		'Log In'                                                       => 'Entrar',
		'Log in'                                                       => 'Entrar',
		'Register'                                                     => 'Cadastrar',
		'&larr; Go to %s'                                              => '&larr; Ir para %s',
		'Back to login'                                                => 'Voltar ao login',
		'Show password'                                                => 'Mostrar senha',
		'Hide password'                                                => 'Ocultar senha',
		'You have logged in successfully.'                             => 'Login realizado com sucesso.',
		'You are now logged out.'                                      => 'Você saiu da sua conta.',
		'Your session has expired. Please log in to continue where you left off.' => 'Sua sessão expirou. Faça login novamente para continuar de onde parou.',
		'<strong>Error:</strong> User registration is currently not allowed.' => '<strong>Erro:</strong> o cadastro de usuários está desativado no momento.',
		'<strong>You have successfully updated WordPress!</strong> Please log back in to see what&#8217;s new.' => '<strong>Você atualizou o WordPress com sucesso!</strong> Faça login novamente para ver as novidades.',
		'Recovery Mode Initialized. Please log in to continue.'        => 'Modo de recuperação iniciado. Faça login para continuar.',

		// Erros de autenticação.
		'<strong>Error:</strong> The username field is empty.'         => '<strong>Erro:</strong> o campo de usuário está vazio.',
		'<strong>Error:</strong> The password field is empty.'         => '<strong>Erro:</strong> o campo de senha está vazio.',
		'<strong>Error:</strong> The username <strong>%s</strong> is not registered on this site. If you are unsure of your username, try your email address instead.' => '<strong>Erro:</strong> o usuário <strong>%s</strong> não está cadastrado neste site. Se não tiver certeza do seu usuário, tente seu e-mail.',
		'<strong>Error:</strong> The password you entered for the username %s is incorrect.' => '<strong>Erro:</strong> a senha digitada para o usuário %s está incorreta.',
		'<strong>Error:</strong> The password you entered for the email address %s is incorrect.' => '<strong>Erro:</strong> a senha digitada para o e-mail %s está incorreta.',
		'Unknown email address. Check again or try your username.'     => 'E-mail desconhecido. Confira novamente ou tente seu usuário.',
		'<strong>Error:</strong> Unknown email address. Check again or try your username.' => '<strong>Erro:</strong> e-mail desconhecido. Confira novamente ou tente seu usuário.',
		'<strong>Error:</strong> Unknown username. Check again or try your email address.' => '<strong>Erro:</strong> usuário desconhecido. Confira novamente ou tente seu e-mail.',

		// Esqueci minha senha / redefinição.
		'Lost Password'                                                => 'Esqueci minha senha',
		'Lost your password?'                                          => 'Esqueceu a senha?',
		'Please enter your username or email address. You will receive an email message with instructions on how to reset your password.' => 'Digite seu usuário ou e-mail. Você vai receber uma mensagem com instruções para redefinir sua senha.',
		'Get New Password'                                             => 'Obter nova senha',
		'<strong>Error:</strong> Your password reset link appears to be invalid. Please request a new link below.' => '<strong>Erro:</strong> seu link de redefinição de senha parece ser inválido. Solicite um novo link abaixo.',
		'<strong>Error:</strong> Your password reset link has expired. Please request a new link below.' => '<strong>Erro:</strong> seu link de redefinição de senha expirou. Solicite um novo link abaixo.',
		'<strong>Error:</strong> The email could not be sent. Your site may not be correctly configured to send emails. <a href="%s">Get support for resetting your password</a>.' => '<strong>Erro:</strong> não foi possível enviar o e-mail. Seu site pode não estar configurado corretamente para enviar e-mails. <a href="%s">Peça ajuda para redefinir sua senha</a>.',
		'Password Reset'                                               => 'Redefinição de senha',
		'Reset Password'                                               => 'Redefinir senha',
		'Your password has been reset.'                                => 'Sua senha foi redefinida.',
		'Enter your new password below or generate one.'               => 'Digite sua nova senha abaixo ou gere uma.',
		'New password'                                                 => 'Nova senha',
		'Confirm new password'                                         => 'Confirme a nova senha',
		'Confirm Password'                                             => 'Confirmar senha',
		'Confirm use of weak password'                                 => 'Confirmar uso de senha fraca',
		'Strength indicator'                                           => 'Indicador de força',
		'Generate Password'                                            => 'Gerar senha',
		'Save Password'                                                => 'Salvar senha',
		'The password cannot be a space or all spaces.'                => 'A senha não pode ser um espaço ou só espaços.',
		'<strong>Error:</strong> The passwords do not match.'          => '<strong>Erro:</strong> as senhas não coincidem.',

		// Cadastro.
		'Registration Form'                                            => 'Formulário de cadastro',
		'Register For This Site'                                       => 'Cadastre-se neste site',
		'Registration confirmation will be emailed to you.'            => 'A confirmação do cadastro será enviada por e-mail.',
		'Check your email'                                             => 'Confira seu e-mail',
		'Check your email for the confirmation link, then visit the <a href="%s">login page</a>.' => 'Confira seu e-mail para o link de confirmação e depois acesse a <a href="%s">página de login</a>.',
		'Registration complete. Please check your email, then visit the <a href="%s">login page</a>.' => 'Cadastro concluído. Confira seu e-mail e depois acesse a <a href="%s">página de login</a>.',
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
