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
$id = 'acfcolumns-' . $block['id'];
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
// $text = get_field('text') ?: '<h3>Your content here...</h3>';
$image = get_field('image') ?: '';
$video = get_field( 'video' ) ?: '';
$options = get_field('options') ?: '';

if( !empty($options) ) { 
    $className .= ' '.implode(" ", $options);
}

?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="contained">

        <?php
            $template = array(
                array( 'core/columns', array(), array(
                    array( 'core/column', array(), array(
                        array( 'core/image', array() ),
                        array( 'core/embed', array() ),
                    ) ),
                    array( 'core/column', array( 
                            'align' => 'full-width', 
                        ), array(
                            array( 'core/heading', array(
                                'placeholder' => 'Add a title...',
                            ) ),
                            array( 'core/paragraph', array(
                                'placeholder' => 'Add some inner content here'
                            ) ),
                    ) ),
                ) )
            );
            echo '<InnerBlocks template="' . esc_attr( wp_json_encode( $template ) ) . '" templateLock="insert" />'; ?>

    </div>
</section>