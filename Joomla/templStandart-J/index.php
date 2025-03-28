<?php

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\HTML\HTMLHelper;

$indexDir = dirname(__FILE__);
require_once $indexDir . '/functions.php';

HTMLHelper::_('jquery.framework');
HTMLHelper::_('bootstrap.framework');

$app = Factory::getApplication();
$config = $app->getConfig();
$sef = $app->get('sef', false);

$defaultLogo = getLogoInfo(array('src' => "/images/education-logo.png"));

// Create alias for $this object reference:
$document = $this;

$currentUrl = Uri::getInstance()->toString();
if ($sef)
{
    $document->setBase($currentUrl);
}

$metaGeneratorContent = '';
if ($metaGeneratorContent) {
    $document->setMetaData('generator', $metaGeneratorContent);
}

$templateUrl = $document->baseurl . '/templates/' . $document->template;
// $faviconPath = "favicon.png" ? $templateUrl . '/images/' . "favicon.png" : '';

Core::load("Core_Page");
Core::load("Core_PageProperties");

// Initialize $view:
$this->view = new CorePage($this);

$pageProperties = new CorePageProperties($this);
$bodyClass = $pageProperties->getBodyClass('u-body u-xl-mode');
$bodyStyle = $pageProperties->getBodyStyle();
$backToTop = $pageProperties->getBackToTop();
$popupDialogs = $pageProperties->getPopupDialogs();
$showHeader = $pageProperties->showHeader();
$showFooter = $pageProperties->showFooter();
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
  
<?php if ($this->params->get('templateColor'))
	{
		$this->addStyleDeclaration('
		:root  {
		 --tempcolor: '.$this->params->get('templateColor').'!important;
		}
		        
		');
	}
?>	
	<?php if ($this->params->get('templateakcentColor'))
	{
		$this->addStyleDeclaration('
		 :root  {
		 --tempakcentcolor: '.$this->params->get('templateakcentColor').';
		}
		
		');
	}
?>	
  
  
  
  
  
<!--    <?php // if ($faviconPath) : ?>
        <link href="<?php // echo $faviconPath; ?>" rel="icon" type="image/x-icon" />
    <?php // endif; ?> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <?php echo CoreStatements::head(); ?>
    <meta name="theme-color" content="#0a75a0">
    <link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/default.css" media="screen" type="text/css" />
    <?php if($this->view->isFrontEditing()) : ?>
        <link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/frontediting.css" media="screen" type="text/css" />
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/template.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/media.css" id="theme-media-css" media="screen" type="text/css" />
    <link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/fonts.css" media="screen" type="text/css" /><?php if (isset($document->localFontsFile)) : ?><link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/<?php echo $document->localFontsFile; ?>" media="screen" type="text/css" /><?php else : ?><?php endif; ?>
    <?php include_once "$indexDir/styles.php"; ?>
    <?php if ($this->params->get('jquery', '0') == '1') : ?>
        <script src="<?php echo $templateUrl; ?>/scripts/jquery.js"></script>
    <?php endif; ?>
    <script src="<?php echo $templateUrl; ?>/scripts/script.js"></script>
    <?php if ($this->params->get('jsonld', '0') == '1') : ?>
    <script type="application/ld+json">
{
	"@context": "http://schema.org",
	"@type": "Organization",
	"name": "<?php echo $config->get('sitename'); ?>",
	"sameAs": [],
	"url": "<?php echo JUri::getInstance()->toString(); ?>",
	"logo": "<?php echo $defaultLogo['src']; ?>"
}
</script>
    <?php
    if ($currentUrl == Uri::base()) {
    ?>
        <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "WebSite",
      "name": "<?php echo $config->get('sitename'); ?>",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "<?php echo JUri::base() . 'index.php?searchword={query' . '}&option=com_search'; ?>",
        "query-input": "required name=query"
      },
      "url": "<?php echo $currentUrl; ?>"
    }
    </script>
    <?php } ?>
    <?php endif; ?>
    <?php if ($this->params->get('metatags', '0') == '1') : ?>
        <?php
        renderSeoTags($document->seoTags);
        ?>
    <?php endif; ?>
   
	<?php $logoInfo = getLogoInfo(array(
            'src' => "/images/education-logo.png",
            'href' => "#",
        ), true); ?>
    <link  rel="shortcut icon" type="image/svg" href="<?php echo $logoInfo['src']; ?>"/>

	<script src="https://kit.fontawesome.com/6a3dcf1097.js" crossorigin="anonymous"></script>
  
  <!-- Button visually impaired CSS-->
  
  <link rel="stylesheet" href="<?php echo $templateUrl; ?>/bvi/dist/css/bvi.min.css" type="text/css">
	
	<!-- user css -->
  <?php if ($this->params->get('usercss')){
    $userstyle = '<style>' . $this->params->get('usercss') . '</style>';}?>
  <?php echo $userstyle; ?>
