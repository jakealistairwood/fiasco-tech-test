<?php
//
// FOOTER
//
?>

	</main>

	<?php if( is_post_type_archive( ['programme','spaces','jobs'] ) ){
		get_template_part('parts/keep-in-touch'); 
	} ?>

	<?php get_template_part('parts/support-us'); ?>

	<div id="cursor" class="cursor"></div>

	<footer id="colophon" role="contentinfo">

		<div class="footer__wrapper contained">
			
			<div class="footer__content footer__content--last">
				<?php wp_nav_menu( array( 'theme_location' => 'footer-col-one', 'menu_class' => 'footer__menu', 'container' => '' ) ); ?>
			</div>
			<div class="footer__content footer__content--line">
				<div class="footer__column column--address">
					<?php the_field('footer-details','option'); ?>
					<?php $number = get_field('number','option');
					if( $number ){ echo '<p>Tel: ' . $number . '</p>'; } ?>
					<?php $email = get_field('email','option');
					if( $email ){ echo '<p><a href="mailto:' . $email . '" target="_blank">' . $email . '</a></p>'; } ?>
				</div>
			</div>
			<div class="footer__column column--sponsors">
				<?php 
				$sponsors = get_field('sponsors','option');
				if($sponsors){
					echo '<ul class="sponsors">';
					foreach( $sponsors as $sponsor ){
						echo '<li><img src="' . $sponsor['url'] . '" alt="' . $sponsor['alt'] . '" /></li>';
					}
					echo '</ul>';
				} ?>
			</div>

		</div>
		
		<div class="footer__wrapper contained">

			<div class="footer__column">
				<?php wp_nav_menu( array( 'theme_location' => 'footer-legal', 'menu_class' => 'footer__menu inline-list', 'container' => '' ) ); ?>
				<span class="site-credit">&copy; <?php if( get_field('copyright', 'option') ){ the_field('copyright', 'option'); } else { echo bloginfo('name'); } ?> <?php echo date("Y") ?></span>
			</div>
			<div class="footer__column column--social">
				<ul class="icon-list">
					<?php if(get_field('instagram_profile' ,'option')){ ?><li><a class="icon-list__instagram" href="<?php the_field('instagram_profile', 'option'); ?>" target="_blank">Instagram</a></li><?php } ?>
					<?php if(get_field('facebook_profile', 'option')){ ?><li><a class="icon-list__facebook" href="<?php the_field('facebook_profile', 'option'); ?>" target="_blank">Facebook</a></li><?php } ?>
					<?php if(get_field('twitter_profile', 'option')){ ?><li><a class="icon-list__twitter" href="<?php the_field('twitter_profile', 'option'); ?>" target="_blank">Twitter</a></li><?php } ?>
				</ul>
			</div>

		</div>
	</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
