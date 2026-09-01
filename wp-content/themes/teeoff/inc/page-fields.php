<?php
defined( 'ABSPATH' ) || exit;

/**
 * Editable text + image fields for the static pages (Accueil, A propos,
 * Nos solutions, Technologie, Partenaires, Carrieres, Contact).
 *
 * These pages are built from PHP templates (front-page.php, page-*.php) so
 * their headings/paragraphs/section images are NOT part of the block
 * editor content area or the standard "Image mise en avant" panel. This
 * adds a single "Contenu de la page (TeeOff)" box, in the sidebar (so it
 * is visible immediately, not buried below the content editor), exposing
 * every editable text AND image for that page. Values fall back to the
 * original copy/placeholder when left empty, so nothing breaks.
 */

add_action( 'add_meta_boxes_page', 'teeoff_page_content_meta_box' );
function teeoff_page_content_meta_box( $post ) {
	add_meta_box( 'teeoff_page_content', __( 'Contenu de la page (TeeOff)', 'teeoff' ), 'teeoff_page_content_meta_box_html', 'page', 'side', 'high' );
}

add_action( 'admin_enqueue_scripts', 'teeoff_admin_assets' );
function teeoff_admin_assets( $hook ) {
	if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
		return;
	}
	$screen = get_current_screen();
	if ( ! $screen || ! in_array( $screen->post_type, array( 'page', 'solution', 'partenaire', 'emploi' ), true ) ) {
		return;
	}
	wp_enqueue_media();
	wp_enqueue_script( 'teeoff-admin', TEEOFF_URI . '/assets/js/admin.js', array( 'jquery' ), TEEOFF_VERSION, true );
	wp_enqueue_style( 'teeoff-admin', TEEOFF_URI . '/assets/css/admin.css', array(), TEEOFF_VERSION );
}

