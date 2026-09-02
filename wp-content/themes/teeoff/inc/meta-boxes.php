<?php
defined( 'ABSPATH' ) || exit;

/* ---------------------------------------------------------------------
 * Solution (Santé / Éducation / Guides pratiques / Religion & Culture)
 * ------------------------------------------------------------------- */

function teeoff_solution_meta_box() {
	add_meta_box( 'teeoff_solution_details', __( 'Détails de la solution', 'teeoff' ), 'teeoff_solution_meta_box_html', 'solution', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'teeoff_solution_meta_box' );

function teeoff_solution_meta_box_html( $post ) {
	wp_nonce_field( 'teeoff_solution_meta', 'teeoff_solution_meta_nonce' );
	$subtitle = get_post_meta( $post->ID, '_teeoff_subtitle', true );
	$benefits = get_post_meta( $post->ID, '_teeoff_benefits', true );
	$card_ref = get_post_meta( $post->ID, '_teeoff_card_ref', true );
	?>
	<div class="teeoff-image-hint">
		<?php esc_html_e( "Pour changer l'image de cette carte : utilisez le bloc \"Image mise en avant\" dans la colonne de droite (au-dessus).", 'teeoff' ); ?>
	</div>
	<p>
		<label for="teeoff_subtitle"><strong><?php esc_html_e( 'Accroche courte (affichée sur la carte)', 'teeoff' ); ?></strong></label><br>
		<input type="text" id="teeoff_subtitle" name="teeoff_subtitle" value="<?php echo esc_attr( $subtitle ); ?>" class="widefat">
	</p>
	<p>
		<label for="teeoff_benefits"><strong><?php esc_html_e( 'Avantages (un par ligne)', 'teeoff' ); ?></strong></label><br>
		<textarea id="teeoff_benefits" name="teeoff_benefits" rows="5" class="widefat"><?php echo esc_textarea( $benefits ); ?></textarea>
	</p>
	<p>
		<label for="teeoff_card_ref"><strong><?php esc_html_e( 'Référence prompt Leonardo (suggestion pour générer une image)', 'teeoff' ); ?></strong></label><br>
		<input type="text" id="teeoff_card_ref" name="teeoff_card_ref" value="<?php echo esc_attr( $card_ref ); ?>" class="widefat" placeholder="ex: 4.1">
		<span class="description"><?php esc_html_e( "Ce champ n'affiche pas d'image, c'est juste un renvoi vers references/leonardo-ai-prompts.md.", 'teeoff' ); ?></span>
	</p>
	<?php
}

function teeoff_save_solution_meta( $post_id ) {
	if ( ! isset( $_POST['teeoff_solution_meta_nonce'] ) || ! wp_verify_nonce( $_POST['teeoff_solution_meta_nonce'], 'teeoff_solution_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( isset( $_POST['teeoff_subtitle'] ) ) {
		update_post_meta( $post_id, '_teeoff_subtitle', sanitize_text_field( wp_unslash( $_POST['teeoff_subtitle'] ) ) );
	}
	if ( isset( $_POST['teeoff_benefits'] ) ) {
		update_post_meta( $post_id, '_teeoff_benefits', sanitize_textarea_field( wp_unslash( $_POST['teeoff_benefits'] ) ) );
	}
	if ( isset( $_POST['teeoff_card_ref'] ) ) {
		update_post_meta( $post_id, '_teeoff_card_ref', sanitize_text_field( wp_unslash( $_POST['teeoff_card_ref'] ) ) );
	}
}
add_action( 'save_post_solution', 'teeoff_save_solution_meta' );

/* ---------------------------------------------------------------------
 * Partenaire
 * ------------------------------------------------------------------- */

function teeoff_partenaire_meta_box() {
	add_meta_box( 'teeoff_partenaire_details', __( 'Détails du partenaire', 'teeoff' ), 'teeoff_partenaire_meta_box_html', 'partenaire', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'teeoff_partenaire_meta_box' );

function teeoff_partenaire_meta_box_html( $post ) {
	wp_nonce_field( 'teeoff_partenaire_meta', 'teeoff_partenaire_meta_nonce' );
	$url = get_post_meta( $post->ID, '_teeoff_website', true );
	?>
	<p>
		<label for="teeoff_website"><strong><?php esc_html_e( 'Site web du partenaire', 'teeoff' ); ?></strong></label><br>
		<input type="url" id="teeoff_website" name="teeoff_website" value="<?php echo esc_attr( $url ); ?>" class="widefat" placeholder="https://">
	</p>
	<p class="description"><?php esc_html_e( 'Ajoutez le logo du partenaire comme image mise en avant. Définissez son type via la taxonomie "Types de partenariat".', 'teeoff' ); ?></p>
	<?php
}

function teeoff_save_partenaire_meta( $post_id ) {
	if ( ! isset( $_POST['teeoff_partenaire_meta_nonce'] ) || ! wp_verify_nonce( $_POST['teeoff_partenaire_meta_nonce'], 'teeoff_partenaire_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( isset( $_POST['teeoff_website'] ) ) {
		update_post_meta( $post_id, '_teeoff_website', esc_url_raw( wp_unslash( $_POST['teeoff_website'] ) ) );
	}
}
add_action( 'save_post_partenaire', 'teeoff_save_partenaire_meta' );

/* ---------------------------------------------------------------------
 * Emploi (Carrieres)
 * ------------------------------------------------------------------- */

function teeoff_emploi_meta_box() {
	add_meta_box( 'teeoff_emploi_details', __( "Détails de l'offre", 'teeoff' ), 'teeoff_emploi_meta_box_html', 'emploi', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'teeoff_emploi_meta_box' );

function teeoff_emploi_meta_box_html( $post ) {
	wp_nonce_field( 'teeoff_emploi_meta', 'teeoff_emploi_meta_nonce' );
	$contrat = get_post_meta( $post->ID, '_teeoff_contrat', true );
	$lieu    = get_post_meta( $post->ID, '_teeoff_lieu', true );
	$limite  = get_post_meta( $post->ID, '_teeoff_limite', true );
	$profil  = get_post_meta( $post->ID, '_teeoff_profil', true );
	?>
	<p><label><strong><?php esc_html_e( 'Type de contrat', 'teeoff' ); ?></strong></label><br>
		<input type="text" name="teeoff_contrat" value="<?php echo esc_attr( $contrat ); ?>" class="widefat"></p>
	<p><label><strong><?php esc_html_e( 'Localisation', 'teeoff' ); ?></strong></label><br>
		<input type="text" name="teeoff_lieu" value="<?php echo esc_attr( $lieu ); ?>" class="widefat"></p>
	<p><label><strong><?php esc_html_e( 'Date limite', 'teeoff' ); ?></strong></label><br>
		<input type="date" name="teeoff_limite" value="<?php echo esc_attr( $limite ); ?>"></p>
	<p><label><strong><?php esc_html_e( 'Profil recherché', 'teeoff' ); ?></strong></label><br>
		<textarea name="teeoff_profil" rows="4" class="widefat"><?php echo esc_textarea( $profil ); ?></textarea></p>
	<?php
}

function teeoff_save_emploi_meta( $post_id ) {
	if ( ! isset( $_POST['teeoff_emploi_meta_nonce'] ) || ! wp_verify_nonce( $_POST['teeoff_emploi_meta_nonce'], 'teeoff_emploi_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( isset( $_POST['teeoff_contrat'] ) ) {
		update_post_meta( $post_id, '_teeoff_contrat', sanitize_text_field( wp_unslash( $_POST['teeoff_contrat'] ) ) );
	}
	if ( isset( $_POST['teeoff_lieu'] ) ) {
		update_post_meta( $post_id, '_teeoff_lieu', sanitize_text_field( wp_unslash( $_POST['teeoff_lieu'] ) ) );
	}
	if ( isset( $_POST['teeoff_limite'] ) ) {
		update_post_meta( $post_id, '_teeoff_limite', sanitize_text_field( wp_unslash( $_POST['teeoff_limite'] ) ) );
	}
	if ( isset( $_POST['teeoff_profil'] ) ) {
		update_post_meta( $post_id, '_teeoff_profil', sanitize_textarea_field( wp_unslash( $_POST['teeoff_profil'] ) ) );
	}
}
add_action( 'save_post_emploi', 'teeoff_save_emploi_meta' );
