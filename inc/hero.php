<?php if( has_post_thumbnail() ){ ?>

	<section class="hero hero--fullscreen">

		<?php
			$image_id = get_post_thumbnail_id( $post );
			$alt = get_post_meta ( $image_id, '_wp_attachment_image_alt', true );
			$image = get_the_post_thumbnail_url( get_the_ID(), 'fullscreen' );
		?>

		<img class="blurry" data-src="<?php echo $image; ?>" src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ); ?>" alt="<?php echo $alt ?>">

	</section>

<?php } ?>