<?php
defined( 'ABSPATH' ) || exit;

function teeoff_register_cpts() {

	register_post_type( 'solution', array(
		'labels' => array(
			'name'          => __( 'Solutions', 'teeoff' ),
			'singular_name' => __( 'Solution', 'teeoff' ),
			'add_new_item'  => __( 'Ajouter une solution', 'teeoff' ),
			'edit_item'     => __( 'Modifier la solution', 'teeoff' ),
			'all_items'     => __( 'Nos solutions', 'teeoff' ),
		),
		'public'       => true,
		'has_archive'  => false,
		'rewrite'      => array( 'slug' => 'nos-solutions', 'with_front' => false ),
		'menu_icon'    => 'dashicons-microphone',
		'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
		'show_in_rest' => true,
	) );

	register_post_type( 'partenaire', array(
		'labels' => array(
			'name'          => __( 'Partenaires', 'teeoff' ),
			'singular_name' => __( 'Partenaire', 'teeoff' ),
			'add_new_item'  => __( 'Ajouter un partenaire', 'teeoff' ),
			'edit_item'     => __( 'Modifier le partenaire', 'teeoff' ),
		),
		'public'       => true,
		'has_archive'  => false,
		'rewrite'      => array( 'slug' => 'partenaires', 'with_front' => false ),
		'menu_icon'    => 'dashicons-groups',
		'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'show_in_rest' => true,
	) );

	register_post_type( 'emploi', array(
		'labels' => array(
			'name'          => __( "Offres d'emploi", 'teeoff' ),
			'singular_name' => __( "Offre d'emploi", 'teeoff' ),
			'add_new_item'  => __( 'Ajouter une offre', 'teeoff' ),
			'edit_item'     => __( "Modifier l'offre", 'teeoff' ),
		),
		'public'       => true,
		'has_archive'  => false,
		'rewrite'      => array( 'slug' => 'carrieres', 'with_front' => false ),
		'menu_icon'    => 'dashicons-businessman',
		'supports'     => array( 'title', 'editor' ),
		'show_in_rest' => true,
	) );

	register_taxonomy( 'type_partenariat', 'partenaire', array(
		'labels'       => array(
			'name'          => __( 'Types de partenariat', 'teeoff' ),
			'singular_name' => __( 'Type de partenariat', 'teeoff' ),
		),
		'public'       => true,
		'hierarchical' => true,
		'show_in_rest' => true,
		'rewrite'      => array( 'slug' => 'type-partenariat' ),
	) );
}
add_action( 'init', 'teeoff_register_cpts' );

/**
 * Shows a thumbnail column in the admin list tables for Solutions and
 * Partenaires so editors can see at a glance which entries still need an
 * image, without having to open every single one.
 */
function teeoff_add_thumbnail_column( $columns ) {
	$new = array();
	foreach ( $columns as $key => $label ) {
		if ( 'title' === $key ) {
			$new['teeoff_thumbnail'] = __( 'Image', 'teeoff' );
		}
		$new[ $key ] = $label;
	}
	return $new;
}
add_filter( 'manage_solution_posts_columns', 'teeoff_add_thumbnail_column' );
add_filter( 'manage_partenaire_posts_columns', 'teeoff_add_thumbnail_column' );

function teeoff_render_thumbnail_column( $column, $post_id ) {
	if ( 'teeoff_thumbnail' !== $column ) {
		return;
	}
	if ( has_post_thumbnail( $post_id ) ) {
		echo get_the_post_thumbnail( $post_id, array( 60, 60 ), array( 'style' => 'object-fit:cover;border-radius:4px;' ) );
	} else {
		echo '<span style="color:#a00;">' . esc_html__( 'Aucune image', 'teeoff' ) . '</span>';
	}
}
add_action( 'manage_solution_posts_custom_column', 'teeoff_render_thumbnail_column', 10, 2 );
add_action( 'manage_partenaire_posts_custom_column', 'teeoff_render_thumbnail_column', 10, 2 );
