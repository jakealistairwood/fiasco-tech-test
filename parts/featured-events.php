<?php

$event_date_format = 'd/m/Y g:i a';

$id = get_the_ID();

$args = array(  
	'post_type' => 'programme',
	'post_status' => 'publish',
	'posts_per_page' => 3,
	'post__not_in' => get_post_type() === 'programme' ? array($id) : array(),
	'meta_query' => array(
		'start_date'  => array(
			'key'     => 'start_date',
			'value'   => date($event_date_format),
			'compare' => '>=',
			'type'    => 'DATETIME'
		),
	),
	'orderby' => 'start_date',
	'order' => 'ASC'
);

$the_query = new WP_Query( $args );

?>

<?php if ( $the_query->have_posts() ) : ?>
	<section class="contained featured-events animate-in">
		<header>
			<h4 class="section-title">
				<button type="button" class="cta active">What’s On</button>
				<a href="<?php echo site_url('/programme'); ?>" class="cta">
					<?php echo is_single() ? "Back to Programme" : "All Programmes"; ?>
				</a>
			</h4>
		</header>

		<ul class="events-list">
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<li>
					<div class="event-type-box">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php if( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail('landscape'); ?>
							<?php else : ?>
								<div class="inner-box">
									<h6 class="caps"><span><?php echo str_replace(' ', '', get_field('type', $post->ID)); ?></span></h6>
								</div>
							<?php endif; ?>
						</a>
					</div>

					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<strong class="h5 event-title caps"><?php the_title(); ?></strong>
						<?php if($date = get_field('start_date', $post->ID)) : $event_date = DateTime::createFromFormat($event_date_format, $date); ?>
							<span class="subtitle-2 event-date"><?php echo $event_date->format('d.m.y'); ?></span>
						<?php endif; ?>
					</a>
				</li>
			<?php endwhile; ?>
		</ul>
	</section>
<?php endif; wp_reset_postdata(); ?>
