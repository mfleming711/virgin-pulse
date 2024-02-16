<?php
// add data to block context

$picked_ids = $context['fields']['picked_posts'] ?: [];
$categories = $context['fields']['categories'] ?: [];
$tax_query = [];

if ($categories && count($categories)) {
  $tax_query[] = [
    'taxonomy'  => 'ressource_category',
    'field'     => 'term_id',
    'terms'     => $categories,
  ];
}

$args = [
  'post_type' => 'ressource',
  'posts_per_page' => 4,
  'post__not_in' => $picked_ids,
  'tax_query' => $tax_query,
  'orderby' => [
    'date' => 'DESC',
  ],
  'fields' => 'ids'
];
$recent_ids = Timber::get_posts($args)->to_array() ?? [];

$context['posts'] = array_slice(array_merge($picked_ids, $recent_ids), 0, 4);