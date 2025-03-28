<?php
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

ob_start();
?>
	<nav class="u-dropdown-icon u-menu u-menu-dropdown u-offcanvas u-menu-3" data-position="hmenu">
          <div class="menu-collapse" style="font-size: 1.125rem; letter-spacing: 0px; text-transform: uppercase; font-weight: 700;">
            <a class="u-button-style u-custom-active-border-color u-custom-active-color u-custom-border u-custom-border-color u-custom-borders u-custom-color u-custom-hover-border-color u-custom-hover-color u-custom-left-right-menu-spacing u-custom-text-active-color u-custom-text-color u-custom-text-hover-color u-custom-top-bottom-menu-spacing u-nav-link" href="#">
              <svg class="u-svg-link" viewBox="0 0 24 24"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#menu-hamburger"></use></svg>
              <svg class="u-svg-content" version="1.1" id="menu-hamburger" viewBox="0 0 16 16" x="0px" y="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg"><g><rect y="1" width="16" height="2"></rect><rect y="7" width="16" height="2"></rect><rect y="13" width="16" height="2"></rect>
</g></svg>
            </a>
          </div>
          <div class="u-custom-menu u-nav-container">
            [[menu]]
          </div>
          <div class="u-custom-menu u-nav-container-collapse">
            <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
              <div class="u-inner-container-layout u-sidenav-overflow">
                <div class="u-menu-close"></div>
                [[responsive_menu]]
              </div>
            </div>
            <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
          </div>
        </nav>
<?php
$menuTemplate = processPositions(ob_get_clean());

if (!function_exists('renderMegaPopup3')) {
    function renderMegaPopup3($match)
    {
    $popupsDir = dirname(dirname(__FILE__)) . '/megapopups';
    $megaMenuDefaultTemplatesPath = $popupsDir . '/megapopup_default.php';
    $megaMenuTemplatesPaths = array(
            
        );

        $templatePath = array_key_exists($match[1], $megaMenuTemplatesPaths) ? $megaMenuTemplatesPaths[$match[1]] : $megaMenuDefaultTemplatesPath;
        ob_start();
        include_once $templatePath;
        $template = ob_get_clean();

        $subitems = $match[2];
        $template = str_replace('[[popup_menu]]', $subitems, $template);
        $template = processPositions($template);
        return $template;
    }
}

