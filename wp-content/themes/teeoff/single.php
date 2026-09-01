<?php defined( 'ABSPATH' ) || exit; get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	<article <?php post_class( 'article' ); ?>>
		<section class="page-hero page-hero--compact">
			<div class="container">
				<span class="eyebrow"><?php $cats = get_the_category(); echo esc_html( $cats ? $cats[0]->name : __( 'Actualites', 'teeoff' ) ); ?></span>
				<h1><?php the_title(); ?></h1>
				<div class="article-meta">
					<span><?php echo esc_html( get_the_date() ); ?></span>
					<span><?php esc_html_e( 'par', 'teeoff' ); ?> <?php the_author(); ?></span>
				</div>
			</div>
		</section>

		<div class="container article-media">
			<?php if ( has_post_thumbnail() ) :
				the_post_thumbnail( 'teeoff-banner', array( 'loading' => 'eager' ) );
			else :
				teeoff_media_image( array( 'ref' => '9.2', 'label' => __( 'Image principale (prompt 9.2–9.6)', 'teeoff' ), 'ratio' => 'ratio-16-9' ) );
			endif; ?>
		</div>

		<div class="container article-content">
			<?php the_content(); ?>
		</div>

		<div class="container article-share">
			<span><?php esc_html_e( 'Partager :', 'teeoff' ); ?></span>
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode( get_permalink() ); ?>" target="_blank" rel="noopener noreferrer">Facebook</a>
			<a href="https://twitter.com/intent/tweet?url=<?php echo rawurlencode( get_permalink() ); ?>&text=<?php echo rawurlencode( get_the_title() ); ?>" target="_blank" rel="noopener noreferrer">X</a>
			<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo rawurlencode( get_permalink() ); ?>" target="_blank" rel="noopener noreferrer">LinkedIn</a>
		</div>
	</article>
<?php endwhile; ?>

<?php get_template_part( 'template-parts/content', 'cta' ); ?>
<?php get_footer(); ?>
