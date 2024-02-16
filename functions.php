<?php

require_once __DIR__ . "/vendor/autoload.php";

Timber\Timber::init();
Timber::$dirname = ["templates", "templates/pages", "templates/components"];

require_once __DIR__ . "/inc/BaseSite.php";
require_once __DIR__ . "/inc/BaseBlock.php";
require_once __DIR__ . "/inc/BaseAjax.php";

class PulseSite extends Base\Site
{
  public function __construct()
  {
    parent::__construct();
    add_action("init", [$this, "register_post_types"]);
    add_action("init", [$this, "register_taxonomies"]);
    add_action("wp_enqueue_scripts", [$this, "enqueue_scripts"]);
    add_action("admin_enqueue_scripts", [$this, "enqueue_admin_scripts"]);
    add_action("acf/init", [$this, "acf_init"]);

    add_filter('get_the_excerpt', [$this, "generate_excerpt"], 10, 2);

    add_filter("timber_context", [$this, "add_to_context"]);

    Base\Ajax::register();
  
    // redirect ...?lang=fr urls to /fr/... schema
    add_action('template_redirect', function() {
      $lang = get_query_var('lang');
      if (empty($lang) && !$lang) return;

      $translated_url = apply_filters( 'wpml_permalink', get_the_permalink( get_the_id() ), $lang );

      if (!empty($translated_url )) exit( wp_redirect( $translated_url, 301 ) );
    });
  }

  public function acf_init()
  {
    include_once "inc/register_blocks.php";

    acf_add_options_page(array(
      'page_title'    => 'Global Settings',
      'menu_title'    => 'Global Settings',
      'menu_slug'     => 'global-settings',
      'capability'    => 'edit_posts',
      'menu_icon'     => 'dashicons-admin-settings',
      'redirect'      => false,
      'show_in_graphql' => true,
    ));
  }

  public function enqueue_scripts()
  {
    $version = wp_get_theme()->get("Version");
    wp_enqueue_style(
      "main-styles",
      get_stylesheet_directory_uri() . "/style.css",
      false,
      // $version,
      filemtime(dirname(__FILE__) . '/style.css'),
      "all"
    );
    wp_enqueue_script(
      "theme-js",
      get_template_directory_uri() . "/static/js/theme.min.js",
      ["jquery"],
      filemtime(dirname(__FILE__) . '/static/js/theme.min.js'),
      // $version,
      true
    );
  }

  public function enqueue_admin_scripts()
  {
    wp_enqueue_style(
      "admin-styles",
      get_stylesheet_directory_uri() . "/admin.css"
    );
  }

  public function add_to_context($context)
  {
    return $context;
  }

  public function register_post_types()
  {
    include_once('inc/posttypes/events.php');
  }

  public function register_taxonomies()
  {
    include_once('inc/posttypes/custom_taxonomies.php');
  }

  public function generate_excerpt($excerpt, $post)
  {
    if (!empty($excerpt)) return $excerpt;
    $blocks = get_field( 'richtext_builder', $post->ID ) ?? [] ?: [];
    $content = array();
		
    foreach ( $blocks as $block ) {
      if ( $block['acf_fc_layout'] != 'richtext') continue;
      $content[] = $block['copy'];
    }

    $text = strip_tags($content[0] ?? '');
    $intro =  implode(' ', array_slice(explode(' ', $text), 0, 30));
    return $intro;
  }
}

new PulseSite();
