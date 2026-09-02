<?php
/**
 * Template Name: Nos solutions
 */
defined( 'ABSPATH' ) || exit; get_header();

$teeoff_page_id = get_the_ID();
?>

<section class="page-hero page-hero--compact">
	<div class="container">
		<span class="eyebrow"><?php esc_html_e( 'Nos solutions', 'teeoff' ); ?></span>
		<h1><?php echo esc_html( teeoff_field( $teeoff_page_id, 'hero_title', 'Des services essentiels accessibles par la voix' ) ); ?></h1>
		<p class="page-hero__lead"><?php echo esc_html( teeoff_field( $teeoff_page_id, 'hero_lead', 'Santé, éducation, guides pratiques, religion et culture : découvrez comment TeeOff Technologies SN rend ces services accessibles à tous, par un simple appel téléphonique.' ) ); ?></p>
	</div>
</section>

<section class="section solutions">
	<div class="container">
		<?php get_template_part( 'template-parts/content', 'solutions-grid' ); ?>
	</div>
</section>

<?php get_template_part( 'template-parts/content', 'cta' ); ?>
<?php get_footer(); ?>
