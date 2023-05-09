<?php
	

/**
 * media Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'media-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'text-and-media';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$text = get_field('text') ?: '<h3>Your content here...</h3>';
$image = get_field('image') ?: '';
$video = get_field( 'video' ) ?: '';
$options = get_field('options') ?: '';

if( !empty($options) ) { 
    $className .= ' '.implode(" ", $options);
}

?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="contained">

        <div class="text-and-media__text">
            <?php echo $text; ?>
        </div>

        
        <?php if( !empty($image) || !empty($video) ){ ?>

            <div class="text-and-media__media">
                
                <?php if ( $image ) : ?>
                    <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
                <?php elseif( $video ) : ?>
                    <?php echo $video; ?>
                <?php endif; ?>

            </div>

        <?php } ?>

    </div>
</section>