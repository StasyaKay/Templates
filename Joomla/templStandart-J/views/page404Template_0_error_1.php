<section class="u-align-center u-clearfix u-image lazyload u-section-1" id="sec-e7bb" data-bg="url('<?php $app = JFactory::getApplication();  echo JURI::root(true); ?>/templates/<?php echo $app->getTemplate(); ?>/images/error-404.png')" style="padding-bottom: 250px; background-size: unset; background-position-y: bottom;">
  <div class="u-clearfix u-sheet u-valign-top u-sheet-1">
    <h1 class="u-text u-text-default u-text-1">404</h1>
    <div class="u-text u-text-default u-text-not-found-message u-text-2"><?php echo outputErrorPage($this); ?></div>
    <p class="u-text u-text-3"> Страница, которую вы ищете, была перемещена, удалена, переименована или, возможно, никогда не существовала</p>
    <a href="" class="u-active-palette-1-base u-black u-border-active-white u-border-hover-white u-border-none u-btn u-button-style u-hover-palette-1-base u-text-active-white u-text-body-alt-color u-text-hover-white u-btn-1">Перейти на главную</a>
  </div>
</section>
