<?php

$today = date('Ymd');

$args = [
  'post_type' => 'event',
  'posts_per_page' => 1,
  'meta_query' => [
    [
      'key'     => 'start_date',
      'compare' => '>=',
      'value'   => $today,
    ]
  ],
  'orderby' => [
    'start_date' => 'ASC',
    'time' => 'ASC',
  ],
];
$context['next_event'] = Timber::get_posts($args)->to_array()[0] ?? null;