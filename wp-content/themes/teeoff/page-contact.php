<?php defined( 'ABSPATH' ) || exit; get_header();

$teeoff_page_id = get_the_ID();
?>

<section class="page-hero page-hero--compact">
	<div class="container">
		<span class="eyebrow"><?php esc_html_e( 'Contact', 'teeoff' ); ?></span>
		<h1><?php echo esc_html( teeoff_field( $teeoff_page_id, 'hero_title', 'Parlons de votre projet' ) ); ?></h1>
		<p class="page-hero__lead"><?php echo esc_html( teeoff_field( $teeoff_page_id, 'hero_lead', "Une question, un projet, une demande de partenariat ? L'equipe TeeOff Technologies vous repond." ) ); ?></p>
	</div>
</section>

<section class="section contact">
	<div class="container contact__grid">
		<div class="contact__info">
			<?php
			$img = get_theme_mod( 'teeoff_contact_image' );
			if ( $img ) {
				printf( '<div class="teeoff-media ratio-4-3"><img src="%1$s" alt="" loading="lazy"></div>', esc_url( $img ) );
			} else {
				teeoff_media_image( array( 'ref' => '12.1', 'label' => __( 'Illustration Contact (prompt 12.1)', 'teeoff' ), 'ratio' => 'ratio-4-3' ) );
			}
			?>

			<ul class="contact-details">
				<?php
				$phone   = get_theme_mod( 'teeoff_phone' );
				$email   = get_theme_mod( 'teeoff_email' );
				$address = get_theme_mod( 'teeoff_address' );
				?>
				<?php if ( $phone ) : ?><li><strong><?php esc_html_e( 'Telephone', 'teeoff' ); ?></strong><a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></li><?php endif; ?>
				<?php if ( $email ) : ?><li><strong><?php esc_html_e( 'Email', 'teeoff' ); ?></strong><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></li><?php endif; ?>
				<?php if ( $address ) : ?><li><strong><?php esc_html_e( 'Adresse', 'teeoff' ); ?></strong><?php echo esc_html( $address ); ?></li><?php endif; ?>
			</ul>
			<div class="footer-social contact-social"><?php teeoff_social_links(); ?></div>

			<?php $map = get_theme_mod( 'teeoff_maps_embed' ); if ( $map ) : ?>
				<div class="contact-map">
					<iframe src="<?php echo esc_url( $map ); ?>" width="100%" height="280" style="border:0" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="<?php esc_attr_e( 'Localisation TeeOff Technologies', 'teeoff' ); ?>"></iframe>
				</div>
			<?php endif; ?>
		</div>

		<div class="contact__form">
			<h2><?php esc_html_e( 'Envoyez-nous un message', 'teeoff' ); ?></h2>
			<?php get_template_part( 'template-parts/form', 'contact' ); ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
