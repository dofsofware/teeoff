<?php
defined( 'ABSPATH' ) || exit;

$solutions = get_posts( array(
	'post_type'      => 'solution',
	'numberposts'    => -1,
	'post_status'    => 'publish',
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
) );
?>
<div class="solutions-grid">
	<?php foreach ( $solutions as $post ) : setup_postdata( $post );
		$subtitle = get_post_meta( $post->ID, '_teeoff_subtitle', true );
		$ref      = get_post_meta( $post->ID, '_teeoff_card_ref', true );
		$slug     = $post->post_name;
		?>
		<article class="solution-card">
			<div class="solution-card__media">
				<?php if ( has_post_thumbnail() ) :
					the_post_thumbnail( 'teeoff-card', array( 'loading' => 'lazy' ) );
				else :
					teeoff_media_image( array(
						'ref'   => $ref,
						'label' => sprintf( __( 'Image %1$s (prompt %2$s)', 'teeoff' ), get_the_title(), $ref ? $ref : '?' ),
						'ratio' => 'ratio-4-3',
					) );
				endif; ?>
				<span class="solution-card__icon"><?php echo teeoff_solution_icon_svg( $slug ); ?></span>
			</div>
			<div class="solution-card__body">
				<h3><?php the_title(); ?></h3>
				<p><?php echo esc_html( $subtitle ? $subtitle : wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
				<a href="<?php the_permalink(); ?>" class="link-arrow"><?php esc_html_e( 'Découvrir', 'teeoff' ); ?></a>
			</div>
		</article>
	<?php endforeach; wp_reset_postdata(); ?>
</div>
