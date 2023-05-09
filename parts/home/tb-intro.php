<?php

$intro = get_field('intro');

$featured_section = $intro['featured_section'];
$featured_title = $featured_section['title'];
$featured_text = $featured_section['text'];
$featured_cta = $featured_section['cta'];
$featured_image = $featured_section['image'];

$page_links = $intro['page_links'];

?>

<?php if (!empty($intro)) : ?>
	<section class="tb-intro">
		<?php if (!empty($featured_section)) : ?>
			<div class="home-featured-module animate-in">
				<div class="contained featured">
					<div class="columns">
						<div class="column column-text">
							<div class="text-content">
								<?php if (!empty($featured_title)) : ?>
									<h3><?php echo $featured_title; ?></h3>
								<?php else : ?>
									<h3>A PLatform <br> to Thrive</h3>
								<?php endif; ?>

								<?php if (!empty($featured_text)) : ?>
									<p class="subtitle"><?php echo $featured_text; ?></p>
								<?php else : ?>
									<p class="subtitle">Our vision is for live performance and <br> performance makers to be valued.</p>
								<?php endif; ?>

								<?php if (!empty($featured_cta)) : ?>
									<a href="<?php echo $featured_cta['url']; ?>" class="cta darkgreen" title="<?php echo $featured_cta['title']; ?>" <?php if (!empty($featured_cta['target'])) { ?> target="<?php echo $featured_cta['target']; ?>" <?php } ?>><?php echo $featured_cta['title']; ?></a>
								<?php endif; ?>
							</div>
						</div>
						<div class="column column-media">
							<div class="featured-image-wrapper">
								<div class="annotation-wrapper">
									<img src="<?php echo get_template_directory_uri() . '/img/annotations/star-1.png'; ?>" class="annotation" alt="annotation">
								</div>
								
								<?php if (!empty($featured_image)) : ?>
									<?php echo wp_get_attachment_image($featured_image['ID'], 'large', '', ['class'=>'featured_image'] ); ?>
								<?php else : ?>
									<img class="featured_image" src="<?php echo get_template_directory_uri() . '/img/static/tb-intro-hero.png'; ?>" alt="">
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if( !empty($page_links) ): ?>
			<div class="home-page-links animate-in">
				<div class="contained page-links">
					<?php foreach( $page_links as $index => $page_link) : ?>
						<?php
							$url = $page_link['page']['url'];
							$title = $page_link['page']['title'];
							$anchor = $page_link['anchor'];
							$target = $page_link['page']['target'] ?: '_self';
						?>
						 <div class="columns">
							 <div class="column column-text">
								<h4>
									<?php if( !empty($anchor) ) : ?>
										<a href="<?php echo $url ?>" target="<?php echo $target ?>" class="subtitle">
											<?php echo $title; ?>
										</a>

										<a class="caps" href="<?php echo $url ?>" target="<?php echo $target ?>" class="page-title">
											<?php echo $page_link['anchor']; ?>
										</a>
									<?php else : ?>
										<a href="<?php echo $url ?>" target="<?php echo $target ?>" class="page-title">
											<?php echo $title; ?>
										</a>
									<?php endif; ?>
								</h4>
							 </div>

							 <div class="column column-media">
								<a href="<?php echo $url ?>" target="<?php echo $target ?>">
									<?php echo wp_get_attachment_image($page_link['image']['ID'], 'landscape', '', ['class'=>'featured_image'] ); ?>
								</a>
							 </div>
						 </div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
	</section>
<?php endif; ?>
