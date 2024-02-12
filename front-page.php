<?php

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
Timber::render(array('frontpage.twig', 'page-' . $post->post_name . '.twig', 'page.twig'), $context);
