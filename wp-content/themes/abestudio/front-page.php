<?php
/**
 * The front page template.
 *
 * @package ABEStudio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$abe_contato_page = get_page_by_path( 'contato' );
$abe_contato_url  = $abe_contato_page ? get_permalink( $abe_contato_page ) : home_url( '/contato/' );

$abe_services = array(
	array(
		'icon'  => '◆',
		'title' => __( 'Design de Produto Digital', 'abestudio' ),
		'desc'  => __( 'Interfaces web e mobile pensadas para conversão, usabilidade e consistência de marca.', 'abestudio' ),
	),
	array(
		'icon'  => '◇',
		'title' => __( 'Desenvolvimento Web', 'abestudio' ),
		'desc'  => __( 'Sites institucionais, landing pages e sistemas sob medida, do zero ao ar.', 'abestudio' ),
	),
	array(
		'icon'  => '●',
		'title' => __( 'Branding & Identidade Visual', 'abestudio' ),
		'desc'  => __( 'Naming, identidade e diretrizes de marca para negócios que querem ser lembrados.', 'abestudio' ),
	),
	array(
		'icon'  => '○',
		'title' => __( 'UI/UX & Prototipagem', 'abestudio' ),
		'desc'  => __( 'Pesquisa, wireframes e protótipos navegáveis antes de qualquer linha de código.', 'abestudio' ),
	),
	array(
		'icon'  => '▲',
		'title' => __( 'Manutenção & Suporte', 'abestudio' ),
		'desc'  => __( 'Evolução contínua, correções e performance para o seu site não parar no tempo.', 'abestudio' ),
	),
);

$abe_portfolio_query = new WP_Query(
	array(
		'post_type'      => 'portfolio',
		'posts_per_page' => 6,
		'no_found_rows'  => true,
	)
);
?>

<section class="hero">
	<div class="container">
		<p class="eyebrow"><?php esc_html_e( 'Estúdio criativo de design & desenvolvimento', 'abestudio' ); ?></p>
		<h1><?php esc_html_e( 'Marcas e produtos digitais com identidade, do briefing ao deploy.', 'abestudio' ); ?></h1>
		<p><?php esc_html_e( 'O AB Estúdio une design e código para criar sites, produtos e marcas que fazem sentido para o seu negócio.', 'abestudio' ); ?></p>
		<div class="hero-actions">
			<a class="button button-accent" href="<?php echo esc_url( get_post_type_archive_link( 'portfolio' ) ); ?>"><?php esc_html_e( 'Ver portfólio', 'abestudio' ); ?></a>
			<a class="button button-ghost" href="<?php echo esc_url( $abe_contato_url ); ?>"><?php esc_html_e( 'Fale com a gente', 'abestudio' ); ?></a>
		</div>
	</div>
</section>

<section class="services" id="servicos">
	<div class="container">
		<div class="section-heading">
			<p class="eyebrow"><?php esc_html_e( 'O que fazemos', 'abestudio' ); ?></p>
			<h2><?php esc_html_e( 'Serviços', 'abestudio' ); ?></h2>
			<p><?php esc_html_e( 'Do posicionamento de marca ao produto no ar — atuamos em cada etapa ou só na que você precisa.', 'abestudio' ); ?></p>
		</div>
		<div class="services-grid">
			<?php foreach ( $abe_services as $abe_service ) : ?>
				<div class="service-card">
					<div class="service-icon"><?php echo esc_html( $abe_service['icon'] ); ?></div>
					<h3><?php echo esc_html( $abe_service['title'] ); ?></h3>
					<p><?php echo esc_html( $abe_service['desc'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="portfolio" id="portfolio">
	<div class="container">
		<div class="portfolio-header">
			<div class="section-heading" style="margin-bottom:0;">
				<p class="eyebrow"><?php esc_html_e( 'Trabalhos recentes', 'abestudio' ); ?></p>
				<h2><?php esc_html_e( 'Portfólio', 'abestudio' ); ?></h2>
			</div>
			<a class="button" href="<?php echo esc_url( get_post_type_archive_link( 'portfolio' ) ); ?>"><?php esc_html_e( 'Ver todos os projetos', 'abestudio' ); ?></a>
		</div>

		<?php if ( $abe_portfolio_query->have_posts() ) : ?>
			<div class="portfolio-grid">
				<?php
				while ( $abe_portfolio_query->have_posts() ) :
					$abe_portfolio_query->the_post();
					get_template_part( 'template-parts/content', 'portfolio-card' );
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		<?php else : ?>
			<p class="portfolio-empty"><?php esc_html_e( 'Em breve, novos projetos por aqui.', 'abestudio' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<section class="cta">
	<div class="container">
		<h2><?php esc_html_e( 'Tem um projeto em mente?', 'abestudio' ); ?></h2>
		<p><?php esc_html_e( 'Conte um pouco sobre a sua ideia e a gente retorna com os próximos passos.', 'abestudio' ); ?></p>
		<a class="button button-accent" href="<?php echo esc_url( $abe_contato_url ); ?>"><?php esc_html_e( 'Iniciar conversa', 'abestudio' ); ?></a>
	</div>
</section>

<?php
get_footer();
