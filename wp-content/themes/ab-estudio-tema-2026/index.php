<?php
/**
 * Fallback template — not in scope yet, only header + hero are built so far.
 *
 * @package ABEstudio2026
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main class="container" style="padding: 60px 24px;">
	<p><?php esc_html_e( 'Este tema ainda está em construção — só o header e o banner principal existem por enquanto.', 'abestudio2026' ); ?></p>
</main>
<?php
get_footer();
