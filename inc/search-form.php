<?php
	$search = get_search_query();
	global $post_type;

	if( empty($search) ){
		$value = "";
	} else {
		$value = get_search_query();
	}
?>

<button class="searchform__button">Search</button>

<form id="searchform" class="searchform<?php if( is_search() ){ echo ' searchform--open'; } ?>" action="<?php echo home_url( '/' ); ?>" method="get">
	<div class="searchform__close"></div>
	<p class="searchform__title">Search resources</p>
	<input type="text" id="s" placeholder="Type here..." name="s" value="<?php echo $value ?>" />
	<input type="submit" class="button-outline searchform__submit" value="Search" />
	<?php if( $post_type == 'resources' || is_page('resources') ){ ?>
		<input type="hidden" name="post_type" value="resources" />
	<?php } ?>
	<span class="searchform__tooltip">Press enter to search</span>
</form>
