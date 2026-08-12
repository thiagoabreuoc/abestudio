<?php
/**
 * The archive template for the portfolio custom post type.
 *
 * @package ABEStudio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$abe_categories = get_terms(
	array(
		'taxonomy'   => 'categoria_portfolio',
		'hide_empty' => true,
	)
);
?>

<main class="site-main">
	<div class="container">
		<div class="section-heading">
			<p class="eyebrow"><?php esc_html_e( 'Trabalhos', 'abestudio' ); ?></p>
			<h1 class="page-title"><?php esc_html_e( 'Portfólio', 'abestudio' ); ?></h1>
			<p><?php esc_html_e( 'Uma seleção de projetos de design e desenvolvimento do AB Estúdio.', 'abestudio' ); ?></p>
		</div>

		<?php if ( ! empty( $abe_categories ) && ! is_wp_error( $abe_categories ) ) : ?>
			<div class="portfolio-meta">
				<?php foreach ( $abe_categories as $abe_term ) : ?>
					<a href="<?php echo esc_url( get_term_link( $abe_term ) ); ?>"><?php echo esc_html( $abe_term->name ); ?></a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if ( have_posts() ) : ?>
			<div class="portfolio-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', 'portfolio-card' );
				endwhile;
				?>
			</div>

			<?php the_posts_pagination(); ?>

		<?php else : ?>

			<p class="portfolio-empty"><?php esc_html_e( 'Em breve, novos projetos por aqui.', 'abestudio' ); ?></p>

		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
