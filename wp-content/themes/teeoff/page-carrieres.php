<?php defined( 'ABSPATH' ) || exit; get_header();

$teeoff_page_id = get_the_ID();
?>

<section class="page-hero page-hero--tech">
	<div class="page-hero__media">
		<?php
		$img = get_theme_mod( 'teeoff_careers_image' );
		if ( $img ) {
			printf( '<div class="teeoff-media ratio-fill"><img src="%1$s" alt="" loading="eager"></div>', esc_url( $img ) );
		} else {
			teeoff_media_image( array( 'ref' => '13', 'label' => __( 'Illustration Carrieres (prompt 13)', 'teeoff' ), 'ratio' => 'ratio-fill' ) );
		}
		?>
		<div class="page-hero__overlay"></div>
	</div>
	<div class="container page-hero__content">
		<span class="eyebrow eyebrow--light"><?php esc_html_e( 'Carrieres', 'teeoff' ); ?></span>
		<h1><?php echo esc_html( teeoff_field( $teeoff_page_id, 'hero_title', "Rejoignez l'aventure TeeOff" ) ); ?></h1>
		<p class="page-hero__lead"><?php echo esc_html( teeoff_field( $teeoff_page_id, 'hero_lead', 'Nous construisons une technologie qui rapproche des millions de personnes des services essentiels. Venez y contribuer.' ) ); ?></p>
	</div>
</section>

<section class="section jobs">
	<div class="container">
		<?php
		$jobs = get_posts( array( 'post_type' => 'emploi', 'numberposts' => -1, 'post_status' => 'publish' ) );
		if ( $jobs ) :
			?>
			<div class="jobs-list">
				<?php foreach ( $jobs as $post ) : setup_postdata( $post );
					$contrat = get_post_meta( $post->ID, '_teeoff_contrat', true );
					$lieu    = get_post_meta( $post->ID, '_teeoff_lieu', true );
					$limite  = get_post_meta( $post->ID, '_teeoff_limite', true );
					?>
					<a href="<?php the_permalink(); ?>" class="job-card">
						<div class="job-card__main">
							<h3><?php the_title(); ?></h3>
							<div class="job-card__meta">
								<?php if ( $contrat ) : ?><span><?php echo esc_html( $contrat ); ?></span><?php endif; ?>
								<?php if ( $lieu ) : ?><span><?php echo esc_html( $lieu ); ?></span><?php endif; ?>
								<?php if ( $limite ) : ?><span><?php echo esc_html__( 'Avant le', 'teeoff' ) . ' ' . esc_html( date_i18n( 'd/m/Y', strtotime( $limite ) ) ); ?></span><?php endif; ?>
							</div>
						</div>
						<span class="job-card__cta"><?php esc_html_e( "Voir l'offre", 'teeoff' ); ?> &rarr;</span>
					</a>
				<?php endforeach; wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<div class="empty-state">
				<p><?php esc_html_e( "Aucune offre n'est publiee pour le moment. Revenez bientot !", 'teeoff' ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>
