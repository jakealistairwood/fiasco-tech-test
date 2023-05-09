<?php if ($quick_resources = get_field('quick_resources')) : ?>
    <div class="block">
        <section class="contained quick-links animate-in">
            <header>
                <h4 class="section-title">Quick resources</h4>
            </header>

            <ul class="quick-links__list">
                <?php foreach($quick_resources as $quick_resource) : ?>
                    <li>
                        <a href="<?php echo $quick_resource->guid; ?>" title="<?php echo $quick_resource->post_title; ?>">
                            <span class="quick-link__title"><?php echo $quick_resource->post_title; ?></span>
                            <span class="quick-link__illustration">
                                <svg viewBox="0 0 17 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.4405 6.13651C12.9223 5.14194 13.3729 4.396 13.7925 3.89872H0.20256V2.91968H13.7925C13.3729 2.42239 12.9223 1.67646 12.4405 0.681885H13.2564C14.2354 1.81632 15.2611 2.6555 16.3333 3.19941V3.61899C15.2611 4.14736 14.2354 4.98653 13.2564 6.13651H12.4405Z" fill="white"/>
                                </svg>
                            </span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </div>
<?php else:
    $args = array(  
        'post_type' => 'resources',
        'post_status' => 'publish',
        'posts_per_page' => 5,
        'offset' => 0,
        'orderby' => 'publish_date',
        'order' => 'ASC'
    );

    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ) : ?>
        <section class="contained quick-links animate-in">
            <header>
                <h4 class="section-title">Quick resources</h4>
            </header>

            <ul class="quick-links__list">
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <li>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <span class="quick-link__title"><?php the_title(); ?></span>
                            <span class="quick-link__illustration">
                                <svg viewBox="0 0 17 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.4405 6.13651C12.9223 5.14194 13.3729 4.396 13.7925 3.89872H0.20256V2.91968H13.7925C13.3729 2.42239 12.9223 1.67646 12.4405 0.681885H13.2564C14.2354 1.81632 15.2611 2.6555 16.3333 3.19941V3.61899C15.2611 4.14736 14.2354 4.98653 13.2564 6.13651H12.4405Z" fill="white"/>
                                </svg>
                            </span>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </section>
    <?php endif; wp_reset_postdata(); ?>
<?php endif; ?>
