<?php
/*
 * HOME PAGE TEMPLATE
 */

get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php get_template_part('parts/home/hero'); ?>

	<?php get_template_part('parts/home/tb-intro'); ?>

	<?php get_template_part('parts/featured-events'); ?>

	<?php get_template_part('parts/quick-resources'); ?>

	<?php get_template_part('parts/instagram-feed'); ?>

	<?php get_template_part('parts/keep-in-touch'); ?>
<?php endwhile; else: ?>
	<?php get_template_part('inc/content-coming-soon'); ?>
<?php endif; ?>

<?php get_template_part( 'footer' ); ?>
