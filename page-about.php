<?php
/*
 * MAIN TEMPLATE
 */

get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="contained">
            <?php get_template_part('parts/meet-the-team') ?>
        </div>

    <?php endwhile;
else : ?>
    <?php get_template_part('inc/content-coming-soon'); ?>
<?php endif; ?>

<?php get_template_part('footer'); ?>