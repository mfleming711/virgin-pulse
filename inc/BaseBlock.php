<?php

namespace Base;
use Timber\Timber;

class Block
{
  public static function register(
    $name,
    $title = '',
    $mode = 'preview',
    $category = 'common',
    $icon = 'star-filled'
  ) {
    if (!function_exists('acf_register_block_type')) {
      return;
    }
    $title = $title ?: $name;
    $supports = ['align' => true, 'anchor' => true];
    if ($mode == 'nested') {
      $mode = 'preview';
      $supports = [
        'align' => true,
        'mode' => false,
        'jsx' => true,
      ];
    }
    acf_register_block_type([
      'name' => $name,
      'title' => __($title, 'your-text-domain'),
      'render_callback' => ['Base\Block', 'render'],
      'category' => 'formatting',
      'icon' => $icon,
      'mode' => $mode,
      'keywords' => [$name],
      'supports' => $supports,
    ]);
  }

  public static function render(
    $block,
    $content = '',
    $is_preview = false,
    $post_id = 0
  ) {
    $context = \Timber::get_context();
    $context['post'] = new \Timber\Post($post_id);
    $context['block'] = $block;
    $context['fields'] = get_fields();
    $context['is_preview'] = $is_preview;
    $context['className'] = '';
    if (!empty($block['className'])) {
      $context['className'] .= $block['className'];
    }
    if (!empty($block['align'])) {
      $context['className'] .= ' align' . $block['align'];
    }
    if ($is_preview) {
      $context['className'] .= ' is-preview';
    }
    $_template = explode('acf/', $block['name'])[1];
    $_phpfile =
      get_template_directory() .
      "/templates/blocks/{$_template}/{$_template}.php";

    if (is_file($_phpfile)) {
      include $_phpfile;
    }

    \Timber::render(
      ["blocks/{$_template}/{$_template}.twig", 'blocks/default/default.twig'],
      $context /* , 36000 */
    );
  }
}
