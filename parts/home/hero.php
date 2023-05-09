<?php

$hero = get_field('hero');
$hero_type = $hero['hero_type'];
$video = $hero['video'];
$image = $hero['image'];
$title = $hero['title'];
$text = $hero['text'];

?>

<section class="hero with-<?php echo $hero_type ?>">
    <?php if ($hero_type === 'video') : ?>
        <div class="video-wrapper">
            <video autoplay loop muted playsinline preload="none" id="home-hero-video">
                <?php if ($video) : ?>
                    <source src="<?php echo $video; ?>" type="video/mp4">
                <?php endif; ?>
            </video>
        </div>
    <?php endif; ?>

    <div class="contained">
        <div class="columns">
            <div class="column">
                <h1><?php echo $title; ?></h1>
                <p class="subtitle subtitle-1"><?php echo $text; ?></p>

                <img src="<?php echo get_template_directory_uri() . '/img/annotations/hero-underline.png'; ?>" class="annotation" alt="annotation">

                <?php get_template_part('parts/home/ctas'); ?>
            </div>

            <?php if($hero_type === 'image') : ?>
                <div class="column column-media">
                    <picture>
                        <source srcset="<?php echo get_template_directory_uri() . '/img/ghost.png'; ?>"
                                media="(max-width: 767px)">
                        <source srcset="<?php echo $image['sizes']["2048x2048"]; ?>"
                                media="(min-width: 1600px)">
                        <img src="<?php echo $image['sizes']["1536x1536"]; ?>" alt="<?php echo $image['alt']; ?>">
                    </picture>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_template_part('parts/home/ctas'); ?>
