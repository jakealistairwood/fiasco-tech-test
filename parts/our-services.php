<?php

$args = array(
    'post_type' => 'services',
    'posts_per_page' => -1,
    'order' => 'ASC'
);

$the_query = new WP_Query($args); ?>

<section class="hero">
    <div class="contained">
        <div class="columns">
            <div class="column column-left">
                <h1 class="h3"><?php the_title(); ?></h1>

                <?php the_content(); ?>
            </div>

            <?php if ( $the_query->have_posts() ) : ?>
                <div class="column column-right">
                    <ul>
                        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                            <li>
                                <p class="h4 caps"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php if ( have_posts() ) : ?>
    <section class="contained">
        <?php while ( have_posts() ) : the_post(); ?>
            <!--  -->
        <?php endwhile; ?>
    </section>
<?php else: ?>
    <section class="contained wysiwyg">
        <h3>Content coming soon...</h3>
        <p>Sorry this page is not available yet, please try again later.</p>
    </section>
<?php endif; ?>
