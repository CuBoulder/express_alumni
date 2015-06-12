<?php if($view_mode == 'teaser'): ?>
  <div class="gallery-view-mode-teaser node-view-mode-teaser clearfix">
    <?php if(!empty($content['field_photo'][0])): ?>
      <?php print render($content['field_photo'][0]); ?>
    <?php endif; ?>
    <div class="gallery-view-mode-teaser-content node-view-mode-teaser-content">
      <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
      <div class="gallery-summary"><?php print render($content['body']); ?></div>
    </div>
  </div>
<?php elseif($view_mode == 'embed'): ?>
  <div class="gallery-view-mode-embed node-view-mode-embed clearfix">
    <div class="gallery-view-mode-embed-content node-view-mode-embed-content">
      <h3<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h3>
      <div class="node-view-mode-embed-summary gallery-view-mode-embed-summary"><?php print render($content['body']); ?></div>
      <?php print render($content); ?>
    </div>
  </div>
<?php elseif($view_mode == 'sidebar'): ?>
  <div class="gallery-view-mode-sidebar clearfix node-view-mode-sidebar">
    <?php if(!empty($content['field_photo'][0])): ?>
      <?php print render($content['field_photo'][0]); ?>
    <?php endif; ?>
    <div class="gallery-view-mode-sidebar-content node-view-mode-sidebar-content">
      <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
    </div>
  </div>
<?php elseif($view_mode == 'title'): ?>
  <div class="gallery-view-mode-title node-view-mode-title clearfix">
    <div class="gallery-view-mode-titles-content node-view-mode-titles-content">
      <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
    </div>
  </div>
<?php else: ?>
  <?php print render($content); ?>
<?php endif; ?>