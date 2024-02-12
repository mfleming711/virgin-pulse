<?php

$context = Timber::get_context();
$templates = array('archive.twig');

$context['title'] = 'Archive';
if (is_day()) {
	$context['title'] = 'Archive: ' . get_the_date('D M Y');
} else if (is_month()) {
	$context['title'] = 'Archive: ' . get_the_date('M Y');
} else if (is_year()) {
	$context['title'] = 'Archive: ' . get_the_date('Y');
} else if (is_tag()) {
	$context['title'] = single_tag_title('', false);
} else if (is_category()) {
	$context['title'] = single_cat_title('', false);
	array_unshift($templates, 'archive-' . get_query_var('cat') . '.twig');
} else if (is_post_type_archive()) {
	$context['title'] = post_type_archive_title('', false);
	array_unshift($templates, 'archive-' . get_post_type() . '.twig');
}

$tax_query = [];

// if (isset($_GET["solutions"])) {
// 	$tax_query[] = [
// 		'taxonomy' => 'tx_solution',
// 		'terms' => explode(',', $_GET["solutions"]),
// 		'field' => 'slug',
// 		'operator' => 'IN'
// 	];
// }


$context['posts'] = new Timber\PostQuery();

// overwrite pagination settings:
// https://github.com/timber/timber/blob/master/lib/Pagination.php#L107
$context['posts']['pagination'] = Timber::get_pagination([
	"start_size" => 1,
	"mid_size" => 1,
	"end_size" => 1,
	"show_all" => true,
]);


// get taxonomy terms
$hide_empty = false;

$context['categories'] = Timber::get_terms([
	'taxonomy'   => 'category',
	'hide_empty' => $hide_empty,
]);

// for some reason WordPress will return only the first matching category
// so we read from $_GET directly and only fallback to get_query_var if empty
$context['current_category'] = explode(',', ($_GET['category_name'] ?? false) ?: get_query_var('category_name'));


$context['solutions'] = Timber::get_terms([
	'taxonomy'   => 'tx_solution',
	'hide_empty' => $hide_empty,
]);
$context['current_solutions'] = explode(',', get_query_var('tx_solution'));

$context['industries'] = Timber::get_terms([
	'taxonomy'   => 'tx_industry',
	'hide_empty' => $hide_empty,
]);
$context['current_industries'] = explode(',', get_query_var('tx_industry'));

$context['roles'] = Timber::get_terms([
	'taxonomy'   => 'tx_role',
	'hide_empty' => $hide_empty,
]);
$context['current_roles'] = explode(',', get_query_var('tx_role'));

$context['technologies'] = Timber::get_terms([
	'taxonomy'   => 'tx_topic',
	'hide_empty' => $hide_empty,
]);
$context['current_technologies'] = explode(',', get_query_var('tx_topic'));

$context['current_order'] = get_query_var('order');

Timber::render('archive.twig', $context);
