<?php
/**
 * Search form template.
 *
 * @package ABEStudio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="s"><?php esc_html_e( 'Pesquisar por:', 'abestudio' ); ?></label>
	<input type="search" id="s" name="s" placeholder="<?php esc_attr_e( 'Pesquisar…', 'abestudio' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>">
	<button type="submit"><?php esc_html_e( 'Buscar', 'abestudio' ); ?></button>
</form>
