<?php
/**
 * The footer for our theme — minimal for now, not in scope yet.
 *
 * @package ABEstudio2026
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$abe2026_wa_message = 'Olá! 😊 Vi o site da AB Estúdio e adorei o que vocês fazem. Gostaria de solicitar um orçamento!';
$abe2026_wa_url     = 'https://wa.me/5521985845997?text=' . rawurlencode( $abe2026_wa_message );
?>
<svg width="0" height="0" style="position: absolute;" aria-hidden="true" focusable="false">
	<defs>
		<linearGradient id="abe-tabbar-icon-gradient" x1="0%" y1="0%" x2="100%" y2="0%">
			<stop offset="0%" style="stop-color: var(--abe-teal);" />
			<stop offset="45%" style="stop-color: var(--abe-green);" />
			<stop offset="88%" style="stop-color: var(--abe-yellow);" />
			<stop offset="100%" style="stop-color: var(--abe-orange);" />
		</linearGradient>
	</defs>
</svg>
<nav class="mobile-tabbar" aria-label="<?php esc_attr_e( 'Navegação rápida', 'abestudio2026' ); ?>">
	<a class="mobile-tabbar-item" href="#">
		<svg class="mobile-tabbar-icon" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
			<circle cx="5" cy="5" r="2"/><circle cx="12" cy="5" r="2"/><circle cx="19" cy="5" r="2"/>
			<circle cx="5" cy="12" r="2"/><circle cx="12" cy="12" r="2"/><circle cx="19" cy="12" r="2"/>
			<circle cx="5" cy="19" r="2"/><circle cx="12" cy="19" r="2"/><circle cx="19" cy="19" r="2"/>
		</svg>
		<span><?php esc_html_e( 'APPs', 'abestudio2026' ); ?></span>
	</a>
	<a class="mobile-tabbar-item" href="<?php echo esc_url( $abe2026_wa_url ); ?>" target="_blank" rel="noopener">
		<svg class="mobile-tabbar-icon" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
			<path d="M16.04 2.67C8.83 2.67 2.98 8.52 2.98 15.73c0 2.5.7 4.83 1.9 6.83L3 29.33l6.94-1.82a12.9 12.9 0 0 0 6.1 1.55h.01c7.21 0 13.06-5.85 13.06-13.06 0-3.49-1.36-6.77-3.82-9.24a12.98 12.98 0 0 0-9.25-3.83Zm0 23.9h-.01a10.9 10.9 0 0 1-5.55-1.52l-.4-.24-4.12 1.08 1.1-4.02-.26-.41a10.83 10.83 0 0 1-1.66-5.77c0-6.01 4.89-10.9 10.91-10.9a10.84 10.84 0 0 1 7.71 3.2 10.83 10.83 0 0 1 3.19 7.71c0 6.02-4.9 10.87-10.91 10.87Zm5.98-8.16c-.33-.16-1.94-.96-2.24-1.07-.3-.11-.52-.16-.74.16-.22.33-.85 1.07-1.04 1.29-.19.22-.38.24-.71.08-.33-.16-1.38-.51-2.63-1.62-.97-.86-1.63-1.93-1.82-2.25-.19-.33-.02-.5.14-.66.15-.15.33-.38.49-.58.16-.19.22-.33.33-.55.11-.22.05-.41-.03-.58-.08-.16-.74-1.78-1.01-2.44-.27-.64-.54-.56-.74-.57-.19-.01-.41-.01-.63-.01-.22 0-.58.08-.88.41-.3.33-1.15 1.12-1.15 2.74s1.18 3.18 1.34 3.4c.16.22 2.32 3.55 5.63 4.98.79.34 1.4.55 1.88.7.79.25 1.51.21 2.08.13.63-.09 1.94-.79 2.22-1.55.27-.77.27-1.42.19-1.55-.08-.14-.3-.22-.63-.38Z"/>
		</svg>
		<span><?php esc_html_e( 'Contato', 'abestudio2026' ); ?></span>
	</a>
	<span class="mobile-tabbar-item mobile-tabbar-item-soon">
		<svg class="mobile-tabbar-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
			<circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8"/>
			<path d="M12 7v5l3.5 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>
		<span><?php esc_html_e( 'Em breve', 'abestudio2026' ); ?></span>
	</span>
</nav>

<?php wp_footer(); ?>
</body>
</html>
