<?php
use Joomla\CMS\Factory;
$document = Factory::getApplication()->getDocument();
?>
<header class=" u-clearfix u-header u-section-row-container" id="sec-616b">
  <div class="u-section-rows">
    <div class="u-align-center u-palette-1-base u-section-row u-valign-middle u-section-row-1" id="top-header">
      <div class="u-clearfix u-layout-custom-sm u-layout-custom-xs u-layout-wrap u-layout-wrap-1 u-sheet">
        <div class="u-gutter-0 u-layout">
          <div class="u-layout-row">
            <div class="u-container-style u-layout-cell u-size-48 u-layout-cell-1">
              <div class="u-container-layout u-valign-middle u-container-layout-1">
                <?php echo CoreStatements::position('topmenuleft', '', 1, 'hmenu'); ?>
              </div>
            </div>
            <div class="u-container-style u-layout-cell u-size-12 u-layout-cell-2">
              <div class="u-container-layout u-valign-middle u-container-layout-2">
                <?php echo CoreStatements::position('topmenuright', '', 2, 'hmenu'); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="u-image u-section-row lazyload u-image-1" id="midle-header" data-image-width="1920" data-image-height="367" data-bg="url('<?php $templateImage = getThemeParams('templateImage'); if ($templateImage) {echo ($document->baseurl),('/'),($templateImage); }?>">
      <div class="u-clearfix u-sheet u-valign-middle-xl u-sheet-1">
        <div class="u-clearfix u-layout-wrap u-layout-wrap-2 u-sheet">
          <div class="u-layout">
            <div class="u-layout-row">
              <div class="u-container-style u-layout-cell u-size-12 u-layout-cell-3">
                <div class="u-container-layout u-container-layout-3">
                  <?php $logoInfo = getLogoInfo(array(
            'src' => "/images/education-logo.png",
            'href' => "#",
        ), true); ?><a href="<?php echo $logoInfo['href']; ?>" class="u-align-center u-image u-logo u-image-2" data-image-width="980" data-image-height="1002" title="Главная">
                    <img src="<?php echo $logoInfo['src']; ?>" class="u-logo-image u-logo-image-1" data-image-width="80">
                  </a>
                </div>
              </div>
              <div class="u-container-style u-layout-cell u-size-36 u-layout-cell-4">
                <div class="u-container-layout u-valign-middle u-container-layout-4">
                  <div class="u-container-style u-expanded-width u-group u-shape-rectangle u-group-1">
                    <div class="u-container-layout u-valign-middle u-container-layout-5">
                      <h2 class="u-align-center u-subtitle u-text u-text-default u-text-1"><?php $siteSlogan = getThemeParams('siteSlogan');if ($siteSlogan) {echo $siteSlogan; } else {    ob_start(); ?>Расшифровка аббревиатуры наименования<?php echo ob_get_clean();}?></h2>
                      <h1 class="u-align-center u-headline u-text u-text-default u-text-palette-5-base u-title u-text-2">
                        <a href="<?php echo JFactory::getDocument()->baseurl; ?>"><?php $siteTitle = getThemeParams('siteTitle');if ($siteTitle) {   echo $siteTitle; } else {    ob_start(); ?>Наименование организации<?php echo ob_get_clean();}?></a>
                      </h1>
                    </div>
                  </div>
                </div>
              </div>
              <div class="u-container-style u-layout-cell u-size-12 u-layout-cell-5">
                <div class="u-container-layout u-valign-middle u-container-layout-6">
                  <div class="u-container-style u-expanded-width u-group u-shape-rectangle u-group-2">
                    <div class="u-container-layout u-container-layout-7">
                      <a href="#" class="u-active-none u-border-none u-bottom-left-radius-0 u-bottom-right-radius-0 u-btn u-btn-rectangle u-button-style u-hover-none u-none u-radius-0 u-top-left-radius-0 u-top-right-radius-0 u-btn-1" data-animation-name="" data-animation-duration="0" data-animation-direction=""><span class="u-icon u-icon-1"><svg class="u-svg-content" viewBox="0 0 54.757 54.757" x="0px" y="0px" style="width: 1em; height: 1em;"><path d="M40.94,5.617C37.318,1.995,32.502,0,27.38,0c-5.123,0-9.938,1.995-13.56,5.617c-6.703,6.702-7.536,19.312-1.804,26.952
	L27.38,54.757L42.721,32.6C48.476,24.929,47.643,12.319,40.94,5.617z M27.557,26c-3.859,0-7-3.141-7-7s3.141-7,7-7s7,3.141,7,7
	S31.416,26,27.557,26z"></path></svg><img src=""></span><?php $adress = getThemeParams('adress');if ($adress) {echo $adress; } else {ob_start(); ?>656xxx, Алтайский край, г.Барнаул, ул.*************, д*** <?php echo ob_get_clean();}?>
                      </a>
                      <a href="tel:<?php $phone = getThemeParams('phone'); echo preg_replace('/[^\d+]+/','',$phone);?>" class="u-active-none u-border-none u-bottom-left-radius-0 u-bottom-right-radius-0 u-btn u-btn-rectangle u-button-style u-hover-none u-none u-radius-0 u-top-left-radius-0 u-top-right-radius-0 u-btn-2"><span class="u-icon u-text-grey-80 u-icon-2"><svg class="u-svg-content" viewBox="0 0 405.333 405.333" x="0px" y="0px" style="width: 1em; height: 1em;"><path d="M373.333,266.88c-25.003,0-49.493-3.904-72.704-11.563c-11.328-3.904-24.192-0.896-31.637,6.699l-46.016,34.752    c-52.8-28.181-86.592-61.952-114.389-114.368l33.813-44.928c8.512-8.512,11.563-20.971,7.915-32.64    C142.592,81.472,138.667,56.96,138.667,32c0-17.643-14.357-32-32-32H32C14.357,0,0,14.357,0,32    c0,205.845,167.488,373.333,373.333,373.333c17.643,0,32-14.357,32-32V298.88C405.333,281.237,390.976,266.88,373.333,266.88z"></path></svg><img src=""></span><?php if ($phone) {echo $phone;} else {ob_start(); ?>+7 (****) *** ***<?php echo ob_get_clean();}?>
						</a>
                      <a href="mailto:<?php $mail = getThemeParams('mail'); echo $mail; ?>" class="u-active-none u-border-none u-bottom-left-radius-0 u-bottom-right-radius-0 u-btn u-btn-rectangle u-button-style u-hover-none u-none u-radius-0 u-top-left-radius-0 u-top-right-radius-0 u-btn-3"><span class="u-file-icon u-icon u-text-grey-80 u-icon-3"><img src="<?php $app = JFactory::getApplication();  echo JURI::root(true); ?>/templates/<?php echo $app->getTemplate(); ?>/images/3.png" alt=""></span><?php $mail = getThemeParams('mail');if ($mail) {echo $mail; } else {ob_start(); ?>******@company.com<?php echo ob_get_clean();}?>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="u-palette-1-base u-section-row u-section-row-3" id="buttom-header">
      <div class="u-clearfix u-sheet u-sheet-2">
        <?php echo CoreStatements::position('hmenu', '', 3, 'hmenu'); ?>
      </div>
    </div>
  </div>

</header>
