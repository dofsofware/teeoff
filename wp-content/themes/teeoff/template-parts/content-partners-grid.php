<?php
defined( 'ABSPATH' ) || exit;

$number   = isset( $args['number'] ) ? $args['number'] : 8;
$partners = get_posts( array(
	'post_type'   => 'partenaire',
	'numberposts' => $number,
	'post_status' => 'publish',
) );
?>
<div class="partners-grid">
	<?php foreach ( $partners as $post ) : setup_postdata( $post );
		$website = get_post_meta( $post->ID, '_teeoff_website', true );
		$types   = get_the_terms( $post->ID, 'type_partenariat' );
		?>
		<div class="partner-card">
			<div class="partner-card__logo">
				<?php if ( has_post_thumbnail() ) :
					the_post_thumbnail( 'medium', array( 'loading' => 'lazy' ) );
				else :
					teeoff_media_image( array( 'label' => get_the_title(), 'ratio' => 'ratio-1-1' ) );
				endif; ?>
			</div>
			<h3><?php the_title(); ?></h3>
			<?php if ( get_the_excerpt() ) : ?><p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 14 ) ); ?></p><?php endif; ?>
			<?php if ( $types && ! is_wp_error( $types ) ) : ?>
				<span class="partner-card__type"><?php echo esc_html( $types[0]->name ); ?></span>
			<?php endif; ?>
			<?php if ( $website ) : ?>
				<a href="<?php echo esc_url( $website ); ?>" target="_blank" rel="noopener noreferrer" class="link-arrow"><?php esc_html_e( 'Visiter le site', 'teeoff' ); ?></a>
			<?php endif; ?>
		</div>
	<?php endforeach; wp_reset_postdata(); ?>
</div>
