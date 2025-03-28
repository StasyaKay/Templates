<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;

$document = Factory::getApplication()->getDocument();

$postStyles = <<<STYLES
<style>
 .u-section-1 {
  min-height: 318px;
}
.u-section-1 .u-post-details-1 {
  min-height: 308px;
  margin-bottom: 0;
  box-shadow: 1px 1px 5px 0 rgba(242,242,242,1);
}
.u-section-1 .u-container-layout-1 {
  padding: 0;
}
.u-section-1 .u-text-1 {
  font-weight: normal;
  text-transform: none;
  line-height: 1.4;
  letter-spacing: 0px;
  margin: 1px 0 0;
}
.u-section-1 .u-metadata-1 {
  margin: -1px auto 0 0;
}
.u-section-1 .u-image-1 {
  height: 170px;
  width: 170px;
  margin: 16px auto 0 8px;
}
.u-section-1 .u-text-2 {
  margin: 16px 8px 0;
}
@media (max-width: 1199px) {

  .u-section-1 .u-image-1 {
    margin-top: 80px;
  }
  .u-section-1 .u-text-2 {
    margin-right: 0;
  }
}
@media (max-width: 991px) {
  .u-section-1 .u-container-layout-1 {
    padding: 0;
  }
}
@media (max-width: 575px) {
  .u-section-1 .u-metadata-1 {
    margin-top: 13px;
  }
  .u-section-1 .u-image-1 {
    margin-top: 67px;
  }
}
</style>
STYLES;
$document->addCustomTag($postStyles);

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

echo $component->pageHeading();

$beforeDisplayContent = $this->item->event->beforeDisplayContent;

$index = 0;
${'title' . $index} = strlen($article->title) ? $this->escape($article->title) : '';
${'titleLink' . $index} = strlen($article->titleLink) ? $article->titleLink : '';
${'shareLink' . $index} = strlen($article->shareLink) ? $article->shareLink : '';

$content = $beforeDisplayContent;
if (strlen($article->text)) {
    $content = $article->text($article->text);
}
if ($article->introVisible) {
    $content .= $article->intro($article->intro);
}
if (strlen($article->readmore)) {
    $content .= $article->readmore($article->readmore, $article->readmoreLink);
}
${'content' . $index} = $content;

${'image' . $index} = $article->images['fulltext']['image'];
${'tags' . $index} = count($article->tags) > 0 ? implode('', $article->tags) : '';

${'metadata' . $index} = array();
if (strlen($article->author)) {
    ${'metadata' . $index}['author'] = $article->authorInfo($article->author, $article->authorLink);
}
if (strlen($article->published)) {
    ${'metadata' . $index}['date'] = $article->publishedDateInfo($article->published);
}
if (strlen($article->category)) {
    ${'metadata' . $index}['category'] = $article->categories($article->parentCategory, $article->parentCategoryLink, $article->category, $article->categoryLink);
}

if ($this->item->params->get('access-edit')) {
    ${'metadata' . $index}['edit']  = $article->editIcon();
}

include_once dirname(dirname(dirname(dirname(__FILE__)))) . '/views/postTemplate_0_post_1.php';

$afterDisplayContent = $this->item->event->afterDisplayContent;
if ($afterDisplayContent) {
    ?>
    <section><div class=""><?php echo $afterDisplayContent; ?></div></section>
<?php } ?>