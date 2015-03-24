<?php
/**
 * @file
 * Returns the HTML for a single Drupal page.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728148
 */
?>

<div id="page" class="<?php print $classes; ?>">
  <div id="header-wrapper" class="section-wrapper">
    <header class="header" id="header" role="banner">    
      <div id="branding">
        <?php print render($page['branding']); ?>
      </div>
      
      <div id="search">
        <?php print render($page['search_box']); ?>
      </div>
      
      
      
  
      <?php //print render($page['header']); ?>
    </header>
  </div>
  <div id="secondary-menu-wrapper" class="section-wrapper">
    <div id="secondary-navigation">
      <?php print render($page['secondary_menu']); ?>
    </div>
  </div>
  <div id="main-menu-wrapper" class="section-wrapper">
    <div id="navigation">
      
      <?php print render($page['menu']); ?>
    </div>
  </div>
  <div id="mobile-navigation">
    <div id="mobile-search">
        <?php print render($page['search_box']); ?>
      </div>
      <?php if ($main_menu): ?>
        <nav id="mobile-menu" role="navigation" tabindex="-1">
          <?php
          // This code snippet is hard to modify. We recommend turning off the
          // "Main menu" on your sub-theme's settings form, deleting this PHP
          // code block, and, instead, using the "Menu block" module.
          // @see https://drupal.org/project/menu_block
          print theme('links__system_main_menu', array(
            'links' => $main_menu,
            'attributes' => array(
              'class' => array('links', 'inline', 'clearfix'),
            ),
            'heading' => array(
              'text' => t('Main menu'),
              'level' => 'h2',
              'class' => array('element-invisible'),
            ),
          )); ?>
        </nav>
      <?php endif; ?>
  </div>
  <div id="intro-wide-wrapper" class="section-wrapper">
    <?php print render($page['intro']); ?>
  </div>
  <div id="slider-wrapper" class="section-wrapper">
    <div id="slider">
      <?php print render($page['slider']); ?>
    </div>
  </div>
  <div id="content-wrapper" class="section-wrapper">
    <div id="main">
      <div id="content" class="column" role="main">
        <?php print render($page['highlighted']); ?>
        <?php print $breadcrumb; ?>
        <a id="main-content"></a>
        <?php print render($title_prefix); ?>
        <?php if ($title): ?>
          <h1 class="page__title title <?php if (isset($title_hidden)) { print 'element-invisible'; } ?>" id="page-title"><?php print $title; ?></h1>
        <?php endif; ?>
        <?php print render($title_suffix); ?>
        <?php print $messages; ?>
        <?php print render($tabs); ?>
        <?php print render($page['help']); ?>
        <?php if ($action_links): ?>
          <ul class="action-links"><?php print render($action_links); ?></ul>
        <?php endif; ?>
        <?php print render($page['content']); ?>
        <?php print $feed_icons; ?>
      </div>
  
      
      <?php
        // Render the sidebars to see if there's anything in them.
        $sidebar_first  = render($page['sidebar_first']);
        $sidebar_second = render($page['sidebar_second']);
      ?>
  
      <?php if ($sidebar_first || $sidebar_second): ?>
        <aside class="sidebars">
          <?php print $sidebar_second; ?>
          <?php print $sidebar_first; ?>
          
        </aside>
      <?php endif; ?>
  
    </div>
  </div>
  <div id="post-wide-wrapper" class="section-wrapper">
    <?php print render($page['wide_2']); ?>
  </div>
  <div id="after-content-wrapper" class="section-wrapper">
    <div id="after-content">
      <?php print render($page['after_content']); ?>
    </div>
  </div>
  <div id="after-content2-wrapper" class="section-wrapper">
    <div id="after-content-2">
      <?php print render($page['lower']); ?>
    </div>
  </div>
  <div id="footer-section">
    <div id="footer-wrapper" class="section-wrapper">
      <div id="footer">
        <?php print render($page['footer']); ?>
      </div>
    </div>
    <?php if (isset($footer_menu)): ?>
      <div id="footer-menu-wrapper" class="section-wrapper <?php print $footer_menu_color; ?>">
        <div id="footer-menu">
          <?php print theme('links__footer_menu', array('links' => $footer_menu, 'attributes' => array('id' => 'footer-menu-links', 'class' => array('links', 'inline-menu', 'clearfix')), 'heading' => array('text' => t('Footer menu'),'level' => 'h2','class' => array('element-invisible')))); ?>
        </div>
      </div>
    <?php endif; ?>
    <div id="site-info-wrapper" class="section-wrapper">
      <div id="site-info">
        <?php print render($page['site_info']); ?>
      </div>
    </div>
  </div>

  

</div>


<?php print render($page['bottom']); ?>
