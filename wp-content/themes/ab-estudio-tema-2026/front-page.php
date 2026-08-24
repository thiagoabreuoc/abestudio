<?php
/**
 * The front page template — header + hero banner only (work in progress).
 *
 * Layout inspired by the Litho "Home Freelancer" demo hero, recreated with
 * plain CSS (gradient, dot pattern, glow circles, rotated word). The hero
 * photo comes from Appearance > Customize > Header Image so no stock asset
 * is baked into the theme.
 *
 * @package ABEstudio2026
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="hero-wrap">
	<section class="hero-banner">
		<span class="hero-glow-0" aria-hidden="true"></span>
		<span class="hero-glow-1" aria-hidden="true"></span>

		<div class="container">
			<div class="hero-copy">
				<h1 class="hero-title">
					<span class="hero-title-solid"><?php esc_html_e( 'ab', 'abestudio2026' ); ?></span>
					<span class="hero-title-outline"><?php esc_html_e( 'estúdio', 'abestudio2026' ); ?></span>
				</h1>
				<div class="hero-quote-wrap">
					<p class="hero-quote">
						<span class="dash" aria-hidden="true"></span>
						<span class="hero-quote-text" data-phrases="<?php echo esc_attr( 'Excelentes experiências digitais|Negócios digitais' ); ?>"><?php esc_html_e( 'Excelentes experiências digitais', 'abestudio2026' ); ?></span>
					</p>
				</div>
			</div>

			<div class="hero-photo">
				<?php if ( has_header_image() ) : ?>
					<img src="<?php header_image(); ?>" alt="<?php esc_attr_e( 'Foto de destaque', 'abestudio2026' ); ?>">
				<?php else : ?>
					<div class="hero-photo-placeholder">
						<span class="avatar-head"></span>
						<span class="avatar-body"></span>
						<span class="hero-photo-hint"><?php esc_html_e( 'Adicione sua foto em Aparência → Personalizar → Imagem de Cabeçalho', 'abestudio2026' ); ?></span>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<?php
		$abe2026_wa_message = 'Olá! 😊 Vi o site da AB Estúdio e adorei o que vocês fazem. Gostaria de solicitar um orçamento!';
		$abe2026_wa_url     = 'https://wa.me/5521985845997?text=' . rawurlencode( $abe2026_wa_message );
		?>
		<a class="hero-whatsapp-float" href="<?php echo esc_url( $abe2026_wa_url ); ?>" target="_blank" rel="noopener" aria-label="WhatsApp">
			<svg viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
				<path d="M16.04 2.67C8.83 2.67 2.98 8.52 2.98 15.73c0 2.5.7 4.83 1.9 6.83L3 29.33l6.94-1.82a12.9 12.9 0 0 0 6.1 1.55h.01c7.21 0 13.06-5.85 13.06-13.06 0-3.49-1.36-6.77-3.82-9.24a12.98 12.98 0 0 0-9.25-3.83Zm0 23.9h-.01a10.9 10.9 0 0 1-5.55-1.52l-.4-.24-4.12 1.08 1.1-4.02-.26-.41a10.83 10.83 0 0 1-1.66-5.77c0-6.01 4.89-10.9 10.91-10.9a10.84 10.84 0 0 1 7.71 3.2 10.83 10.83 0 0 1 3.19 7.71c0 6.02-4.9 10.87-10.91 10.87Zm5.98-8.16c-.33-.16-1.94-.96-2.24-1.07-.3-.11-.52-.16-.74.16-.22.33-.85 1.07-1.04 1.29-.19.22-.38.24-.71.08-.33-.16-1.38-.51-2.63-1.62-.97-.86-1.63-1.93-1.82-2.25-.19-.33-.02-.5.14-.66.15-.15.33-.38.49-.58.16-.19.22-.33.33-.55.11-.22.05-.41-.03-.58-.08-.16-.74-1.78-1.01-2.44-.27-.64-.54-.56-.74-.57-.19-.01-.41-.01-.63-.01-.22 0-.58.08-.88.41-.3.33-1.15 1.12-1.15 2.74s1.18 3.18 1.34 3.4c.16.22 2.32 3.55 5.63 4.98.79.34 1.4.55 1.88.7.79.25 1.51.21 2.08.13.63-.09 1.94-.79 2.22-1.55.27-.77.27-1.42.19-1.55-.08-.14-.3-.22-.63-.38Z"/>
			</svg>
		</a>
	</section>

	<button type="button" class="scroll-down" data-scroll-down aria-label="<?php esc_attr_e( 'Rolar para baixo', 'abestudio2026' ); ?>">
		<svg width="14" height="22" viewBox="0 0 14 22" fill="none" xmlns="http://www.w3.org/2000/svg">
			<rect x="1" y="1" width="12" height="20" rx="6" stroke="#232323" stroke-width="1.4"/>
			<rect x="6" y="5" width="2" height="5" rx="1" fill="#232323"/>
		</svg>
	</button>
</div>

<section class="about-hello">
	<div class="container">
		<div class="about-hello-row">
			<div class="about-hello-word"><?php esc_html_e( 'Olá.', 'abestudio2026' ); ?></div>
			<h2 class="about-hello-heading"><?php esc_html_e( 'Estamos há mais de', 'abestudio2026' ); ?> <strong><?php esc_html_e( '15 anos', 'abestudio2026' ); ?></strong> <?php esc_html_e( 'criando design digital', 'abestudio2026' ); ?></h2>
			<div class="about-hello-copy">
				<p><?php esc_html_e( 'Cada projeto é imaginado, focando na melhor experiência para nossos parceiros e clientes.', 'abestudio2026' ); ?></p>
				<a href="#" class="about-info-link"><?php esc_html_e( 'Mais', 'abestudio2026' ); ?></a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
