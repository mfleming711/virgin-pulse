<?php 

// unregister_taxonomy_for_object_type('post_tag', 'post');

// register_taxonomy('solutions', 'post', array(
//   'hierarchical' => true,
//   'labels' => array(
//     'name' => _x( 'Solutions', 'taxonomy general name' ),
//     'singular_name' => _x( 'Solutions', 'taxonomy singular name' ),
//     'search_items' =>  __( 'Search Solutions' ),
//     'all_items' => __( 'All Solutions' ),
//     'parent_item' => __( 'Parent Solution' ),
//     'parent_item_colon' => __( 'Parent Solution:' ),
//     'edit_item' => __( 'Edit Solution' ),
//     'update_item' => __( 'Update Solution' ),
//     'add_new_item' => __( 'Add New Solution' ),
//     'new_item_name' => __( 'New Solution' ),
//     'menu_name' => __( 'Solutions' ),
//   ),
//   'publicly_queryable' => true,
//   'show_ui' => true,
//   'show_in_rest' => true,
//   // Control the slugs used for this taxonomy
//   'rewrite' => array(
//     'slug' => 'solutions', // This controls the base slug that will display before each term
//     'with_front' => true, // Don't display the category base before "/locations/"
//   ),
//   'show_in_graphql' => true,
//   'graphql_single_name' => 'solution',
//   'graphql_plural_name' => 'solutions',
// ));