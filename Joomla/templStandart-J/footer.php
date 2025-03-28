<?php
use Joomla\CMS\Factory;
$document = Factory::getApplication()->getDocument();
?>
    <footer class="u-clearfix u-footer u-palette-1-base u-footer" id="footer">
  <div class="u-clearfix u-gutter-10 u-layout-wrap u-layout-wrap-1">
    <div class="u-gutter-0 u-layout">
      <div class="u-layout-col">
        <div class="u-size-30">
          <div class="u-layout-row">
            <div class="u-align-left u-container-style u-layout-cell u-size-20 u-layout-cell-1">
              <div class="u-container-layout u-container-layout-1">
                <img class="u-align-center u-image u-image-contain u-image-default lazyload u-image-1" alt="" data-image-width="980" data-image-height="1002" data-src="<?php $logoFile = getThemeParams('logoFile'); if ($logoFile) {echo ($document->baseurl),('/'),($logoFile); } else {ob_start(); ?><?php $app = JFactory::getApplication();  echo JURI::root(true); ?>/templates/<?php echo $app->getTemplate(); ?>/images/education-logo.png<?php echo ob_get_clean();}?>"><!--position-->
                <?php $positionName = 'footer1'; ?><div data-position="footer1" class="u-position u-position-1"><!--block-->
                <div style="text-align: center;"><span style="font-size: 14px;font-weight: 700;"><?php echo date("Y");?> г.<br /><?php $siteCopy = getThemeParams('siteCopy'); echo $siteCopy;?></span></div>
                  <?php echo CoreStatements::position('footer1', 'block%block_1', 'block_1'); ?><!--/block-->
                </div><!--/position-->
              </div>
            </div>
            <div class="u-align-left u-container-style u-layout-cell u-size-20 u-layout-cell-2">
              <div class="u-container-layout u-container-layout-2"><!--position-->
                <?php $positionName = 'footer2'; if ($positionName && CoreStatements::containsModules($positionName)) : ?><div data-position="footer2" class="u-align-center u-position u-position-2"><!--block-->
                  <?php echo CoreStatements::position('footer2', 'block%block_2', 'block_2'); ?><!--/block-->
                </div><?php else: ?><div class="hidden-position" style="display:none"></div><?php endif; ?><!--/position-->
              </div>
            </div>
            <div class="u-container-style u-layout-cell u-size-20 u-layout-cell-3">
              <div class="u-container-layout u-container-layout-3"><!--position-->
                <?php $positionName = 'footer3'; if ($positionName && CoreStatements::containsModules($positionName)) : ?><div data-position="footer3" class="u-align-center u-position u-position-3"><!--block-->
                  <?php echo CoreStatements::position('footer3', 'block%block_3', 'block_3'); ?><!--/block-->
                </div><?php else: ?><div class="hidden-position" style="display:none"></div><?php endif; ?><!--/position-->
              </div>
            </div>
          </div>
        </div>
        <div class="u-size-30">
          <div class="u-layout-row">
            <div class="u-container-style u-layout-cell u-size-60 u-layout-cell-4">
              <div class="u-container-layout u-container-layout-4"><!--position-->
                <?php $positionName = 'bottomfooter'; if ($positionName && CoreStatements::containsModules($positionName)) : ?><div data-position="bottomfooter" class="u-align-center u-border-1 u-border-no-bottom u-border-no-left u-border-no-right u-border-palette-1-light-3 u-position u-position-4"><!--block-->
                  <?php echo CoreStatements::position('bottomfooter', 'block%block_4', 'block_4'); ?><!--/block-->
                </div><?php else: ?><div class="hidden-position" style="display:none"></div><?php endif; ?><!--/position-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="u-align-left u-container-style u-expanded-width u-grey-10 u-group u-group-1">
    <div class="u-container-layout u-container-layout-5">
      <p class="u-align-center u-text u-text-default u-text-9"> Коллекция шаблонов <a href="https://aictioko.ru/" class="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-palette-1-base u-btn-1" target="_blank">КАУ ДПО «АИЦТиОКО имени О.Р. Львова»</a>. 
      </p>
    </div>
  </div>
</footer>
    