<?php

function cutradition_form_system_theme_settings_alter(&$form, &$form_state) {
  $theme = $form_state['build_info']['args'][0];
	$form['cutradition_theme_settings'] = array(
		'#type' => 'fieldset', 
		'#title' => t('cutradition Theme Settings'), 
		'#collapsible' => TRUE, 
		'#collapsed' => TRUE,
	);
	
	$form['cutradition_theme_settings']['layout_style'] = array(
	  '#type' => 'radios', 
	  '#title' => t('Layout Style'), 
	  '#default_value' => theme_get_setting('layout_style', 'alumni') ? theme_get_setting('layout_style', 'alumni') : 'layout-wide', 
	  '#description' => t('Pick a layout style for your site.'),
	  '#options' => array(
      'layout-wide' => t('Wide'),
      'layout-boxed' => t('Boxed'),
    ),
	);	
}