<?php

/* ========================================================================================================================

TIDYING WORDPRESS

======================================================================================================================== */

// HIDE FRONT END ADMIN BAR
add_filter('show_admin_bar', '__return_false');


// STYLE USER REGISTRATION WINDOW
function custom_login_stylesheet()
{
	wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/style-login.css');
}
add_action('login_enqueue_scripts', 'custom_login_stylesheet');


// HIDE ALL DASHBOARD WIDGETS
function disable_dashboard_widgets()
{
	global $wp_meta_boxes;
	$wp_meta_boxes['dashboard']['normal']['core'] = array();
	$wp_meta_boxes['dashboard']['side']['core'] = array();
}
add_action('wp_dashboard_setup', 'disable_dashboard_widgets', 999);


// ADD CUSTOM WIDGET
function wporg_add_dashboard_widgets()
{
	wp_add_dashboard_widget(
		'wp_dashboard_setup',
		esc_html__('Welcome', 'wporg'),
		'custom_dashboard_help'
	);
	$admins = get_super_admins();
	function custom_dashboard_help()
	{
		echo '<img style="max-width:100%" src="' . get_bloginfo('stylesheet_directory') . '/img/icon-okaytowave.gif" alt="okay"/><h1 style="color:#342F87;"><strong>Welcome to your website</strong></h1><p>Welcome to your custom Wordpress website and bespoke theme built by <a href="https://fiasco.design" target="_blank">Fiasco Design</a>. If you discover bugs or difficulties uploading content you can raise them as a ticket on Codebase. If you need help, you can contact the developer <a href="mailto:tom@fiasco.design" target="_blank">here</a>.</p>';
	}
	global $wp_meta_boxes;
	$default_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
	$example_widget_backup = array('wp_dashboard_setup' => $default_dashboard['wp_dashboard_setup']);
	unset($default_dashboard['wp_dashboard_setup']);
	$sorted_dashboard = array_merge($example_widget_backup, $default_dashboard);
	$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}
add_action('wp_dashboard_setup', 'wporg_add_dashboard_widgets', 1000);


// HIDE BACKEND SIDEBAR MENU ITEMS
function remove_menus()
{
	$admins = array(
		'administrator',
		'fiasco',
		'freelancer'
	);
	$current_user = wp_get_current_user();
	if (!in_array($current_user->user_login, $admins)) {
		remove_menu_page(''); //hide dashboard updates
		remove_menu_page('edit-comments.php'); //hide comments
		// remove_menu_page( 'themes.php' ); //hide appearance and themes
		remove_menu_page('users.php'); //hide users
		remove_menu_page('plugins.php'); //hide plugins section
		remove_menu_page('tools.php'); //hide tools section
		remove_menu_page('options-general.php'); //hide settings
		remove_menu_page('wpcf7'); //hide contact forms
		remove_menu_page('edit.php?post_type=acf-field-group'); //hide acf
		remove_menu_page('cptui_main_menu'); //hide custom post types
	}
	remove_menu_page('edit.php'); // hide posts
}
add_action('admin_menu', 'remove_menus', 999);


// HIDE CUSTOMIZE OPTION
add_action('admin_head', 'hide_customize');
function hide_customize()
{
	echo '<style>.hide-if-no-customize{display:none;}</style>';
}


// Allow editors to see access the Menus page under Appearance but hide other options
function hide_menu()
{
	$user = wp_get_current_user();

	// Check if the current user is an Editor
	if (in_array('editor', (array) $user->roles)) {

		// They're an editor, so grant the edit_theme_options capability if they don't have it
		if (!current_user_can('edit_theme_options')) {
			$role_object = get_role('editor');
			$role_object->add_cap('edit_theme_options');
		}

		// Hide the Themes page
		remove_submenu_page('themes.php', 'themes.php');

		// Hide the Widgets page
		remove_submenu_page('themes.php', 'widgets.php');

		// Hide the Customize page
		remove_submenu_page('themes.php', 'customize.php');

		// Remove Customize from the Appearance submenu
		global $submenu;
		unset($submenu['themes.php'][6]);
	}
}

