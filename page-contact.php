<?php
/*
 * MAIN TEMPLATE
 */

get_header();

?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<img src="<?php echo get_template_directory_uri() . '/img/annotations/arrowcontact-page--right.png'; ?>" class="annotation annotation-1" alt="annotation">

	<div class="contained contact-form-wrapper">
		<div class="columns">
			<div class="column column-left">
				<h1><span>Get in <br>Touch</span></h1>

				<button type="button" class="cta darkgreen new-enquiry-button">New enquiry</button>
			</div>

			<div class="column column-right ">
				<?php if (get_field('success_message')) : ?>
					<div class="success-msg">
						<p><?php the_field('success_message'); ?></p>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="contact-form">
			<?php echo do_shortcode( '[wpforms id="742" title="false"]' ); ?>
			<?php echo do_shortcode( '[wpforms id="551" title="false"]' ); ?>
		</div>
	</div>


	<section class="contained follow-us">
		<div class="columns">
			<div class="column column-left">
				<h2>Follow us.</h2>
			</div>

			<div class="column column-right">
				<ul class="social-links">
					<?php if(get_field('twitter_profile', 'option')){ ?><li><a class="cta darkgreen" href="<?php the_field('twitter_profile', 'option'); ?>" target="_blank">Twitter</a></li><?php } ?>
					<?php if(get_field('instagram_profile' ,'option')){ ?><li><a class="cta darkgreen" href="<?php the_field('instagram_profile', 'option'); ?>" target="_blank">Instagram</a></li><?php } ?>
					<?php if(get_field('facebook_profile', 'option')){ ?><li><a class="cta darkgreen" href="<?php the_field('facebook_profile', 'option'); ?>" target="_blank">Facebook</a></li><?php } ?>
				</ul>
			</div>
		</div>
	</section>

<?php endwhile; else: ?>
	<?php get_template_part('inc/content-coming-soon'); ?>
<?php endif; ?>

<?php get_template_part( 'footer' ); ?>
