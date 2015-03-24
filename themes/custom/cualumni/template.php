<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728096
 */


/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
/* -- Delete this line if you want to use this function
function cuzen_preprocess_maintenance_page(&$variables, $hook) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  cuzen_preprocess_html($variables, $hook);
  cuzen_preprocess_page($variables, $hook);
}
// */

/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
/* -- Delete this line if you want to use this function
function cuzen_preprocess_html(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // The body tag's classes are controlled by the $classes_array variable. To
  // remove a class from $classes_array, use array_diff().
  //$variables['classes_array'] = array_diff($variables['classes_array'], array('class-to-remove'));
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
/* -- Delete this line if you want to use this function
function cuzen_preprocess_page(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function cuzen_preprocess_node(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // cuzen_preprocess_node_page() or cuzen_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function cuzen_preprocess_comment(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the region templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
/* -- Delete this line if you want to use this function
function cuzen_preprocess_region(&$variables, $hook) {
  // Don't use Zen's region--sidebar.tpl.php template for sidebars.
  //if (strpos($variables['region'], 'sidebar_') === 0) {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('region__sidebar'));
  //}
}
// */

function cuzen_preprocess_html(&$variables) {
  $element = array(
    '#tag' => 'link', // The #tag is the html tag - <link />
    '#attributes' => array( // Set up an array of attributes inside the tag
      'href' => '//fast.fonts.net/cssapi/86696b99-fb1a-4964-9676-9233fb4fca8f.css',
      'rel' => 'stylesheet',
      'type' => 'text/css',
    ),
  );
  if (variable_get('use_fonts', TRUE)) {
    drupal_add_html_head($element, 'web_fonts');
  }

  // Turn off IE Compatibility Mode
  $element = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'http-equiv' => 'X-UA-Compatible',
      'content' => 'IE=edge',
    ),
  );
  drupal_add_html_head($element, 'ie_compatibility_mode');
  
  $variables['head_title_array']['slogan'] = 'University of Colorado Boulder';
  $variables['head_title'] = implode(' | ', $variables['head_title_array']);
  
  $headings = theme_get_setting('headings') ? theme_get_setting('headings') : 'headings-bold';
  $variables['attributes_array']['class'][]=$headings;
  $page_title_image_background = theme_get_setting('page_title_image_background') ? theme_get_setting('page_title_image_background') : 'page-title-image-background-white';
  $variables['attributes_array']['class'][]=$page_title_image_background;
  $icon_color = theme_get_setting('block_icons_color') ? theme_get_setting('block_icons_color') : 'block-icons-inherit';
  $variables['attributes_array']['class'][]=$icon_color;
  
  $variables['classes_array'][] = 'banner-black';
}

function cuzen_preprocess_page(&$variables) {
  global $base_url;
  $variables['site_slogan'] = 'University of Colorado <strong>Boulder</strong>';
  $variables['print_logo'] = '<img src="' . $base_url . '/' . drupal_get_path('theme','cuzen') . '/images/print-logo.png" alt="University of Colorado Boulder" />';  
  
  if($variables['is_front'] == TRUE) {
    $variables['title_hidden'] = TRUE;
  }
  cuzen_home_icon($variables, 'footer_menu');
  $variables['footer_menu_color'] = theme_get_setting('footer_menu_color') ? theme_get_setting('footer_menu_color') : 'footer-menu-gray';
}
/**
  * Implements theme_page_alter();
  *
  * Force regions to render even if empty
  */
function cuzen_page_alter(&$page) {
  $regions = array('branding', 'secondary_menu', 'menu', 'site_info');
  foreach ($regions as $region) {
    if ( !isset($page[$region]) || empty($page[$region])) {
      $page[$region] = array(
        '#region' => $region,
        '#weight' => '-10',
        '#theme_wrappers' => array('region'),
      );
    }
  }
  $responsive_config = theme_get_setting('site_is_responsive');
  if ($responsive_config == 'enabled') {
    drupal_add_css(drupal_get_path('theme', 'cuzen') . '/css/responsive-styles.css');
  } else {
    drupal_add_css(drupal_get_path('theme', 'cuzen') . '/css/fixed-styles.css');
  }
}