if (!function_exists('buildMenu3')) {
    function buildMenu3($list, $default_id, $active_id, $path, $options)
	{
        $isMegaMenu = isset($options['megamenu_on']) && $options['megamenu_on'] == 'true' ? true : false;

        if ($isMegaMenu) {
            $rootIndx = null;
            $subRootIndx = null;
            foreach ($list as $i => &$item) {
                $level = (int) $item->level;

                if ($level === 1) {
                    $rootIndx = $i;
                }

                if ($level === 2) {
                    $subRootIndx = $i;
                }

                if ($level > 2) {
                    $list[$rootIndx]->isMegaMenu = true;
                    $list[$subRootIndx]->isMegaMenu = true;
                    $item->isMegaMenu = true;
                    $item->parent = false;
                    $item->deeper = false;

                    $nextIndex = $i + 1;
                    if (!array_key_exists($nextIndex, $list) || (array_key_exists($nextIndex, $list) && (int)$list[$nextIndex]->level < $level)) {
                        $item->shallower = true;
                        $item->level_diff = 1;
                    } else {
                        $item->shallower = false;
                    }
                    $item->level = '3';
                }
            }
        }
        ob_start();
        $popupKey = 0;
        ?>
        <ul class="<?php echo $options['menu_class']; ?>">
            <?php foreach ($list as $i => &$item) {
                if ($item->level == 1) {
                    ++$popupKey;
                }
                $class = 'item-' . $item->id;

                if ($item->id == $default_id) {
                    $class .= ' default';
                }

                $itemIsCurrent = false;
                if (($item->id == $active_id) || ($item->type == 'alias' && $item->getParams()->get('aliasoptions') == $active_id)) {
                    $class .= ' current';
                    $itemIsCurrent = true;
                }

                if (in_array($item->id, $path)) {
                    $class .= ' active';
                } elseif ($item->type == 'alias') {
                    $aliasToId = $item->getParams()->get('aliasoptions');

                    if (count($path) > 0 && $aliasToId == $path[count($path) - 1]) {
                        $class .= ' active';
                    } elseif (in_array($aliasToId, $path)) {
                        $class .= ' alias-parent-active';
                    }
                }

                if ($item->type == 'separator') {
                    $class .= ' divider';
                }

                if ($item->deeper) {
                    $class .= ' deeper';
                }

                if ($item->parent) {
                    $class .= ' parent';
                }

                $submenuItemClass = $options['submenu_item_class'];
                if ($item->level > 2 && isset($item->isMegaMenu)) {
                    $submenuItemClass = $options['mega_submenu_item_class'];
                }
                echo '<li class="' . ($item->level == 1 ? $options['item_class'] : $submenuItemClass) . ' ' . $class . '">';

                $submenuLinkClass = $options['submenu_link_class'];
                if ($item->level > 2 && isset($item->isMegaMenu)) {
                    $submenuLinkClass = $options['mega_submenu_link_class'];
                }
                $linkClassName = $item->level == 1 ? $options['link_class'] : $submenuLinkClass;

                $submenuLinkStyle = $options['submenu_link_style'];
                if ($item->level > 2 && isset($item->isMegaMenu)) {
                    $submenuLinkStyle = $options['mega_submenu_link_style'];
                }
                $linkInlineStyles = $item->level == 1 ? $options['link_style'] : $submenuLinkStyle;

                switch ($item->type) :
                    case 'separator':
                    case 'component':
                    case 'heading':
                    case 'url':
                        require ModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type);
                        break;

                    default:
                        require ModuleHelper::getLayoutPath('mod_menu', 'default_url');
                        break;
                endswitch;

                // The next item is deeper.
                if ($item->deeper) {
                    if ($item->level == 1 && isset($item->isMegaMenu)) {
                        echo '<!--start_megapopup_' . $popupKey .'-->';
                    } else {
                        if (isset($item->isMegaMenu) && $item->level == 2) {
                            echo '<div class="level-3 u-nav-popup">';
                        } else {
                            echo '<div class="u-nav-popup">';
                        }
                    }
                    if (isset($item->isMegaMenu) && $item->level == 2) {
                        echo '<ul class="' . $options['mega_submenu_class'] . '">';
                    } else {
                        $options['submenu_class'] = $isMegaMenu && !isset($item->isMegaMenu)
                            ? preg_replace('/u-nav-[\d]+/', '', $options['submenu_class'])
                            : $options['submenu_class'];
                        echo '<ul class="' . $options['submenu_class'] . '">';
                    }
                } // The next item is shallower.
                elseif ($item->shallower) {
                    if (isset($item->isMegaMenu)) {
                        echo str_repeat('</ul></div></li>', $item->level_diff -1) . '</ul><!--end_megapopup--></li>';
                    } else {
                        echo '</li>';
                        echo str_repeat('</ul></div></li>', $item->level_diff);
                    }
                } // The next item is on the same level.
                else {
                    echo '</li>';
                }
            }
            ?></ul>
        <?php
        $menuResult = ob_get_clean();
        $menuResult = preg_replace_callback('/<\!--start\_megapopup_([\d]+)-->([\s\S]+?)<\!--end\_megapopup-->/', 'renderMegaPopup3', $menuResult);
        return $menuResult;
    }
}
$mainList = unserialize(serialize($list));
$menu_html = buildMenu3($mainList, $default_id, $active_id, $path, array(
        'container_class' => 'u-dropdown-icon u-menu u-menu-dropdown u-offcanvas u-menu-3',
        'menu_class' => 'u-nav u-spacing-2 u-unstyled u-nav-5',
        'item_class' => 'u-nav-item',
        'link_class' => 'u-active-palette-5-base u-button-style u-hover-palette-5-base u-nav-link u-text-active-palette-4-base u-text-hover-palette-1-base u-text-palette-5-base',
        'link_style' => 'padding: 20px 10px;',
        'submenu_class' => 'u-h-spacing-15 u-nav u-unstyled u-v-spacing-10 u-block-c88c-11',
        'submenu_item_class' => 'u-nav-item',
        'submenu_link_class' => 'u-active-palette-4-dark-2 u-button-style u-hover-palette-4-base u-nav-link u-palette-4-dark-1',
        'submenu_link_style' => '',
        'megamenu_on' => '',
        'mega_submenu_class' => '',
        'mega_submenu_item_class' => '',
        'mega_submenu_link_class' => '',
        'mega_submenu_link_style' => '',
    )
);

$resp_menu = buildMenu3($list, $default_id, $active_id, $path, array(
        'container_class' => 'u-dropdown-icon u-menu u-menu-dropdown u-offcanvas u-menu-3',
        'menu_class' => 'u-align-center u-nav u-popupmenu-items u-unstyled u-nav-6',
        'item_class' => 'u-nav-item',
        'link_class' => 'u-button-style u-nav-link',
        'link_style' => '',
        'submenu_class' => 'u-h-spacing-15 u-nav u-unstyled u-v-spacing-10 u-block-c88c-9',
        'submenu_item_class' => 'u-nav-item',
        'submenu_link_class' => 'u-active-palette-4-dark-2 u-button-style u-hover-palette-4-base u-nav-link u-palette-4-dark-1',
        'submenu_link_style' => ''
    )
);

if (preg_match('#<ul[\s\S]*ul>#', $resp_menu, $m)) {
    $responsive_nav = $m[0];
    if (preg_match('#<ul[\s\S]*ul>#', $menu_html, $m)) {
        $regular_nav = $m[0];
        $menu_html = strtr($menuTemplate, array('[[menu]]' => $regular_nav, '[[responsive_menu]]' => $responsive_nav));
        $menu_html = preg_replace('#<\/li>\s+<li#', '</li><li', $menu_html); // remove spaces
        echo $menu_html;
    }
}
