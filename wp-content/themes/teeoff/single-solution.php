<?php defined( 'ABSPATH' ) || exit; get_header(); ?>

<?php while ( have_posts() ) : the_post();
	$subtitle      = get_post_meta( get_the_ID(), '_teeoff_subtitle', true );
	$benefits      = get_post_meta( get_the_ID(), '_teeoff_benefits', true );
	$ref           = get_post_meta( get_the_ID(), '_teeoff_card_ref', true );
	$benefits_list = $benefits ? array_filter( array_map( 'trim', explode( "\n", $benefits ) ) ) : array();
	?>
	<section class="page-hero page-hero--compact">
		<div class="container">
			<span class="eyebrow"><?php esc_html_e( 'Nos solutions', 'teeoff' ); ?></span>
			<h1><?php the_title(); ?></h1>
			<?php if ( $subtitle ) : ?><p class="page-hero__lead"><?php echo esc_html( $subtitle ); ?></p><?php endif; ?>
		</div>
	</section>

	<section class="section solution-detail">
		<div class="container solution-detail__grid">
			<div class="solution-detail__media">
				<?php if ( has_post_thumbnail() ) :
					the_post_thumbnail( 'teeoff-banner', array( 'loading' => 'eager' ) );
				else :
					teeoff_media_image( array(
						'ref'   => $ref,
						'label' => sprintf( __( 'Image %1$s (prompt %2$s)', 'teeoff' ), get_the_title(), $ref ? $ref : '?' ),
						'ratio' => 'ratio-4-3',
					) );
				endif; ?>
			</div>
			<div class="solution-detail__text">
				<?php the_content(); ?>
				<?php if ( $benefits_list ) : ?>
					<ul class="check-list">
						<?php foreach ( $benefits_list as $b ) : ?><li><?php echo esc_html( $b ); ?></li><?php endforeach; ?>
					</ul>
				<?php endif; ?>
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--primary"><?php esc_html_e( 'Nous contacter', 'teeoff' ); ?></a>
			</div>
		</div>
	</section>
<?php endwhile; ?>

<section class="section solutions solutions--compact">
	<div class="container">
		<div class="section-heading">
			<span class="eyebrow"><?php esc_html_e( 'Continuer la decouverte', 'teeoff' ); ?></span>
			<h2><?php esc_html_e( 'Nos autres solutions', 'teeoff' ); ?></h2>
		</div>
		<?php get_template_part( 'template-parts/content', 'solutions-grid' ); ?>
	</div>
</section>

<?php get_footer(); ?>
