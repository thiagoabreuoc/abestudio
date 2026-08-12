<?php
/**
 * Custom template tags for this theme.
 *
 * @package ABEStudio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Prints the post meta (date, author) for the current post.
 */
function abe_posted_on() {
	printf(
		'<span class="posted-on">%1$s</span> <span class="byline">%2$s %3$s</span>',
		esc_html( get_the_date() ),
		esc_html__( 'por', 'abestudio' ),
		esc_html( get_the_author() )
	);
}

/**
 * Prints the "categoria_portfolio" terms for the current portfolio item, linked.
 */
function abe_portfolio_categories() {
	$terms = get_the_terms( get_the_ID(), 'categoria_portfolio' );

	if ( empty( $terms ) || is_wp_error( $terms ) ) {
		return;
	}

	echo '<div class="portfolio-meta">';
	foreach ( $terms as $term ) {
		printf(
			'<a href="%1$s">%2$s</a>',
			esc_url( get_term_link( $term ) ),
			esc_html( $term->name )
		);
	}
	echo '</div>';
}

/**
 * Returns the first "categoria_portfolio" term name for the current portfolio item, if any.
 */
function abe_portfolio_primary_category() {
	$terms = get_the_terms( get_the_ID(), 'categoria_portfolio' );

	if ( empty( $terms ) || is_wp_error( $terms ) ) {
		return '';
	}

	return $terms[0]->name;
}
