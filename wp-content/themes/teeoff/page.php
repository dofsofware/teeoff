<?php defined( 'ABSPATH' ) || exit; get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	<section class="page-hero page-hero--compact">
		<div class="container">
			<h1><?php the_title(); ?></h1>
		</div>
	</section>
	<section class="section">
		<div class="container legal-content">
			<?php the_content(); ?>
		</div>
	</section>
<?php endwhile; ?>

<?php get_footer(); ?>
