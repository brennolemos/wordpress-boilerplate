<?php
// Template Geral
get_header();
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="container">
			<h1><?php single_post_title(); ?></h1>
		</div>

		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</article>

<?php endwhile; else : ?>

	<article>
		<div class="entry-content">
			<p>Conteúdo não encontrado</p>
		</div>
	</article>

<?php endif; ?>

<?php get_footer(); ?>
