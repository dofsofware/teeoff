<?php
defined( 'ABSPATH' ) || exit;

/**
 * Routes wp_mail() through a real SMTP account instead of PHP's mail()
 * function (which needs a local mail server XAMPP doesn't provide, and
 * most production hosts throttle or block outright). Only activates once
 * TEEOFF_SMTP_HOST is defined in wp-config.php — see the placeholder block
 * added there for the constants to set.
 */
function teeoff_configure_smtp( $phpmailer ) {
	if ( ! defined( 'TEEOFF_SMTP_HOST' ) || ! TEEOFF_SMTP_HOST ) {
		return;
	}

	$phpmailer->isSMTP();
	$phpmailer->Host       = TEEOFF_SMTP_HOST;
	$phpmailer->Port       = defined( 'TEEOFF_SMTP_PORT' ) ? TEEOFF_SMTP_PORT : 587;
	$phpmailer->SMTPAuth   = true;
	$phpmailer->Username   = defined( 'TEEOFF_SMTP_USER' ) ? TEEOFF_SMTP_USER : '';
	$phpmailer->Password   = defined( 'TEEOFF_SMTP_PASS' ) ? TEEOFF_SMTP_PASS : '';
	$phpmailer->SMTPSecure = defined( 'TEEOFF_SMTP_SECURE' ) ? TEEOFF_SMTP_SECURE : 'tls';
	$phpmailer->From       = defined( 'TEEOFF_SMTP_FROM' ) ? TEEOFF_SMTP_FROM : $phpmailer->Username;
	$phpmailer->FromName   = defined( 'TEEOFF_SMTP_FROM_NAME' ) ? TEEOFF_SMTP_FROM_NAME : get_bloginfo( 'name' );
}
add_action( 'phpmailer_init', 'teeoff_configure_smtp' );

/**
 * wp_mail() validates the From address (via setFrom()) before phpmailer_init
 * fires, so on environments where the site domain doesn't resolve to a valid
 * mailbox (e.g. "wordpress@localhost" locally), sending fails before our SMTP
 * config even runs. Force a valid From address whenever SMTP is configured.
 */
function teeoff_mail_from( $from_email ) {
	return defined( 'TEEOFF_SMTP_FROM' ) && TEEOFF_SMTP_FROM ? TEEOFF_SMTP_FROM : $from_email;
}
add_filter( 'wp_mail_from', 'teeoff_mail_from' );

function teeoff_mail_from_name( $from_name ) {
	return defined( 'TEEOFF_SMTP_FROM_NAME' ) && TEEOFF_SMTP_FROM_NAME ? TEEOFF_SMTP_FROM_NAME : $from_name;
}
add_filter( 'wp_mail_from_name', 'teeoff_mail_from_name' );
