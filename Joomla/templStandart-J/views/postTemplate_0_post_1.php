<section class="u-align-center u-clearfix u-section-1" id="sec-4901"><!--post_details--><!--post_details_options_json--><!--{"source":""}--><!--/post_details_options_json--><!--blog_post-->
      <div class="u-border-2 u-border-grey-5 u-container-style u-expanded-width u-post-details u-shape-rectangle u-post-details-1">
        
        <div class="u-container-layout u-container-layout-1"><!--blog_post_header-->
          <?php if ($title0): ?><h3 class="u-align-left u-blog-control u-text u-text-1">
            <?php if ($titleLink0): ?><a class="u-post-header-link" href="<?php echo $titleLink0; ?>"><?php endif; ?><?php echo $title0; ?><?php if ($titleLink0): ?></a><?php endif; ?>
          </h3><?php endif; ?><!--/blog_post_header--><!--blog_post_metadata-->
          <?php if (count($metadata0) > 0): ?>
<div class="u-align-left u-blog-control u-metadata u-text-grey-30 u-metadata-1"><!--blog_post_metadata_date-->
            <?php if (isset($metadata0['date'])): ?><span class="u-meta-date u-meta-icon"><?php echo $metadata0['date']; ?></span><?php endif; ?><!--/blog_post_metadata_date--><!--blog_post_metadata_category-->
            <?php if (isset($metadata0['category'])): ?><span class="u-meta-category u-meta-icon"><?php echo $metadata0['category']; ?></span><?php endif; ?><!--/blog_post_metadata_category--><!--blog_post_metadata_comments-->
            <!--/blog_post_metadata_comments-->
	
	<!--/blog_post_metadata_comments--><!--blog_post_metadata_edit-->
                  <?php if (isset($metadata0['edit'])): ?><span class="u-meta-edit u-meta-icon"><?php echo $metadata0['edit']; ?></span><?php endif; ?><!--/blog_post_metadata_edit-->
          </div>
<?php endif; ?><!--/blog_post_metadata--><!--blog_post_image-->
          <?php if ($image0) : ?><img alt="" class="u-blog-control u-image u-image-default lazyload u-image-1" data-src="<?php echo $image0; ?>"><?php else: ?><div class="none-post-image" style="display: none;"></div><?php endif; ?><!--/blog_post_image--><!--blog_post_content-->
          <div class="u-align-justify u-blog-control u-post-content u-text u-text-2"><?php echo $content0; ?></div><!--/blog_post_content-->
        </div>
      </div><!--/blog_post--><!--/post_details-->
    </section>
