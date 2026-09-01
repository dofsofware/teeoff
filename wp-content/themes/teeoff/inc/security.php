<?php
defined( 'ABSPATH' ) || exit;

/**
 * Baseline WordPress security hardening (cahier des charges §22), kept
 * plugin-free to respect the "limiter les extensions" requirement (§31).
 */

remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );

add_filter( 'xmlrpc_enabled', '__return_false' );

if ( ! defined( 'DISALLOW_FILE_EDIT' ) ) {
	define( 'DISALLOW_FILE_EDIT', true );
}

add_filter( 'login_errors', function () {
	return __( 'Identifiants incorrects.', 'teeoff' );
} );

/**
 * Simple transient-based login throttle: 5 failures locks an IP out of
 * further attempts for 15 minutes.
 */
function teeoff_check_login_attempts( $user, $username, $password ) {
	if ( empty( $username ) || empty( $password ) ) {
		return $user;
	}
	$key      = 'teeoff_login_fail_' . md5( teeoff_get_ip() );
	$attempts = (int) get_transient( $key );
	if ( $attempts >= 5 ) {
		return new WP_Error( 'too_many_attempts', __( 'Trop de tentatives de connexion. Reessayez dans 15 minutes.', 'teeoff' ) );
	}
	return $user;
}
add_filter( 'authenticate', 'teeoff_check_login_attempts', 30, 3 );

add_action( 'wp_login_failed', function () {
	$key      = 'teeoff_login_fail_' . md5( teeoff_get_ip() );
	$attempts = (int) get_transient( $key );
	set_transient( $key, $attempts + 1, 15 * MINUTE_IN_SECONDS );
} );

add_action( 'wp_login', function () {
	delete_transient( 'teeoff_login_fail_' . md5( teeoff_get_ip() ) );
} );

function teeoff_get_ip() {
	return isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '0.0.0.0';
}

add_action( 'send_headers', function () {
	if ( ! is_admin() ) {
		header( 'X-Content-Type-Options: nosniff' );
		header( 'X-Frame-Options: SAMEORIGIN' );
		header( 'Referrer-Policy: strict-origin-when-cross-origin' );
	}
} );
