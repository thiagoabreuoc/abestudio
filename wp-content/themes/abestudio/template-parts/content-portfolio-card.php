<?php
/**
 * Portfolio card used in grids (front page preview and portfolio archive).
 *
 * @package ABEStudio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$abe_category = abe_portfolio_primary_category();
?>
<a class="portfolio-card" href="<?php the_permalink(); ?>">
	<?php if ( has_post_thumbnail() ) : ?>
		<?php the_post_thumbnail( 'abe-portfolio-card' ); ?>
	<?php endif; ?>
	<div class="portfolio-card-overlay">
		<?php if ( $abe_category ) : ?>
			<p class="portfolio-card-cat"><?php echo esc_html( $abe_category ); ?></p>
		<?php endif; ?>
		<h3><?php the_title(); ?></h3>
	</div>
</a>
