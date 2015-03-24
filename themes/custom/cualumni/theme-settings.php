<?php
/**
 * Implements hook_form_system_theme_settings_alter().
 *
 * @param $form
 *   Nested array of form elements that comprise the form.
 * @param $form_state
 *   A keyed array containing the current state of the form.
 */
function cuzen_form_system_theme_settings_alter(&$form, &$form_state, $form_id = NULL)  {
  // Work-around for a core bug affecting admin themes. See issue #943212.
  if (isset($form_id)) {
    return;
  }

  $theme = $form_state['build_info']['args'][0];
	$form['cuzen_theme_settings'] = array(
		'#type' => 'fieldset', 
		'#title' => t('Theme Settings'),
	);
	$form['cuzen_theme_settings']['responsive'] = array(
		'#type' => 'fieldset', 
		'#title' => t('Responsive/Mobile Friendly'), 
		'#collapsible' => TRUE, 
		'#collapsed' => TRUE,
	);
	$form['cuzen_theme_settings']['responsive']['site_is_responsive'] = array(
	  '#type' => 'radios', 
	  '#title' => t('Enable responsive/mobile friendly design'), 
	  '#default_value' => theme_get_setting('site_is_responsive', $theme) ? theme_get_setting('site_is_responsive', $theme) : 'disabled', 
	  '#description' => t('Pick a style for your sites headings.'),
	  '#options' => array(
      'disabled' => t('Disabled'),
      'enabled' => t('Enabled'),
    ),
	);
	$form['cuzen_theme_settings']['typography'] = array(
		'#type' => 'fieldset', 
		'#title' => t('Typography'), 
		'#collapsible' => TRUE, 
		'#collapsed' => TRUE,
	);
	
	$form['cuzen_theme_settings']['typography']['headings'] = array(
	  '#type' => 'radios', 
	  '#title' => t('Heading Style'), 
	  '#default_value' => theme_get_setting('headings', $theme) ? theme_get_setting('headings', $theme) : 'headings-bold', 
	  '#description' => t('Pick a style for your sites headings.'),
	  '#options' => array(
      'headings-bold' => t('Bold'),
      'headings-light' => t('Light'),
    ),
	);
	if (module_exists('cu_title_image')) {
    $form['cuzen_theme_settings']['page_title_image'] = array(
  		'#type' => 'fieldset', 
  		'#title' => t('Page Title Image'), 
  		'#collapsible' => TRUE, 
  		'#collapsed' => TRUE,
  	);
  	$form['cuzen_theme_settings']['page_title_image']['page_title_image_background'] = array(
  	  '#type' => 'radios', 
  	  '#title' => t('Page Title Image Style'), 
  	  '#default_value' => theme_get_setting('page_title_image_background', $theme) ? theme_get_setting('page_title_image_background', $theme) : 'page-title-image-background-white', 
  	  '#description' => t('Pick a style for page title image text.'),
  	  '#options' => array(
        'page-title-image-background-white' => t('Solid'),
        'page-title-image-background-transparent' => t('Transparent'),
      ),
  	);
	}
	
	$form['cuzen_theme_settings']['columns'] = array(
		'#type' => 'fieldset', 
		'#title' => t('Column Options'), 
		'#collapsible' => TRUE, 
		'#collapsed' => TRUE,
	);
	$form['cuzen_theme_settings']['columns']['after_content_columns'] = array(
	  '#type' => 'radios', 
	  '#title' => t('After Content Columns'), 
	  '#default_value' => theme_get_setting('after_content_columns', $theme) ? theme_get_setting('after_content_columns', $theme) : '3', 
	  '#description' => t('Pick how many columns for blocks after the content'),
	  '#options' => array(
      '6' => t('6'),
      '4' => t('4'),
      '3' => t('3'),
      '2' => t('2'),
      '1' => t('1'),
    ),
	);
	 $form['cuzen_theme_settings']['columns']['lower_columns'] = array(
	  '#type' => 'radios', 
	  '#title' => t('After Content 2 Columns'), 
	  '#default_value' => theme_get_setting('lower_columns', $theme) ? theme_get_setting('lower_columns', $theme) : '2', 
	  '#description' => t('Pick how many columns for blocks in the second after content region'),
	  '#options' => array(
      '6' => t('6'),
      '4' => t('4'),
      '3' => t('3'),
      '2' => t('2'),
      '1' => t('1'),
    ),
	);
  $form['cuzen_theme_settings']['columns']['footer_columns'] = array(
	  '#type' => 'radios', 
	  '#title' => t('Footer Columns'), 
	  '#default_value' => theme_get_setting('footer_columns', $theme) ? theme_get_setting('footer_columns', $theme) : '4', 
	  '#description' => t('Pick how many columns for blocks in the footer'),
	  '#options' => array(
      '6' => t('6'),
      '4' => t('4'),
      '3' => t('3'),
      '2' => t('2'),
      '1' => t('1'),
    ),
	);
	
	$form['cuzen_theme_settings']['breadcrumbs'] = array(
		'#type' => 'fieldset', 
		'#title' => t('Breadcrumbs'), 
		'#collapsible' => TRUE, 
		'#collapsed' => TRUE,
	);
	$form['cuzen_theme_settings']['breadcrumbs']['use_breadcrumbs'] = array(
    '#type' => 'checkbox', 
   	'#title' => t('Use Breadcrumbs'), 
   	'#default_value' => theme_get_setting('use_breadcrumbs', $theme) ? theme_get_setting('use_breadcrumbs', $theme) : FALSE, 
   	'#description' => t('Enable breadcrumb navigation.'),
  );  
  $form['cuzen_theme_settings']['action_menu'] = array(
    '#type' => 'fieldset',
    '#title' => t('Secondary Menu'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['cuzen_theme_settings']['action_menu']['use_action_menu'] = array(
    '#type' => 'checkbox',
    '#title' => t('Placement'),
    '#default_value' => theme_get_setting('use_action_menu', $theme) ? theme_get_setting('use_action_menu', $theme) : FALSE,
    '#description' => t('Place secondary menu as buttons on main navigation bar. Secondary menu label does not display when this option is selected.'),
  );
  $form['cuzen_theme_settings']['action_menu']['action_menu_color'] = array(
	  '#type' => 'radios', 
	  '#title' => t('Color'), 
	  '#default_value' => theme_get_setting('action_menu_color', $theme) ? theme_get_setting('action_menu_color', $theme) : 'action-none', 
	  '#description' => t('Pick color for action menu'),
	  '#options' => array(
      'action-blue' => t('Blue'),
      'action-gray' => t('Gray'),
      'action-gold' => t('Gold'),
      'action-none' => t('None (same as main menu navigation)'),
    ),
	);
	$form['cuzen_theme_settings']['footer_menu'] = array(
    '#type' => 'fieldset',
    '#title' => t('Footer Menu'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['cuzen_theme_settings']['footer_menu']['footer_menu_color'] = array(
	  '#type' => 'radios', 
	  '#title' => t('Color'), 
	  '#default_value' => theme_get_setting('footer_menu_color', $theme) ? theme_get_setting('footer_menu_color', $theme) : 'footer-menu-gray', 
	  '#description' => t('Pick color for footer menu.'),
	  '#options' => array(
      'footer-menu-gray' => t('Gray'),
      'footer-menu-gold' => t('Gold'),
    ),
	);
	
	$form['cuzen_theme_settings']['block_icons'] = array(
    '#type' => 'fieldset',
    '#title' => t('Block Icons'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['cuzen_theme_settings']['block_icons']['block_icons_color'] = array(
	  '#type' => 'radios', 
	  '#title' => t('Color'), 
	  '#default_value' => theme_get_setting('block_icons_color', $theme) ? theme_get_setting('block_icons_color', $theme) : 'block-icons-inherit', 
	  '#description' => t('Pick color for block title icons.'),
	  '#options' => array(
	    'block-icons-inherit' => t('Same as block title text'),
      'block-icons-gray' => t('Gray'),
      'block-icons-gold' => t('Gold'),
    ),
	);

  // Remove some of the base theme's settings.
  /* -- Delete this line if you want to turn off this setting.
  unset($form['themedev']['zen_wireframes']); // We don't need to toggle wireframes on this site.
  // */

  // We are editing the $form in place, so we don't need to return anything.
}
