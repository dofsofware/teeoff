<?php defined( 'ABSPATH' ) || exit; ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Aller au contenu', 'teeoff' ); ?></a>

<header class="site-header" id="site-header">
	<div class="container site-header__inner">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
			<?php if ( has_custom_logo() ) : the_custom_logo(); else : ?>
				<span class="site-logo__text"><?php bloginfo( 'name' ); ?></span>
			<?php endif; ?>
		</a>

		<nav class="main-nav" aria-label="<?php esc_attr_e( 'Menu principal', 'teeoff' ); ?>">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'main-nav__list',
				'fallback_cb'    => false,
			) );
			?>
		</nav>

		<div class="site-header__actions">
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--primary btn--sm"><?php esc_html_e( 'Nous contacter', 'teeoff' ); ?></a>
			<button class="nav-toggle" aria-expanded="false" aria-controls="mobile-nav">
				<span></span><span></span><span></span>
				<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'teeoff' ); ?></span>
			</button>
		</div>
	</div>

	<div class="mobile-nav" id="mobile-nav">
		<?php
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container'      => false,
			'menu_class'     => 'mobile-nav__list',
			'fallback_cb'    => false,
		) );
		?>
		<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--primary mobile-nav__cta"><?php esc_html_e( 'Nous contacter', 'teeoff' ); ?></a>
	</div>
</header>

<main id="main">
