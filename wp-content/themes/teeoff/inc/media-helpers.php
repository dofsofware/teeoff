<?php
defined( 'ABSPATH' ) || exit;

/**
 * Media placeholder system.
 *
 * The site is developed before final photos/videos exist. Every spot that
 * needs a generated visual renders either the real media (once uploaded via
 * a Custom Field, the Customizer, or a featured image) or an on-brand
 * placeholder that names the exact prompt reference to use from
 * references/leonardo-ai-prompts.md. This keeps development and asset
 * generation decoupled: editors can see at a glance, on the live front-end,
 * which prompt produces which image.
 */

function teeoff_media_image( $args = array() ) {
	$defaults = array(
		'image_id' => 0,
		'ref'      => '',
		'label'    => '',
		'alt'      => '',
		'class'    => '',
		'ratio'    => 'ratio-4-3',
		'size'     => 'teeoff-card',
	);
	$args    = wp_parse_args( $args, $defaults );
	$classes = trim( 'teeoff-media ' . $args['ratio'] . ' ' . $args['class'] );

	if ( $args['image_id'] ) {
		printf(
			'<div class="%1$s">%2$s</div>',
			esc_attr( $classes ),
			wp_get_attachment_image( $args['image_id'], $args['size'], false, array(
				'alt'     => esc_attr( $args['alt'] ),
				'loading' => 'lazy',
			) )
		);
		return;
	}

	printf(
		'<div class="%1$s media-placeholder"%2$s><span class="media-placeholder__icon">%3$s</span><span class="media-placeholder__label">%4$s</span></div>',
		esc_attr( $classes ),
		$args['ref'] ? ' data-prompt-ref="' . esc_attr( $args['ref'] ) . '"' : '',
		teeoff_placeholder_icon_svg(),
		esc_html( $args['label'] ? $args['label'] : __( 'Image a generer', 'teeoff' ) )
	);
}

function teeoff_media_video( $args = array() ) {
	$defaults = array(
		'video_url' => '',
		'poster_id' => 0,
		'ref'       => '',
		'label'     => '',
		'class'     => '',
		'ratio'     => 'ratio-16-9',
	);
	$args    = wp_parse_args( $args, $defaults );
	$classes = trim( 'teeoff-media ' . $args['ratio'] . ' ' . $args['class'] );

	if ( $args['video_url'] ) {
		$poster = $args['poster_id'] ? ' poster="' . esc_url( wp_get_attachment_image_url( $args['poster_id'], 'teeoff-banner' ) ) . '"' : '';
		printf(
			'<div class="%1$s"><video class="teeoff-video" autoplay muted loop playsinline%2$s><source src="%3$s" type="video/mp4"></video></div>',
			esc_attr( $classes ),
			$poster,
			esc_url( $args['video_url'] )
		);
		return;
	}

	if ( $args['poster_id'] ) {
		printf(
			'<div class="%1$s">%2$s</div>',
			esc_attr( $classes ),
			wp_get_attachment_image( $args['poster_id'], 'teeoff-banner', false, array( 'loading' => 'lazy' ) )
		);
		return;
	}

	printf(
		'<div class="%1$s media-placeholder media-placeholder--video"%2$s><span class="media-placeholder__icon">%3$s</span><span class="media-placeholder__label">%4$s</span></div>',
		esc_attr( $classes ),
		$args['ref'] ? ' data-prompt-ref="' . esc_attr( $args['ref'] ) . '"' : '',
		teeoff_placeholder_icon_svg( true ),
		esc_html( $args['label'] ? $args['label'] : __( 'Video a generer', 'teeoff' ) )
	);
}

/**
 * Resolves and renders an image for a given page + field key, trying in
 * order: the image chosen in the "Contenu de la page (TeeOff)" box, the
 * legacy Customizer setting (kept for sites configured before that box
 * existed), the page's own Featured Image (only when explicitly allowed —
 * used for hero banners), and finally the Leonardo prompt placeholder.
 */
function teeoff_page_media_image( $post_id, $key, $args = array() ) {
	$defaults = array(
		'ratio'                 => 'ratio-4-3',
		'size'                  => 'teeoff-card',
		'ref'                   => '',
		'label'                 => '',
		'legacy_mod'            => '',
		'use_featured_fallback' => false,
		'alt'                   => '',
		'class'                 => '',
	);
	$args = wp_parse_args( $args, $defaults );

	$attach_id = function_exists( 'teeoff_image' ) ? teeoff_image( $post_id, $key, $args['use_featured_fallback'] ) : 0;
	if ( $attach_id ) {
		teeoff_media_image( array(
			'image_id' => $attach_id,
			'ratio'    => $args['ratio'],
			'size'     => $args['size'],
			'alt'      => $args['alt'],
			'class'    => $args['class'],
		) );
		return;
	}

	if ( $args['legacy_mod'] ) {
		$url = get_theme_mod( $args['legacy_mod'] );
		if ( $url ) {
			printf(
				'<div class="teeoff-media %1$s %2$s"><img src="%3$s" alt="%4$s" loading="lazy"></div>',
				esc_attr( $args['ratio'] ),
				esc_attr( $args['class'] ),
				esc_url( $url ),
				esc_attr( $args['alt'] )
			);
			return;
		}
	}

	teeoff_media_image( array(
		'ref'   => $args['ref'],
		'label' => $args['label'],
		'ratio' => $args['ratio'],
		'class' => $args['class'],
	) );
}

/**
 * Small on-page reminder for logged-in editors: dotted placeholders map to
 * references/leonardo-ai-prompts.md by the number shown on the block.
 */
function teeoff_prompt_admin_notice() {
	if ( ! is_user_logged_in() || ! current_user_can( 'edit_posts' ) ) {
		return;
	}
	echo '<div class="teeoff-admin-hint">' . esc_html__( 'Les zones en pointilles indiquent un media a generer avec Leonardo AI. Le numero affiche renvoie a references/leonardo-ai-prompts.md', 'teeoff' ) . '</div>';
}
add_action( 'wp_body_open', 'teeoff_prompt_admin_notice' );
