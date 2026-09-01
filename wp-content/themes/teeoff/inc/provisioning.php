<?php
defined( 'ABSPATH' ) || exit;

/**
 * Runs once when the theme is activated: creates the pages listed in the
 * cahier des charges (§4 Arborescence), sets the front page / posts page,
 * enables pretty permalinks, seeds the "Actualites" categories and the
 * four Solution posts, and builds the primary/footer menus (§33). This
 * lets the whole site come up correctly without any manual admin steps
 * even though no WP-CLI/DB access was available while developing.
 */
function teeoff_provision_site() {

	$pages = array(
		'accueil'                      => array( 'title' => 'Accueil', 'template' => '' ),
		'a-propos'                     => array( 'title' => 'A propos', 'template' => 'page-a-propos.php' ),
		'nos-solutions'                => array( 'title' => 'Nos solutions', 'template' => 'page-nos-solutions.php' ),
		'technologie'                  => array( 'title' => 'Technologie', 'template' => 'page-technologie.php' ),
		'partenaires'                  => array( 'title' => 'Partenaires', 'template' => 'page-partenaires.php' ),
		'actualites'                   => array( 'title' => 'Actualites', 'template' => '' ),
		'carrieres'                    => array( 'title' => 'Carrieres', 'template' => 'page-carrieres.php' ),
		'contact'                      => array( 'title' => 'Contact', 'template' => 'page-contact.php' ),
		'mentions-legales'             => array( 'title' => 'Mentions legales', 'template' => '' ),
		'politique-de-confidentialite' => array( 'title' => 'Politique de confidentialite', 'template' => '' ),
	);

	$ids = array();
	foreach ( $pages as $slug => $data ) {
		$existing = get_page_by_path( $slug );
		if ( $existing ) {
			$ids[ $slug ] = $existing->ID;
			continue;
		}
		$id = wp_insert_post( array(
			'post_title'   => $data['title'],
			'post_name'    => $slug,
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
		) );
		if ( $id && ! is_wp_error( $id ) && $data['template'] ) {
			update_post_meta( $id, '_wp_page_template', $data['template'] );
		}
		$ids[ $slug ] = $id;
	}

	if ( ! empty( $ids['accueil'] ) && ! empty( $ids['actualites'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $ids['accueil'] );
		update_option( 'page_for_posts', $ids['actualites'] );
	}

	update_option( 'permalink_structure', '/%postname%/' );

	$categories = array( 'Nouveaux services', 'Nouveaux partenariats', 'Evenements', 'Communiques', 'Innovations technologiques', "Actualites de l'entreprise", 'Temoignages', 'Projets realises' );
	foreach ( $categories as $cat ) {
		if ( ! term_exists( $cat, 'category' ) ) {
			wp_insert_term( $cat, 'category' );
		}
	}

	if ( ! get_posts( array( 'post_type' => 'solution', 'numberposts' => 1, 'post_status' => 'any' ) ) ) {
		$solutions = array(
			array(
				'title'    => 'Sante',
				'subtitle' => 'Accedez a des services de sante et a la teleconsultation par la voix.',
				'content'  => "<p>TeeOff Technologies permet d'acceder a des services de sante et a la teleconsultation grace aux technologies vocales, sans necessiter de smartphone ni de connexion Internet.</p>",
				'ref'      => '4.1',
			),
			array(
				'title'    => 'Education',
				'subtitle' => "Accedez a des contenus pedagogiques et d'apprentissage par la voix.",
				'content'  => "<p>Des contenus educatifs et pedagogiques sont accessibles simplement par un appel telephonique, dans plusieurs langues locales.</p>",
				'ref'      => '4.2',
			),
			array(
				'title'    => 'Guides pratiques',
				'subtitle' => "Informations utiles sur l'agriculture, les droits et les demarches administratives.",
				'content'  => "<p>Retrouvez des guides pratiques sur l'agriculture, les demarches administratives, la prevention et vos droits, accessibles par telephone.</p>",
				'ref'      => '4.3',
			),
			array(
				'title'    => 'Religion & Culture',
				'subtitle' => 'Accedez a des contenus religieux et culturels dans les langues locales.',
				'content'  => "<p>TeeOff donne acces a des contenus religieux et culturels dans les langues locales, pour rester connecte a ses traditions.</p>",
				'ref'      => '4.4',
			),
		);
		foreach ( $solutions as $s ) {
			$id = wp_insert_post( array(
				'post_title'   => $s['title'],
				'post_type'    => 'solution',
				'post_status'  => 'publish',
				'post_content' => $s['content'],
			) );
			if ( $id && ! is_wp_error( $id ) ) {
				update_post_meta( $id, '_teeoff_subtitle', $s['subtitle'] );
				update_post_meta( $id, '_teeoff_card_ref', $s['ref'] );
			}
		}
	}

	teeoff_provision_menu( 'primary', 'Menu principal', array(
		array( 'title' => 'Accueil', 'page' => 'accueil' ),
		array( 'title' => 'A propos', 'page' => 'a-propos' ),
		array( 'title' => 'Nos solutions', 'page' => 'nos-solutions' ),
		array( 'title' => 'Technologie', 'page' => 'technologie' ),
		array( 'title' => 'Partenaires', 'page' => 'partenaires' ),
	), $ids );

	teeoff_provision_menu( 'footer', 'Menu pied de page', array(
		array( 'title' => 'Carrieres', 'page' => 'carrieres' ),
		array( 'title' => 'Mentions legales', 'page' => 'mentions-legales' ),
		array( 'title' => 'Politique de confidentialite', 'page' => 'politique-de-confidentialite' ),
	), $ids );

	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'teeoff_provision_site' );

function teeoff_provision_menu( $location, $menu_name, $items, $ids ) {
	$menu = wp_get_nav_menu_object( $menu_name );
	if ( ! $menu ) {
		$menu_id = wp_create_nav_menu( $menu_name );
	} else {
		$menu_id = $menu->term_id;
	}

	$existing_items = wp_get_nav_menu_items( $menu_id );
	if ( empty( $existing_items ) ) {
		foreach ( $items as $item ) {
			if ( empty( $ids[ $item['page'] ] ) ) {
				continue;
			}
			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title'     => $item['title'],
				'menu-item-object-id' => $ids[ $item['page'] ],
				'menu-item-object'    => 'page',
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
			) );
		}
	}

	$locations              = get_theme_mod( 'nav_menu_locations' );
	$locations              = is_array( $locations ) ? $locations : array();
	$locations[ $location ] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );
}
