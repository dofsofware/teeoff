<?php
defined( 'ABSPATH' ) || exit;

/**
 * Editable text fields for the static pages (Accueil, A propos, Nos
 * solutions, Technologie, Partenaires, Carrieres, Contact).
 *
 * These pages are built from PHP templates (front-page.php, page-*.php) so
 * their headings/paragraphs are NOT part of the block editor content area.
 * Without this, an editor opening "Accueil" in wp-admin would see an empty
 * content box and have no way to change the hero title, the mission text,
 * etc. This adds a "Contenu de la page (TeeOff)" meta box exposing exactly
 * those strings as plain fields, pre-filled with the current copy, so
 * every text on the site can be edited from wp-admin (cahier des charges
 * §18). The templates read these via teeoff_field() and fall back to the
 * original copy when a field is left empty.
 */

add_action( 'add_meta_boxes_page', 'teeoff_page_content_meta_box' );
function teeoff_page_content_meta_box( $post ) {
	add_meta_box( 'teeoff_page_content', __( 'Contenu de la page (TeeOff)', 'teeoff' ), 'teeoff_page_content_meta_box_html', 'page', 'normal', 'high' );
}

function teeoff_page_content_meta_box_html( $post ) {
	wp_nonce_field( 'teeoff_page_content', 'teeoff_page_content_nonce' );

	$template = get_page_template_slug( $post->ID );
	$is_front = ( (int) get_option( 'page_on_front' ) === $post->ID );

	if ( $is_front ) {
		echo '<h4>' . esc_html__( 'Section Hero', 'teeoff' ) . '</h4>';
		teeoff_render_field( $post->ID, 'hero_title', __( 'Titre du Hero', 'teeoff' ) );
		teeoff_render_field( $post->ID, 'hero_subtitle', __( 'Sous-titre du Hero', 'teeoff' ), 'textarea' );

		echo '<h4>' . esc_html__( 'Section Notre mission', 'teeoff' ) . '</h4>';
		teeoff_render_field( $post->ID, 'mission_title', __( 'Titre', 'teeoff' ) );
		teeoff_render_field( $post->ID, 'mission_text', __( 'Texte', 'teeoff' ), 'textarea' );

		echo '<h4>' . esc_html__( 'Section Notre technologie', 'teeoff' ) . '</h4>';
		teeoff_render_field( $post->ID, 'technology_title', __( 'Titre', 'teeoff' ) );
		teeoff_render_field( $post->ID, 'technology_items', __( 'Liste (un element par ligne)', 'teeoff' ), 'textarea' );
		return;
	}

	$hero_templates = array(
		'page-a-propos.php'    => 'A propos',
		'page-nos-solutions.php' => 'Nos solutions',
		'page-technologie.php' => 'Technologie',
		'page-partenaires.php' => 'Partenaires',
		'page-carrieres.php'   => 'Carrieres',
		'page-contact.php'     => 'Contact',
	);

	if ( isset( $hero_templates[ $template ] ) ) {
		echo '<h4>' . esc_html__( 'Bandeau en haut de page', 'teeoff' ) . '</h4>';
		teeoff_render_field( $post->ID, 'hero_title', __( 'Titre', 'teeoff' ) );
		teeoff_render_field( $post->ID, 'hero_lead', __( "Texte d'introduction", 'teeoff' ), 'textarea' );
	}

	if ( 'page-a-propos.php' === $template ) {
		echo '<h4>' . esc_html__( 'Section Vision & Mission', 'teeoff' ) . '</h4>';
		teeoff_render_field( $post->ID, 'vision_title', __( 'Titre — Notre vision', 'teeoff' ) );
		teeoff_render_field( $post->ID, 'about_mission_text', __( 'Texte — Notre mission', 'teeoff' ), 'textarea' );
	}

	if ( 'page-technologie.php' === $template ) {
		echo '<h4>' . esc_html__( 'Bloc technologies (5 elements)', 'teeoff' ) . '</h4>';
		echo '<p class="description">' . esc_html__( 'Un element par ligne, au format : Titre | Description', 'teeoff' ) . '</p>';
		teeoff_render_field( $post->ID, 'technology_items', __( 'Elements', 'teeoff' ), 'textarea', 8 );
	}

	echo '<p class="description">' . esc_html__( 'Le contenu ci-dessous (editeur classique) peut aussi etre utilise si le theme le prevoit pour cette page.', 'teeoff' ) . '</p>';
}

