<?php defined( 'ABSPATH' ) || exit; get_header(); ?>

<?php while ( have_posts() ) : the_post();
	$contrat = get_post_meta( get_the_ID(), '_teeoff_contrat', true );
	$lieu    = get_post_meta( get_the_ID(), '_teeoff_lieu', true );
	$limite  = get_post_meta( get_the_ID(), '_teeoff_limite', true );
	$profil  = get_post_meta( get_the_ID(), '_teeoff_profil', true );
	?>
	<section class="page-hero page-hero--compact">
		<div class="container">
			<span class="eyebrow"><?php esc_html_e( 'Carrieres', 'teeoff' ); ?></span>
			<h1><?php the_title(); ?></h1>
			<div class="job-meta">
				<?php if ( $contrat ) : ?><span><?php echo esc_html( $contrat ); ?></span><?php endif; ?>
				<?php if ( $lieu ) : ?><span><?php echo esc_html( $lieu ); ?></span><?php endif; ?>
				<?php if ( $limite ) : ?><span><?php echo esc_html__( 'Date limite :', 'teeoff' ) . ' ' . esc_html( date_i18n( 'd/m/Y', strtotime( $limite ) ) ); ?></span><?php endif; ?>
			</div>
		</div>
	</section>

	<section class="section job-detail">
		<div class="container job-detail__grid">
			<div class="job-detail__content">
				<?php the_content(); ?>
				<?php if ( $profil ) : ?>
					<h3><?php esc_html_e( 'Profil recherche', 'teeoff' ); ?></h3>
					<p><?php echo nl2br( esc_html( $profil ) ); ?></p>
				<?php endif; ?>
			</div>
			<div class="job-detail__apply">
				<h2><?php esc_html_e( 'Postuler', 'teeoff' ); ?></h2>
				<?php get_template_part( 'template-parts/form', 'job' ); ?>
			</div>
		</div>
	</section>
<?php endwhile; ?>

<?php get_footer(); ?>