add_action('admin_menu', 'hide_menu', 10);




// HIDING UNUSED META BOXES
if (is_admin()) :
	function my_remove_meta_boxes()
	{
		if (!current_user_can('manage_options')) {
			remove_meta_box('postcustom', 'post', 'normal');
			remove_meta_box('commentstatusdiv', 'post', 'normal');
			remove_meta_box('commentsdiv', 'post', 'normal');
			remove_meta_box('sqpt-meta-tags', 'post', 'normal');
		}
	}
	add_action('admin_menu', 'my_remove_meta_boxes');
endif;


// TIDY ADMIN BAR
function remove_admin_bar_links()
{
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wp-logo');
	$wp_admin_bar->remove_menu('updates');
	$wp_admin_bar->remove_menu('comments');
	$wp_admin_bar->remove_menu('wpseo-menu');
	$wp_admin_bar->remove_menu('wpforms-menu');
}
add_action('wp_before_admin_bar_render', 'remove_admin_bar_links');


// CUSTOM ADMIN FOOTER
add_filter('admin_footer_text', 'my_admin_footer_text');
function my_admin_footer_text($default_text)
{
	return '<span id="footer-thankyou">Built by <a href="https://fiasco.design" target="_blank">Fiasco Design</a><span>';
}

// TIDY USER FIELDS
function tidy_user_fields($contact_methods)
{
	unset($contact_methods['aim']);
	unset($contact_methods['jabber']);
	unset($contact_methods['yim']);
	return $contact_methods;
}
add_filter('user_contactmethods', 'tidy_user_fields');


// REMOVE EMOJI CODE
remove_action('wp_head', 'print_emoji_detection_script', 10);
remove_action('wp_print_styles', 'print_emoji_styles', 10);
remove_action('admin_print_scripts', 'print_emoji_detection_script', 10);
remove_action('admin_print_styles', 'print_emoji_styles', 10);


// REMOVING ALL COMMENTS
add_action('admin_init', function () {
	global $pagenow;
	if ($pagenow === 'edit-comments.php') {
		wp_redirect(admin_url());
		exit;
	}
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
	foreach (get_post_types() as $post_type) {
		if (post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
});
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);
add_filter('comments_array', '__return_empty_array', 10, 2);
add_action('admin_menu', function () {
	remove_menu_page('edit-comments.php');
});



// REMOVING YOAST SEO EXTRAS
function yoast_seo_remove_columns($columns)
{
	unset($columns['wpseo-score']);
	unset($columns['wpseo-title']);
	unset($columns['wpseo-metadesc']);
	unset($columns['wpseo-focuskw']);
	unset($columns['wpseo-score-readability']);
	unset($columns['wpseo-links']);
	unset($columns['wpseo-linked']);
	return $columns;
}
add_filter('manage_edit-post_columns', 'yoast_seo_remove_columns');
add_filter('manage_edit-page_columns', 'yoast_seo_remove_columns');
add_filter('manage_edit-product_columns', 'yoast_seo_remove_columns');




// SHOW WORDPRESS SEO META BOX LOW DOWN
function check_wordpress_seo()
{
	if (is_plugin_active('wordpress-seo/wp-seo.php')) {
		add_filter('wpseo_metabox_prio', function () {
			return 'low';
		});
	}
}
add_action('admin_init', 'check_wordpress_seo');



/* ========================================================================================================================

EXTENDING WORDPRESS FUNCTIONALITY

======================================================================================================================== */


// CUSTOM WYSIWYG EDITOR STYLES
function fiasco_custom_editor_styles()
{
	add_editor_style('editor-style.css');
}
add_action('init', 'fiasco_custom_editor_styles');


// Excerpt
function excerpt($limit, $suffix = '...')
{
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt) >= $limit) {
		array_pop($excerpt);
		$excerpt = implode(" ", $excerpt) . nl2br($suffix);
	} else {
		$excerpt = implode(" ", $excerpt);
	}
	$excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
	return $excerpt;
}


