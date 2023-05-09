<?php

if( $support = get_field( 'support_us', 'option' ) ) : ?>
	<?php $make_a_donation_link = get_field( 'make_a_donation_link', 'option' ) ?: '#'; ?>

	<section class="support-us">

		<button type="button" class="support-us__btn open-btn cta">Support us</button>

		<div class="support-us__wrapper">
			<button type="button" class="close-btn">
				<svg xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 25.5 25.5" xml:space="preserve"><path transform="rotate(-45.001 12.739 12.74)" fill="#033" d="M11.7 3.8h2v17.9h-2z"/><path transform="rotate(-45.001 12.739 12.74)" fill="#033" d="M3.8 11.7h17.9v2H3.8z"/><path d="M12.7 1h0c6.5 0 11.7 5.3 11.7 11.7h0c0 6.5-5.3 11.7-11.7 11.7h0C6.3 24.5 1 19.2 1 12.7h0C1 6.3 6.3 1 12.7 1z" fill="none" stroke="#033" stroke-width="2"/></svg>
			</button>

			<div class="contained">
				<div class="columns">
					<div class="column">
						<h3>Support<br>Theatre<br>Bristol.</h3>
					</div>
					<div class="column">
						<div class="make-a-donation">
							<a class="cta darkgreen" href="<?php echo $make_a_donation_link; ?>">Make a donation</a>
						</div>
					</div>
				</div>

				<div class="wysiwyg">
					<?php echo $support; ?>
				</div>

				<?php if(!empty($examples = get_field( 'example_tiles', 'option' ))) : ?>

					<div class="how-it-helps">
						<h3 class="h4">How your support helps</h3>

						<div class="tiles">
				            <?php $count = 0; foreach($examples[0]['tile'] as $post) : setup_postdata($post); ?>
				                <?php
				                	get_template_part('inc/tiles', null, array('index' => $count, 'will-transition' => true));

				                	$count === 3 ? $count = 0 : $count++;
				                ?>
				            <?php endforeach; wp_reset_postdata(); ?>
				        </div>

					</div>
				<?php endif; ?>

				<div class="bottom-message">
					<?php if(!empty($make_a_donation_support_title = get_field( 'make_a_donation_support_title', 'option' ))) : ?>
						<p><?php echo $make_a_donation_support_title; ?></p>
					<?php endif; ?>

					<a class="cta darkgreen" href="<?php echo $make_a_donation_link; ?>">Make a donation</a>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
