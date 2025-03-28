<?php
defined('_JEXEC') or die;

$document = JFactory::getDocument();

$pageStyles = <<<STYLES
<style>
 .u-section-1 {
  background-position: 50% 50%;
}
.u-section-1 .u-sheet-1 {
  min-height: 772px;
}
.u-section-1 .u-text-1 {
  font-size: 12.5rem;
  font-weight: 700;
  line-height: 1;
  margin: 0 auto;
}
.u-section-1 .u-text-2 {
  font-size: 1.875rem;
  font-weight: 700;
  line-height: 1;
  text-transform: uppercase;
  margin: 15px auto 0;
}
.u-section-1 .u-text-3 {
  background-image: none;
  font-size: 1.5rem;
  width: 525px;
  margin: 15px auto 0;
}
.u-section-1 .u-btn-1 {
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  text-shadow: 0 0 0 rgba(0,0,0,0);
  font-size: 1.125rem;
  background-image: none;
  margin: 0 auto 60px;
  padding: 10px 54px 10px 52px;
}
@media (max-width: 1199px) {
  .u-section-1 .u-sheet-1 {
    min-height: 637px;
  }
  .u-section-1 .u-text-1 {
    margin-top: 60px;
  }
  .u-section-1 .u-btn-1 {
    border-style: none;
  }
}
@media (max-width: 991px) {
  .u-section-1 .u-sheet-1 {
    min-height: 488px;
  }
}
@media (max-width: 767px) {
  .u-section-1 .u-sheet-1 {
    min-height: 610px;
  }
}
@media (max-width: 575px) {
  .u-section-1 .u-sheet-1 {
    min-height: 544px;
  }
  .u-section-1 .u-text-1 {
    font-size: 7.5rem;
  }
  .u-section-1 .u-text-2 {
    font-size: 1.5rem;
    width: auto;
    margin-left: 16px;
    margin-right: 16px;
  }
  .u-section-1 .u-text-3 {
    font-size: 1.25rem;
    width: auto;
    margin-left: 0;
    margin-right: 0;
  }
}
</style>
STYLES;
$document->pageStyles = $pageStyles;

$backToTop = <<<BACKTOTOP

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

ob_start();
echo '<!--component_settings-->' . json_encode($settings) . '<!--/component_settings-->';
include_once dirname(__FILE__) . '/page404Template_0_error_1.php';
$document->pageContent = ob_get_clean();