<?php

$context = Timber::get_context();
$post = Timber::get_post();
$context['post'] = $post;


Timber::render(array('page-' . $post->post_name . '.twig', 'page.twig'), $context);