function cuzen_preprocess_region(&$variables, $hook) {
  global $base_url;
  switch ($variables['region']) {
    case 'branding':
      $variables['logo'] = theme_get_setting('logo');
      $variables['front_page'] = url('<front>');
      $variables['site_name'] = variable_get('site_name');
      $variables['site_slogan'] = variable_get('site_slogan');
      $variables['print_logo'] = '<img src="' . $base_url . '/' . drupal_get_path('theme','cuzen') . '/images/print-logo.png" alt="University of Colorado Boulder" />'; 
      break;
    case 'secondary_menu':
      $variables['secondary_menu'] = menu_secondary_menu();
      $variables['secondary_menu_heading'] = theme_get_setting('secondary_menu_label') ? theme_get_setting('secondary_menu_label') : '';
      break;
    case 'menu':
      $variables['main_menu'] = menu_main_menu();
      cuzen_home_icon($variables, 'main_menu');
      break;
    case 'after_content':
      $variables['classes_array'][] = 'three-columns';
      break;
    case 'lower':
      $variables['classes_array'][] = 'two-columns';
      break;
    case 'footer':
      $variables['classes_array'][] = 'four-columns';
      break;
    case 'site_info':
      $variables['base_url'] = $base_url;
      $variables['beboulder']['color'] = 'white';
      $variables['classes_array'][] = !empty($variables['content']) ? 'footer-2col' : 'footer-1col';
      break;
  }
}

/**
 * Implements theme_image_style().
 */
function cuzen_image_style(&$variables) {
  // Determine the dimensions of the styled image.
  $dimensions = array(
    'width' => $variables['width'],
    'height' => $variables['height'],
  );
  image_style_transform_dimensions($variables['style_name'], $dimensions);
  $variables['width'] = $dimensions['width'];
  $variables['height'] = $dimensions['height'];
  // Determine the url for the styled image.
  $variables['path'] = image_style_url($variables['style_name'], $variables['path']);
  $variables['attributes']['class'] = array('image-' . $variables['style_name']);
  return theme('image', $variables);
}

function cuzen_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
  if (!empty($breadcrumb)) {
    // Replace the Home breadcrumb with a Home icon
    //$breadcrumb[0] = str_replace('Home','<i class="fa fa-home"></i> <span class="home-breadcrumb element-invisible">Home</span>',$breadcrumb[0]);
    // Get current page title and add to breadcrumb array
    $breadcrumb[] = drupal_get_title();
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
    $output .= '<div class="breadcrumb">' . implode(' / ', $breadcrumb) . '</div>';
    return $output;
  }
}

/**
 * Implements hook_preprocess_node().
 */
