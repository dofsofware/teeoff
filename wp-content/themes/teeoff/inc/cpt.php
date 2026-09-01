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
