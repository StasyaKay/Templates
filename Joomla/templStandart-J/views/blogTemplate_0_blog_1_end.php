
          </div>
          <div class="u-list-control"><!--blog_pagination--><!--blog_pagination_options_json--><!--{"ul":"style=\"\" class=\"responsive-style1 u-pagination u-unstyled\"","li":"style=\"\" class=\"u-nav-item u-pagination-item\"","link":"style=\"padding: 16px 28px;\" class=\"u-button-style u-nav-link\""}--><!--/blog_pagination_options_json-->
            <?php 
$GLOBALS['theme_pagination_styles'] = array(
    'ul' => 'style="" class="responsive-style1 u-pagination u-unstyled"',
    'li' => 'style="" class="u-nav-item u-pagination-item"',
    'link' => 'style="padding: 16px 28px;" class="u-button-style u-nav-link"'
);
?><?php if (property_exists($this, 'pagination')) { echo $this->pagination->getPagesLinks();  }  ?><!--/blog_pagination-->
          </div>
        </div>
      </div>
    </section>