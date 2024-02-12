<?php

namespace Base;

class Ajax
{
  public static function register()
  {
    self::register_actions('base_ajax_example', false);
  }

  private static function register_actions(
    $name,
    $priv = false,
    $callback = false
  ) {
    if ($callback === false) {
      $callback = ['Base\Ajax', $name];
    }
    add_action('wp_ajax_' . $name, $callback);
    if (!$priv) {
      add_action('wp_ajax_nopriv_' . $name, $callback);
    }
  }

  public static function base_ajax_example()
  {
    $res = 'ajax json';
    echo json_encode($res);
    wp_die();
  }
}
