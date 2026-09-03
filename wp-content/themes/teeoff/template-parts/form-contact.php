<?php
defined( 'ABSPATH' ) || exit;
$status = isset( $_GET['teeoff_contact'] ) ? sanitize_key( $_GET['teeoff_contact'] ) : '';
?>
<?php if ( 'success' === $status ) : ?>
	<div class="form-notice form-notice--success"><?php esc_html_e( 'Merci, votre message a bien été envoyé. Nous vous répondrons rapidement.', 'teeoff' ); ?></div>
<?php elseif ( 'mail_error' === $status ) : ?>
	<div class="form-notice form-notice--error"><?php esc_html_e( "Votre message n'a pas pu être envoyé pour une raison technique. Merci de réessayer plus tard ou de nous contacter directement par téléphone.", 'teeoff' ); ?></div>
<?php elseif ( 'error' === $status ) : ?>
	<div class="form-notice form-notice--error"><?php esc_html_e( 'Une erreur est survenue. Merci de vérifier les champs obligatoires et de réessayer.', 'teeoff' ); ?></div>
<?php endif; ?>

<form class="teeoff-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
	<input type="hidden" name="action" value="teeoff_contact_submit">
	<?php wp_nonce_field( 'teeoff_contact_form', 'teeoff_contact_nonce' ); ?>
	<div class="teeoff-form__honeypot" aria-hidden="true"><label>Website<input type="text" name="teeoff_website_hp" tabindex="-1" autocomplete="off"></label></div>

	<div class="form-row form-row--2col">
		<div class="form-field">
			<label for="name"><?php esc_html_e( 'Nom et prénom', 'teeoff' ); ?> *</label>
			<input type="text" id="name" name="name" required>
		</div>
		<div class="form-field">
			<label for="organisation"><?php esc_html_e( 'Entreprise / Organisation', 'teeoff' ); ?></label>
			<input type="text" id="organisation" name="organisation">
		</div>
	</div>
	<div class="form-row form-row--2col">
		<div class="form-field">
			<label for="email"><?php esc_html_e( 'Email', 'teeoff' ); ?> *</label>
			<input type="email" id="email" name="email" required>
		</div>
		<div class="form-field">
			<label for="phone"><?php esc_html_e( 'Téléphone', 'teeoff' ); ?></label>
			<input type="tel" id="phone" name="phone">
		</div>
	</div>
	<div class="form-field">
		<label for="subject"><?php esc_html_e( 'Objet', 'teeoff' ); ?></label>
		<input type="text" id="subject" name="subject">
	</div>
	<div class="form-field">
		<label for="message"><?php esc_html_e( 'Message', 'teeoff' ); ?> *</label>
		<textarea id="message" name="message" rows="5" required></textarea>
	</div>
	<div class="form-field form-field--checkbox">
		<label><input type="checkbox" name="consent" value="1" required> <?php esc_html_e( 'J\'accepte que mes données soient utilisées pour traiter ma demande.', 'teeoff' ); ?> *</label>
	</div>
	<button type="submit" class="btn btn--primary"><?php esc_html_e( 'Envoyer', 'teeoff' ); ?></button>
</form>
