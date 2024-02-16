<?php

namespace Base;
use Timber\Timber;

if (!class_exists('\Timber')) {
  add_filter('template_include', function ($template) {
    return get_stylesheet_directory() . '/static/no-timber.html';
  });
  return;
}

class Site extends \Timber\Site
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
    // $twig->addExtension(new \Twig_Extension_StringLoader());
    $twig->addFunction(new \Twig\TwigFunction(
      'print', [$this, 'bs_debug_print'], ['needs_context' => true]
    ));
    $twig->addFunction(new \Twig\TwigFunction(
      'render_layouts', [$this, 'bs_render_layouts']
    ));
    $twig->addFilter(
      new \Twig\TwigFilter('obfuscate', [$this, 'bs_obfuscate'])
    );
    $twig->addFilter(
      new \Twig\TwigFilter('file_size', [$this, 'bs_attachement_file_size'])
    );
    $twig->addFilter(
      new \Twig\TwigFilter('file_type', [$this, 'bs_attachement_file_type'])
    );
    $twig->addFilter(
      new \Twig\TwigFilter('time_span', [$this, 'bs_calc_time_span'])
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
    // $mimes['svg'] = 'image/svg+xml';
    // $mimes['vcf'] = 'text/x-vcard';
    return $mimes;
  }

  function bs_debug_print($context, $data = false)
  {
    return '<pre style="height:200px; overflow:auto; resize:vertical; background: #eee; padding: 1.6rem;">' .
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

  function bs_calc_time_span( $_timestamps )
  {
  	$output = '';
  	$input_times = explode('-', $_timestamps);
  	$unixtimestamp = strtotime($input_times[0]);
  	$end_unixtimestamp = strtotime($input_times[1]);

  	$date = new \DateTime();
  	$date->setTimestamp($unixtimestamp);
  	$end_date = new \DateTime();
  	$end_date->setTimestamp($end_unixtimestamp);
  	$y_diff = ( date('Y', $date->getTimestamp() ) == date('Y', $end_date->getTimestamp() ) );
  	$m_diff = ( date('n', $date->getTimestamp() ) == date('n', $end_date->getTimestamp() ) );
  	$d_diff = ( date('d', $date->getTimestamp() ) == date('d', $end_date->getTimestamp() ) );
  	if ( !!$y_diff && !!$m_diff && !$d_diff) {
  		$t_day = date_i18n("j", $unixtimestamp) . '–' . date_i18n("j", $end_unixtimestamp) . '';
  		$t_month = date_i18n("F", $unixtimestamp) . ' ';
  		$t_year = date_i18n("Y", $unixtimestamp);
  	} elseif ( !!$y_diff && !$m_diff) {
  		$t_day = '';
  		$t_month =
  			date_i18n("F", $unixtimestamp) . ' '
  		. date_i18n("j", $unixtimestamp)
  		. ' – '
  		. date_i18n("F", $end_unixtimestamp) . ' '
  		. date_i18n("j", $end_unixtimestamp). ' ';
  		$t_year = date_i18n("Y", $unixtimestamp);
  	} elseif ( !$y_diff ) {
  		$t_day = '';
  		$t_month = '';
  		$t_year =
  			date_i18n("F", $unixtimestamp) . '. '
  		. date_i18n("j", $unixtimestamp) . ''
  		. '–'
  		. date_i18n("F", $end_unixtimestamp) . '. '
  		. date_i18n("j", $end_unixtimestamp) . ' ';
  	} else {
			$t_day = date_i18n("j", $unixtimestamp);
			$t_month = date_i18n("F", $unixtimestamp) . ' ';
		}
  	$output .= '<span class="month">' . $t_month . '</span>';
  	$output .= '<span class="day">' . $t_day . '</span>';
  	// $output .= '<span class="year">' . $t_year . '</span>';
  	return $output;
  }
}
