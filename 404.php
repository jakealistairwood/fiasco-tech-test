<?php
/*
 * The template for displaying 404 pages (Not Found)
 */
get_header();

$page = get_field('error_page','option');

?>


<?php if ( !empty($page->post_content) ) { ?>

	<section class="contained">

		<?php echo $page->post_content; ?>

	</section>

<?php } else { ?>

	<section class="contained four-o-four">
		<h1 class="h4">404</h1>
		<h2>Page not found.</h2>
		<p>Whoops. We can't seem to find that page. Click below to go back to the homepage.</p>
		<p><a class="cta" href="<?php echo bloginfo( 'url' ); ?>" aria-label="Homepage">Go to homepage</a></p>
	</section>

<?php } ?>


<?php get_template_part( 'footer' ); ?>