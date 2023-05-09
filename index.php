<?php
/*
 * MAIN TEMPLATE
 */

get_header();

$page_title = 'Find a space in Bristol';

if (is_post_type_archive('programme')) {
    $page_title = 'Our programme';
} else if (is_post_type_archive('jobs')) {
    $page_title = 'Job opportunities';
}

?>

<section class="contained">
	<h1 class="h2"><?php echo $page_title; ?></h1>
</section>

<?php if ( have_posts() ) : ?>
	<section class="contained">
		<div class="lists">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part('inc/lists'); ?>
			<?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
		</div>

		<?php get_template_part('inc/pagination'); ?>
	</section>
<?php else: ?>
	<?php get_template_part('inc/content-coming-soon'); ?>
<?php endif; ?>

<?php get_template_part( 'footer' ); ?>
