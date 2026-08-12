<?php
/**
 * The footer for our theme.
 *
 * @package ABEStudio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	<footer class="site-footer">
		<div class="container">
			<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
				<?php dynamic_sidebar( 'footer-1' ); ?>
			<?php endif; ?>

			<nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Menu do Rodapé', 'abestudio' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'menu_class'     => 'footer-menu',
						'container'      => false,
						'fallback_cb'    => false,
					)
				);
				?>
			</nav>

			<div class="footer-bottom">
				<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'Todos os direitos reservados.', 'abestudio' ); ?></p>
				<p><?php esc_html_e( 'Design & desenvolvimento por AB Estúdio.', 'abestudio' ); ?></p>
			</div>
		</div>
	</footer>
<?php wp_footer(); ?>
</body>
</html>
