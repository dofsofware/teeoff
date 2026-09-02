<?php
/**
 * Template Name: Technologie
 */
defined( 'ABSPATH' ) || exit; get_header();

$teeoff_page_id = get_the_ID();
?>

<section class="page-hero page-hero--tech">
	<div class="page-hero__media">
		<?php
		teeoff_page_media_image( $teeoff_page_id, 'hero_bg_image', array(
			'ratio'                 => 'ratio-fill',
			'size'                  => 'teeoff-banner',
			'legacy_mod'            => 'teeoff_tech_hero_image',
			'use_featured_fallback' => true,
			'ref'                   => '11.1',
			'label'                 => __( 'Bannière Technologie (prompt 11.1)', 'teeoff' ),
		) );
		?>
		<div class="page-hero__overlay"></div>
	</div>
	<div class="container page-hero__content">
		<span class="eyebrow eyebrow--light"><?php esc_html_e( 'Technologie', 'teeoff' ); ?></span>
		<h1><?php echo esc_html( teeoff_field( $teeoff_page_id, 'hero_title', "Une technologie pour faciliter l'accès de la population aux services de base" ) ); ?></h1>
		<p class="page-hero__lead"><?php echo esc_html( teeoff_field( $teeoff_page_id, 'hero_lead', 'Interfaces vocales, téléphonie, intelligence artificielle, multilinguisme : découvrez les technologies qui rendent les services de TeeOff Technologies SN accessibles à tous.' ) ); ?></p>
	</div>
</section>

<section class="section tech-details">
	<div class="container">
		<?php
		$refs  = array( '7.2', '7.3', '7.4', '7.5', '7.6' );
		$items = teeoff_field_pairs( $teeoff_page_id, 'technology_items', array(
			array( 'Interface vocale', "L'utilisateur interagit avec le service à travers la voix, sans avoir besoin de savoir lire ou écrire." ),
			array( 'Téléphonie', 'Les services sont accessibles depuis un téléphone classique, sans nécessiter de smartphone.' ),
			array( 'Intelligence artificielle', "L'IA peut être utilisée pour certains services, notamment dans le domaine de la santé." ),
			array( 'Multilinguisme', 'Les solutions peuvent être adaptées aux langues locales pour toucher le plus grand nombre.' ),
			array( 'Accessibilité sans Internet', "L'objectif est de fonctionner dans des environnements où l'accès à Internet est limité ou inexistant." ),
		) );
		?>
		<div class="tech-grid">
			<?php foreach ( $items as $i => $item ) :
				$ref = isset( $refs[ $i ] ) ? $refs[ $i ] : '';
				?>
				<div class="tech-card">
					<div class="tech-card__media">
						<?php
						teeoff_page_media_image( $teeoff_page_id, 'tech_item_image_' . ( $i + 1 ), array(
							'ratio' => 'ratio-1-1',
							'alt'   => $item[0],
							'ref'   => $ref,
							'label' => sprintf( __( 'Illustration %1$s (prompt %2$s)', 'teeoff' ), $item[0], $ref ? $ref : '?' ),
						) );
						?>
					</div>
					<h3><?php echo esc_html( $item[0] ); ?></h3>
					<p><?php echo esc_html( $item[1] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/content', 'cta' ); ?>
<?php get_footer(); ?>
