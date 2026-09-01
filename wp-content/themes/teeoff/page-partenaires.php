<?php
/**
 * Template Name: Partenaires
 */
defined( 'ABSPATH' ) || exit; get_header();

$teeoff_page_id = get_the_ID();
?>

<section class="page-hero page-hero--compact">
	<div class="container">
		<span class="eyebrow"><?php esc_html_e( 'Nos partenaires', 'teeoff' ); ?></span>
		<h1><?php echo esc_html( teeoff_field( $teeoff_page_id, 'hero_title', "Ils construisent l'accessibilite avec nous" ) ); ?></h1>
		<p class="page-hero__lead"><?php echo esc_html( teeoff_field( $teeoff_page_id, 'hero_lead', "TeeOff Technologies collabore avec des entreprises technologiques, operateurs telecoms, etablissements de sante et d'education, et organisations culturelles pour elargir l'acces a ses services." ) ); ?></p>
	</div>
</section>

<section class="section partners">
	<div class="container">
		<?php
		$partners = get_posts( array( 'post_type' => 'partenaire', 'numberposts' => -1, 'post_status' => 'publish' ) );
		if ( $partners ) :
			get_template_part( 'template-parts/content', 'partners-grid', array( 'number' => -1 ) );
		else :
			?>
			<div class="empty-state">
				<?php teeoff_media_image( array( 'ref' => '8.2', 'label' => __( 'Illustration Partenariat (prompt 8.2)', 'teeoff' ), 'ratio' => 'ratio-1-1', 'class' => 'empty-state__media' ) ); ?>
				<p><?php esc_html_e( 'Nos partenariats seront bientot presentes ici.', 'teeoff' ); ?></p>
			</div>
		<?php endif; wp_reset_postdata(); ?>
	</div>
</section>

<section class="section partnership-cta">
	<div class="container partnership-cta__grid">
		<div class="partnership-cta__media">
			<?php
			teeoff_page_media_image( $teeoff_page_id, 'partnership_image', array(
				'ratio'      => 'ratio-4-3',
				'legacy_mod' => 'teeoff_partnership_image',
				'ref'        => '12.2',
				'label'      => __( 'Devenir partenaire (prompt 12.2)', 'teeoff' ),
			) );
			?>
		</div>
		<div class="partnership-cta__text">
			<span class="eyebrow"><?php esc_html_e( 'Devenir partenaire', 'teeoff' ); ?></span>
			<h2><?php esc_html_e( "Construisons ensemble l'acces aux services essentiels", 'teeoff' ); ?></h2>
			<p><?php esc_html_e( 'Entreprises technologiques, operateurs telecoms, etablissements de sante ou d\'education, organisations religieuses ou culturelles : proposez un partenariat a TeeOff Technologies.', 'teeoff' ); ?></p>
			<?php get_template_part( 'template-parts/form', 'partnership' ); ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
