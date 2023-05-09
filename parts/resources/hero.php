<?php
	$resources_page_id = get_page_by_path('resources')->ID;

	$title = get_field('title', $resources_page_id);
	$text = get_field('text', $resources_page_id);

	// CTA 1
	$cta1 = get_field('cta', $resources_page_id);
	$cta1_prefix = $cta1['prefix'] ?: 'Something to add?';
	$cta1_title = $cta1['cta_link'] && $cta1['cta_link']['title']
		? $cta1['cta_link']['title']
		: 'GET IN TOUCH';
	$cta1_url = $cta1['cta_link'] && $cta1['cta_link']['url']
		? $cta1['cta_link']['url']
		: site_url('/contact');
	$cta1_target = $cta1['cta_link'] && $cta1['cta_link']['target']
		? $cta1['cta_link']['target']
		: '_self';

	// CTA 2
	$cta2 = get_field('cta2', $resources_page_id);
	if (!empty($cta2) && !empty($cta2['cta_link'])) {
		$cta2_prefix = $cta2['prefix'] ?: 'Do you have a space available to hire?';
		$cta2_title = $cta2['cta_link']['title'];
		$cta2_url = $cta2['cta_link']['url'];
		$cta2_target = $cta2['cta_link']['target'] ?: '_self';
	}
?>

<section class="hero with-image hero--resources">
	<div class="hero__overflow-mask">
		<div class="contained">
			<div class="columns">
				<div class="column column-text">
					<?php if (!empty($title)) : ?>
						<h1 class="underline underline--alt"><?php echo $title; ?></h1>
					<?php else: ?>
						<h1 class="underline underline--alt">Resource<br>Library</h1>
					<?php endif; ?>

					<?php if (!empty($text)) : ?>
						<p class="subtitle subtitle-1"><?php echo $text; ?></p>
					<?php else: ?>
						<p class="subtitle subtitle-1">A collection of free resources for <br>artists and freelance creatives.</p>
					<?php endif; ?>

					<div class="call-to-action">
						<p>
							<?php echo $cta1_prefix; ?> <a href="<?php echo $cta1_url; ?>" class="link darkgreen" title="<?php echo $cta1_title; ?>" target="<?php echo $cta1_target; ?>"><?php echo $cta1_title; ?></a>
						</p>

						<?php if(isset($cta2)) : ?>
							<p>
								<?php echo $cta2_prefix; ?> <a href="<?php echo $cta2_url; ?>" class="link darkgreen" title="<?php echo $cta2_title; ?>" target="<?php echo $cta2_target; ?>"><?php echo $cta2_title; ?></a>
							</p>
						<?php endif; ?>
					</div>
				</div>

				<div class="column column-media">
					<div class="annotation-wrapper">
						<picture>
							<source srcset="<?php echo get_template_directory_uri() . '/img/annotations/circle-3-lg.png'; ?>"
									media="(min-width: 1024px)">
							<img src="<?php echo get_template_directory_uri() . '/img/annotations/circle-3.png'; ?>" class="annotation" alt="annotation">
						</picture>
					</div>
					<div class="featured-image-wrapper">
						<picture>
							<source srcset="<?php echo get_template_directory_uri() . '/img/static/resources-hero-lg.png'; ?>"
									media="(min-width: 768px)">
							<img class="featured_image" src="<?php echo get_template_directory_uri() . '/img/static/resources-hero.png'; ?>" alt="A spinning dancer with a crown on their head and elaborate costume. They are a female presenting person of colour with long dark hair and a smile." data-caption="Photo: Bristol Live" data-title="Production: St. Paul’s Carnival">
						</picture>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
