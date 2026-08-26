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

	</section>

	<button type="button" class="scroll-down" data-scroll-down aria-label="<?php esc_attr_e( 'Rolar para baixo', 'abestudio2026' ); ?>">
		<svg class="scroll-down-icon-mouse" width="14" height="22" viewBox="0 0 14 22" fill="none" xmlns="http://www.w3.org/2000/svg">
			<rect x="1" y="1" width="12" height="20" rx="6" stroke="#232323" stroke-width="1.4"/>
			<rect x="6" y="5" width="2" height="5" rx="1" fill="#232323"/>
		</svg>
		<svg class="scroll-down-icon-arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M6 9l6 6 6-6" stroke="#232323" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>
	</button>
</div>

<section class="about-hello">
	<div class="container">
		<div class="about-hello-row">
			<div class="about-hello-word"><?php esc_html_e( 'Olá.', 'abestudio2026' ); ?></div>
			<h2 class="about-hello-heading"><?php esc_html_e( 'Estamos há mais de', 'abestudio2026' ); ?> <strong><?php esc_html_e( '15 anos', 'abestudio2026' ); ?></strong> <?php esc_html_e( 'criando design digital', 'abestudio2026' ); ?></h2>
			<div class="about-hello-copy">
				<p><?php esc_html_e( 'Cada projeto é idealizado, focando na melhor experiência para nossos parceiros e clientes.', 'abestudio2026' ); ?></p>
				<a href="#" class="about-info-link"><?php esc_html_e( 'Mais', 'abestudio2026' ); ?></a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
