<?php
defined( 'ABSPATH' ) || exit;
$status = isset( $_GET['teeoff_partnership'] ) ? sanitize_key( $_GET['teeoff_partnership'] ) : '';
?>
<?php if ( 'success' === $status ) : ?>
	<div class="form-notice form-notice--success"><?php esc_html_e( 'Merci, votre demande de partenariat a bien été envoyée.', 'teeoff' ); ?></div>
<?php elseif ( 'mail_error' === $status ) : ?>
	<div class="form-notice form-notice--error"><?php esc_html_e( "Votre demande n'a pas pu être envoyée pour une raison technique. Merci de réessayer plus tard ou de nous contacter directement par téléphone.", 'teeoff' ); ?></div>
<?php elseif ( 'error' === $status ) : ?>
	<div class="form-notice form-notice--error"><?php esc_html_e( 'Une erreur est survenue. Merci de vérifier les champs obligatoires.', 'teeoff' ); ?></div>
<?php endif; ?>

<form class="teeoff-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" enctype="multipart/form-data">
	<input type="hidden" name="action" value="teeoff_partnership_submit">
	<?php wp_nonce_field( 'teeoff_partnership_form', 'teeoff_partnership_nonce' ); ?>
	<div class="teeoff-form__honeypot" aria-hidden="true"><label>Website<input type="text" name="teeoff_website_hp" tabindex="-1" autocomplete="off"></label></div>

	<div class="form-row form-row--2col">
		<div class="form-field"><label for="p_name"><?php esc_html_e( 'Nom', 'teeoff' ); ?> *</label><input type="text" id="p_name" name="name" required></div>
		<div class="form-field"><label for="p_org"><?php esc_html_e( 'Organisation', 'teeoff' ); ?></label><input type="text" id="p_org" name="organisation"></div>
	</div>
	<div class="form-row form-row--2col">
		<div class="form-field"><label for="p_role"><?php esc_html_e( 'Fonction', 'teeoff' ); ?></label><input type="text" id="p_role" name="role"></div>
		<div class="form-field">
			<label for="p_type"><?php esc_html_e( 'Type de partenariat', 'teeoff' ); ?></label>
			<select id="p_type" name="partnership_type">
				<option value=""><?php esc_html_e( 'Selectionner...', 'teeoff' ); ?></option>
				<option value="technologique"><?php esc_html_e( 'Technologique', 'teeoff' ); ?></option>
				<option value="telecom"><?php esc_html_e( 'Opérateur télécom', 'teeoff' ); ?></option>
				<option value="sante"><?php esc_html_e( 'Santé', 'teeoff' ); ?></option>
				<option value="education"><?php esc_html_e( 'Éducation', 'teeoff' ); ?></option>
				<option value="culturel"><?php esc_html_e( 'Religieux / Culturel', 'teeoff' ); ?></option>
				<option value="institutionnel"><?php esc_html_e( 'Institutionnel', 'teeoff' ); ?></option>
				<option value="autre"><?php esc_html_e( 'Autre', 'teeoff' ); ?></option>
			</select>
		</div>
	</div>
	<div class="form-row form-row--2col">
		<div class="form-field"><label for="p_email"><?php esc_html_e( 'Email', 'teeoff' ); ?> *</label><input type="email" id="p_email" name="email" required></div>
		<div class="form-field"><label for="p_phone"><?php esc_html_e( 'Téléphone', 'teeoff' ); ?></label><input type="tel" id="p_phone" name="phone"></div>
	</div>
	<div class="form-field"><label for="p_message"><?php esc_html_e( 'Message', 'teeoff' ); ?> *</label><textarea id="p_message" name="message" rows="5" required></textarea></div>
	<div class="form-field"><label for="p_file"><?php esc_html_e( 'Pièce jointe (facultatif — PDF ou Word)', 'teeoff' ); ?></label><input type="file" id="p_file" name="attachment" accept=".pdf,.doc,.docx"></div>
	<button type="submit" class="btn btn--primary"><?php esc_html_e( 'Envoyer la demande', 'teeoff' ); ?></button>
</form>
