<?php
/*
 * MAIN TEMPLATE
 */

get_header();

get_template_part('parts/our-services');


$args = array(  
	'post_type' => 'services',
	'post_status' => 'publish',
	'posts_per_page' => -1,
	'order' => 'ASC'
);

$services = new WP_Query( $args );

$bgcolor = array(
	'#FFA5BF',
	'#FFB12A',
	'#AEE2D0'
);

echo '<div id="page-background"></div>';

if ( $services->have_posts() ) : while ( $services->have_posts() ) : $services->the_post(); ?>
	<section id="<?php echo $post->post_name; ?>" class="module-service" data-bgcolor="<?php echo $bgcolor[0]; ?>">
		<div class="module-service__bg" style="<?php if($bgcolor){ echo 'background-color:'.$bgcolor[0]; } ?>">

			<a class="module-service__image" href="<?php the_permalink() ?>" data-speed="1.5">
				<div class="module-service__formatter">
					<?php 
						$image = get_post_thumbnail_id();
						if( $image ){ ?>
							<?php echo wp_get_attachment_image($image, 'large', '', ['class'=>'parallax-image featured_image'] ); ?>
						<?php
						}
					?>
				</div>
			</a>

			<div class="module-service__content">

				<h3 class="title h4"><?php the_title(); ?></h3>

				<div class="wysiwyg">
					<?php 
						$excerpt = get_field('excerpt');
						if( $excerpt ){
							echo $excerpt;
						} else {
							the_excerpt();
						}
					?>
				</div>

				<p><a class="button" href="<?php the_permalink(); ?>">More Info</a></p>

			</div>

		</div>
	</section>
<?php array_push($bgcolor, array_shift($bgcolor)); endwhile; else:
echo '<section class="archive-wrapper center"><h4>Sorry, there are no projects to show</h4></div>';
endif;


echo '<div class="back-to-top"><div class="contained"><a href="#" class="button">Back to top</a></div></div>';


get_template_part( 'footer' );

?>
