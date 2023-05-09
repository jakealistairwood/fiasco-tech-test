<?php

//
//
// CUSTOM POST TYPE
//
//
function cptui_register_my_cpts() {

	/**
	 * Post Type: Programme
	 */
	$labels = array(
		"name" => "Programme",
		"singular_name" => "Programme",
	);
	$args = array(
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "programme", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 2,
		"menu_icon" => "dashicons-calendar-alt",
		"supports" => array( "title", "editor", "excerpt", "thumbnail" ),
	);
	register_post_type( "programme", $args );

	/**
	 * Post Type: Team
	 */
	$labels = array(
		"name" => __( "Team Members", "bid" ),
		"singular_name" => __( "Team Member", "bid" ),
	);
	$args = array(
		"label" => __( "Team Members", "bid" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => "team",
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "team", "with_front" => false ),
		"query_var" => true,
		"menu_position" => 3,
		"menu_icon" => "dashicons-admin-users",
		"supports" => array( "title", "editor", "thumbnail", "revisions" ),
	);
	register_post_type( "team-members", $args );

	/**
	 * Post Type: Board Members
	 */
	$labels = array(
		"name" => __( "Board Members", "bid" ),
		"singular_name" => __( "Board Member", "bid" ),
	);
	$args = array(
		"label" => __( "Board Members", "bid" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => "board",
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "board-member", "with_front" => false ),
		"query_var" => true,
		"menu_position" => 4,
		"menu_icon" => "dashicons-groups",
		"supports" => array( "title", "editor", "thumbnail", "revisions" ),
	);
	register_post_type( "board-members", $args );


	/**
	 * Post Type: Resources
	 */
	$labels = array(
		"name" => __( "Resources", "bid" ),
		"singular_name" => __( "Resource", "bid" ),
	);
	$args = array(
		"label" => __( "Resources", "bid" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => "resources",
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "resource", "with_front" => false ),
		"query_var" => true,
		"menu_position" => 5,
		"menu_icon" => "dashicons-book-alt",
		"supports" => array( "title", "revisions","thumbnail","excerpt" ),
	);
	register_post_type( "resources", $args );



	/**
	 * Post Type: Services
	 */
	$labels = array(
		"name" => __( "Services", "bid" ),
		"singular_name" => __( "Service", "bid" ),
	);
	$args = array(
		"label" => __( "Services", "bid" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => "services",
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "service", "with_front" => false ),
		"query_var" => true,
		"menu_position" => 6,
		"menu_icon" => "dashicons-awards",
		"supports" => array( "title", "revisions","thumbnail" ),
	);
	register_post_type( "services", $args );



	/**
	 * Post Type: Jobs
	 */
	$labels = array(
		"name" => __( "Jobs", "bid" ),
		"singular_name" => __( "Job", "bid" ),
	);
	$args = array(
		"label" => __( "Jobs", "bid" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => "jobs",
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "job", "with_front" => false ),
		"query_var" => true,
		"menu_position" => 7,
		"menu_icon" => "dashicons-portfolio",
		"supports" => array( "title", "editor", "thumbnail", "excerpt" ),
	);
	register_post_type( "jobs", $args );



	/**
	 * Post Type: Space
	 */
	$labels = array(
		"name" => __( "Spaces", "bid" ),
		"singular_name" => __( "Space", "bid" ),
	);
	$args = array(
		"label" => __( "Spaces", "bid" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => "spaces",
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "space", "with_front" => false ),
		"query_var" => true,
		"menu_position" => 8,
		"menu_icon" => "dashicons-admin-multisite",
		"supports" => array( "title", "editor", "thumbnail","excerpt" ),
	);
	register_post_type( "spaces", $args );

}
add_action( 'init', 'cptui_register_my_cpts' );


//
//
// TAXONOMIES
//
//
function cptui_register_my_taxes() {


	/**
	 * Taxonomy: Team
	 */
	$labels = array(
		"name" => __( "Teams", "bid" ),
		"singular_name" => __( "Team", "bid" ),
		"add_new_item" => __( "Add New Team", "bid" ),
	);
	$args = array(
		"label" => __( "Team", "bid" ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Team",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'teams', 'with_front' => false, ),
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "service",
		"show_in_quick_edit" => true,
	);
	register_taxonomy( "teams", array( "team-members" ), $args );



	/**
	 * Taxonomy: Resource Type
	 */
	$labels = array(
		"name" => __( "Resource Types", "bid" ),
		"singular_name" => __( "Resource Type", "bid" ),
		"add_new_item" => __( "Add New Type", "bid" ),
	);
	$args = array(
		"label" => __( "Resource Type", "bid" ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Type",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'resources/types', 'with_front' => false, ),
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "service",
		"show_in_quick_edit" => true,
	);
	register_taxonomy( "resource-types", array( "resources" ), $args );


}
add_action( 'init', 'cptui_register_my_taxes' );


?>
