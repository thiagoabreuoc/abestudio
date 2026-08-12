<?php
/**
 * The template for displaying 404 pages (not found).
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
		<h1 class="page-title"><?php esc_html_e( 'Página não encontrada', 'abestudio' ); ?></h1>
		<p><?php esc_html_e( 'O conteúdo que você procura não existe ou foi movido.', 'abestudio' ); ?></p>
		<p><a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Voltar para a home', 'abestudio' ); ?></a></p>
	</div>
</main>

<?php
get_footer();