function cuzen_preprocess_node(&$variables) {
  // Making comments appear at the bottom of $content
  $variables['content']['comments']['#weight'] = 1000;
  if ($plugin = context_get_plugin('reaction', 'block')) {
    if ($context_content_sidebar_left_blocks = $plugin->block_get_blocks_by_region('content_sidebar_left')) {
      $variables['content_sidebar_left'] = $context_content_sidebar_left_blocks;
      $variables['content_sidebar_left']['#theme_wrappers'] = array('region');
      $variables['content_sidebar_left']['#region'] = 'content_sidebar_left';
      $variables['classes_array'][] = 'content-sidebar-left';
    }
    if ($context_content_sidebar_right_blocks = $plugin->block_get_blocks_by_region('content_sidebar_right')) {
      $variables['content_sidebar_right'] = $context_content_sidebar_right_blocks;
      $variables['content_sidebar_right']['#theme_wrappers'] = array('region');
      $variables['content_sidebar_right']['#region'] = 'content_sidebar_right';
      $variables['classes_array'][] = 'content-sidebar-right';
    }
  }
  if ($content_sidebar_left_blocks = block_get_blocks_by_region('content_sidebar_left')) {
    $variables['content_sidebar_left'] = $content_sidebar_left_blocks;
    $variables['content_sidebar_left']['#theme_wrappers'] = array('region');
    $variables['content_sidebar_left']['#region'] = 'content_sidebar_left';
    $variables['classes_array'][] = 'content-sidebar-left';
  }
  if ($content_sidebar_right_blocks = block_get_blocks_by_region('content_sidebar_right')) {
    $variables['content_sidebar_right'] = $content_sidebar_right_blocks;
    $variables['content_sidebar_right']['#theme_wrappers'] = array('region');
    $variables['content_sidebar_right']['#region'] = 'content_sidebar_right';
    $variables['classes_array'][] = 'content-sidebar-right';
  }
  if (!empty($variables['content_sidebar_left']) && !empty($variables['content_sidebar_right'])) {
    $variables['content_sidebar_left']['#region'] = 'content_sidebars';
    $variables['content_sidebar_right']['#region'] = 'content_sidebars';
  }
  switch ($variables['type']) {
    case 'slider':
      unset($variables['content_sidebar_left']);
      unset($variables['content_sidebar_right']);
      break;
    case 'file':
      unset($variables['content_sidebar_left']);
      unset($variables['content_sidebar_right']);
      break;
    case 'video':
      unset($variables['content_sidebar_left']);
      unset($variables['content_sidebar_right']);
      break;
    case 'person':
      unset($variables['content_sidebar_left']);
      unset($variables['content_sidebar_right']);
      break;
      
    case 'page':
      unset($variables['content']['links']);
      break;
  }
}

function cuzen_menu_link(array $variables) {
  $element = $variables['element'];
  if (isset($element['#localized_options']['icon'])&& strlen($element['#localized_options']['icon']) > 3 ) {
    $element['#localized_options']['html'] = TRUE;
    $hide = isset($element['#localized_options']['hide_text']) ? $element['#localized_options']['hide_text'] : 0;
    $hide_class = $hide ? 'hide-text' : '';
    $space = $hide ? '' : ' ';
    $element['#title'] = '<i class="fa fa-fw ' . $element['#localized_options']['icon'] . '"></i>' . $space . '<span class="' . $hide_class . '">' . $element['#title']  . '</span>';
  }
  $sub_menu = '';
  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}
