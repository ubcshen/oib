<?php
/**
 * team functions and definitions
 *
 */

/*-----------------------------------------------------------------------------------*/
/*  Register customers post format.
/*-----------------------------------------------------------------------------------*/
add_action( 'init', 'team_posttype_init' );
if ( !function_exists( 'team_posttype_init' ) ) :
function team_posttype_init() {

    $project_labels = array(
        'name' => _x('Team Members', 'post type general name'),
        'singular_name' => _x('team member', 'post type singular name'),
        'menu_name' => __('Team Members')

    );

    $project_args = array(
        'labels' => $project_labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => 5,
        'rewrite' => array('slug' => 'team-member'),
        //'taxonomies' => array('post_tag'),
        'supports' => array( 'title', 'excerpt', 'thumbnail', 'editor')
    );
    register_post_type( 'team', $project_args );

}
endif;

/*-----------------------------------------------------------------------------------*/
/*  project team taxonomies.
/*-----------------------------------------------------------------------------------*/
add_action( 'init', 'team_taxonomies_innit', 0 );
if ( !function_exists( 'team_taxonomies_innit' ) ) :
function team_taxonomies_innit() {
    // project Category

    $labels = array(
        'name' => _x( 'Team Types', 'taxonomy general name'),
        'singular_name' => _x( 'teamtype', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Team Type' ),
        'all_items' => __( 'All Team Types'),
        'parent_item' => __( 'Parent Team Type'),
        'parent_item_colon' => __( 'Parent Team Type:'),
        'edit_item' => __( 'Edit Team Type'),
        'update_item' => __( 'Update Team Type'),
        'add_new_item' => __( 'Add New Team Type'),
        'new_item_name' => __( 'New Team Type Name'),
        'menu_name' => __( 'Team Types'),
    );

    register_taxonomy('team-types',array('team'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'team-types' ),
    ));

}
endif;

