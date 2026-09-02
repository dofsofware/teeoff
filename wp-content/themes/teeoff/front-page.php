<?php defined( 'ABSPATH' ) || exit; get_header();

$teeoff_page_id = get_the_ID();
?>

<section class="hero">
	<div class="hero__media">
		<?php
		$hero_video = get_theme_mod( 'teeoff_hero_video' );
		if ( $hero_video ) {
			teeoff_media_video( array( 'video_url' => $hero_video, 'ratio' => 'ratio-fill' ) );
		} else {
			teeoff_page_media_image( $teeoff_page_id, 'hero_image', array(
				'ratio'                 => 'ratio-fill',
				'size'                  => 'teeoff-banner',
				'legacy_mod'            => 'teeoff_hero_image',
				'use_featured_fallback' => true,
				'alt'                   => __( 'TeeOff Technologies SN — services vocaux accessibles', 'teeoff' ),
				'ref'                   => '2.1',
				'label'                 => __( 'Hero — personne utilisant un téléphone (prompt 2.1)', 'teeoff' ),
			) );
		}
		?>
		<div class="hero__overlay"></div>
	</div>
	<div class="container hero__content">
		<h1 class="hero__title"><?php echo esc_html( teeoff_field( $teeoff_page_id, 'hero_title', "Rendre l'essentiel accessible à tous, partout." ) ); ?></h1>
		<p class="hero__subtitle"><?php echo esc_html( teeoff_field( $teeoff_page_id, 'hero_subtitle', "TeeOff Technologies SN utilise les technologies vocales pour rapprocher les populations urbaines et rurales des services essentiels — santé, éducation, guides pratiques, religion et culture — même sans smartphone ni connexion Internet." ) ); ?></p>
		<div class="hero__actions">
			<a href="<?php echo esc_url( home_url( '/nos-solutions/' ) ); ?>" class="btn btn--secondary"><?php esc_html_e( 'Découvrir nos solutions', 'teeoff' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--outline"><?php esc_html_e( 'Nous contacter', 'teeoff' ); ?></a>
		</div>
	</div>
</section>

<section class="section mission">
	<div class="container mission__grid">
		<div class="mission__media">
			<?php
			teeoff_page_media_image( $teeoff_page_id, 'mission_image', array(
				'ratio'      => 'ratio-1-1',
				'legacy_mod' => 'teeoff_mission_image',
				'ref'        => '3.1',
				'label'      => __( 'Illustration Mission (prompt 3.1)', 'teeoff' ),
			) );
			?>
		</div>
		<div class="mission__text">
			<span class="eyebrow"><?php esc_html_e( 'Notre mission', 'teeoff' ); ?></span>
			<h2><?php echo esc_html( teeoff_field( $teeoff_page_id, 'mission_title', 'Un appel. Un service. Un impact.' ) ); ?></h2>
			<p><?php echo esc_html( teeoff_field( $teeoff_page_id, 'mission_text', "TeeOff Technologies SN développe des services à valeur ajoutée accessibles par téléphone afin de rapprocher les populations des services essentiels du quotidien, en tenant compte des réalités locales, de la diversité linguistique et des contraintes liées à l'accès à Internet." ) ); ?></p>
			<a href="<?php echo esc_url( home_url( '/a-propos/' ) ); ?>" class="link-arrow"><?php esc_html_e( 'En savoir plus', 'teeoff' ); ?></a>
		</div>
	</div>
</section>

<section class="section solutions" id="solutions">
	<div class="container">
		<div class="section-heading">
			<span class="eyebrow"><?php esc_html_e( 'Nos solutions', 'teeoff' ); ?></span>
			<h2><?php esc_html_e( "Quatre domaines d'impact, un seul numéro à composer", 'teeoff' ); ?></h2>
		</div>
		<?php get_template_part( 'template-parts/content', 'solutions-grid' ); ?>
	</div>
</section>

<section class="section why-teeoff">
	<div class="container">
		<div class="section-heading">
			<span class="eyebrow"><?php esc_html_e( 'Pourquoi TeeOff ?', 'teeoff' ); ?></span>
			<h2><?php esc_html_e( 'Une technologie pensée pour tous', 'teeoff' ); ?></h2>
		</div>
		<?php get_template_part( 'template-parts/content', 'why-teeoff' ); ?>
	</div>
</section>

<section class="section how-it-works">
	<div class="container">
		<div class="section-heading">
			<span class="eyebrow"><?php esc_html_e( 'Comment ça fonctionne ?', 'teeoff' ); ?></span>
			<h2><?php esc_html_e( 'En quatre étapes simples', 'teeoff' ); ?></h2>
		</div>
		<?php get_template_part( 'template-parts/content', 'how-it-works' ); ?>
	</div>
</section>

<section class="section technology technology--dark">
	<div class="technology__media">
		<?php
		$tech_video = get_theme_mod( 'teeoff_technology_video' );
		if ( $tech_video ) {
			teeoff_media_video( array( 'video_url' => $tech_video, 'ratio' => 'ratio-fill' ) );
		} else {
			teeoff_page_media_image( $teeoff_page_id, 'technology_poster', array(
				'ratio'      => 'ratio-fill',
				'size'       => 'teeoff-banner',
				'legacy_mod' => 'teeoff_technology_poster',
				'ref'        => '7.1 / 15.3',
				'label'      => __( 'Vidéo/illustration Technologie (prompt 7.1 / 15.3)', 'teeoff' ),
			) );
		}
		?>
		<div class="technology__overlay"></div>
	</div>
	<div class="container technology__content">
		<span class="eyebrow eyebrow--light"><?php esc_html_e( 'Notre technologie', 'teeoff' ); ?></span>
		<h2><?php echo esc_html( teeoff_field( $teeoff_page_id, 'technology_title', 'Une infrastructure vocale, intelligente et multilingue' ) ); ?></h2>
		<ul class="technology__list">
			<?php
			$technology_items = teeoff_field_lines( $teeoff_page_id, 'technology_items', array(
				'Interfaces vocales intuitives',
				'Téléphonie classique et mobile',
				'Intelligence artificielle',
				'Traitement automatique de la voix',
				'Multilinguisme (langues locales)',
				'Services accessibles sans Internet',
			) );
			foreach ( $technology_items as $item ) :
				?>
				<li><?php echo esc_html( $item ); ?></li>
			<?php endforeach; ?>
		</ul>
		<a href="<?php echo esc_url( home_url( '/technologie/' ) ); ?>" class="btn btn--secondary"><?php esc_html_e( 'Découvrir la technologie', 'teeoff' ); ?></a>
	</div>
</section>

<?php
$partners = get_posts( array( 'post_type' => 'partenaire', 'numberposts' => 8, 'post_status' => 'publish' ) );
if ( $partners ) :
	?>
	<section class="section partners">
		<div class="container">
			<div class="section-heading">
				<span class="eyebrow"><?php esc_html_e( 'Nos partenaires', 'teeoff' ); ?></span>
				<h2><?php esc_html_e( 'Ils nous font confiance', 'teeoff' ); ?></h2>
			</div>
			<?php get_template_part( 'template-parts/content', 'partners-grid' ); ?>
			<div class="section-cta">
				<a href="<?php echo esc_url( home_url( '/partenaires/' ) ); ?>" class="link-arrow"><?php esc_html_e( 'Voir tous les partenaires', 'teeoff' ); ?></a>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php
$news = get_posts( array( 'numberposts' => 3, 'post_status' => 'publish' ) );
if ( $news ) :
	?>
	<section class="section news">
		<div class="container">
			<div class="section-heading">
				<span class="eyebrow"><?php esc_html_e( 'Actualités', 'teeoff' ); ?></span>
				<h2><?php esc_html_e( 'Les dernières nouvelles de TeeOff', 'teeoff' ); ?></h2>
			</div>
			<div class="news-grid">
				<?php foreach ( $news as $post ) : setup_postdata( $post ); ?>
					<article class="news-card">
						<a href="<?php the_permalink(); ?>" class="news-card__media">
							<?php if ( has_post_thumbnail() ) :
								the_post_thumbnail( 'teeoff-card', array( 'loading' => 'lazy' ) );
							else :
								teeoff_media_image( array( 'ref' => '9.2', 'label' => __( 'Image article (prompt 9.2–9.6)', 'teeoff' ), 'ratio' => 'ratio-4-3' ) );
							endif; ?>
						</a>
						<div class="news-card__body">
							<span class="news-card__date"><?php echo esc_html( get_the_date() ); ?></span>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 16 ) ); ?></p>
						</div>
					</article>
				<?php endforeach; wp_reset_postdata(); ?>
			</div>
			<div class="section-cta">
				<a href="<?php echo esc_url( home_url( '/actualites/' ) ); ?>" class="link-arrow"><?php esc_html_e( 'Toutes les actualités', 'teeoff' ); ?></a>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php get_template_part( 'template-parts/content', 'cta' ); ?>
<?php get_footer(); ?>
