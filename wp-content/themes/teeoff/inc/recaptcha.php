<?php
defined( 'ABSPATH' ) || exit;

/**
 * Native Google reCAPTCHA v2 ("I'm not a robot") for the contact and
 * partnership forms, on top of the existing honeypot. Opt-in via
 * TEEOFF_RECAPTCHA_SITE_KEY / TEEOFF_RECAPTCHA_SECRET_KEY in wp-config.php
 * (see placeholders there) — forms work without it configured, they just
 * skip the widget and the server-side check.
 */
function teeoff_recaptcha_enabled() {
	return defined( 'TEEOFF_RECAPTCHA_SITE_KEY' ) && TEEOFF_RECAPTCHA_SITE_KEY
		&& defined( 'TEEOFF_RECAPTCHA_SECRET_KEY' ) && TEEOFF_RECAPTCHA_SECRET_KEY;
}

function teeoff_recaptcha_field() {
	if ( ! teeoff_recaptcha_enabled() ) {
		return;
	}
	?>
	<div class="form-field">
		<div class="g-recaptcha" data-sitekey="<?php echo esc_attr( TEEOFF_RECAPTCHA_SITE_KEY ); ?>"></div>
	</div>
	<?php
}

/**
 * Verifies the widget's response token with Google. Returns true when
 * reCAPTCHA isn't configured, so it never blocks submissions on
 * environments where it hasn't been set up yet.
 */
function teeoff_verify_recaptcha() {
	if ( ! teeoff_recaptcha_enabled() ) {
		return true;
	}

	$token = isset( $_POST['g-recaptcha-response'] ) ? sanitize_text_field( wp_unslash( $_POST['g-recaptcha-response'] ) ) : '';
	if ( ! $token ) {
		return false;
	}

	$response = wp_remote_post( 'https://www.google.com/recaptcha/api/siteverify', array(
		'body'    => array(
			'secret'   => TEEOFF_RECAPTCHA_SECRET_KEY,
			'response' => $token,
			'remoteip' => isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '',
		),
		'timeout' => 10,
	) );

	if ( is_wp_error( $response ) ) {
		error_log( 'TeeOff reCAPTCHA verification request failed: ' . $response->get_error_message() );
		return false;
	}

	$body = json_decode( wp_remote_retrieve_body( $response ), true );
	return ! empty( $body['success'] );
}

function teeoff_recaptcha_scripts() {
	if ( ! teeoff_recaptcha_enabled() ) {
		return;
	}
	if ( is_page_template( 'page-contact.php' ) || is_page_template( 'page-partenaires.php' ) ) {
		wp_enqueue_script( 'google-recaptcha', 'https://www.google.com/recaptcha/api.js', array(), null, true );
	}
}
add_action( 'wp_enqueue_scripts', 'teeoff_recaptcha_scripts' );
