<?php
defined( 'ABSPATH' ) || exit;

/**
 * Fallback values shown on the live site until an admin overrides them in
 * Personnaliser → Coordonnées. Customizer setting 'default' values only
 * apply inside the Customizer preview, so templates must fall back to
 * these directly via teeoff_get_contact_mod().
 */
function teeoff_contact_defaults() {
	return array(
		'teeoff_phone'   => '+221 33 821 86 71',
		'teeoff_email'   => 'contact@teeofftechnologiesenegal.com',
		'teeoff_address' => "02 Place de l'indépendance, Dakar Plateau, Sénégal",
	);
}

function teeoff_get_contact_mod( $key ) {
	$defaults = teeoff_contact_defaults();
	$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	return get_theme_mod( $key, $default );
}

function teeoff_customize_register( $wp_customize ) {

	/* Colors ------------------------------------------------------- */
	$wp_customize->add_section( 'teeoff_colors', array(
		'title'    => __( 'Couleurs de la marque', 'teeoff' ),
		'priority' => 30,
	) );
	$wp_customize->add_setting( 'teeoff_color_primary', array(
		'default'           => '#121F4B',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'teeoff_color_primary', array(
		'label'   => __( 'Couleur primaire', 'teeoff' ),
		'section' => 'teeoff_colors',
	) ) );
	$wp_customize->add_setting( 'teeoff_color_secondary', array(
		'default'           => '#FFB920',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'teeoff_color_secondary', array(
		'label'   => __( 'Couleur secondaire', 'teeoff' ),
		'section' => 'teeoff_colors',
	) ) );

	/* Logos ---------------------------------------------------------- */
	$wp_customize->add_section( 'teeoff_logos', array(
		'title'       => __( 'Logos', 'teeoff' ),
		'description' => __( "Le logo de l'en-tête se règle dans Identité du site (ci-dessus). Le champ ci-dessous permet d'utiliser un logo différent dans le pied de page ; laissez-le vide pour réutiliser le logo de l'en-tête.", 'teeoff' ),
		'priority'    => 31,
	) );
	teeoff_add_media_setting( $wp_customize, 'teeoff_footer_logo', __( 'Logo du pied de page', 'teeoff' ), 'teeoff_logos', 'image' );

	/* Contact info --------------------------------------------------- */
	$wp_customize->add_section( 'teeoff_contact', array(
		'title'    => __( 'Coordonnées', 'teeoff' ),
		'priority' => 35,
	) );
	$contact_fields = array(
		'teeoff_phone'           => __( 'Téléphone', 'teeoff' ),
		'teeoff_email'           => __( 'Email', 'teeoff' ),
		'teeoff_address'         => __( 'Adresse', 'teeoff' ),
		'teeoff_maps_embed'      => __( 'URL Google Maps (lien embed)', 'teeoff' ),
		'teeoff_social_linkedin' => __( 'LinkedIn URL', 'teeoff' ),
		'teeoff_social_facebook' => __( 'Facebook URL', 'teeoff' ),
		'teeoff_social_instagram'=> __( 'Instagram URL', 'teeoff' ),
		'teeoff_social_youtube'  => __( 'YouTube URL', 'teeoff' ),
		'teeoff_social_x'        => __( 'X (Twitter) URL', 'teeoff' ),
		'teeoff_social_tiktok'   => __( 'TikTok URL', 'teeoff' ),
		'teeoff_notify_email'    => __( 'Email de notification (formulaires)', 'teeoff' ),
	);
	$contact_defaults = teeoff_contact_defaults();
	foreach ( $contact_fields as $id => $label ) {
		$wp_customize->add_setting( $id, array(
			'default'           => isset( $contact_defaults[ $id ] ) ? $contact_defaults[ $id ] : '',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( $id, array(
			'label'   => $label,
			'section' => 'teeoff_contact',
			'type'    => 'text',
		) );
	}

	/* Homepage media --------------------------------------------------- */
	$wp_customize->add_section( 'teeoff_media_home', array(
		'title'    => __( 'Medias — Page d\'accueil', 'teeoff' ),
		'priority' => 40,
	) );
	teeoff_add_media_setting( $wp_customize, 'teeoff_hero_image', __( 'Image du Hero (ref. 2.1)', 'teeoff' ), 'teeoff_media_home', 'image' );
	teeoff_add_media_setting( $wp_customize, 'teeoff_hero_video', __( 'Vidéo du Hero (ref. 15.1, .mp4)', 'teeoff' ), 'teeoff_media_home', 'file' );
	teeoff_add_media_setting( $wp_customize, 'teeoff_mission_image', __( 'Illustration Mission (ref. 3.1)', 'teeoff' ), 'teeoff_media_home', 'image' );
	teeoff_add_media_setting( $wp_customize, 'teeoff_technology_video', __( 'Vidéo Technologie (ref. 15.3, .mp4)', 'teeoff' ), 'teeoff_media_home', 'file' );
	teeoff_add_media_setting( $wp_customize, 'teeoff_technology_poster', __( 'Image Technologie (ref. 7.1)', 'teeoff' ), 'teeoff_media_home', 'image' );

	/* Other pages media -------------------------------------------------- */
	$wp_customize->add_section( 'teeoff_media_pages', array(
		'title'    => __( 'Medias — Autres pages', 'teeoff' ),
		'priority' => 41,
	) );
	teeoff_add_media_setting( $wp_customize, 'teeoff_about_team_image', __( 'À propos — Équipe (ref. 10.1)', 'teeoff' ), 'teeoff_media_pages', 'image' );
	teeoff_add_media_setting( $wp_customize, 'teeoff_about_vision_image', __( 'À propos — Vision (ref. 10.2)', 'teeoff' ), 'teeoff_media_pages', 'image' );
	teeoff_add_media_setting( $wp_customize, 'teeoff_tech_hero_image', __( 'Technologie — Bannière (ref. 11.1)', 'teeoff' ), 'teeoff_media_pages', 'image' );
	teeoff_add_media_setting( $wp_customize, 'teeoff_contact_image', __( 'Contact — Illustration (ref. 12.1)', 'teeoff' ), 'teeoff_media_pages', 'image' );
	teeoff_add_media_setting( $wp_customize, 'teeoff_partnership_image', __( 'Devenir partenaire — Illustration (ref. 12.2)', 'teeoff' ), 'teeoff_media_pages', 'image' );
	teeoff_add_media_setting( $wp_customize, 'teeoff_careers_image', __( 'Carrières — Illustration (ref. 13)', 'teeoff' ), 'teeoff_media_pages', 'image' );
	teeoff_add_media_setting( $wp_customize, 'teeoff_404_image', __( 'Page 404 — Illustration (ref. 14.1)', 'teeoff' ), 'teeoff_media_pages', 'image' );
	teeoff_add_media_setting( $wp_customize, 'teeoff_og_image', __( 'Image de partage réseaux sociaux (ref. 1.2)', 'teeoff' ), 'teeoff_media_pages', 'image' );
}
add_action( 'customize_register', 'teeoff_customize_register' );

function teeoff_add_media_setting( $wp_customize, $id, $label, $section, $type = 'image' ) {
	$wp_customize->add_setting( $id, array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	if ( 'image' === $type ) {
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $id, array(
			'label'   => $label,
			'section' => $section,
		) ) );
	} else {
		$wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, $id, array(
			'label'   => $label,
			'section' => $section,
		) ) );
	}
}

function teeoff_customizer_css() {
	$primary   = get_theme_mod( 'teeoff_color_primary', '#121F4B' );
	$secondary = get_theme_mod( 'teeoff_color_secondary', '#FFB920' );
	?>
	<style id="teeoff-customizer-css">
		:root {
			--teeoff-primary: <?php echo esc_html( $primary ); ?>;
			--teeoff-secondary: <?php echo esc_html( $secondary ); ?>;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'teeoff_customizer_css' );
