<?php

$args = array(
    'post_type' => 'team-members',
);

$team_members = new WP_Query($args);

// var_dump($team_members);

?>
<?php if ($team_members->have_posts()) : ?>
    <section class="meet-the-team">
        <h2 class="meet-the-team__section-title">Meet the Team</h2>
        <div class="meet-the-team__wrapper">
            <ul class="meet-the-team__members">
                <?php while ($team_members->have_posts()) : $team_members->the_post(); ?>
                    <li class="meet-the-team__member meet-the-team__member--active">
                        <button><?php echo get_the_title(); ?></button>
                    </li>
                <?php endwhile ?>
                <li class="meet-the-team__member meet-the-team__member--all">
                    <button>Full Team</button>
                </li>
            </ul>
            <div class="meet-the-team__member-profile">
                <div class="meet-the-team__profile-img">
                    <?php echo get_the_post_thumbnail(); ?>
                    <div class="decor-element"></div>
                </div>
                <div class="meet-the-team__profile-overview">
                    <header>
                        <h4><?php echo get_the_title(); ?></h4>
                        <span><?php echo get_field('position'); ?></span>
                    </header>
                    <p><?php echo the_content(); ?></p>

                </div>
            </div>
        </div>
    <?php endif ?>

    </section>