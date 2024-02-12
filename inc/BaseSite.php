<?php

namespace Base;
use Timber\Timber;

if (!class_exists('\Timber')) {
  add_filter('template_include', function ($template) {
    return get_stylesheet_directory() . '/static/no-timber.html';
  });
  return;
}

class Site extends \TimberSite
{
  function __construct()
  {
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    add_theme_support('custom-logo');
    add_theme_support('html5', [
      'comment-list',
      'comment-form',
      'search-form',
      'gallery',
      'caption',
    ]);
    add_theme_support('align-wide');
    add_theme_support('align-full');
    add_post_type_support('page', 'excerpt');

    add_filter('get_twig', [$this, 'bs_add_to_twig']);
    add_filter('timber_context', [$this, 'bs_add_to_context']);
    add_filter('upload_mimes', [$this, 'bs_add_mime_types']);
  }

  function bs_add_to_twig($twig)
  {
    $twig->addExtension(new \Twig_Extension_StringLoader());
    $twig->addFunction(new \Twig_Function(
      'print', [$this, 'bs_debug_print'], ['needs_context' => true]
    ));
    $twig->addFunction(new \Twig_Function(
      'render_layouts', [$this, 'bs_render_layouts']
    ));
    $twig->addFilter(
      new \Twig_SimpleFilter('obfuscate', [$this, 'bs_obfuscate'])
    );
    $twig->addFilter(
      new \Twig_SimpleFilter('file_size', [$this, 'bs_attachement_file_size'])
    );
    $twig->addFilter(
      new \Twig_SimpleFilter('file_type', [$this, 'bs_attachement_file_type'])
    );
    return $twig;
  }

  function bs_render_layouts($field_name)
  {
    $layouts = get_field($field_name);
    if (empty($layouts)) return "";

    foreach ($layouts as $index => $layout) {
      $context = $layout;
      $context['index'] = $index;

      $template = $layout['acf_fc_layout'];
      $template_underline = str_replace('_', '-', $template);
      $template_underline = str_replace(':', '-', $template_underline);

      $phpfile = get_template_directory() .
      "/templates/layouts/{$template_underline}/{$template_underline}.php";
      if (is_file($phpfile)) include $phpfile;

      \Timber::render(
        [
          "layouts/{$template}/{$template}.twig",
          "layouts/{$template_underline}/{$template_underline}.twig",
          'layouts/default/default.twig'
        ],
        $context /* , 36000 */
      );
    }
  }

  function bs_add_to_context($context)
  {
    foreach (get_registered_nav_menus() as $k => $v) {
      $context['menu_' . $k] = new \TimberMenu($k);
    }
    $context['site'] = \Timber::get_context()['site'];
    $context['site']->logo = get_custom_logo();
    $context['globals'] = get_fields('option');
    return $context;
  }

  function bs_add_mime_types($mimes)
  {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['vcf'] = 'text/x-vcard';
    return $mimes;
  }

  function bs_debug_print($context, $data = false)
  {
    return '<pre style="height:200px; overflow:auto; resize:vertical;">' .
      print_r($data ?: $context, true) .
      '</pre>';
  }

  function bs_obfuscate($string)
  {
    return mb_encode_numericentity(
      $string,
      [0x000000, 0x10ffff, 0, 0xffffff],
      'UTF-8'
    );
  }

  function bs_attachement_file_size($_path)
  {
    $file = get_attached_file($_path);
    $file_size = filesize($file);
    return size_format($file_size);
  }

  function bs_attachement_file_type($_path)
  {
    $file = get_attached_file($_path);
    return pathinfo($file)['extension'];
  }
}
