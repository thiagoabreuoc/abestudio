<?php
/**
 * The archive template for a single "categoria_portfolio" term.
 *
 * @package ABEStudio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$abe_term = get_queried_object();
?>

<main class="site-main">
	<div class="container">
		<div class="section-heading">
			<p class="eyebrow"><?php esc_html_e( 'Categoria', 'abestudio' ); ?></p>
			<h1 class="page-title"><?php echo esc_html( $abe_term->name ); ?></h1>
			<?php if ( ! empty( $abe_term->description ) ) : ?>
				<p><?php echo esc_html( $abe_term->description ); ?></p>
			<?php endif; ?>
		</div>

		<p><a href="<?php echo esc_url( get_post_type_archive_link( 'portfolio' ) ); ?>">&larr; <?php esc_html_e( 'Todos os projetos', 'abestudio' ); ?></a></p>

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

			<p class="portfolio-empty"><?php esc_html_e( 'Nenhum projeto nesta categoria ainda.', 'abestudio' ); ?></p>

		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
