<?php
defined( 'ABSPATH' ) || exit;

/**
 * All UI icons are hand-authored inline SVG (two-tone, brand colors) so the
 * site does not depend on AI-generated images for small functional icons.
 * Big photographic / illustrative visuals still use Leonardo AI — see
 * references/leonardo-ai-prompts.md and inc/media-helpers.php.
 */

function teeoff_solution_icon_svg( $slug ) {
	$icons = array(
		'sante'             => '<svg viewBox="0 0 48 48" width="28" height="28" aria-hidden="true"><circle cx="24" cy="24" r="22" fill="var(--teeoff-secondary)"/><path d="M24 14v20M14 24h20" stroke="var(--teeoff-primary)" stroke-width="4" stroke-linecap="round"/></svg>',
		'education'         => '<svg viewBox="0 0 48 48" width="28" height="28" aria-hidden="true"><circle cx="24" cy="24" r="22" fill="var(--teeoff-secondary)"/><path d="M12 17l12-5 12 5-12 5-12-5z" fill="var(--teeoff-primary)"/><path d="M16 20v8c0 2 3.5 4 8 4s8-2 8-4v-8" stroke="var(--teeoff-primary)" stroke-width="2.5" fill="none" stroke-linecap="round"/></svg>',
		'guides-pratiques'  => '<svg viewBox="0 0 48 48" width="28" height="28" aria-hidden="true"><circle cx="24" cy="24" r="22" fill="var(--teeoff-secondary)"/><circle cx="24" cy="24" r="10" stroke="var(--teeoff-primary)" stroke-width="2.5" fill="none"/><path d="M24 18l3 6-3 6-3-6 3-6z" fill="var(--teeoff-primary)"/></svg>',
		'religion-culture'  => '<svg viewBox="0 0 48 48" width="28" height="28" aria-hidden="true"><circle cx="24" cy="24" r="22" fill="var(--teeoff-secondary)"/><path d="M24 11l3.2 8.8L36 23l-8.8 3.2L24 35l-3.2-8.8L12 23l8.8-3.2L24 11z" fill="var(--teeoff-primary)"/></svg>',
	);
	return isset( $icons[ $slug ] ) ? $icons[ $slug ] : '';
}

function teeoff_why_icon_svg( $key ) {
	$icons = array(
		'accessible'         => '<svg viewBox="0 0 40 40" width="32" height="32" fill="none" aria-hidden="true"><rect x="12" y="4" width="16" height="32" rx="3" stroke="var(--teeoff-primary)" stroke-width="2"/><circle cx="20" cy="30" r="1.6" fill="var(--teeoff-primary)"/><path d="M15 12l3 3 7-7" stroke="var(--teeoff-secondary)" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'sans-internet'      => '<svg viewBox="0 0 40 40" width="32" height="32" fill="none" aria-hidden="true"><path d="M6 16a20 20 0 0 1 28 0M11 21a13 13 0 0 1 18 0M16 26a6 6 0 0 1 8 0" stroke="var(--teeoff-primary)" stroke-width="2" stroke-linecap="round"/><circle cx="20" cy="31" r="1.8" fill="var(--teeoff-primary)"/><path d="M6 6l28 28" stroke="var(--teeoff-secondary)" stroke-width="2.4" stroke-linecap="round"/></svg>',
		'multilingue'        => '<svg viewBox="0 0 40 40" width="32" height="32" fill="none" aria-hidden="true"><path d="M8 10h16v11H16l-4 4v-4H8z" stroke="var(--teeoff-primary)" stroke-width="2" stroke-linejoin="round"/><path d="M18 24h10l4 4v-4h2V15h-8" stroke="var(--teeoff-secondary)" stroke-width="2" stroke-linejoin="round"/></svg>',
		'accessible-partout' => '<svg viewBox="0 0 40 40" width="32" height="32" fill="none" aria-hidden="true"><path d="M20 4C13 4 8 9.5 8 16c0 9 12 20 12 20s12-11 12-20c0-6.5-5-12-12-12z" stroke="var(--teeoff-primary)" stroke-width="2"/><circle cx="20" cy="16" r="4.5" fill="var(--teeoff-secondary)"/></svg>',
		'simple'             => '<svg viewBox="0 0 40 40" width="32" height="32" fill="none" aria-hidden="true"><circle cx="20" cy="20" r="16" stroke="var(--teeoff-primary)" stroke-width="2"/><circle cx="20" cy="20" r="5" fill="var(--teeoff-secondary)"/></svg>',
	);
	return isset( $icons[ $key ] ) ? $icons[ $key ] : '';
}