</head>
<body <?php echo $bodyClass . $bodyStyle; ?>>
<?php
if ($showHeader) {
    $this->view->renderHeader($indexDir, $this->params);
}
?>
<div class="wrap-content"> 
<div class="u-section-rows">
        <div class="u-align-justify u-section-row" id="pageslider">
          <?php $positionName = 'pageslider'; if ($positionName && CoreStatements::containsModules($positionName)) : ?><div data-position="pageslider" class=""><!--block-->
                  <?php echo CoreStatements::position('pageslider', 'block', 'block_top'); ?><!--/block-->
                </div><?php else: ?><div class="hidden-position" style="display:none"></div><?php endif; ?><!--/position-->
          
         </div>
        <div class="u-align-justify u-section-row" id="modbreadcrumbs">
            <?php $positionName = 'breadcrumb'; if ($positionName && CoreStatements::containsModules($positionName)) : ?><div data-position="breadcrumb" class="breadcrumbs u-sheet"><!--block-->
                    <?php echo CoreStatements::position('breadcrumb', 'block', 'block_breadcrumb'); ?><!--/block-->
                  </div><?php else: ?><div class="hidden-position" style="display:none"></div><?php endif; ?><!--/position-->
          </div>
</div> 

<div class="u-section-rows">
	<nav class="mod-icon">
        <div class="u-section-row u-section-row-3" id="imeny">
          <div class="u-clearfix u-sheet u-sheet-2">
            <?php echo CoreStatements::position('imeny', '', 4, 'imeny'); ?>
          </div>
        </div>
  </nav>
 
</div>
  
<div class="u-section-rows">
        <div class="u-section-row u-section-row-3" id="banner-top">
          <?php $positionName = 'banner-top'; if ($positionName && CoreStatements::containsModules($positionName)) : ?><div data-position="banner-top" class="banner-top u-sheet"><!--block-->
                  <?php echo CoreStatements::position('banner-top', 'block', 'banner-top'); ?><!--/block-->
                </div><?php else: ?><div class="hidden-position" style="display:none"></div><?php endif; ?><!--/position-->
          
         </div>
</div>
  
<div class="u-section-rows top-i">
  <div class="banner-top-i u-sheet">
        <div class="u-section-row u-section-row-3" id="top1">
          <?php $positionName = 'top1'; if ($positionName && CoreStatements::containsModules($positionName)) : ?><div data-position="top1" class="top1"><!--block-->
                  <?php echo CoreStatements::position('top1', 'block', 'top1'); ?><!--/block-->
                </div><?php else: ?><div class="hidden-position" style="display:none"></div><?php endif; ?><!--/position-->
          
         </div>
  
  		<div class="u-section-row u-section-row-3" id="top2">
          <?php $positionName = 'top2'; if ($positionName && CoreStatements::containsModules($positionName)) : ?><div data-position="top2" class="top2"><!--block-->
                  <?php echo CoreStatements::position('top2', 'block', 'top2'); ?><!--/block-->
                </div><?php else: ?><div class="hidden-position" style="display:none"></div><?php endif; ?><!--/position-->
          
         </div>
  
  		<div class="u-section-row u-section-row-3" id="top3">
          <?php $positionName = 'top3'; if ($positionName && CoreStatements::containsModules($positionName)) : ?><div data-position="top3" class="top3"><!--block-->
                  <?php echo CoreStatements::position('top3', 'block', 'top3'); ?><!--/block-->
                </div><?php else: ?><div class="hidden-position" style="display:none"></div><?php endif; ?><!--/position-->
          
         </div>
    </div>