function cuzen_links__system_main_menu($variables) {
  $classes = join(' ',$variables['attributes']['class']);
  $html = '  <ul class="' . $classes . '">';
  
  // Add first and last classes to first and last list items
  reset($variables['links']);
  $first = key($variables['links']);
  end($variables['links']);
  $last = key($variables['links']);
  reset($variables['links']);
  
  $variables['links'][$first]['attributes']['class'][] = 'first';
  $variables['links'][$last]['attributes']['class'][] = 'last';
  foreach ($variables['links'] as $link) {
    $classes = '';
    if (!empty($link['attributes']['class'])) {
      $classes = join(' ', $link['attributes']['class']);
    }
    if (isset($link['icon']) && strlen($link['icon']) > 3) {
      $link['html'] = TRUE;
      $hide = isset($link['hide_text']) ? $link['hide_text'] : 0;
      $hide_class = $hide ? 'hide-text' : '';
      $space = $hide ? '' : ' ';
      $title = '<i class="fa fa-fw '. $link['icon'] . '"></i>' . $space . '<span class="' . $hide_class . '">' . $link['title'] . '</span>';
      $html .= '<li class="' . $classes .'">'.l($title, $link['href'], $link).'</li>';
    }
    else if (isset($link['title']) && isset($link['href'])) {
      $html .= '<li class="' . $classes .'">'.l($link['title'], $link['href'], $link).'</li>';
    }
  }
  $html .= "  </ul>";
  return $html;
}
function cuzen_links__system_secondary_menu($variables) {
  // Prepare label - set by more_menus.module
  $classes = join(' ',$variables['attributes']['class']);
  $html = '  <ul class="' . $classes . '">';
  $label = variable_get('secondary_menu_label') ? '<h2 class="inline secondary-menu-label">' . variable_get('secondary_menu_label') . '</h2>': '';
  if (theme_get_setting('use_action_menu') && !isset($variables['mobile'])) {
    $html = '  <ul id="action-menu" class="' . $classes . '">';
  } else {
    $html = $label . '  <ul class="' . $classes . '">';
  }
  
  // Add first and last classes to first and last list items
  reset($variables['links']);
  $first = key($variables['links']);
  end($variables['links']);
  $last = key($variables['links']);
  reset($variables['links']);
  
  $variables['links'][$first]['attributes']['class'][] = 'first';
  $variables['links'][$last]['attributes']['class'][] = 'last';
  
  
  foreach ($variables['links'] as $link) {
    $classes = '';
    if (!empty($link['attributes']['class'])) {
      $classes = join(' ', $link['attributes']['class']);
    }
    if (isset($link['icon']) && strlen($link['icon']) > 3) {
      $link['html'] = TRUE;
      $hide = isset($link['hide_text']) ? $link['hide_text'] : 0;
      $hide_class = $hide ? 'hide-text' : '';
      $space = $hide ? '' : ' ';
      $title = '<i class="fa fa-fw '. $link['icon'] . '"></i>' . $space . '<span class="' . $hide_class . '">' . $link['title'] . '</span>';
      $html .= '<li class="' . $classes .'">'.l($title, $link['href'], $link).'</li>';
    }
    else if (isset($link['title']) && isset($link['href'])) {
      $html .= '<li class="' . $classes .'">'.l($link['title'], $link['href'], $link).'</li>';
    }
  }
  $html .= "  </ul>";
  return $html;
}
function cuzen_links__footer_menu($variables) {
  $classes = join(' ',$variables['attributes']['class']);
  $html = '<ul id="footer-menu-links" class="' . $classes . '">';
  
  // Add first and last classes to first and last list items
  reset($variables['links']);
  $first = key($variables['links']);
  end($variables['links']);
  $last = key($variables['links']);
  reset($variables['links']);
  
  $variables['links'][$first]['attributes']['class'][] = 'first';
  $variables['links'][$last]['attributes']['class'][] = 'last';
  foreach ($variables['links'] as $link) {
    $classes = '';
    if (!empty($link['attributes']['class'])) {
      $classes = join(' ', $link['attributes']['class']);
    }
    if (isset($link['icon']) && strlen($link['icon']) > 3) {
      $link['html'] = TRUE;
      $hide = isset($link['hide_text']) ? $link['hide_text'] : 0;
      $hide_class = $hide ? 'hide-text' : '';
      $space = $hide ? '' : ' ';
      $title = '<i class="fa fa-fw '. $link['icon'] . '"></i>' . $space . '<span class="' . $hide_class . '">' . $link['title'] . '</span>';
      $html .= '<li class="' . $classes .'">'.l($title, $link['href'], $link).'</li>';
    }
    else if (isset($link['title']) && isset($link['href'])) {
      $html .= '<li class="' . $classes .'">'.l($link['title'], $link['href'], $link).'</li>';
    }
  }
  $html .= "  </ul>";
  return $html;
}


function cuzen_home_icon(&$variables, $menu) {
  if (isset($variables[$menu])) {
    foreach ($variables[$menu] as $key => $value) {
      if($variables[$menu][$key]['href'] == '<front>') {
        $variables[$menu][$key]['html'] = TRUE;
        $variables[$menu][$key]['title'] = '<i class="fa fa-home"></i><span class="element-invisible">Home</span>';
        $variables[$menu][$key]['attributes']['id'] = 'home-link';
      }
    }
  }
}
/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function cuzen_preprocess_block(&$variables, $hook) {
  // Add a count to all the blocks in the region.
  // $variables['classes_array'][] = 'count-' . $variables['block_id'];

  // By default, Zen will use the block--no-wrapper.tpl.php for the main
  // content. This optional bit of code undoes that:
  //if ($variables['block_html_id'] == 'block-system-main') {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('block__no_wrapper'));
  //}
}
// */
