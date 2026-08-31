<?php
/**
 * The header for our theme — transparent, sits on top of the hero banner.
 *
 * @package ABEstudio2026
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="orientation-lock" aria-hidden="true">
	<svg class="orientation-lock-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
		<rect x="3" y="7" width="14" height="10" rx="2" stroke="currentColor" stroke-width="1.8"/>
		<path d="M20 9v6M20 9l-2.5-2.5M20 15l-2.5 2.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
	</svg>
	<p><?php esc_html_e( 'Gire seu aparelho para o modo retrato para continuar navegando.', 'abestudio2026' ); ?></p>
</div>
<header id="masthead" class="site-header">
	<div class="container">
		<div class="site-branding">
			<a class="site-logo site-logo-header" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<span class="site-logo-mark" role="img" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></span>
			</a>
		</div>

		<div class="header-actions">
			<?php
			$abe2026_wa_message = 'Olá! 😊 Vi o site da AB Estúdio e adorei o que vocês fazem. Gostaria de solicitar um orçamento!';
			$abe2026_wa_url     = 'https://wa.me/5521975745997?text=' . rawurlencode( $abe2026_wa_message );
			?>
			<nav class="header-nav" aria-label="<?php esc_attr_e( 'Menu Principal', 'abestudio2026' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_class'     => 'header-nav-menu',
						'container'      => false,
						'fallback_cb'    => false,
					)
				);
				?>
			</nav>
			<a class="header-whatsapp" href="<?php echo esc_url( $abe2026_wa_url ); ?>" target="_blank" rel="noopener">
				<span class="header-whatsapp-icon-wrap">
					<svg class="header-whatsapp-icon" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
						<path d="M16.04 2.67C8.83 2.67 2.98 8.52 2.98 15.73c0 2.5.7 4.83 1.9 6.83L3 29.33l6.94-1.82a12.9 12.9 0 0 0 6.1 1.55h.01c7.21 0 13.06-5.85 13.06-13.06 0-3.49-1.36-6.77-3.82-9.24a12.98 12.98 0 0 0-9.25-3.83Zm0 23.9h-.01a10.9 10.9 0 0 1-5.55-1.52l-.4-.24-4.12 1.08 1.1-4.02-.26-.41a10.83 10.83 0 0 1-1.66-5.77c0-6.01 4.89-10.9 10.91-10.9a10.84 10.84 0 0 1 7.71 3.2 10.83 10.83 0 0 1 3.19 7.71c0 6.02-4.9 10.87-10.91 10.87Zm5.98-8.16c-.33-.16-1.94-.96-2.24-1.07-.3-.11-.52-.16-.74.16-.22.33-.85 1.07-1.04 1.29-.19.22-.38.24-.71.08-.33-.16-1.38-.51-2.63-1.62-.97-.86-1.63-1.93-1.82-2.25-.19-.33-.02-.5.14-.66.15-.15.33-.38.49-.58.16-.19.22-.33.33-.55.11-.22.05-.41-.03-.58-.08-.16-.74-1.78-1.01-2.44-.27-.64-.54-.56-.74-.57-.19-.01-.41-.01-.63-.01-.22 0-.58.08-.88.41-.3.33-1.15 1.12-1.15 2.74s1.18 3.18 1.34 3.4c.16.22 2.32 3.55 5.63 4.98.79.34 1.4.55 1.88.7.79.25 1.51.21 2.08.13.63-.09 1.94-.79 2.22-1.55.27-.77.27-1.42.19-1.55-.08-.14-.3-.22-.63-.38Z"/>
					</svg>
				</span>
				<span class="header-whatsapp-text-mobile"><?php esc_html_e( 'Whatsapp', 'abestudio2026' ); ?></span>
				<span class="header-whatsapp-text-tablet"><?php esc_html_e( 'Fale conosco', 'abestudio2026' ); ?></span>
				<span class="header-whatsapp-tooltip" role="tooltip">
					<strong><?php esc_html_e( 'Horário de atendimento', 'abestudio2026' ); ?></strong>
					<?php esc_html_e( 'Seg. a sex., das 9h às 18h', 'abestudio2026' ); ?>
					<span class="header-whatsapp-countdown" data-whatsapp-countdown aria-live="polite">
						<?php esc_html_e( 'Redirecionando em', 'abestudio2026' ); ?> <span data-countdown-value>5</span>s…
					</span>
				</span>
			</a>
			<a class="apps-badge apps-badge-mobile" href="#">
				<span>APPs</span>
			</a>
			<a class="apps-badge apps-badge-desktop" href="#">
				<svg class="apps-badge-icon" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
					<circle cx="5" cy="5" r="2"/><circle cx="12" cy="5" r="2"/><circle cx="19" cy="5" r="2"/>
					<circle cx="5" cy="12" r="2"/><circle cx="12" cy="12" r="2"/><circle cx="19" cy="12" r="2"/>
					<circle cx="5" cy="19" r="2"/><circle cx="12" cy="19" r="2"/><circle cx="19" cy="19" r="2"/>
				</svg>
				<span><span class="apps-badge-text-nossos">NOSSOS </span>APPS</span>
			</a>
			<button type="button" class="hamburger" data-nav-toggle aria-expanded="false" aria-controls="nav-drawer" aria-label="<?php esc_attr_e( 'Abrir menu', 'abestudio2026' ); ?>">
				<span></span>
				<span></span>
				<span></span>
			</button>
		</div>
	</div>

	<div class="whatsapp-wrap">
		<svg class="whatsapp-orbit" viewBox="0 0 120 120" aria-hidden="true" focusable="false">
			<defs>
				<path id="whatsapp-orbit-path-top" d="M 21,60 A 39,39 0 0 1 99,60" />
				<path id="whatsapp-orbit-path-bottom" d="M 99,60 A 39,39 0 0 1 21,60" />
			</defs>
			<g class="whatsapp-orbit-spin">
				<text text-anchor="middle">
					<textPath href="#whatsapp-orbit-path-top" startOffset="50%">CHAME NO WHATSAPP •</textPath>
				</text>
				<text text-anchor="middle">
					<textPath href="#whatsapp-orbit-path-bottom" startOffset="50%">CHAME NO WHATSAPP •</textPath>
				</text>
			</g>
		</svg>
		<a class="whatsapp-float" href="<?php echo esc_url( $abe2026_wa_url ); ?>" target="_blank" rel="noopener" aria-label="WhatsApp">
			<svg viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
				<path d="M16.04 2.67C8.83 2.67 2.98 8.52 2.98 15.73c0 2.5.7 4.83 1.9 6.83L3 29.33l6.94-1.82a12.9 12.9 0 0 0 6.1 1.55h.01c7.21 0 13.06-5.85 13.06-13.06 0-3.49-1.36-6.77-3.82-9.24a12.98 12.98 0 0 0-9.25-3.83Zm0 23.9h-.01a10.9 10.9 0 0 1-5.55-1.52l-.4-.24-4.12 1.08 1.1-4.02-.26-.41a10.83 10.83 0 0 1-1.66-5.77c0-6.01 4.89-10.9 10.91-10.9a10.84 10.84 0 0 1 7.71 3.2 10.83 10.83 0 0 1 3.19 7.71c0 6.02-4.9 10.87-10.91 10.87Zm5.98-8.16c-.33-.16-1.94-.96-2.24-1.07-.3-.11-.52-.16-.74.16-.22.33-.85 1.07-1.04 1.29-.19.22-.38.24-.71.08-.33-.16-1.38-.51-2.63-1.62-.97-.86-1.63-1.93-1.82-2.25-.19-.33-.02-.5.14-.66.15-.15.33-.38.49-.58.16-.19.22-.33.33-.55.11-.22.05-.41-.03-.58-.08-.16-.74-1.78-1.01-2.44-.27-.64-.54-.56-.74-.57-.19-.01-.41-.01-.63-.01-.22 0-.58.08-.88.41-.3.33-1.15 1.12-1.15 2.74s1.18 3.18 1.34 3.4c.16.22 2.32 3.55 5.63 4.98.79.34 1.4.55 1.88.7.79.25 1.51.21 2.08.13.63-.09 1.94-.79 2.22-1.55.27-.77.27-1.42.19-1.55-.08-.14-.3-.22-.63-.38Z"/>
			</svg>
		</a>
	</div>

	<div class="nav-drawer" id="nav-drawer" data-nav-drawer>
		<div class="nav-drawer-header">
			<a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<span class="site-logo-mark" role="img" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></span>
			</a>
			<a class="nav-drawer-login" href="<?php echo esc_url( wp_login_url() ); ?>"><?php esc_html_e( 'Entrar', 'abestudio2026' ); ?></a>
			<button type="button" class="nav-drawer-close" data-nav-close aria-label="<?php esc_attr_e( 'Fechar menu', 'abestudio2026' ); ?>"></button>
		</div>
		<nav class="main-navigation" aria-label="<?php esc_attr_e( 'Menu Principal', 'abestudio2026' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_class'     => 'primary-menu',
					'container'      => false,
					'fallback_cb'    => false,
				)
			);
			?>
			<a class="nav-drawer-login nav-drawer-login-end" href="<?php echo esc_url( wp_login_url() ); ?>"><?php esc_html_e( 'Entrar', 'abestudio2026' ); ?></a>
		</nav>
	</div>
	<div class="nav-overlay" data-nav-overlay></div>
</header>
