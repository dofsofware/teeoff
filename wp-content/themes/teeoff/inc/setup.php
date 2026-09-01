<?php
defined( 'ABSPATH' ) || exit;

function teeoff_setup() {
	load_theme_textdomain( 'teeoff', TEEOFF_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 240,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'align-wide' );

	register_nav_menus( array(
		'primary' => __( 'Menu principal', 'teeoff' ),
		'footer'  => __( 'Menu pied de page', 'teeoff' ),
	) );

	add_image_size( 'teeoff-card', 800, 800, true );
	add_image_size( 'teeoff-banner', 1920, 1080, true );
	add_image_size( 'teeoff-wide', 2400, 900, true );
}
add_action( 'after_setup_theme', 'teeoff_setup' );

/**
 * No widget-ready footer area: WordPress auto-assigns its default
 * widgets (Archives, Categories) the first time a theme registers a
 * sidebar, which broke the 4-column footer grid layout. The footer's
 * Navigation / Informations / Contact columns already cover everything
 * the site needs there.
 */

function teeoff_scripts() {
	wp_enqueue_style( 'teeoff-google-fonts', 'https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Inter:wght@400;500;600;700&display=swap', array(), null );
	wp_enqueue_style( 'teeoff-main', TEEOFF_URI . '/assets/css/main.css', array(), TEEOFF_VERSION );
	wp_enqueue_script( 'teeoff-main', TEEOFF_URI . '/assets/js/main.js', array(), TEEOFF_VERSION, true );

	if ( is_singular() && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'teeoff_scripts' );

function teeoff_body_classes( $classes ) {
	if ( is_front_page() ) {
		$classes[] = 'is-home';
	}
	return $classes;
}
add_filter( 'body_class', 'teeoff_body_classes' );

/**
 * Prints the social network links configured in the Customizer
 * (Apparence > Personnaliser > Coordonnees).
 */
function teeoff_social_links() {
	$networks = array(
		'linkedin'  => 'LinkedIn',
		'facebook'  => 'Facebook',
		'instagram' => 'Instagram',
		'youtube'   => 'YouTube',
		'x'         => 'X',
		'tiktok'    => 'TikTok',
	);
	foreach ( $networks as $key => $label ) {
		$url = get_theme_mod( 'teeoff_social_' . $key );
		if ( ! $url ) {
			continue;
		}
		printf(
			'<a href="%1$s" class="social-link" target="_blank" rel="noopener noreferrer" aria-label="%2$s">%3$s</a>',
			esc_url( $url ),
			esc_attr( $label ),
			teeoff_social_icon_svg( $key )
		);
	}
}
