<?php

$labels = array(
  'name'                  => _x( 'Events', 'Post Type General Name', 'pulse_theme' ),
  'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'pulse_theme' ),
  'menu_name'             => __( 'Events', 'pulse_theme' ),
  'name_admin_bar'        => __( 'Event', 'pulse_theme' ),
  'archives'              => __( 'Event Archives', 'pulse_theme' ),
  'attributes'            => __( 'Event Attributes', 'pulse_theme' ),
  'parent_item_colon'     => __( 'Parent Event:', 'pulse_theme' ),
  'all_items'             => __( 'All Events', 'pulse_theme' ),
  'add_new_item'          => __( 'Add New Event', 'pulse_theme' ),
  'add_new'               => __( 'Add New', 'pulse_theme' ),
  'new_item'              => __( 'New Event', 'pulse_theme' ),
  'edit_item'             => __( 'Edit Event', 'pulse_theme' ),
  'update_item'           => __( 'Update Event', 'pulse_theme' ),
  'view_item'             => __( 'View Event', 'pulse_theme' ),
  'view_items'            => __( 'View Events', 'pulse_theme' ),
  'search_items'          => __( 'Search Event', 'pulse_theme' ),
  'not_found'             => __( 'Not found', 'pulse_theme' ),
  'not_found_in_trash'    => __( 'Not found in Trash', 'pulse_theme' ),
  'featured_image'        => __( 'Event Image', 'pulse_theme' ),
  'set_featured_image'    => __( 'Set Event image', 'pulse_theme' ),
  'remove_featured_image' => __( 'Remove Event image', 'pulse_theme' ),
  'use_featured_image'    => __( 'Use as Event image', 'pulse_theme' ),
  'insert_into_item'      => __( 'Insert into Event', 'pulse_theme' ),
  'uploaded_to_this_item' => __( 'Uploaded to this Event', 'pulse_theme' ),
  'items_list'            => __( 'Events list', 'pulse_theme' ),
  'items_list_navigation' => __( 'Events list navigation', 'pulse_theme' ),
  'filter_items_list'     => __( 'Filter Events list', 'pulse_theme' ),
);

$args = array(
  'label'                 => __( 'Event', 'pulse_theme' ),
  'description'           => __( 'Events Description', 'pulse_theme' ),
  'labels'                => $labels,
  'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', ),
  'hierarchical'          => false,
  'public'                => true,
  'show_ui'               => true,
  'show_in_menu'          => true,
  'menu_position'         => 5,
  'menu_icon'             => 'dashicons-calendar',
  'show_in_admin_bar'     => true,
  'show_in_nav_menus'     => true,
  'can_export'            => true,
  'has_archive'           => true,
  'exclude_from_search'   => false,
  'publicly_queryable'    => false, // Set to false to prevent single post views for this post type
  'capability_type'       => 'page',
);

register_post_type( 'event', $args );

add_filter('timber/post/classmap', function ($classmap) {
  $classmap['event'] = Event::class;
  return $classmap;
});

class Event extends Timber\Post  {
  public static function build(WP_Post $wp_post): self
  {
      $post = parent::build($wp_post);
      $post->start_date = get_field('start_date', $post->ID);
      $post->end_date = get_field('end_date', $post->ID);
      $post->time = get_field('time', $post->ID);
      $post->timezone = get_field('timezone', $post->ID);
      $post->location = get_field('location', $post->ID);
      $post->url = get_field('url', $post->ID);
      return $post;
  }
}