function teeoff_step_icon_svg( $n ) {
	$icons = array(
		1 => '<svg viewBox="0 0 40 40" width="30" height="30" aria-hidden="true"><path d="M12 8c0-1 1-2 2-2h4c1 3 1 5 0 7l-3 2c1.5 4 4.5 7 8.5 8.5l2-3c2-1 4-1 7 0v4c0 1-1 2-2 2C18 26.5 13.5 22 12 12z" fill="var(--teeoff-primary)"/></svg>',
		2 => '<svg viewBox="0 0 40 40" width="30" height="30" fill="none" aria-hidden="true"><rect x="9" y="6" width="22" height="28" rx="3" stroke="var(--teeoff-primary)" stroke-width="2"/><path d="M14 14h12M14 20h12M14 26h7" stroke="var(--teeoff-secondary)" stroke-width="2.2" stroke-linecap="round"/></svg>',
		3 => '<svg viewBox="0 0 40 40" width="30" height="30" fill="none" aria-hidden="true"><rect x="16" y="6" width="8" height="16" rx="4" stroke="var(--teeoff-primary)" stroke-width="2"/><path d="M11 18a9 9 0 0 0 18 0M20 27v6M15 33h10" stroke="var(--teeoff-secondary)" stroke-width="2.2" stroke-linecap="round"/></svg>',
		4 => '<svg viewBox="0 0 40 40" width="30" height="30" fill="none" aria-hidden="true"><circle cx="20" cy="20" r="15" stroke="var(--teeoff-primary)" stroke-width="2"/><path d="M13 20l5 5 9-10" stroke="var(--teeoff-secondary)" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/></svg>',
	);
	return isset( $icons[ $n ] ) ? $icons[ $n ] : '';
}

function teeoff_value_icon_svg( $key ) {
	$icons = array(
		'accessibilite' => '<svg viewBox="0 0 40 40" width="30" height="30" fill="none" aria-hidden="true"><rect x="8" y="12" width="24" height="18" rx="2" stroke="var(--teeoff-primary)" stroke-width="2"/><path d="M8 16h24" stroke="var(--teeoff-primary)" stroke-width="2"/><circle cx="20" cy="23" r="3" fill="var(--teeoff-secondary)"/></svg>',
		'inclusion'     => '<svg viewBox="0 0 40 40" width="30" height="30" fill="none" aria-hidden="true"><circle cx="16" cy="20" r="9" stroke="var(--teeoff-primary)" stroke-width="2"/><circle cx="24" cy="20" r="9" stroke="var(--teeoff-secondary)" stroke-width="2"/></svg>',
		'innovation'    => '<svg viewBox="0 0 40 40" width="30" height="30" fill="none" aria-hidden="true"><path d="M20 6a10 10 0 0 1 6 18c-1 1-2 3-2 5h-8c0-2-1-4-2-5A10 10 0 0 1 20 6z" stroke="var(--teeoff-primary)" stroke-width="2"/><path d="M17 33h6" stroke="var(--teeoff-secondary)" stroke-width="2.4" stroke-linecap="round"/></svg>',
		'impact-social' => '<svg viewBox="0 0 40 40" width="30" height="30" fill="none" aria-hidden="true"><path d="M20 30S8 22 8 14a6 6 0 0 1 12-2 6 6 0 0 1 12 2c0 8-12 16-12 16z" fill="var(--teeoff-secondary)"/><path d="M12 30h16" stroke="var(--teeoff-primary)" stroke-width="2" stroke-linecap="round"/></svg>',
		'simplicite'    => '<svg viewBox="0 0 40 40" width="30" height="30" fill="none" aria-hidden="true"><circle cx="20" cy="20" r="14" stroke="var(--teeoff-primary)" stroke-width="2"/><circle cx="20" cy="20" r="4" fill="var(--teeoff-secondary)"/></svg>',
		'proximite'     => '<svg viewBox="0 0 40 40" width="30" height="30" fill="none" aria-hidden="true"><circle cx="12" cy="14" r="3.4" fill="var(--teeoff-secondary)"/><circle cx="28" cy="26" r="3.4" fill="var(--teeoff-primary)"/><path d="M14.5 16.5L25.5 23.5" stroke="var(--teeoff-primary)" stroke-width="2" stroke-linecap="round"/></svg>',
	);
	return isset( $icons[ $key ] ) ? $icons[ $key ] : '';
}

