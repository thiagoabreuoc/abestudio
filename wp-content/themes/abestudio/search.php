<?php
/**
 * The template for displaying search results.
 *
 * @package ABEStudio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main class="site-main">
	<div class="container">
		<h1 class="page-title">
			<?php
			printf(
				/* translators: %s: search query. */
				esc_html__( 'Resultados da busca por: %s', 'abestudio' ),
				'<span>' . get_search_query() . '</span>'
			);
			?>
		</h1>

		<?php if ( have_posts() ) : ?>

			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article <?php post_class(); ?>>
					<h2 class="entry-title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h2>
					<?php abe_posted_on(); ?>
					<div class="entry-summary">
						<?php the_excerpt(); ?>
					</div>
				</article>
			<?php endwhile; ?>

			<?php the_posts_pagination(); ?>

		<?php else : ?>

			<p><?php esc_html_e( 'Nenhum resultado encontrado.', 'abestudio' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
