<?php defined( 'ABSPATH' ) || exit; ?>
</main>

<footer class="site-footer">
	<div class="container site-footer__grid">
		<div class="footer-brand">
			<?php if ( has_custom_logo() ) : the_custom_logo(); else : ?>
				<span class="site-logo__text site-logo__text--light"><?php bloginfo( 'name' ); ?></span>
			<?php endif; ?>
			<p class="footer-tagline"><?php esc_html_e( "Rendre l'essentiel accessible a tous, partout.", 'teeoff' ); ?></p>
			<div class="footer-social"><?php teeoff_social_links(); ?></div>
		</div>

		<nav class="footer-nav" aria-label="<?php esc_attr_e( 'Navigation', 'teeoff' ); ?>">
			<h3><?php esc_html_e( 'Navigation', 'teeoff' ); ?></h3>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'footer-nav__list',
				'fallback_cb'    => false,
			) );
			?>
		</nav>

		<nav class="footer-nav" aria-label="<?php esc_attr_e( 'Informations', 'teeoff' ); ?>">
			<h3><?php esc_html_e( 'Informations', 'teeoff' ); ?></h3>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'footer',
				'container'      => false,
				'menu_class'     => 'footer-nav__list',
				'fallback_cb'    => false,
			) );
			?>
		</nav>

		<div class="footer-contact">
			<h3><?php esc_html_e( 'Contact', 'teeoff' ); ?></h3>
			<?php
			$phone   = get_theme_mod( 'teeoff_phone' );
			$email   = get_theme_mod( 'teeoff_email' );
			$address = get_theme_mod( 'teeoff_address' );
			?>
			<?php if ( $phone ) : ?><p><a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></p><?php endif; ?>
			<?php if ( $email ) : ?><p><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></p><?php endif; ?>
			<?php if ( $address ) : ?><p><?php echo esc_html( $address ); ?></p><?php endif; ?>
		</div>

		<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
			<div class="footer-widgets"><?php dynamic_sidebar( 'footer-1' ); ?></div>
		<?php endif; ?>
	</div>

	<div class="site-footer__bottom">
		<div class="container">
			<p>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'Tous droits reserves.', 'teeoff' ); ?></p>
			<p class="site-footer__baseline"><?php esc_html_e( 'Un appel. Un service. Un impact.', 'teeoff' ); ?></p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
