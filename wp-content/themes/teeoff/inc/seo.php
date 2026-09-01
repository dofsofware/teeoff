<?php
defined( 'ABSPATH' ) || exit;

/**
 * Lightweight, plugin-free SEO basics (cahier des charges §21): a per-page
 * meta description field plus Open Graph / Twitter card tags. WordPress
 * core already provides the XML sitemap (wp-sitemap.xml since 5.5) and
 * clean permalinks are enabled during provisioning.
 */

function teeoff_seo_meta_box() {
	foreach ( array( 'page', 'post', 'solution', 'partenaire', 'emploi' ) as $type ) {
		add_meta_box( 'teeoff_seo', __( 'SEO', 'teeoff' ), 'teeoff_seo_meta_box_html', $type, 'normal', 'low' );
	}
}
add_action( 'add_meta_boxes', 'teeoff_seo_meta_box' );

function teeoff_seo_meta_box_html( $post ) {
	wp_nonce_field( 'teeoff_seo_meta', 'teeoff_seo_meta_nonce' );
	$desc = get_post_meta( $post->ID, '_teeoff_meta_description', true );
	?>
	<p>
		<label for="teeoff_meta_description"><strong><?php esc_html_e( 'Meta description', 'teeoff' ); ?></strong></label><br>
		<textarea id="teeoff_meta_description" name="teeoff_meta_description" rows="3" class="widefat" maxlength="160"><?php echo esc_textarea( $desc ); ?></textarea>
		<span class="description"><?php esc_html_e( '160 caracteres max. Utilisee par les moteurs de recherche et lors du partage sur les reseaux sociaux.', 'teeoff' ); ?></span>
	</p>
	<?php
}

function teeoff_save_seo_meta( $post_id ) {
	if ( ! isset( $_POST['teeoff_seo_meta_nonce'] ) || ! wp_verify_nonce( $_POST['teeoff_seo_meta_nonce'], 'teeoff_seo_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( isset( $_POST['teeoff_meta_description'] ) ) {
		$desc = sanitize_textarea_field( wp_unslash( $_POST['teeoff_meta_description'] ) );
		update_post_meta( $post_id, '_teeoff_meta_description', mb_substr( $desc, 0, 160 ) );
	}
}
add_action( 'save_post', 'teeoff_save_seo_meta' );

function teeoff_output_meta_tags() {
	$desc = get_bloginfo( 'description' );

	if ( is_singular() ) {
		global $post;
		$custom = get_post_meta( $post->ID, '_teeoff_meta_description', true );
		$desc   = $custom ? $custom : wp_trim_words( wp_strip_all_tags( $post->post_content ), 30, '...' );
	}

	if ( $desc ) {
		echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
	}

	$og_image = get_theme_mod( 'teeoff_og_image' );
	if ( is_singular() && has_post_thumbnail() ) {
		$og_image = get_the_post_thumbnail_url( null, 'teeoff-banner' );
	}

	echo '<meta property="og:title" content="' . esc_attr( wp_get_document_title() ) . '">' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $desc ) . '">' . "\n";
	echo '<meta property="og:type" content="' . ( is_singular( 'post' ) ? 'article' : 'website' ) . '">' . "\n";
	echo '<meta property="og:url" content="' . esc_url( is_singular() ? get_permalink() : home_url( '/' ) ) . '">' . "\n";
	echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . "\n";
	if ( $og_image ) {
		echo '<meta property="og:image" content="' . esc_url( $og_image ) . '">' . "\n";
	}
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
}
add_action( 'wp_head', 'teeoff_output_meta_tags', 1 );
