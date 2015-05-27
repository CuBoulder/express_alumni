<?php if(!drupal_is_front_page()): ?>
<div class="page-title-wrapper" style="background-image:url(<?php print $title_image; ?>);">
  <div class="page-title-section container-12 clearfix">
    
    <?php if (isset($title_image)): ?>
      <div id="page-title-image-wrapper" class="grid-<?php print $columns; ?>" >        
        <div id="page-title-image">
          <h1 id="page-title-image-title"><?php print drupal_get_title(); ?></h1>
        </div>
      </div>
    <?php else: ?>
      <div class="title-wrapper grid-<?php print $columns; ?>">
        <h1 class="title <?php if (strlen(drupal_get_title()) > 25) { print 'long-title'; } ?>" id="page-title"><?php print drupal_get_title(); ?></h1>
      </div>
    <?php endif; ?>
    <?php if ($breadcrumb): ?>
      <div id="breadcrumb" class="grid-<?php print $columns; ?>"><?php print $breadcrumb; ?></div>
    <?php endif; ?>    
  </div>
</div>
<?php endif; ?> 

<?php if ($wrapper): ?><div<?php print $attributes; ?>><?php endif; ?>  
  <div<?php print $content_attributes; ?>>    
       
    <?php if ($messages): ?>
      <div id="messages" class="grid-<?php print $columns; ?>"><?php print $messages; ?></div>
    <?php endif; ?>
    <?php print $content; ?>
  </div>
<?php if ($wrapper): ?></div><?php endif; ?>