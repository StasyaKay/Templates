<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;

$document = Factory::getApplication()->getDocument();

$blogStyles = <<<STYLES
<style>
.u-section-1 .u-sheet-1 {
  min-height: 181px;
}
.u-section-1 .u-group-1 {
  background-image: none;
  box-shadow: 1px 1px 5px 0 rgba(242,242,242,1);
  margin-top: 0;
  margin-bottom: 0;
  min-height: 159px;
}
.u-section-1 .u-repeater-1 {
  grid-template-columns: 100%;
  grid-gap: 0px 0px;
  min-height: 159px;
}
.u-section-1 .u-repeater-item-1 {
  margin-top: 20px;
  margin-bottom: 0;
}
.u-section-1 .u-container-layout-1 {
  padding: 0;
}
.u-section-1 .u-group-1 {
  background-image: none;
  box-shadow: 1px 1px 5px 0 rgba(242,242,242,1);
  margin-top: 0;
  margin-bottom: 0;
  min-height: 159px;
}
.u-section-1 .u-container-layout-2 {
  padding-left: 0;
  padding-right: 0;
}
.u-section-1 .u-text-1 {
  text-transform: none;
  font-size: 1.875rem;
  margin: 0;
}
.u-section-1 .u-metadata-1 {
  text-transform: none;
  margin: 0 auto 0 0;
}
.u-section-1 .u-text-2 {
  margin: 13px 7px 0;
}
.u-section-1 .u-btn-1 {
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: normal;
  margin: 0 7px 0 auto;
}
.u-section-1 .u-gallery-nav-1 {
  position: absolute;
  left: 10px;
  width: 40px;
  height: 40px;
}
.u-section-1 .u-gallery-nav-2 {
  position: absolute;
  width: 40px;
  height: 40px;
  left: auto;
  top: 213px;
  right: 13px;
}
@media (max-width: 1199px) {
  .u-section-1 .u-repeater-1 {
    height: 222px;
    margin-top: 0;
    margin-bottom: 0;
  }
  .u-section-1 .u-container-layout-2 {
    padding-top: 0;
    padding-bottom: 0;
  }
  .u-section-1 .u-text-2 {
    border-style: none none solid;
    margin-right: 0;
    margin-left: 0;
    padding: 0;
  }
  .u-section-1 .u-btn-1 {
    border-style: solid;
    margin-right: 0;
  }
}
@media (max-width: 991px) {
  .u-section-1 .u-container-layout-1 {
    padding: 0;
  }
  .u-section-1 .u-container-layout-2 {
    padding-left: 0;
    padding-right: 0;
  }
}
@media (max-width: 575px) {
  .u-section-1 .u-text-1 {
    font-size: 1.5rem;
  }
}
.u-section-1 .u-sheet-2 {
  min-height: 20px;
}
 .u-section-2 {
  min-height: 59px;
}

</style>
STYLES;
$document->addCustomTag($blogStyles);

$backToTop = <<<BACKTOTOP
<span style="height: 64px; width: 64px; margin-left: 0px; margin-right: auto; margin-top: 0px; right: 20px; bottom: 20px;" class="u-back-to-top u-icon u-opacity u-opacity-85 u-spacing-15 u-text-palette-5-base" data-href="#">
        <svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 551.13 551.13"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-1d98"></use></svg>
        <svg class="u-svg-content" enable-background="new 0 0 551.13 551.13" viewBox="0 0 551.13 551.13" xmlns="http://www.w3.org/2000/svg" id="svg-1d98"><path d="m275.565 189.451 223.897 223.897h51.668l-275.565-275.565-275.565 275.565h51.668z"></path></svg>
    </span>
BACKTOTOP;
$popupDialogs=<<<DIALOGS

DIALOGS;
$settings = array(
    'hideHeader' => false,
    'hideFooter' => false,
    'bodyClass' => 'u-body u-xl-mode',
    'bodyStyle' => "",
    'localFontsFile' => "",
    'backToTop' => $backToTop,
    'popupDialogs' => $popupDialogs,
);
echo '<!--component_settings-->' . json_encode($settings) . '<!--/component_settings-->';

?>
<?php

$funcsInfo = array(
   array('repeatable' => true, 'name' => 'blogTemplate_0_blog_1', 'itemsExists' => true),

);

$funcsStaticInfo = array(
   array('repeatable' => false, 'name' => 'blogTemplate_1_blog_1'),

);

if ($this->params->get('show_page_heading')) {
    echo '<section class="u-clearfix"><div class="u-clearfix u-sheet"><h1>';
    echo $this->params->get('page_heading');
    echo '</h1></div></section>';
}

if (count($funcsInfo)) {
    foreach ($funcsInfo as $funcInfo) {
        if (!$funcInfo['itemsExists']) {
            include $themePath . '/views/' . $funcInfo['name'] . '.php';
            continue;
        }
        if (file_exists($themePath . '/views/' . $funcInfo['name'] . '_start.php')) {
            include $themePath . '/views/' . $funcInfo['name'] . '_start.php';
        }
        foreach ($allItems as $item) {
            $j = 0;
            $article = $component->article('archive', $item, $item->params);

            ${'title' . $j} = strlen($article->title) ? $this->escape($article->title) : '';
            ${'titleLink' . $j} = strlen($article->titleLink) ? $article->titleLink : '';

            // Readmore button not need on archive blog
            ${'readmore' . $j} = '';
            ${'readmoreLink' . $j} = '';

            ${'shareLink' . $j} = strlen($article->shareLink) ? $article->shareLink : '';
            ${'content' . $j} = $article->intro(funcBalanceTags($article->intro));
            ${'postItemInvisible' . $j} = true;
            ${'image' . $j} = null;
            ${'tags' . $j} = null;

            ${'metadata' . $j} = array();
            if (strlen($article->author)) {
                ${'metadata' . $j}['author'] = $article->authorInfo($article->author, $article->authorLink);
            }
            if (strlen($article->published)) {
                ${'metadata' . $j}['date'] = $article->publishedDateInfo($article->published);
            }
            if (strlen($article->category)) {
                ${'metadata' . $j}['category'] = $article->categories($article->parentCategory, $article->parentCategoryLink, $article->category, $article->categoryLink);
            }
            include $themePath . '/views/' . $funcInfo['name'] . '.php';
        }
        if (file_exists($themePath . '/views/' . $funcInfo['name'] . '_end.php')) {
            include $themePath . '/views/' . $funcInfo['name'] . '_end.php';
        }
    }
}

if (count($funcsStaticInfo)) {
    for ($i = 0; $i < count($funcsStaticInfo); $i++) {
        include_once $themePath . '/views/' . $funcsStaticInfo[$i]['name'] . '.php';
    }
}