// CUSTOM PAGE COLORS
function html_classes()
{
	global $post;
	$colour = '#fff';
	if (is_page('about')) {
		$colour = '#ffb12a';
	}
	if (is_page('contact')) {
		$colour = '#ffa5bf';
	}
	// if( is_page('our-services') ){
	// 	$colour = '#aee2d0';
	// }
	return $colour;
}


// CUSTOM BODY CLASSES
function body_classes($classes)
{
	global $post;
	if (is_front_page()) {
		foreach ($classes as $key => $value) {
			if ($value == 'page-template-default') unset($classes[$key]);
		}
		$classes[] = ' nav--light';
	}
	if (is_page()) {
		$classes[] = $post->slug;
	}
	return $classes;
}
add_filter('body_class', 'body_classes');


//Page Slug Body Class
function add_slug_body_class($classes)
{
	global $post;
	if (isset($post)) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}
add_filter('body_class', 'add_slug_body_class');


// ADD BROWSER TYPE AS BODY CLASS
function browser_body_class($classes)
{
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
	if ($is_lynx) $classes[] = 'lynx';
	elseif ($is_gecko) $classes[] = 'gecko';
	elseif ($is_opera) $classes[] = 'opera';
	elseif ($is_NS4) $classes[] = 'ns4';
	elseif ($is_safari) $classes[] = 'safari';
	elseif ($is_chrome) $classes[] = 'chrome';
	elseif ($is_IE) {
		$classes[] = 'ie';
		if (preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version))
			$classes[] = 'ie' . $browser_version[1];
	} else $classes[] = 'unknown';
	if ($is_iphone) $classes[] = 'iphone';
	if (stristr($_SERVER['HTTP_USER_AGENT'], 'mac')) {
		$classes[] = 'osx';
	} elseif (stristr($_SERVER['HTTP_USER_AGENT'], 'linux')) {
		$classes[] = 'linux';
	} elseif (stristr($_SERVER['HTTP_USER_AGENT'], 'windows')) {
		$classes[] = 'windows';
	}
	return $classes;
}
add_filter('body_class', 'browser_body_class');


// ADDING THUMBNAILS TO BACKEND POST COLUMNS
add_filter('manage_posts_columns', 'posts_columns', 5);
function posts_columns($defaults)
{
	$defaults['thumbnail'] = __('Thumbs');
	return $defaults;
}
add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);
function posts_custom_columns($column_name, $id)
{
	if ($column_name === 'thumbnail') {
		echo the_post_thumbnail('thumbnail');
	}
}





/* ========================================================================================================================

CUSTOM POST TYPES

======================================================================================================================== */
include("inc/custom-post-types.php");


/* ========================================================================================================================

Image handling

======================================================================================================================== */


// INCREASE UPLOAD SIZE
@ini_set('upload_max_size', '64M');
@ini_set('post_max_size', '64M');
@ini_set('max_execution_time', '3000');


// ADD THUMBNAIL SUPPORT
add_theme_support('post-thumbnails');
// set_post_thumbnail_size( 600, 600, true );

// IMAGES
if (function_exists('add_image_size')) {
	add_image_size('event_thumbnail', 205, 115, true);
	// add_image_size( 'fullscreen', 1920, 1000 );
	add_image_size('landscape', 884, 584, true);
	add_image_size('portrait', 400, 460, true);
}

// REMOVE DEFAULT IMAGE UPLOAD SIZE THRESHOLD (Wordpress default is 2560px)
add_filter('big_image_size_threshold', '__return_false');

// ADD NEW IMAGE CROP TO GUTENBERG CHOICES
// add_filter( 'image_size_names_choose','custom_gutenberg_image_options' );
// function custom_gutenberg_image_options( $sizes ) {
// 	return array_merge( $sizes, array(
// 	'custom-image-square' => __( 'Square' ),
// 	'blog-width' => __( 'Blog Content Full Width' ),
// 	) );
// }







/* ========================================================================================================================

CUSTOMIZE THE WYSIWYG EDITOR

======================================================================================================================== */

// TinyMCE: First line toolbar customizations
if (!function_exists('base_extended_editor_mce_buttons')) {
	function base_extended_editor_mce_buttons($buttons)
	{
		return array(
			'formatselect', 'styleselect', 'bold', 'underline', 'blockquote', 'bullist', 'link', 'unlink', 'removeformat'
		);
	}
	add_filter("mce_buttons", "base_extended_editor_mce_buttons", 0);
}

