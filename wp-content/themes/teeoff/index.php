<?php defined( 'ABSPATH' ) || exit; get_header(); ?>

<section class="page-hero page-hero--compact">
	<div class="container">
		<span class="eyebrow"><?php esc_html_e( 'Actualités', 'teeoff' ); ?></span>
		<h1><?php echo ( is_home() && ! is_front_page() ) ? esc_html__( 'Actualités & réalisations', 'teeoff' ) : esc_html( get_the_archive_title() ); ?></h1>
		<p class="page-hero__lead"><?php esc_html_e( 'Nouveaux services, partenariats, événements et innovations : suivez l\'actualité de TeeOff Technologies SN.', 'teeoff' ); ?></p>
	</div>
</section>

<section class="section news-archive">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="news-grid">
				<?php while ( have_posts() ) : the_post(); ?>
					<article <?php post_class( 'news-card' ); ?>>
						<a href="<?php the_permalink(); ?>" class="news-card__media">
							<?php if ( has_post_thumbnail() ) :
								the_post_thumbnail( 'teeoff-card', array( 'loading' => 'lazy' ) );
							else :
								teeoff_media_image( array( 'ref' => '9.2', 'label' => __( 'Image article (prompt 9.2–9.6)', 'teeoff' ), 'ratio' => 'ratio-4-3' ) );
							endif; ?>
						</a>
						<div class="news-card__body">
							<span class="news-card__date"><?php echo esc_html( get_the_date() ); ?> &middot; <?php the_author(); ?></span>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
						</div>
					</article>
				<?php endwhile; ?>
			</div>
			<div class="pagination">
				<?php the_posts_pagination( array( 'prev_text' => __( '&larr; Précédent', 'teeoff' ), 'next_text' => __( 'Suivant &rarr;', 'teeoff' ) ) ); ?>
			</div>
		<?php else : ?>
			<div class="empty-state"><p><?php esc_html_e( 'Aucun article publié pour le moment.', 'teeoff' ); ?></p></div>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>
