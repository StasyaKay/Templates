<!--blog_post-->
            <div class="u-align-left u-blog-post u-container-style u-repeater-item u-white u-repeater-item-1">  
  

              <div class="u-container-layout u-similar-container u-valign-top u-container-layout-1"><!--blog_post_header-->
                <?php if ($title0): ?><h4 class="u-blog-control u-text u-text-default u-text-1">
                  <?php if ($titleLink0): ?><a class="u-post-header-link" href="<?php echo $titleLink0; ?>"><?php endif; ?><?php echo $title0; ?><?php if ($titleLink0): ?></a><?php endif; ?>
                </h4><?php endif; ?><!--/blog_post_header--><!--blog_post_metadata-->
                <?php if (count($metadata0) > 0): ?>
<div class="u-blog-control u-metadata u-metadata-1"><!--blog_post_metadata_date-->
                  <?php if (isset($metadata0['date'])): ?><span class="u-meta-date u-meta-icon"><?php echo $metadata0['date']; ?></span><?php endif; ?><!--/blog_post_metadata_date-->
	<!--/blog_post_metadata_comments--><!--blog_post_metadata_edit-->
                  <?php if (isset($metadata0['edit'])): ?><span class="u-meta-edit u-meta-icon"><?php echo $metadata0['edit']; ?></span><?php endif; ?><!--/blog_post_metadata_edit-->
                </div>
<?php endif; ?><!--/blog_post_metadata--><!--blog_post_content-->
                <div class="u-blog-control u-post-content u-text u-text-2"><?php echo $content0; ?></div><!--/blog_post_content--><!--blog_post_readmore-->
                <?php if ($readmoreLink0): ?><a href="<?php echo $readmoreLink0; ?>" class="u-blog-control u-btn u-button-style u-hover-palette-1-base u-text-hover-white u-text-palette-1-base u-btn-1">Подробнее</a><?php endif; ?><!--/blog_post_readmore-->
              </div>
            </div><!--/blog_post-->