</div> 
  
<?php $this->view->renderLayout(); ?>
  

 
<div class="u-section-rows bottom-i">
  <div class="banner-bottom-i u-sheet">
        <div class="u-section-row u-section-row-3" id="bottom1">
          <?php $positionName = 'bottom1'; if ($positionName && CoreStatements::containsModules($positionName)) : ?><div data-position="bottom1" class="bottom1"><!--block-->
                  <?php echo CoreStatements::position('bottom1', 'block', 'bottom1'); ?><!--/block-->
                </div><?php else: ?><div class="hidden-position" style="display:none"></div><?php endif; ?><!--/position-->
          
         </div>
  
  		<div class="u-section-row u-section-row-3" id="bottom2">
          <?php $positionName = 'bottom2'; if ($positionName && CoreStatements::containsModules($positionName)) : ?><div data-position="bottom2" class="bottom2"><!--block-->
                  <?php echo CoreStatements::position('bottom2', 'block', 'bottom2'); ?><!--/block-->
                </div><?php else: ?><div class="hidden-position" style="display:none"></div><?php endif; ?><!--/position-->
          
         </div>
  
  		<div class="u-section-row u-section-row-3" id="bottom3">
          <?php $positionName = 'bottom3'; if ($positionName && CoreStatements::containsModules($positionName)) : ?><div data-position="bottom3" class="bottom3"><!--block-->
                  <?php echo CoreStatements::position('bottom3', 'block', 'bottom3'); ?><!--/block-->
                </div><?php else: ?><div class="hidden-position" style="display:none"></div><?php endif; ?><!--/position-->
          
         </div>
    </div>
</div> 
  
<div class="u-section-rows">
        <div class="u-section-row u-section-row-3" id="banner-bottom">
          <?php $positionName = 'banner-bottom'; if ($positionName && CoreStatements::containsModules($positionName)) : ?><div data-position="banner-bottom" class="banner-bottom u-sheet"><!--block-->
                  <?php echo CoreStatements::position('banner-bottom', 'block', 'banner-bottom'); ?><!--/block-->
                </div><?php else: ?><div class="hidden-position" style="display:none"></div><?php endif; ?><!--/position-->
          
         </div>
</div>

<div class="u-section-rows">
        <div class="u-section-row u-section-row-3" id="slidebanner">
          <?php $positionName = 'slidebanner'; if ($positionName && CoreStatements::containsModules($positionName)) : ?><div data-position="slidebanner" class="slidebanner"><!--block-->
                  <?php echo CoreStatements::position('slidebanner', 'block', 'slidebanner'); ?><!--/block-->
                </div><?php else: ?><div class="hidden-position" style="display:none"></div><?php endif; ?><!--/position-->
          
         </div>
</div>  
  
<?php
if ($showFooter) {
    $this->view->renderFooter($indexDir, $this->params);
}
?>
</div>

<?php echo $backToTop; ?>
<?php echo $popupDialogs; ?>
  
  <!-- Button visually impaired JS -->

  
  <script src="<?php echo $templateUrl; ?>/bvi/dist/js/bvi.min.js"></script>
        <script> 
        new isvek.Bvi();
        </script>
</body>
</html>
