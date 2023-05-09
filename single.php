<?php
/*
 * MAIN TEMPLATE
 */

get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<?php if ( have_rows( 'blocks' ) ): ?>
		<?php while ( have_rows( 'blocks' ) ) : the_row(); ?>
			<?php if ( get_row_layout() == 'text_and_media' ) : ?>

				<?php
					$options = get_sub_field( 'options' );
					$image = get_sub_field( 'image' );
					$video = get_sub_field( 'video' );
				?>

				<section class="block text-and-media animate-in<?php if($options){ echo ' '.implode(" ", $options); } if(!$image && !$video){ echo ' text-only'; } ?>">
					<div class="contained">
						<div class="text-and-media__text text-column">
							<?php the_sub_field( 'text' ); ?>
						</div>

						<?php if( $image || $video ) : ?>
							<div class="text-and-media__media">
								<?php if ( $image ) : ?>
									<?php echo wp_get_attachment_image($image['ID'], 'landscape', '', ['class'=>'featured_image'] ); ?>
								<?php elseif( $video ) : ?>
									<?php echo $video; ?>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				</section>

			<?php elseif ( get_row_layout() == 'text_only_2_columns' ) : ?>

				<?php
					$options = get_sub_field( 'options' );
					$image = get_sub_field( 'image' );
					$video = get_sub_field( 'video' );
				?>

				<section class="block text-only-2-columns animate-in<?php if($options){ echo ' '.implode(" ", $options); } ?>">
					<div class="contained">
						<div class="column column-left text-column">
							<?php the_sub_field( 'column_left' ); ?>
						</div>

						<div class="column column-right text-column">
							<?php the_sub_field( 'column_right' ); ?>
						</div>
					</div>
				</section>

			<?php elseif ( get_row_layout() == 'images' ) : ?>

				<?php
					$options = get_sub_field('options');
					$images = get_sub_field( 'gallery' );
				?>

				<?php if ( count($images) > 0 ) : ?>
					<figure class="block fullwidth-gallery animate-in<?php if($options){ echo ' '.implode(" ", $options); } ?>">
						<div class="contained">
							<ul>
								<?php foreach ( $images as $image ) : ?>
									<li>
										<?php echo wp_get_attachment_image($image['ID'], 'large', '', ['class'=>'featured_image'] ); ?>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</figure>
				<?php endif; ?>

			<?php elseif ( get_row_layout() == 'fullwidth-image' ) : ?>

				<figure class="block fullwidth-image animate-in">
					<?php $image = get_sub_field( 'image' ); ?>
					<?php if ( $image ) : ?>
						<?php echo wp_get_attachment_image($image['ID'], 'url', '', ['class'=>'featured_image'] ); ?>
					<?php endif; ?>
				</figure>

			<?php elseif ( get_row_layout() == 'spacer' ) : ?>

				<?php $options = get_sub_field('options'); ?>
				<div class="spacer<?php if($options){ echo ' '.implode(" ", $options); } ?>"></div>

			<?php endif; ?>
		<?php endwhile; ?>
	<?php else: ?>
		<?php get_template_part('inc/content-coming-soon'); ?>
	<?php endif; ?>

	<?php if (get_post_type() === 'programme') : ?>
		<div class="block">
			<?php get_template_part('parts/featured-events'); ?>
		</div>
	<?php else : ?>
		<?php if ($ymals = get_field('related')) : ?>
			<div class="block">
				<section class="contained quick-links animate-in">
			        <header>
			            <h4 class="section-title">You Might Also Like</h4>
			        </header>

			        <ul class="quick-links__list">
			            <?php foreach($ymals as $ymal) : ?>
			                <li>
			                    <a href="<?php echo $ymal->guid; ?>" title="<?php echo $ymal->post_title; ?>">
			                        <span class="quick-link__title"><?php echo $ymal->post_title; ?></span>
			                        <span class="quick-link__illustration">
			                            <svg viewBox="0 0 17 7" fill="none" xmlns="http://www.w3.org/2000/svg">
			                                <path d="M12.4405 6.13651C12.9223 5.14194 13.3729 4.396 13.7925 3.89872H0.20256V2.91968H13.7925C13.3729 2.42239 12.9223 1.67646 12.4405 0.681885H13.2564C14.2354 1.81632 15.2611 2.6555 16.3333 3.19941V3.61899C15.2611 4.14736 14.2354 4.98653 13.2564 6.13651H12.4405Z" fill="white"/>
			                            </svg>
			                        </span>
			                    </a>
			                </li>
			            <?php endforeach; ?>
			        </ul>
			    </section>
		    </div>
		<?php endif; ?>
	<?php endif; ?>

	<?php get_template_part('parts/keep-in-touch'); ?>

<?php endwhile; ?>
<?php else: ?>
	<?php get_template_part('inc/content-coming-soon'); ?>
<?php endif; ?>

<?php get_template_part( 'footer' ); ?>
