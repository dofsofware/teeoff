<?php
defined( 'ABSPATH' ) || exit;

/**
 * Native form handling (no plugin dependency, per cahier des charges §31 —
 * limit plugins to what is strictly necessary). Every form is protected by
 * a WordPress nonce and a honeypot field against spam.
 */

/**
 * Logs the underlying PHPMailer error when wp_mail() fails, since a bare
 * mail() failure (e.g. no local mail server) otherwise leaves no trace.
 */
function teeoff_log_mail_failure( $wp_error ) {
	error_log( 'TeeOff wp_mail failure: ' . $wp_error->get_error_message() );
}
add_action( 'wp_mail_failed', 'teeoff_log_mail_failure' );

function teeoff_handle_contact_form() {
	if ( ! isset( $_POST['teeoff_contact_nonce'] ) || ! wp_verify_nonce( $_POST['teeoff_contact_nonce'], 'teeoff_contact_form' ) ) {
		wp_die( esc_html__( 'Requête invalide.', 'teeoff' ) );
	}
	if ( ! empty( $_POST['teeoff_website_hp'] ) ) {
		wp_safe_redirect( add_query_arg( 'teeoff_contact', 'error', wp_get_referer() ) );
		exit;
	}

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$org     = isset( $_POST['organisation'] ) ? sanitize_text_field( wp_unslash( $_POST['organisation'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$subject = isset( $_POST['subject'] ) ? sanitize_text_field( wp_unslash( $_POST['subject'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
	$consent = ! empty( $_POST['consent'] );

	if ( ! $name || ! is_email( $email ) || ! $message || ! $consent ) {
		wp_safe_redirect( add_query_arg( 'teeoff_contact', 'error', wp_get_referer() ) );
		exit;
	}

	$to      = 'contact@teeofftechnologiesenegal.com';
	$title   = $subject ? $subject : __( 'Nouveau message', 'teeoff' );
	$body    = "Nom: $name\nOrganisation: $org\nEmail: $email\nTéléphone: $phone\nObjet: $subject\n\nMessage:\n$message";
	$headers = array(
		'Content-Type: text/plain; charset=UTF-8',
		'Reply-To: ' . $email,
		'Bcc: xamalteam@gmail.com',
	);

	$sent = wp_mail( $to, '[Contact TeeOff] ' . $title, $body, $headers );

	wp_safe_redirect( add_query_arg( 'teeoff_contact', $sent ? 'success' : 'mail_error', wp_get_referer() ) );
	exit;
}
add_action( 'admin_post_teeoff_contact_submit', 'teeoff_handle_contact_form' );
add_action( 'admin_post_nopriv_teeoff_contact_submit', 'teeoff_handle_contact_form' );

function teeoff_handle_partnership_form() {
	if ( ! isset( $_POST['teeoff_partnership_nonce'] ) || ! wp_verify_nonce( $_POST['teeoff_partnership_nonce'], 'teeoff_partnership_form' ) ) {
		wp_die( esc_html__( 'Requête invalide.', 'teeoff' ) );
	}
	if ( ! empty( $_POST['teeoff_website_hp'] ) ) {
		wp_safe_redirect( add_query_arg( 'teeoff_partnership', 'error', wp_get_referer() ) );
		exit;
	}

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$org     = isset( $_POST['organisation'] ) ? sanitize_text_field( wp_unslash( $_POST['organisation'] ) ) : '';
	$role    = isset( $_POST['role'] ) ? sanitize_text_field( wp_unslash( $_POST['role'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$type    = isset( $_POST['partnership_type'] ) ? sanitize_text_field( wp_unslash( $_POST['partnership_type'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	if ( ! $name || ! is_email( $email ) || ! $message ) {
		wp_safe_redirect( add_query_arg( 'teeoff_partnership', 'error', wp_get_referer() ) );
		exit;
	}

	$attachments = teeoff_handle_optional_upload( 'attachment' );

	$to      = 'contact@teeofftechnologiesenegal.com';
	$title   = $org ? $org : $name;
	$body    = "Nom: $name\nOrganisation: $org\nFonction: $role\nEmail: $email\nTéléphone: $phone\nType de partenariat: $type\n\nMessage:\n$message";
	$headers = array(
		'Content-Type: text/plain; charset=UTF-8',
		'Reply-To: ' . $email,
		'Bcc: xamalteam@gmail.com',
	);

	$sent = wp_mail( $to, '[Demande de partenariat] ' . $title, $body, $headers, $attachments );

	wp_safe_redirect( add_query_arg( 'teeoff_partnership', $sent ? 'success' : 'mail_error', wp_get_referer() ) );
	exit;
}
add_action( 'admin_post_teeoff_partnership_submit', 'teeoff_handle_partnership_form' );
add_action( 'admin_post_nopriv_teeoff_partnership_submit', 'teeoff_handle_partnership_form' );

function teeoff_handle_job_application() {
	if ( ! isset( $_POST['teeoff_job_nonce'] ) || ! wp_verify_nonce( $_POST['teeoff_job_nonce'], 'teeoff_job_form' ) ) {
		wp_die( esc_html__( 'Requête invalide.', 'teeoff' ) );
	}
	if ( ! empty( $_POST['teeoff_website_hp'] ) ) {
		wp_safe_redirect( add_query_arg( 'teeoff_job', 'error', wp_get_referer() ) );
		exit;
	}

	$job_id  = isset( $_POST['job_id'] ) ? absint( $_POST['job_id'] ) : 0;
	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	if ( ! $name || ! is_email( $email ) ) {
		wp_safe_redirect( add_query_arg( 'teeoff_job', 'error', wp_get_referer() ) );
		exit;
	}

	$attachments = teeoff_handle_optional_upload( 'cv' );

	$job_title = $job_id ? get_the_title( $job_id ) : __( 'Candidature spontanée', 'teeoff' );
	$to        = get_theme_mod( 'teeoff_notify_email' ) ? get_theme_mod( 'teeoff_notify_email' ) : get_option( 'admin_email' );
	$body      = "Poste: $job_title\nNom: $name\nEmail: $email\nTéléphone: $phone\n\nMessage:\n$message";
	$headers   = array( 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $email );

	wp_mail( $to, '[Candidature] ' . $job_title . ' — ' . $name, $body, $headers, $attachments );

	wp_safe_redirect( add_query_arg( 'teeoff_job', 'success', wp_get_referer() ) );
	exit;
}
add_action( 'admin_post_teeoff_job_submit', 'teeoff_handle_job_application' );
add_action( 'admin_post_nopriv_teeoff_job_submit', 'teeoff_handle_job_application' );

/**
 * Handles an optional PDF/Word upload for the partnership and job forms.
 * Returns an array of absolute file paths suitable for wp_mail()'s
 * attachments parameter.
 */
function teeoff_handle_optional_upload( $field ) {
	if ( empty( $_FILES[ $field ]['name'] ) ) {
		return array();
	}
	require_once ABSPATH . 'wp-admin/includes/file.php';
	$allowed  = array(
		'pdf'  => 'application/pdf',
		'doc'  => 'application/msword',
		'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
	);
	$uploaded = wp_handle_upload( $_FILES[ $field ], array( 'test_form' => false, 'mimes' => $allowed ) );
	if ( ! empty( $uploaded['file'] ) && empty( $uploaded['error'] ) ) {
		return array( $uploaded['file'] );
	}
	return array();
}
