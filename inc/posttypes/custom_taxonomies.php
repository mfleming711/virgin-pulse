<?php 

unregister_taxonomy_for_object_type('post_tag', 'post');

register_taxonomy('ressource_category', 'ressource', array(
  'hierarchical' => true,
  'labels' => array(
    'name' => _x( 'Ressource Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Ressource Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Categories' ),
    'all_items' => __( 'All Categories' ),
    'parent_item' => __( 'Parent Category' ),
    'parent_item_colon' => __( 'Parent Category:' ),
    'edit_item' => __( 'Edit Category' ),
    'update_item' => __( 'Update Category' ),
    'add_new_item' => __( 'Add New Category' ),
    'new_item_name' => __( 'New Category' ),
    'menu_name' => __( 'Categories' ),
  ),
  'publicly_queryable' => false,
  'show_ui' => true,
  'show_in_rest' => true,
));