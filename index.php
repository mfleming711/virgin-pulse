<?php

$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
$templates = array('index.twig', 'archive.twig');
if (is_home()) {
	array_unshift($templates, 'home.twig');
}
Timber::render($templates, $context);