// TinyMCE: Second line toolbar customizations
if (!function_exists('base_extended_editor_mce_buttons_2')) {
	function base_extended_editor_mce_buttons_2($buttons)
	{
		return array();
	}
	add_filter("mce_buttons_2", "base_extended_editor_mce_buttons_2", 0);
}

// Customize the format dropdown items
add_filter('tiny_mce_before_init', 'customformatTinyMCE');
function customformatTinyMCE($init)
{
	$init['block_formats'] = 'Heading 2=h2;Heading 3=h3;Heading 4=h4;Paragraph=p;';
	return $init;
}

// REMOVE PARA TAGS ON IMAGES
function filter_ptags_on_images($content)
{
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');


// Creating Custom Styles
function my_mce_buttons_2($buttons)
{
	array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons_2', 'my_mce_buttons_2');
function my_mce_before_init_insert_formats($init_array)
{
	$style_formats = array(
		array(
			'title' => 'Button',
			'selector' => 'a',
			'classes' => 'button'
		),
		array(
			'title' => 'Call to Action',
			'selector' => 'a',
			'classes' => 'cta'
		),
		array(
			'title' => 'Caps',
			'selector' => 'p',
			'classes' => 'caps'
		),
	);
	$init_array['style_formats'] = json_encode($style_formats);
	return $init_array;
}
add_filter('tiny_mce_before_init', 'my_mce_before_init_insert_formats');





/* ========================================================================================================================

OUR OWN CUSTOM FUNCTIONS

======================================================================================================================== */


//
// REMOVING WIDOWS AS A FUNCTION
//
add_filter('the_title', 'widont');
function widont($str = '')
{
	$str = trim($str);
	$space = strrpos($str, ' ');
	if (false !== $space) {
		$str = substr($str, 0, $space) . '&nbsp;' . substr($str, $space + 1);
	}
	return $str;
}





/* ========================================================================================================================

Theme specific settings

======================================================================================================================== */


// THEME SUPPORT OPTIONS
function my_theme_support()
{
	// ADDING EXCERPTS TO PAGES
	add_post_type_support('page', 'excerpt');
	// DYNAMIC TITLE TAGS
	add_theme_support('title-tag');
}
add_action('after_setup_theme', 'my_theme_support');



/* ========================================================================================================================

	Navigation

	======================================================================================================================== */
register_nav_menus(array(
	'primary' => 'Main Left of Logo',
	'secondary' => 'Main Right of Logo',
	'mobile' => 'Mobile Navigation',
	'footer-col-one' => 'Footer Column 1',
	'footer-legal' => 'Footer Legal Links',
));


/* ========================================================================================================================

	Scripts

	======================================================================================================================== */


// USE GOOGLE JQUERY LIBRARY
if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue()
{
	wp_deregister_script('jquery');
	wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js", false, null);
	wp_enqueue_script('jquery');
}

// LOAD JQUERY SCRIPTS
function script_enqueuer()
{
	wp_register_script('additional-scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), filemtime(get_template_directory() . '/js/scripts.js'));
	wp_enqueue_script('additional-scripts');

	wp_register_script('site', get_stylesheet_directory_uri() . '/js/site.js', array('jquery'), filemtime(get_template_directory() . '/js/site.js'));
	wp_enqueue_script('site');

	wp_register_style('styles', get_template_directory_uri() . '/style.css', array(), filemtime(get_template_directory() . '/style.css'), null);
	wp_enqueue_style('styles');
}
add_action('wp_enqueue_scripts', 'script_enqueuer');




/* ========================================================================================================================

	Alter post queries

	======================================================================================================================== */

function my_post_queries($query)
{
	if (!is_admin() && $query->is_main_query()) {

		// ALL ARCHIVES
		if (is_post_type_archive()) {

			if ($query->query_vars['post_type'] == 'jobs') {
				$query->set('orderby', 'meta_value');
				$query->set('meta_key', 'closing_date');
				$query->set('order', 'ASC');
				$query->set('meta_query', array(
					array(
						'key'     => 'closing_date',
						'value'   => date('Ymd'),
						'compare' => '>=',
						'type'    => 'DATETIME'
					)
				));
			} else if ($query->query_vars['post_type'] == 'programme') {
				$query->set('orderby', 'meta_value');
				$query->set('meta_key', 'start_date');
				$query->set('order', 'ASC');
				$query->set('meta_query', array(
					array(
						'key'     => 'start_date',
						'value'   => date('d/m/Y g:i a'),
						'compare' => '>=',
						'type'    => 'DATETIME'
					)
				));
			}

			//$query->set('posts_per_page', 2);
			$query->set('posts_per_page', -1);
		}
	}
}
add_action('pre_get_posts', 'my_post_queries');




/* ========================================================================================================================

Gutenberg Support

======================================================================================================================== */

function gutenberg_setup()
{
	// allow full width alignments of gutenberg blocks
	add_theme_support('align-wide');

	// allow our custom editor styles
	add_theme_support('editor-styles');

	// add base styles from wordpress for Gutenberg
	add_theme_support('wp-block-styles');

	// allow dark version of editor
	add_theme_support('dark-editor-style');

	// allow reponsive embeds
	add_theme_support('responsive-embeds');

	// disable font size picker
	// add_theme_support( 'editor-font-sizes' );
	add_theme_support('disable-custom-font-sizes');

	// alter the colour palette within the theme
	add_theme_support('editor-color-palette', array(
		// array(
		// 	'name'  => __( 'Light gray', 'brand-hub' ),
		// 	'slug'  => 'light-gray',
		// 	'color'	=> '#f5f5f5',
		// ),
		// array(
		// 	'name'  => __( 'Medium gray', 'brand-hub' ),
		// 	'slug'  => 'medium-gray',
		// 	'color' => '#999',
		// ),
		// array(
		// 	'name'  => __( 'Dark gray', 'brand-hub' ),
		// 	'slug'  => 'dark-gray',
		// 	'color' => '#333',
		// ),
		// array(
		// 	'name'  => __( 'Blue', 'brand-hub' ),
		// 	'slug'  => 'blue',
		// 	'color' => '#0163E6',
		// ),
		array(
			'name'  => __('Dark Green', 'brand-hub'),
			'slug'  => 'dark-green',
			'color' => '#033',
		),
		array(
			'name'  => __('Pink', 'brand-hub'),
			'slug'  => 'pink',
			'color' => '#FFA5BF',
		),
		// array(
		// 	'name'  => __( 'Red', 'brand-hub' ),
		// 	'slug'  => 'red',
		// 	'color' => '#CE2741',
		// ),
	));
}
add_action('after_setup_theme', 'gutenberg_setup');


//
// REMOVING BLOCK STYLES
//
// unregister_block_style( 'core/button', 'fill' );



//
// Register Custom Block Styles
//
if (function_exists('register_block_style')) {
	function register_my_block_styles()
	{

		// Register stylesheet
		// wp_register_style(
		//     'block-styles-stylesheet',
		//     plugins_url( 'style.css', __FILE__ ),
		//     array(),
		//     '1.1'
		// );

		// Register block style
		// register_block_style(
		// 	'core/paragraph',
		// 	array(
		// 		'name'         => 'blue-paragraph',
		// 		'label'        => 'Blue Paragraph',
		// 		'style_handle' => 'block-styles-stylesheet',
		// 		'isDefault' => true
		// 	)
		// );
	}

	add_action('init', 'register_my_block_styles');
}


/* ========================================================================================================================

ACF Options

======================================================================================================================== */

// Add options page
if (function_exists('acf_add_options_page')) {
	acf_add_options_page();
}


//
// AUTO REGISTER BLOCKS USING FOLDERS
//
function my_acf_block_render_callback($block)
{

	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace('acf/', '', $block['name']);

	// include a template part from within the "template-parts/block" folder
	if (file_exists(get_theme_file_path("/blocks/{$slug}/{$slug}.php"))) {
		include(get_theme_file_path("/blocks/{$slug}/{$slug}.php"));
	}

	// wp_enqueue_style(
	// 	'my-block-css',
	// 	plugins_url( "/blocks/{$slug}/{$slug}.css", __FILE__ ),
	// 	[ 'wp-editor' ],
	// 	filemtime( plugin_dir_path( __FILE__ ) . "blocks/{$slug}/{$slug}.css" )
	// );
}

//
// REGISTER CUSTOM BLOCKS
//
if (function_exists('acf_register_block_type')) {
	add_action('acf/init', 'register_acf_block_types');
}

function register_acf_block_types()
{

	if (function_exists('acf_register_block_type')) {

		acf_register_block_type(array(
			'name'              => 'testimonial',
			'title'             => __('Testimonial'),
			'description'       => __('A custom testimonial block.'),
			'render_template'   => 'blocks/testimonial/testimonial.php',
			'category'          => 'layout',
			'icon'              => 'admin-comments',
			'mode'							=> 'preview',
			'keywords'          => array('testimonial', 'quote'),
		));

		acf_register_block_type(array(
			'name'              => 'media',
			'title'             => __('Media'),
			'description'       => __('A custom media and text block.'),
			'render_template'   => 'blocks/media/media.php',
			'category'          => 'layout',
			'icon'              => 'align-pull-right',
			'mode'							=> 'preview',
			'supports'          => array(
				'align' => false,
				'mode' => false,
				'jsx' => true
			),
			'keywords'          => array('testimonial', 'quote'),
		));

		acf_register_block_type(array(
			'name'              => 'acfcolumns',
			'title'             => __('ACF Columns'),
			'description'       => __('A custom media and text block.'),
			'render_template'   => 'blocks/acfcolumns/acfcolumns.php',
			'category'          => 'layout',
			'icon'              => 'align-pull-right',
			'mode'							=> 'preview',
			'supports'          => array(
				'align' => false,
				'mode' => false,
				'jsx' => true
			),
			'keywords'          => array('layout', 'quote'),
		));
	}
}



// Allow gutenberg blocks per post type
add_filter('allowed_block_types', 'fiasco_allowed_block_types', 10, 2);
function fiasco_allowed_block_types($allowed_blocks, $post)
{

	// This list will show on all post types
	$allowed_blocks = array(
		'core/paragraph',
		'core/image',
		'core/heading',
		'core/gallery',
		'core/list',
		'core/quote',
		'core/audio',
		'core/cover',
		'core/columns',
		'core/column',
		'core/group',
		'core/file',
		'core/video',
		//'core/table',
		//'core/verse',
		'core/code',
		'core/freeform',
		'core/html',
		'core/preformatted',
		'core/pullquote',
		'core/block',
		'core/button',
		'core/text-columns',
		// 'core/media-text',
		//'core/more',
		//'core/nextpage',
		'core/separator',
		'core/spacer',
		'core/shortcode',
		//'core/archives',
		'core/categories',
		// 'core/latest-comments',
		'core/latest-posts',
		//'core/calendar',
		//'core/rss',
		//'core/search',
		'core/tag-cloud',
		'core/embed',
		// 'core-embed/amazon-kindle',
		// 'core-embed/animoto',
		// 'core-embed/cloudup',
		// 'core-embed/collegehumor',
		// 'core-embed/crowdsignal',
		// 'core-embed/dailymotion',
		// 'core-embed/facebook',
		// 'core-embed/flickr',
		// 'core-embed/hulu',
		// 'core-embed/imgur',
		// 'core-embed/instagram',
		// 'core-embed/issuu',
		// 'core-embed/kickstarter',
		//'core-embed/meetup-com',
		//'core-embed/mixcloud',
		//'core-embed/polldaddy',
		//'core-embed/reddit',
		//'core-embed/reverbnation',
		//'core-embed/screencast',
		//'core-embed/scribd',
		//'core-embed/slideshare',
		//'core-embed/smugmug',
		'core-embed/soundcloud',
		//'core-embed/speaker',
		//'core-embed/speaker-deck',
		'core-embed/spotify',
		'core-embed/ted',
		//'core-embed/tumblr',
		'core-embed/twitter',
		//'core-embed/videopress',
		'core-embed/vimeo',
		//'core-embed/wordpress',
		//'core-embed/wordpress-tv',
		'core-embed/youtube',
		'acf/testimonial',
		'acf/media',
		'acf/acfcolumns'
	);

	// Add specific post types here for allowed blocks
	// if( $post->post_type === 'page' ) {
	// 	$allowed_blocks[] = 'core/heading';
	// }

	return $allowed_blocks;
}


//
// ENQUEUE BLOCK EDITOR STYLES
//
// function legit_block_editor_styles() {
// 	wp_enqueue_style( 'legit-editor-styles', get_theme_file_uri( '/editor-style.css' ), false, '1.0', 'all' );
// }
// add_action( 'enqueue_block_editor_assets', 'legit_block_editor_styles' );




if (!function_exists('dd')) {
	function dd()
	{
		if (func_num_args() === 1) {
			echo '<hr><pre>';
			print_r(func_get_args()[0]);
			echo '<hr></pre>';
		} else if (func_num_args() > 1) {
			echo '<hr><pre>';
			print_r(func_get_args());
			echo '<hr></pre>';
		} else {
			die;
		}
	}
}



//
// ADDING DATA ATTRIBUTES TO IMAGES
//
add_filter('wp_get_attachment_image_attributes', 'add_custom_image_data_attributes', 10, 3);
function add_custom_image_data_attributes($attr, $attachment, $size)
{

	$caption = wp_get_attachment_caption($attachment->ID);
	$title = get_the_title($attachment->ID);

	// Ensure that the <img> doesn't have the data attribute already
	if (!array_key_exists('data-caption', $attr)) {
		$attr['data-caption'] = $caption;
	}

	// Ensure that the <img> doesn't have the data attribute already
	if (!array_key_exists('data-title', $attr)) {
		$attr['data-title'] = $title;
	}

	return $attr;
}

//
// RENAME SOME INPUT FIELDS IN THE MEDIA LIBRARY ATTACMENT DETAILS MODAL
//
function rename_attachment_details_input_fields($hook)
{
	// Only add to the upload.php admin page.
	// See WP docs.
	if ('upload.php' !== $hook) {
		return;
	}
	wp_register_script('rename_attachment_details_input_fields_script', get_stylesheet_directory_uri() . '/js/rename_attachment_details_input_fields.js');
	wp_enqueue_script('rename_attachment_details_input_fields_script');
}

add_action('admin_enqueue_scripts', 'rename_attachment_details_input_fields');

// Remove non-breaking space from the excerpt
add_filter('the_excerpt', function ($excerpt) {
	return str_replace("&nbsp;", " ", $excerpt);
}, 999, 1);

// Remove non-breaking space from the title
add_filter('the_title', function ($title) {
	return str_replace("&nbsp;", " ", $title);
}, 999, 1);

// Remove non-breaking space from the content
add_filter('the_content', function ($content) {
	return str_replace("&nbsp;", " ", $content);
}, 999, 1);




//
// SEARCH OPTIONS
// Use different search template when using the articles page
//
function template_chooser($template)
{
	global $wp_query;
	$post_type = $wp_query->query_vars["post_type"];
	if ($wp_query->is_search && $post_type == 'resources') {
		return locate_template('search-resources.php');
	}
	return $template;
}
add_filter('template_include', 'template_chooser');

// add_filter( 'relevanssi_hits_filter', 'search_result_types' );
// function search_result_types( $hits ) {
// 	global $hns_search_result_type_counts;
// 	$types = array();
// 	if ( ! empty( $hits ) ) {
// 		foreach ( $hits[0] as $hit ) {
// 			$types[ $hit->post_type ]++;
// 		}
// 	}
// 	$hns_search_result_type_counts = $types;
// 	return $hits;
// }

// add_filter( 'relevanssi_modify_wp_query', 'rlv_postsperpage' );
// function rlv_postsperpage( $query ) {
// 	$query->query_vars['posts_per_page'] = 500;
// 	return $query;
// }
