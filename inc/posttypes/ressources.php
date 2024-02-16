<?php

$labels = array(
  'name'                  => _x( 'Ressources', 'Post Type General Name', 'pulse_theme' ),
  'singular_name'         => _x( 'Ressource', 'Post Type Singular Name', 'pulse_theme' ),
  'menu_name'             => __( 'Ressources', 'pulse_theme' ),
  'name_admin_bar'        => __( 'Ressource', 'pulse_theme' ),
  'archives'              => __( 'Ressource Archives', 'pulse_theme' ),
  'attributes'            => __( 'Ressource Attributes', 'pulse_theme' ),
  'parent_item_colon'     => __( 'Parent Ressource:', 'pulse_theme' ),
  'all_items'             => __( 'All Ressources', 'pulse_theme' ),
  'add_new_item'          => __( 'Add New Ressource', 'pulse_theme' ),
  'add_new'               => __( 'Add New', 'pulse_theme' ),
  'new_item'              => __( 'New Ressource', 'pulse_theme' ),
  'edit_item'             => __( 'Edit Ressource', 'pulse_theme' ),
  'update_item'           => __( 'Update Ressource', 'pulse_theme' ),
  'view_item'             => __( 'View Ressource', 'pulse_theme' ),
  'view_items'            => __( 'View Ressources', 'pulse_theme' ),
  'search_items'          => __( 'Search Ressource', 'pulse_theme' ),
  'not_found'             => __( 'Not found', 'pulse_theme' ),
  'not_found_in_trash'    => __( 'Not found in Trash', 'pulse_theme' ),
  'featured_image'        => __( 'Ressource Image', 'pulse_theme' ),
  'set_featured_image'    => __( 'Set Ressource image', 'pulse_theme' ),
  'remove_featured_image' => __( 'Remove Ressource image', 'pulse_theme' ),
  'use_featured_image'    => __( 'Use as Ressource image', 'pulse_theme' ),
  'insert_into_item'      => __( 'Insert into Ressource', 'pulse_theme' ),
  'uploaded_to_this_item' => __( 'Uploaded to this Ressource', 'pulse_theme' ),
  'items_list'            => __( 'Ressources list', 'pulse_theme' ),
  'items_list_navigation' => __( 'Ressources list navigation', 'pulse_theme' ),
  'filter_items_list'     => __( 'Filter Ressources list', 'pulse_theme' ),
);

$args = array(
  'label'                 => __( 'Ressource', 'pulse_theme' ),
  'description'           => __( 'Ressources Description', 'pulse_theme' ),
  'labels'                => $labels,
  'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', ),
  'hierarchical'          => false,
  'public'                => true,
  'show_ui'               => true,
  'show_in_menu'          => true,
  'menu_position'         => 5,
  'menu_icon'             => 'dashicons-book',
  'show_in_admin_bar'     => true,
  'show_in_nav_menus'     => true,
  'can_export'            => true,
  'has_archive'           => true,
  'exclude_from_search'   => false,
  'publicly_queryable'    => false, // Set to false to prevent single post views for this post type
  'capability_type'       => 'page',
);

register_post_type( 'ressource', $args );

add_filter('timber/post/classmap', function ($classmap) {
  $classmap['ressource'] = Ressource::class;
  return $classmap;
});

class Ressource extends Timber\Post  {
  public static function build(WP_Post $wp_post): self
  {
      $post = parent::build($wp_post);
      $post->external_url = get_field('external_url', $post->ID);
      $post->ressource_category = get_the_terms($post->ID, 'ressource_category')[0] ?? null;
      return $post;
  }
}