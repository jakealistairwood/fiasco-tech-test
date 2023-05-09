<?php
/*
 * MAIN TEMPLATE
 */

get_header();

$currentPage = get_queried_object();
$resource_types = get_terms('resource-types', array('hide_empty' => 0));

usort($resource_types, function($a, $b) {
	if ($a->name === 'Archive' || $a->name === 'Other') {
		return 1;
	}
	
	return ($a < $b) ? -1 : 1;
});

get_template_part('parts/resources/hero');

?>

<?php if( $resource_types ) : ?>
	<div id="archive-header" class="full resources">
		<div class="filters filters--tax">
			<div class="filters__dropdown">
				<span class="filters__label">Filter</span>
				<button type="button" class="filters__trigger"><?php echo $currentPage->name ?></button>
				<div class="filters__options">
					<a class="filters__button <?php if( empty($currentPage->slug) ) { echo ' filters__button--active'; } ?>" href="<?php echo site_url('/resources'); ?>" data-projectfilter="all">All</a>

					<?php foreach($resource_types as $resource_type) : ?>
						<?php
							if( empty($currentPage->slug) ) {
								$currentPage->slug = 'all';
							}
							if( $resource_type->slug == $currentPage->slug ) {
								$active = ' filters__button--active';
							} else {
								$active = '';
							}
							echo '<a class="filters__button'.$active.'" href="'.get_category_link( $resource_type->term_id ).'" data-projectfilter="'.$resource_type->slug.'">'.$resource_type->name.'</a>';
						?>
					<?php endforeach; ?>
				</div>
			</div>
			<div style="display:none" class="filters__clear"><a class="button-outline" href="<?php echo get_post_type_archive_link('resources') ?>">Clear results</a></div>
			<?php get_template_part('inc/search-form') ?>
		</div>
	</div>
<?php endif; ?>

<?php if ( have_posts() ) : ?>
	<section class="tiles-wrapper full">
		<div id="tiles" class="tiles">
			<?php $count = 0; while ( have_posts() ) : the_post(); ?>
				<?php get_template_part('inc/tiles', null, array('index' => $count, 'will-transition' => true)); ?>
			<?php $count === 3 ? $count = 0 : $count++; endwhile; ?>
			<div class="tile tile--spacer"></div>
		</div>

	</section>
<?php else: ?>
	<?php get_template_part('inc/content-coming-soon'); ?>
<?php endif; ?>

<?php get_template_part( 'footer' ); ?>
