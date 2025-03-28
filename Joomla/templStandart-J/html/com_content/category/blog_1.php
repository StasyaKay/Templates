<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;

$document = Factory::getApplication()->getDocument();

$blogStyles = <<<STYLES
<style>
.u-section-1 .u-sheet-1 {
  min-height: 171px;
}
.u-section-1 .u-blog-1 {
  margin: 2px 0 4px;
}
.u-section-1 .u-repeater-1 {
  grid-auto-columns: 100%;
  grid-template-columns: 100%;
  grid-gap: 22px 22px;
  min-height: 165px;
}
.u-section-1 .u-repeater-item-1 {
  background-image: none;
  box-shadow: 1px 1px 5px 0 rgba(192,192,192,1);
}
.u-section-1 .u-container-layout-1 {
  padding: 0;
}
.u-section-1 .u-text-1 {
  width: 100%;
  background-color: var(--tempcolor);
  color: #fff;
  padding: 5px;
  margin: 0;
}
.u-section-1 .u-metadata-1 {
  margin: 10px auto 0 10px;
}
.u-section-1 .u-text-2 {
  margin: 10px 10px 0;
}
.u-section-1 .u-btn-1 {
  letter-spacing: 1px;
  background-image: none;
  margin: 10px 10px 10px auto;
  border: 1px solid;
  border-color: var(--tempcolor);
}
@media (max-width: 1199px) {
  .u-section-1 .u-blog-1 {
    min-height: 375px;
    margin-right: initial;
    margin-left: initial;
  }
  .u-section-1 .u-text-1 {
    margin-left: 0;
  }
  .u-section-1 .u-text-2 {
    margin-right: 0;
  }
  .u-section-1 .u-btn-1 {
    margin-right: 0;
  }
}
@media (max-width: 991px) {
  .u-section-1 .u-container-layout-1 {
    padding: 0;
  }
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

);

echo $component->pageHeading();

if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) {
    echo '<section class="u-clearfix"><div class="u-clearfix"><h2>';
    echo $this->params->get('page_subheading');
    if ($this->params->get('show_category_title')) {
        echo ' <span class="subheading-category">' . $this->category->title . '</span>';
    }
    echo '</h2></div></section>';
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

        $imagesEtalonItems = array();
        $imagesJsonPath = $themePath . '/views/images.json';
        if (file_exists($imagesJsonPath)) {
            ob_start();
            include_once $imagesJsonPath;
            $imagesEtalonItems = json_decode(ob_get_clean(), true);
        }
        $imagesEtalonItem = isset($imagesEtalonItems[$funcInfo['name']]) ? $imagesEtalonItems[$funcInfo['name']] : array();

        foreach ($allItems as $itemIndex => $item) {
            $j = 0;
            $article = $component->article('category', $item, $item->params);
            $beforeDisplayContent = $item->event->beforeDisplayContent;
            ${'title' . $j} = strlen($article->title) ? $this->escape($article->title) : '';
            ${'titleLink' . $j} = strlen($article->titleLink) ? $article->titleLink : '';
            ${'readmore' . $j} = strlen($article->readmore) ? $article->readmore : '';
            ${'readmoreLink' . $j} = strlen($article->readmoreLink) ? $article->readmoreLink : '';
            ${'shareLink' . $j} = strlen($article->shareLink) ? $article->shareLink : '';
            ${'content' . $j} = $beforeDisplayContent . $article->intro(funcBalanceTags($article->intro));

            if ($article->images['intro']['image']) {
                $image = $article->images['intro']['image'];
            } else {
                $imagesPostItem = property_exists($item, 'pageIntroImgStruct') ? $item->pageIntroImgStruct : array();
                $image = getProportionImage($imagesPostItem, $imagesEtalonItem);
            }

            ${'postItemInvisible' . $j} = !$image ? true : false;
            ${'image' . $j} = $image;
            ${'tags' . $j} = count($article->tags) > 0 ? implode('', $article->tags) : '';

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
            if ($item->params->get('access-edit')) {
                ${'metadata' . $j}['edit'] = $article->editIcon();
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