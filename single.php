<?php
require_once(get_template_directory() . "/utilities/php/get_language_code.php");

$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;

Timber::render(
	array(
		'single-' . $post->ID . '.twig',
		'single-' . $post->post_type . '.twig',
		'single.twig'
	),
	$context
);
