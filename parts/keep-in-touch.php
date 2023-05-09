<?php

$title = get_field( 'keep_in_touch_title', 'option' ) ?: 'Keep in touch' ;
$text = get_field( 'keep_in_touch_text', 'option' ) ?: '';

?>
<section class="keep-in-touch">
    <div class="contained">
        <img src="<?php echo get_template_directory_uri() . '/img/annotations/arrow-bottom-right.png'; ?>" class="annotation" alt="annotation">
        <div class="columns">
            <div class="column">
                <h4 class="section-title caps"><?php echo $title; ?></h4>

                <p><?php echo $text; ?></p>
            </div>

            <div class="column">
                <button type="button" class="cta pink">Sign up <span>to our newsletter</span></button>
            </div>
        </div>
    </div>
</section>
