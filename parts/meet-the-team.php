<?php

$args = array(
    'post_type' => 'team-members',
    'post_status' => 'publish',
    'posts_per_page' => 3,
);

$team_members = new WP_Query($args);

$index = 0;

?>
<?php if ($team_members->have_posts()) : ?>
    <section class="meet-the-team">
        <div class="contained">
            <div class="meet-the-team__wrapper">
                <ul class="meet-the-team__member-list">
                    <h2 class="section-header">Meet the Team</h2>
                    <?php while ($team_members->have_posts()) : $team_members->the_post(); ?>
                        <?php $index++; ?>

                        <li class="meet-the-team__member <?php if ($index == 1) : ?> meet-the-team__member--active<?php endif ?>" data-memberID="member-<?php echo strtolower(get_the_ID()) ?>">
                            <button><?php echo get_the_title(); ?></button>
                            <div class="button-hover-element"></div>
                        </li>


                    <?php endwhile ?>

                    <li class="meet-the-team__member meet-the-team__member--all">
                        <button>+ Full Team</button>
                    </li>
                </ul>
                <div class="meet-the-team__member-profiles">
                    <?php while ($team_members->have_posts()) : $team_members->the_post(); ?>

                        <div class="member-profile hidden" data-member="member-<?php echo strtolower(get_the_ID()) ?>">
                            <?php if (get_the_post_thumbnail()) : ?>
                                <div class="member-profile__thumbnail <?php if (get_field('reverse_image') == 1) : ?> member-profile__thumbnail--reversed <?php endif ?>">
                                    <?php echo get_the_post_thumbnail(); ?>
                                    <div class="polygon-element"></div>
                                    <div class="sketch-element"></div>
                                </div>
                            <?php endif ?>
                            <div class="member-profile__overview">
                                <header class="member-profile__header">
                                    <h4><?php echo get_the_title(); ?></h4>
                                    <span class="member-profile__role"><?php echo get_field('position'); ?></span>
                                </header>
                                <p class="member-profile__bio"><?php echo the_content(); ?></p>
                                <?php if (have_rows('contact_details')) : ?>
                                    <ul class="social-links">
                                        <?php while (have_rows('contact_details')) : the_row(); ?>
                                            <li>
                                                <a class="cta darkgreen" href="mailto:<?php echo get_sub_field('email'); ?>">Email</a>
                                            </li>
                                            <?php if (get_sub_field('linkedin')) : ?>
                                                <li>
                                                    <a class="cta darkgreen" href="<?php echo get_sub_field('linkedin') ?>" target="_blank">Linkedin</a>
                                                </li>
                                            <?php endif ?>
                                            <?php if (get_sub_field('twitter')) : ?>
                                                <li>
                                                    <a class="cta darkgreen" href="<?php echo get_sub_field('twitter') ?>" target="_blank">Twitter</a>
                                                </li>
                                            <?php endif ?>
                                        <?php endwhile ?>
                                        <img class="decorative-arrow" src=<?php echo get_template_directory_uri() . '/img/annotations/arrow-right.png'; ?> alt="arrow-right" />
                                    </ul>
                                <?php endif ?>
                            </div>
                        </div>
                    <?php endwhile ?>
                </div>
    </section>
<?php endif ?>