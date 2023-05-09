<?php $p_type = get_post_type(); ?>

<article class="list">
	<a href="<?php the_permalink() ?>" class="list__image list__image-<?php echo $p_type; ?>">
		<?php if ($p_type === 'programme') : ?>
			<?php if( has_post_thumbnail('') ) :
				$image_id = get_post_thumbnail_id( $post );
				$alt = get_post_meta ( $image_id, '_wp_attachment_image_alt', true );
			?>
				<div class="list__format">
					<img class="post_thumbnail" src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'event_thumbnail' ); ?>" alt="<?php echo $alt ?>">
				</div>
			<?php else : ?>
				<div class="inner-box">
	                <h6><span><?php echo str_replace(' ', '', get_field('type', $post->ID)); ?></span></h6>
	            </div>
			<?php endif; ?>
		<?php elseif ($p_type === 'jobs') : ?>
			<img s c="<?php echo get_template_directory_uri() . '/img/site-logo.svg' ; ?>" alt="Theatre Bristol logo">
		<?php else: ?>
			<div class="list__format">
				<?php if( has_post_thumbnail() ){
					$image_id = get_post_thumbnail_id( $post );
					$alt = get_post_meta ( $image_id, '_wp_attachment_image_alt', true );
					$image = get_the_post_thumbnail_url( get_the_ID(), 'fullscreen' );
				?>
					<img class="lazy post_thumbnail" data-src="<?php echo $image; ?>" src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ); ?>" alt="<?php echo $alt ?>">
				<?php } else {
					echo '<div class="list__placeholder"></div>';
				} ?>
			</div>
		<?php endif; ?>
	</a>

	<div class="list__content">
		<div class="list__content-details">
			<h4 class="caps"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
			<a class="excerpt" href="<?php the_permalink() ?>">
				<?php echo excerpt(15, ' <span class="read-more">... Read more</span>'); ?>
			</a>
		</div>

		<div class="list__content-meta">
			<?php if ($p_type === 'programme') :
				$cost = get_field('cost', $post->ID);
				$is_free = get_field('is_free', $post->ID);
			?>
				<?php if($is_free) : ?>
					<span class="event-price"><?php echo 'FREE'; ?></span>
				<?php elseif($cost) : ?>
					<span class="event-price"><?php echo '£' . $cost . 'PH'; ?></span>
				<?php endif; ?>

				<?php if($date = get_field('start_date', $post->ID)) : $event_date = DateTime::createFromFormat('d/m/Y g:i a', $date); ?>
					<span class="event-date"><?php echo $event_date->format('d.m.y'); ?></span>
				<?php endif; ?>
			<?php elseif ($p_type === 'jobs') : ?>
				<?php
					$closing_date = DateTime::createFromFormat('d/m/Y g:i a', get_field('closing_date', $post->ID));
					$location_city = get_field('location_city', $post->ID);
				?>
				<span class="job-location"><?php echo $location_city; ?></span>
				<span class="job-closing-date"><?php echo $closing_date->format('d.m.y'); ?></span>
			<?php elseif ($p_type === 'spaces') : ?>
				<?php
					$cost_per_hour = get_field('cost', $post->ID) ? '£' . get_field('cost', $post->ID) . ' PH' : '';
					$location_city = get_field('postcode', $post->ID);
				?>
				<span class="space-cost"><?php echo $cost_per_hour; ?></span>
				<span class="space-postcode"><?php echo $location_city; ?></span>
			<?php else: ?>
				<!--  -->
			<?php endif; ?>
		</div>
	</div>
</article>
