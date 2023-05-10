<?php
/*
 * MAIN TEMPLATE
 */

get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
    <?php get_template_part('parts/meet-the-team') ?>

    <?php endwhile;
else : ?>
    <?php get_template_part('inc/content-coming-soon'); ?>
<?php endif; ?>

<?php get_template_part('footer'); ?>