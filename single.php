<?php
require_once(get_template_directory() . "/utilities/php/get_language_code.php");

$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;

if ($post->post_type === 'post') {
	$args = [
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => 3,
		'post__not_in' => [get_the_id(), $context['featured_post']->ID ?? ''],
	];
	$latest = Timber::get_posts($args);

	$picked = array_map(function ($post) {
		return new Timber\Post($post);
	}, $context['post']->related_insights ?: []);

	$posts = array_merge($picked, $latest);
	$context['related_posts'] = array_slice($posts, 0, 3);
	$context['language_code'] = get_language_shortcode();
}


Timber::render(
	array(
		'single-' . $post->ID . '.twig',
		'single-' . $post->post_type . '.twig',
		'single.twig'
	),
	$context
);
