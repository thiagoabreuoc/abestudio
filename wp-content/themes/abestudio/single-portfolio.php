<?php
/**
 * The template for displaying a single portfolio project.
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
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class(); ?>>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php abe_portfolio_categories(); ?>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="entry-thumbnail"><?php the_post_thumbnail( 'large' ); ?></div>
				<?php endif; ?>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>

				<a class="back-link button" href="<?php echo esc_url( get_post_type_archive_link( 'portfolio' ) ); ?>">
					<?php esc_html_e( '← Voltar ao portfólio', 'abestudio' ); ?>
				</a>
			</article>
		<?php endwhile; ?>
	</div>
</main>

<?php
get_footer();