function teeoff_render_field( $post_id, $key, $label, $type = 'text', $rows = 4 ) {
	$value = get_post_meta( $post_id, '_teeoff_' . $key, true );
	echo '<p><label for="teeoff_' . esc_attr( $key ) . '"><strong>' . esc_html( $label ) . '</strong></label><br>';
	if ( 'textarea' === $type ) {
		printf(
			'<textarea id="teeoff_%1$s" name="teeoff_%1$s" rows="%3$d" class="widefat">%2$s</textarea>',
			esc_attr( $key ),
			esc_textarea( $value ),
			(int) $rows
		);
	} else {
		printf(
			'<input type="text" id="teeoff_%1$s" name="teeoff_%1$s" value="%2$s" class="widefat">',
			esc_attr( $key ),
			esc_attr( $value )
		);
	}
	echo '</p>';
}

function teeoff_save_page_content_meta( $post_id ) {
	if ( ! isset( $_POST['teeoff_page_content_nonce'] ) || ! wp_verify_nonce( $_POST['teeoff_page_content_nonce'], 'teeoff_page_content' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_page', $post_id ) ) {
		return;
	}

	$text_fields = array( 'hero_title', 'mission_title', 'technology_title', 'vision_title' );
	$area_fields = array( 'hero_subtitle', 'mission_text', 'technology_items', 'hero_lead', 'about_mission_text' );

	foreach ( $text_fields as $key ) {
		$field = 'teeoff_' . $key;
		if ( isset( $_POST[ $field ] ) ) {
			update_post_meta( $post_id, '_teeoff_' . $key, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
		}
	}
	foreach ( $area_fields as $key ) {
		$field = 'teeoff_' . $key;
		if ( isset( $_POST[ $field ] ) ) {
			update_post_meta( $post_id, '_teeoff_' . $key, sanitize_textarea_field( wp_unslash( $_POST[ $field ] ) ) );
		}
	}
}
add_action( 'save_post_page', 'teeoff_save_page_content_meta' );

/**
 * Returns the editor-provided value for a page text field, falling back to
 * $default (the original copy) when nothing has been entered yet.
 */
function teeoff_field( $post_id, $key, $default = '' ) {
	$value = get_post_meta( $post_id, '_teeoff_' . $key, true );
	return ( '' !== trim( (string) $value ) ) ? $value : $default;
}

/**
 * Parses a "Titre | Description" per-line textarea into an array of
 * [title, description] pairs. Falls back to $default (same shape) when
 * empty.
 */
function teeoff_field_pairs( $post_id, $key, $default = array() ) {
	$raw = get_post_meta( $post_id, '_teeoff_' . $key, true );
	if ( ! trim( (string) $raw ) ) {
		return $default;
	}
	$pairs = array();
	foreach ( preg_split( '/\r\n|\r|\n/', $raw ) as $line ) {
		if ( ! trim( $line ) ) {
			continue;
		}
		$parts = array_map( 'trim', explode( '|', $line, 2 ) );
		$pairs[] = array( $parts[0], isset( $parts[1] ) ? $parts[1] : '' );
	}
	return $pairs ? $pairs : $default;
}

/**
 * Parses a one-item-per-line textarea into a plain array of strings.
 */
function teeoff_field_lines( $post_id, $key, $default = array() ) {
	$raw = get_post_meta( $post_id, '_teeoff_' . $key, true );
	if ( ! trim( (string) $raw ) ) {
		return $default;
	}
	$lines = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', $raw ) ) );
	return $lines ? array_values( $lines ) : $default;
}