function teeoff_page_content_meta_box_html( $post ) {
	wp_nonce_field( 'teeoff_page_content', 'teeoff_page_content_nonce' );

	$template = get_page_template_slug( $post->ID );
	if ( ! $template && $post->post_name ) {
		$slug_template = 'page-' . $post->post_name . '.php';
		if ( file_exists( TEEOFF_DIR . '/' . $slug_template ) ) {
			$template = $slug_template;
		}
	}
	$is_front = ( (int) get_option( 'page_on_front' ) === $post->ID );

	if ( $is_front ) {
		echo '<h4>' . esc_html__( 'Hero', 'teeoff' ) . '</h4>';
		teeoff_render_image_field( $post->ID, 'hero_image', __( 'Image / photo de fond', 'teeoff' ), true );
		teeoff_render_field( $post->ID, 'hero_title', __( 'Titre', 'teeoff' ) );
		teeoff_render_field( $post->ID, 'hero_subtitle', __( 'Sous-titre', 'teeoff' ), 'textarea' );

		echo '<h4>' . esc_html__( 'Nos solutions (Sante, Education...)', 'teeoff' ) . '</h4>';
		printf(
			'<div class="teeoff-image-hint">%s<br><a href="%s">%s</a></div>',
			esc_html__( "Les 4 cartes de cette section ne se modifient pas ici : chacune est une fiche a part.", 'teeoff' ),
			esc_url( admin_url( 'edit.php?post_type=solution' ) ),
			esc_html__( 'Ouvrir Solutions -> cliquer une fiche -> Definir l\'image mise en avant', 'teeoff' )
		);

		echo '<h4>' . esc_html__( 'Notre mission', 'teeoff' ) . '</h4>';
		teeoff_render_image_field( $post->ID, 'mission_image', __( 'Image', 'teeoff' ) );
		teeoff_render_field( $post->ID, 'mission_title', __( 'Titre', 'teeoff' ) );
		teeoff_render_field( $post->ID, 'mission_text', __( 'Texte', 'teeoff' ), 'textarea' );

		echo '<h4>' . esc_html__( 'Notre technologie', 'teeoff' ) . '</h4>';
		teeoff_render_image_field( $post->ID, 'technology_poster', __( 'Image / photo de fond', 'teeoff' ) );
		teeoff_render_field( $post->ID, 'technology_title', __( 'Titre', 'teeoff' ) );
		teeoff_render_field( $post->ID, 'technology_items', __( 'Liste (un element par ligne)', 'teeoff' ), 'textarea' );
		return;
	}

	$hero_templates = array(
		'page-a-propos.php'      => 'A propos',
		'page-nos-solutions.php' => 'Nos solutions',
		'page-technologie.php'   => 'Technologie',
		'page-partenaires.php'   => 'Partenaires',
		'page-carrieres.php'     => 'Carrieres',
		'page-contact.php'       => 'Contact',
	);

	if ( isset( $hero_templates[ $template ] ) ) {
		echo '<h4>' . esc_html__( 'Bandeau en haut de page', 'teeoff' ) . '</h4>';
		if ( in_array( $template, array( 'page-technologie.php', 'page-carrieres.php' ), true ) ) {
			teeoff_render_image_field( $post->ID, 'hero_bg_image', __( 'Image / photo de fond', 'teeoff' ), true );
		}
		teeoff_render_field( $post->ID, 'hero_title', __( 'Titre', 'teeoff' ) );
		teeoff_render_field( $post->ID, 'hero_lead', __( "Texte d'introduction", 'teeoff' ), 'textarea' );
	}

	if ( 'page-nos-solutions.php' === $template ) {
		echo '<h4>' . esc_html__( 'Cartes Sante / Education / ...', 'teeoff' ) . '</h4>';
		printf(
			'<div class="teeoff-image-hint">%s<br><a href="%s">%s</a></div>',
			esc_html__( 'Les images des cartes ne se modifient pas ici : chaque solution est une fiche a part.', 'teeoff' ),
			esc_url( admin_url( 'edit.php?post_type=solution' ) ),
			esc_html__( 'Ouvrir Solutions -> cliquer une fiche -> Definir l\'image mise en avant', 'teeoff' )
		);
	}

	if ( 'page-a-propos.php' === $template ) {
		echo '<h4>' . esc_html__( 'Equipe', 'teeoff' ) . '</h4>';
		teeoff_render_image_field( $post->ID, 'about_team_image', __( 'Photo', 'teeoff' ) );
		echo '<p class="description">' . esc_html__( 'Le texte de cette section est le contenu principal de la page (editeur ci-dessus).', 'teeoff' ) . '</p>';

		echo '<h4>' . esc_html__( 'Vision & Mission', 'teeoff' ) . '</h4>';
		teeoff_render_image_field( $post->ID, 'about_vision_image', __( 'Image / photo de fond', 'teeoff' ) );
		teeoff_render_field( $post->ID, 'vision_title', __( 'Titre — Notre vision', 'teeoff' ) );
		teeoff_render_field( $post->ID, 'about_mission_text', __( 'Texte — Notre mission', 'teeoff' ), 'textarea' );
	}

	if ( 'page-technologie.php' === $template ) {
		echo '<h4>' . esc_html__( 'Bloc technologies (5 elements)', 'teeoff' ) . '</h4>';
		echo '<p class="description">' . esc_html__( 'Un element par ligne : Titre | Description', 'teeoff' ) . '</p>';
		teeoff_render_field( $post->ID, 'technology_items', __( 'Elements', 'teeoff' ), 'textarea', 8 );
		for ( $i = 1; $i <= 5; $i++ ) {
			teeoff_render_image_field( $post->ID, 'tech_item_image_' . $i, sprintf( __( 'Image element %d', 'teeoff' ), $i ) );
		}
	}

	if ( 'page-partenaires.php' === $template ) {
		echo '<h4>' . esc_html__( 'Devenir partenaire', 'teeoff' ) . '</h4>';
		teeoff_render_image_field( $post->ID, 'partnership_image', __( 'Image', 'teeoff' ) );

		echo '<h4>' . esc_html__( 'Aucun partenaire publie (3 logos par defaut)', 'teeoff' ) . '</h4>';
		echo '<p class="description">' . esc_html__( "Affiches uniquement tant qu'aucune fiche Partenaire n'est publiee.", 'teeoff' ) . '</p>';
		teeoff_render_field( $post->ID, 'partners_empty_title', __( 'Titre de la section', 'teeoff' ) );
		for ( $i = 1; $i <= 3; $i++ ) {
			teeoff_render_image_field( $post->ID, 'partners_empty_logo_' . $i, sprintf( __( 'Logo %d', 'teeoff' ), $i ) );
			teeoff_render_field( $post->ID, 'partners_empty_logo_name_' . $i, sprintf( __( 'Nom du logo %d', 'teeoff' ), $i ) );
		}
	}

	if ( 'page-contact.php' === $template ) {
		echo '<h4>' . esc_html__( 'Bloc contact', 'teeoff' ) . '</h4>';
		teeoff_render_image_field( $post->ID, 'contact_image', __( 'Image', 'teeoff' ) );
	}
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

/**
 * Renders an image picker backed by the standard WP media library
 * (assets/js/admin.js wires the "Choisir une image" button to wp.media).
 * $use_featured_fallback: when true and no image has been chosen yet here,
 * the page's own Featured Image is shown/used as a starting point — this
 * rescues images editors already set the "normal" WordPress way.
 */
function teeoff_render_image_field( $post_id, $key, $label, $use_featured_fallback = false ) {
	$field_name  = 'teeoff_img_' . $key;
	$attach_id   = (int) get_post_meta( $post_id, '_teeoff_img_' . $key, true );
	$fallback_id = ( ! $attach_id && $use_featured_fallback ) ? (int) get_post_thumbnail_id( $post_id ) : 0;
	$display_id  = $attach_id ? $attach_id : $fallback_id;
	$preview_url = $display_id ? wp_get_attachment_image_url( $display_id, 'medium' ) : '';
	?>
	<div class="teeoff-image-field">
		<label><strong><?php echo esc_html( $label ); ?></strong></label>
		<div class="teeoff-image-field__preview" style="<?php echo $preview_url ? '' : 'display:none;'; ?>">
			<img src="<?php echo esc_url( $preview_url ); ?>" alt="">
		</div>
		<input type="hidden" class="teeoff-image-field__input" name="<?php echo esc_attr( $field_name ); ?>" value="<?php echo esc_attr( $attach_id ?: '' ); ?>">
		<p>
			<button type="button" class="button teeoff-image-field__choose"><?php esc_html_e( 'Choisir une image', 'teeoff' ); ?></button>
			<button type="button" class="button teeoff-image-field__remove" style="<?php echo $display_id ? '' : 'display:none;'; ?>"><?php esc_html_e( 'Retirer', 'teeoff' ); ?></button>
		</p>
		<?php if ( $fallback_id && ! $attach_id ) : ?>
			<p class="description"><?php esc_html_e( "Image mise en avant de la page utilisee par defaut. Choisissez une image ici pour la remplacer.", 'teeoff' ); ?></p>
		<?php endif; ?>
	</div>
	<?php
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

	$text_fields = array( 'hero_title', 'mission_title', 'technology_title', 'vision_title', 'partners_empty_title', 'partners_empty_logo_name_1', 'partners_empty_logo_name_2', 'partners_empty_logo_name_3' );
	$area_fields = array( 'hero_subtitle', 'mission_text', 'technology_items', 'hero_lead', 'about_mission_text' );
	$image_fields = array( 'hero_image', 'mission_image', 'technology_poster', 'hero_bg_image', 'about_team_image', 'about_vision_image', 'partnership_image', 'contact_image', 'tech_item_image_1', 'tech_item_image_2', 'tech_item_image_3', 'tech_item_image_4', 'tech_item_image_5', 'partners_empty_logo_1', 'partners_empty_logo_2', 'partners_empty_logo_3' );

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
	foreach ( $image_fields as $key ) {
		$field = 'teeoff_img_' . $key;
		if ( isset( $_POST[ $field ] ) ) {
			update_post_meta( $post_id, '_teeoff_img_' . $key, absint( $_POST[ $field ] ) );
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
 * Returns the attachment ID chosen for an image field, falling back to the
 * page's Featured Image when $use_featured_fallback is true, then to 0.
 */
function teeoff_image( $post_id, $key, $use_featured_fallback = false ) {
	$attach_id = (int) get_post_meta( $post_id, '_teeoff_img_' . $key, true );
	if ( $attach_id ) {
		return $attach_id;
	}
	if ( $use_featured_fallback ) {
		return (int) get_post_thumbnail_id( $post_id );
	}
	return 0;
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
