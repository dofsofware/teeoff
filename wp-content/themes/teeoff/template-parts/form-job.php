<?php
defined( 'ABSPATH' ) || exit;
$status = isset( $_GET['teeoff_job'] ) ? sanitize_key( $_GET['teeoff_job'] ) : '';
?>
<?php if ( 'success' === $status ) : ?>
	<div class="form-notice form-notice--success"><?php esc_html_e( 'Merci, votre candidature a bien été envoyée.', 'teeoff' ); ?></div>
<?php elseif ( 'error' === $status ) : ?>
	<div class="form-notice form-notice--error"><?php esc_html_e( 'Une erreur est survenue. Merci de vérifier les champs obligatoires.', 'teeoff' ); ?></div>
<?php endif; ?>

<form class="teeoff-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" enctype="multipart/form-data">
	<input type="hidden" name="action" value="teeoff_job_submit">
	<input type="hidden" name="job_id" value="<?php echo esc_attr( get_the_ID() ); ?>">
	<?php wp_nonce_field( 'teeoff_job_form', 'teeoff_job_nonce' ); ?>
	<div class="teeoff-form__honeypot" aria-hidden="true"><label>Website<input type="text" name="teeoff_website_hp" tabindex="-1" autocomplete="off"></label></div>

	<div class="form-row form-row--2col">
		<div class="form-field"><label for="j_name"><?php esc_html_e( 'Nom et prénom', 'teeoff' ); ?> *</label><input type="text" id="j_name" name="name" required></div>
		<div class="form-field"><label for="j_email"><?php esc_html_e( 'Email', 'teeoff' ); ?> *</label><input type="email" id="j_email" name="email" required></div>
	</div>
	<div class="form-field"><label for="j_phone"><?php esc_html_e( 'Téléphone', 'teeoff' ); ?></label><input type="tel" id="j_phone" name="phone"></div>
	<div class="form-field"><label for="j_message"><?php esc_html_e( 'Message de motivation', 'teeoff' ); ?></label><textarea id="j_message" name="message" rows="4"></textarea></div>
	<div class="form-field"><label for="j_cv"><?php esc_html_e( 'CV (PDF ou Word)', 'teeoff' ); ?></label><input type="file" id="j_cv" name="cv" accept=".pdf,.doc,.docx"></div>
	<button type="submit" class="btn btn--primary"><?php esc_html_e( 'Postuler', 'teeoff' ); ?></button>
</form>
