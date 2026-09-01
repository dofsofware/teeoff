<?php defined( 'ABSPATH' ) || exit; get_header();

$teeoff_page_id = get_the_ID();
?>

<section class="page-hero page-hero--compact">
	<div class="container">
		<span class="eyebrow"><?php esc_html_e( 'A propos', 'teeoff' ); ?></span>
		<h1><?php echo esc_html( teeoff_field( $teeoff_page_id, 'hero_title', 'Qui sommes-nous ?' ) ); ?></h1>
		<p class="page-hero__lead"><?php echo esc_html( teeoff_field( $teeoff_page_id, 'hero_lead', "TeeOff Technologies concoit des services a valeur ajoutee (VAS) destines a rapprocher les populations urbaines et rurales des services essentiels du quotidien, en s'appuyant sur les technologies vocales et les reseaux telephoniques." ) ); ?></p>
	</div>
</section>

<section class="section about-team">
	<div class="container about-team__grid">
		<div class="about-team__media">
			<?php
			teeoff_page_media_image( $teeoff_page_id, 'about_team_image', array(
				'ratio'      => 'ratio-4-3',
				'legacy_mod' => 'teeoff_about_team_image',
				'ref'        => '10.1',
				'label'      => __( 'Equipe TeeOff (prompt 10.1)', 'teeoff' ),
			) );
			?>
		</div>
		<div class="about-team__text">
			<?php if ( get_the_content() ) : the_content(); else : ?>
				<p><?php esc_html_e( "TeeOff Technologies developpe des solutions vocales innovantes pour rendre les services essentiels accessibles a tous, partout, y compris aux personnes ne disposant pas de smartphone ou de connexion Internet. L'entreprise s'appuie principalement sur les technologies vocales et les reseaux telephoniques afin de rendre ses services accessibles au plus grand nombre.", 'teeoff' ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>

<section class="section about-vision about-vision--dark">
	<div class="about-vision__media">
		<?php
		teeoff_page_media_image( $teeoff_page_id, 'about_vision_image', array(
			'ratio'      => 'ratio-fill',
			'size'       => 'teeoff-banner',
			'legacy_mod' => 'teeoff_about_vision_image',
			'ref'        => '10.2',
			'label'      => __( 'Vision TeeOff (prompt 10.2)', 'teeoff' ),
		) );
		?>
		<div class="about-vision__overlay"></div>
	</div>
	<div class="container about-vision__content">
		<div class="about-vision__col">
			<span class="eyebrow eyebrow--light"><?php esc_html_e( 'Notre vision', 'teeoff' ); ?></span>
			<h2><?php echo esc_html( teeoff_field( $teeoff_page_id, 'vision_title', "Rendre l'essentiel accessible a tous, partout." ) ); ?></h2>
		</div>
		<div class="about-vision__col">
			<span class="eyebrow eyebrow--light"><?php esc_html_e( 'Notre mission', 'teeoff' ); ?></span>
			<p><?php echo esc_html( teeoff_field( $teeoff_page_id, 'about_mission_text', "Utiliser les technologies vocales et les telecommunications pour faciliter l'acces aux services essentiels, en tenant compte des realites locales, de la diversite linguistique et des contraintes liees a l'acces a Internet." ) ); ?></p>
		</div>
	</div>
</section>

<section class="section values">
	<div class="container">
		<div class="section-heading">
			<span class="eyebrow"><?php esc_html_e( 'Nos valeurs', 'teeoff' ); ?></span>
			<h2><?php esc_html_e( 'Ce qui guide notre action', 'teeoff' ); ?></h2>
		</div>
		<?php
		$values = array(
			'accessibilite' => __( 'Accessibilite', 'teeoff' ),
			'inclusion'     => __( 'Inclusion', 'teeoff' ),
			'innovation'    => __( 'Innovation', 'teeoff' ),
			'impact-social' => __( 'Impact social', 'teeoff' ),
			'simplicite'    => __( 'Simplicite', 'teeoff' ),
			'proximite'     => __( 'Proximite', 'teeoff' ),
		);
		?>
		<div class="values-grid">
			<?php foreach ( $values as $key => $label ) : ?>
				<div class="value-card">
					<span class="value-card__icon"><?php echo teeoff_value_icon_svg( $key ); ?></span>
					<h3><?php echo esc_html( $label ); ?></h3>
				</div>
			<?php endforeach; ?>
		</div>
		<p class="values-note"><?php esc_html_e( 'Ces valeurs seront validees par TeeOff avant integration definitive.', 'teeoff' ); ?></p>
	</div>
</section>

<?php get_template_part( 'template-parts/content', 'cta' ); ?>
<?php get_footer(); ?>
