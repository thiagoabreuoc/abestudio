<?php
/**
 * The main template file.
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

			<p><?php esc_html_e( 'Nenhum conteúdo encontrado.', 'abestudio' ); ?></p>

		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
