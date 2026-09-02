<?php defined( 'ABSPATH' ) || exit; get_header(); ?>

<section class="section error-404">
	<div class="container error-404__inner">
		<?php
		$img = get_theme_mod( 'teeoff_404_image' );
		if ( $img ) {
			printf( '<div class="teeoff-media ratio-4-3 error-404__media"><img src="%1$s" alt="" loading="lazy"></div>', esc_url( $img ) );
		} else {
			teeoff_media_image( array( 'ref' => '14.1', 'label' => __( 'Illustration 404 (prompt 14.1)', 'teeoff' ), 'ratio' => 'ratio-4-3', 'class' => 'error-404__media' ) );
		}
		?>
		<h1><?php esc_html_e( 'Page introuvable', 'teeoff' ); ?></h1>
		<p><?php esc_html_e( "La page que vous recherchez n'existe pas ou plus.", 'teeoff' ); ?></p>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary"><?php esc_html_e( "Retour à l'accueil", 'teeoff' ); ?></a>
	</div>
</section>

<?php get_footer(); ?>
