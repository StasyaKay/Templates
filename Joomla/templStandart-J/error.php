<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;

$indexDir = dirname(__FILE__);
require_once $indexDir .  '/functions.php';

HTMLHelper::_('bootstrap.framework');

$app = Factory::getApplication();
$config = $app->getConfig();
$sef = $app->get('sef', false);

$defaultLogo = getLogoInfo(array('src' => "/images/education-logo.png"));

$errorDocument = $this;
$document = $app->getDocument();

if ($sef) {
    $document->setBase(Uri::getInstance()->toString());
}

$metaGeneratorContent = '';
if ($metaGeneratorContent) {
    $document->setMetaData('generator', $metaGeneratorContent);
}

$templateUrl = $errorDocument->baseurl . '/templates/' . $errorDocument->template;
$faviconPath = "favicon.png" ? $templateUrl . '/images/' . "favicon.png" : '';

Core::load("Core_Page");
Core::load("Core_PageProperties");

// Initialize $view:
$this->view = new CorePage($this);

$themeOptions = $app->getTemplate(true)->params;
$fileName = $themeOptions->get('page404', '');
if ($fileName) {
    include_once $indexDir . '/views/' . $fileName . '.php';
}

$pageProperties = new CorePageProperties($document, '404');
$bodyClass = $pageProperties->getBodyClass('');
$bodyStyle = $pageProperties->getBodyStyle();
$backToTop = $pageProperties->getBackToTop();
$popupDialogs = $pageProperties->getPopupDialogs();
$showHeader = $pageProperties->showHeader();
$showFooter = $pageProperties->showFooter();

$pageContent = isset($document->pageContent) && $document->pageContent ? $document->pageContent : '';
$pageStyles = isset($document->pageStyles) && $document->pageStyles ? $document->pageStyles : '';
$document->pageType = '404';
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <?php if ($faviconPath) : ?>
        <link href="<?php echo $faviconPath; ?>" rel="icon" type="image/x-icon" />
    <?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <meta name="theme-color" content="#478ac9">
    <link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/default.css" media="screen" type="text/css" />
    <?php if($this->view->isFrontEditing()) : ?>
        <link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/frontediting.css" media="screen" type="text/css" />
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/template.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/media.css" id="theme-media-css" media="screen" type="text/css" />
    <link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/fonts.css" media="screen" type="text/css" /><?php if (isset($document->localFontsFile)) : ?><link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/<?php echo $document->localFontsFile; ?>" media="screen" type="text/css" /><?php else : ?><?php endif; ?>
    <?php include_once "$indexDir/styles.php"; ?>
    <script src="<?php echo $templateUrl; ?>/scripts/jquery.js"></script>
    <script src="<?php echo $templateUrl; ?>/scripts/script.js"></script>
    <?php echo $pageStyles; ?>
    
    
    
</head>
<body <?php echo $bodyClass . $bodyStyle; ?>>
<?php
if ($showHeader) {
    $this->view->renderHeader($indexDir);
}
?>
<?php echo $pageContent; ?>
<?php
if ($showFooter) {
    $this->view->renderFooter($indexDir);
}
?>


<?php echo $backToTop; ?>
<?php echo $popupDialogs; ?>
</body>
</html>