function teeoff_social_icon_svg( $icon ) {
	$icons = array(
		'linkedin'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M4.98 3.5C4.98 4.88 3.87 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 4.98 2.12 4.98 3.5zM.24 8.24h4.5V23h-4.5V8.24zM8.5 8.24h4.31v2.02h.06c.6-1.13 2.06-2.32 4.24-2.32 4.53 0 5.37 2.98 5.37 6.86V23h-4.5v-6.98c0-1.67-.03-3.81-2.32-3.81-2.33 0-2.69 1.82-2.69 3.7V23h-4.5V8.24z"/></svg>',
		'facebook'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M22 12a10 10 0 1 0-11.56 9.88v-6.99H7.9V12h2.54V9.8c0-2.5 1.49-3.89 3.78-3.89 1.1 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56V12h2.78l-.44 2.89h-2.34v6.99A10 10 0 0 0 22 12z"/></svg>',
		'instagram' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2.16c3.2 0 3.58.01 4.85.07 1.17.05 1.8.25 2.23.41.56.22.96.48 1.38.9.42.42.68.82.9 1.38.16.42.36 1.06.41 2.23.06 1.27.07 1.65.07 4.85s-.01 3.58-.07 4.85c-.05 1.17-.25 1.8-.41 2.23-.22.56-.48.96-.9 1.38-.42.42-.82.68-1.38.9-.42.16-1.06.36-2.23.41-1.27.06-1.65.07-4.85.07s-3.58-.01-4.85-.07c-1.17-.05-1.8-.25-2.23-.41-.56-.22-.96-.48-1.38-.9-.42-.42-.68-.82-.9-1.38-.16-.42-.36-1.06-.41-2.23-.06-1.27-.07-1.65-.07-4.85s.01-3.58.07-4.85c.05-1.17.25-1.8.41-2.23.22-.56.48-.96.9-1.38.42-.42.82-.68 1.38-.9.42-.16 1.06-.36 2.23-.41C8.42 2.17 8.8 2.16 12 2.16zm0 5.35a4.49 4.49 0 1 0 0 8.98 4.49 4.49 0 0 0 0-8.98zm0 7.4a2.92 2.92 0 1 1 0-5.83 2.92 2.92 0 0 1 0 5.83zm5.72-7.58a1.05 1.05 0 1 1-2.1 0 1.05 1.05 0 0 1 2.1 0z"/></svg>',
		'youtube'   => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23.5 6.19a3.02 3.02 0 0 0-2.12-2.14C19.51 3.5 12 3.5 12 3.5s-7.51 0-9.38.55A3.02 3.02 0 0 0 .5 6.19 31.6 31.6 0 0 0 0 12a31.6 31.6 0 0 0 .5 5.81 3.02 3.02 0 0 0 2.12 2.14C4.49 20.5 12 20.5 12 20.5s7.51 0 9.38-.55a3.02 3.02 0 0 0 2.12-2.14A31.6 31.6 0 0 0 24 12a31.6 31.6 0 0 0-.5-5.81zM9.75 15.5v-7l6.5 3.5-6.5 3.5z"/></svg>',
		'x'         => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.24 2H21l-6.55 7.49L22.5 22h-6.87l-5.38-7.02L3.9 22H1.13l7.02-8.02L1 2h7.03l4.87 6.43L18.24 2zm-1.2 18h1.9L7.05 3.9h-2L17.04 20z"/></svg>',
		'tiktok'    => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M16.6 5.82a4.6 4.6 0 0 1-3.77-4.42h-3.3v14.4a2.7 2.7 0 1 1-2.7-2.7c.24 0 .48.03.7.08V9.9a6 6 0 1 0 5.3 5.95V9.28a7.9 7.9 0 0 0 3.77 1v-3.3a4.58 4.58 0 0 1 0-.16z"/></svg>',
	);
	return isset( $icons[ $icon ] ) ? $icons[ $icon ] : '';
}

function teeoff_placeholder_icon_svg( $is_video = false ) {
	if ( $is_video ) {
		return '<svg width="30" height="30" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"/><path d="M10 9l5 3-5 3V9z" fill="currentColor"/></svg>';
	}
	return '<svg width="30" height="30" viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="4" width="18" height="16" rx="2" stroke="currentColor" stroke-width="1.5"/><circle cx="8.5" cy="9.5" r="1.5" fill="currentColor"/><path d="M3 16l5-5 4 4 3-3 6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
}
