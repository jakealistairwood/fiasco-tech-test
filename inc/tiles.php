<?php
	// Transition delay settings
	$will_transition = array_key_exists('will-transition', $args) ? $args['will-transition'] : false;
	$loop_index = array_key_exists('index', $args) ? $args['index'] : null;
	$transition_delay = $will_transition ? $loop_index / 10 : 0;

	$category = get_the_terms($post, 'resource-types');
	$options = get_field('options');
	$badge = get_field('badge');
?>
<article class="tile animate-in<?php if( $options ){ echo ' '.$options; } if( $badge ){ echo ' tile--tb'; } ?>" style="transition-delay: <?php echo $transition_delay . 's'; ?>">
	<a href="<?php the_permalink(); ?>" class="tile__image">
		<div class="tile__format">
			<?php if( has_post_thumbnail() && empty($options) ) {
				$image_id = get_post_thumbnail_id( $post );
				$alt = get_post_meta ( $image_id, '_wp_attachment_image_alt', true );
				$image = get_the_post_thumbnail_url( get_the_ID(), 'fullscreen' );
			?>
				<img class="lazy" data-src="<?php echo $image; ?>" src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>" alt="<?php echo $alt ?>">
			<?php } else {
				echo '<div class="tile__placeholder"></div>';
			} ?>
		</div>
	</a>

	<div class="tile__content">
		<?php if( $category && $category[0] ) : ?>
			<p class="tile__meta"><?php echo '<span class="tile__date">' . get_the_date( 'd.m.Y' ) . '</span><span>|</span><span class="tile__cat">' . $category[0]->name . '</span>'; ?></p>
		<?php endif; ?>
		<h4 class="caps tile__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<?php if( get_the_excerpt() ) : ?>
			<a class="tile__excerpt" href="<?php the_permalink(); ?>"><?php echo excerpt(30); ?></a>
		<?php endif; ?>
			
		<a class="link darkgreen" href="<?php the_permalink(); ?>">Read More</a>
	</div>
</article>
