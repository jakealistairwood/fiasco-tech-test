<?php
/*
 * SEARCH RESULTS for Articles Index
 */

get_header();

$search = get_search_query();
$resource_types = get_terms('resource-types', array('hide_empty' => 0));
usort($resource_types, function($a, $b) {
	if ($a->name === 'Archive' || $a->name === 'Other') {
		return 1;
	}
	
	return ($a < $b) ? -1 : 1;
});


get_template_part('parts/resources/hero');

?>


	<?php if ( have_posts() ) : ?>

		<div id="archive-header" class="full resources">
		</div>

		<section class="tiles-wrapper full">

			<div id="tiles" class="tiles">

				<div class="search-results__details">
					<p class="search-results__subtitle">
						Showing results for
					</p>
					<h2 class="search-results__title"><?php echo '&#8220;' . $search . '&#8221;'; ?></h2>
					<p class="search-results__count">
						<?php echo $wp_query->found_posts . ' results'; ?>
					</p>
					<p class="search-results__clear"><a href="<?php echo get_post_type_archive_link('resources'); ?>">Clear results</a></p>
				</div>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part('inc/tiles'); ?>

				<?php endwhile; ?>

				<div class="tile tile--spacer"></div>

				<?php get_template_part('inc/pagination'); ?>

			</div>

		</section>

	<?php else: ?>

		<div id="archive-header" class="full resources">
			<div class="filters filters--search">
				<?php get_template_part('inc/search-form') ?>
			</div>
		</div>

		<section id="tiles" class="tiles full">

			<div class="tiles__no-results">
				<h4 class="caps">We couldn't find anything for "<?php echo $search; ?>"</h4>
				<p>Please try searching for something else.</p>
				<p><br/><a class="button-outline clear-button" href="<?php echo get_post_type_archive_link('resources'); ?>">Back to Resources</a></p>
			</div>

		</section>

	<?php endif; ?>



<?php get_template_part( 'footer' ); ?>
