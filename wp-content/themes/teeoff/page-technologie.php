<?php defined( 'ABSPATH' ) || exit; get_header();

$teeoff_page_id = get_the_ID();
?>

<section class="page-hero page-hero--tech">
	<div class="page-hero__media">
		<?php
		$img = get_theme_mod( 'teeoff_tech_hero_image' );
		if ( $img ) {
			printf( '<div class="teeoff-media ratio-fill"><img src="%1$s" alt="" loading="eager"></div>', esc_url( $img ) );
		} else {
			teeoff_media_image( array( 'ref' => '11.1', 'label' => __( 'Banniere Technologie (prompt 11.1)', 'teeoff' ), 'ratio' => 'ratio-fill' ) );
		}
		?>
		<div class="page-hero__overlay"></div>
	</div>
	<div class="container page-hero__content">
		<span class="eyebrow eyebrow--light"><?php esc_html_e( 'Technologie', 'teeoff' ); ?></span>
		<h1><?php echo esc_html( teeoff_field( $teeoff_page_id, 'hero_title', "Une technologie vocale pensee pour l'accessibilite" ) ); ?></h1>
		<p class="page-hero__lead"><?php echo esc_html( teeoff_field( $teeoff_page_id, 'hero_lead', 'Interfaces vocales, telephonie, intelligence artificielle, multilinguisme : decouvrez les technologies qui rendent les services de TeeOff accessibles a tous.' ) ); ?></p>
	</div>
</section>

<section class="section tech-details">
	<div class="container">
		<?php
		$refs  = array( '7.2', '7.3', '7.4', '7.5', '7.6' );
		$items = teeoff_field_pairs( $teeoff_page_id, 'technology_items', array(
			array( 'Interface vocale', "L'utilisateur interagit avec le service a travers la voix, sans avoir besoin de savoir lire ou ecrire." ),
			array( 'Telephonie', 'Les services sont accessibles depuis un telephone classique, sans necessiter de smartphone.' ),
			array( 'Intelligence artificielle', "L'IA peut etre utilisee pour certains services, notamment dans le domaine de la sante." ),
			array( 'Multilinguisme', 'Les solutions peuvent etre adaptees aux langues locales pour toucher le plus grand nombre.' ),
			array( 'Accessibilite sans Internet', "L'objectif est de fonctionner dans des environnements ou l'acces a Internet est limite ou inexistant." ),
		) );
		?>
		<div class="tech-grid">
			<?php foreach ( $items as $i => $item ) :
				$ref = isset( $refs[ $i ] ) ? $refs[ $i ] : '';
				?>
				<div class="tech-card">
					<div class="tech-card__media">
						<?php teeoff_media_image( array( 'ref' => $ref, 'label' => sprintf( __( 'Illustration %1$s (prompt %2$s)', 'teeoff' ), $item[0], $ref ? $ref : '?' ), 'ratio' => 'ratio-1-1' ) ); ?>
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
