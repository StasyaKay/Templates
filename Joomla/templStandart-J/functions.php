<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\Registry\Registry;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Helper\ModuleHelper;

if (!defined('_DESIGNER_FUNCTIONS')) {

    define('_DESIGNER_FUNCTIONS', 1);

    require_once dirname(__FILE__) . '/library/Core.php';

    Core::load("Core_Statements");
    Core::load("Core_PositionsHelper");

    $app = Factory::getApplication();
    $config = $app->getConfig();
    $document = $app->getDocument();

    $document->themeImagesPath = JURI::root(true) . '/templates/' . JFactory::getApplication()->getTemplate() . '/images/';

    $pageDesc = $document->getDescription() ? $document->getDescription() : $config->get('sitename');

    $document->seoTags = array();
    $document->seoTags['canonical'] = array('tag' => 'link', 'rel' => 'canonical', 'href' => Uri::getInstance()->toString());
    $document->seoTags['og:site_name'] = array('tag' => 'meta', 'property' => 'og:site_name', 'content' => $config->get('sitename'));
    $document->seoTags['og:url'] = array('tag' => 'meta', 'property' => 'og:url', 'content' => Uri::getInstance()->toString());
    $document->seoTags['og:title'] = array('tag' => 'meta', 'property' => 'og:title', 'content' => $document->getTitle());
    $document->seoTags['og:type'] = array('tag' => 'meta', 'property' => 'og:type', 'content' => 'website');
    $document->seoTags['og:description'] = array('tag' => 'meta', 'property' => 'og:description', 'content' =>  $pageDesc);

    $twitterAccount = '';

    if ($twitterAccount) {
        $document->seoTags['twitter:site'] = array('tag' => 'meta', 'name' => 'twitter:site', 'content' => $twitterAccount);
        $document->seoTags['twitter:card'] = array('tag' => 'meta', 'name' => 'twitter:card', 'content' => 'summary_large_image');
        $document->seoTags['twitter:title'] = array('tag' => 'meta', 'name' => 'twitter:title', 'content' => $document->getTitle());
        $document->seoTags['twitter:description'] = array('tag' => 'meta', 'name' => 'twitter:description', 'content' => $pageDesc);
    }

    function renderSeoTags($tags) {
        foreach ($tags as $values) {
            $tag = '<';
            foreach ($values as $property => $value) {
                if ($property == 'tag') {
                    $tag .= $value;
                    continue;
                }
                $tag .= ' ' . $property . '="' . $value . '"';
            }
            $tag .= '>';
            echo $tag;
        }
    }

    

    function block_1($caption, $content) {
            $hasCaption = (null !== $caption && strlen(trim($caption)) > 0);
            $hasContent = (null !== $content && strlen(trim($content)) > 0);
            if (!$hasCaption && !$hasContent)
                return '';
            ob_start();
            ?>
            <div class="u-block">
                    <div class="u-block-container u-clearfix"><!--block_header-->
                      <?php if ($hasCaption) : ?><h5 class="u-align-center u-block-header u-h-spacing-5 u-text u-v-spacing-0"><?php echo $caption; ?></h5><?php endif; ?><!--/block_header--><!--block_content-->
                      <?php if ($hasContent) : ?><div class="u-align-center u-block-content u-spacing-5 u-text"><?php echo $content; ?></div><?php endif; ?><!--/block_content-->
                    </div>
                  </div>
            <?php
            return ob_get_clean();
        }
function block_2($caption, $content) {
            $hasCaption = (null !== $caption && strlen(trim($caption)) > 0);
            $hasContent = (null !== $content && strlen(trim($content)) > 0);
            if (!$hasCaption && !$hasContent)
                return '';
            ob_start();
            ?>
            <div class="u-block u-indent-8">
                    <div class="u-block-container u-clearfix"><!--block_header-->
                      <?php if ($hasCaption) : ?><h5 class="u-align-center u-block-header u-h-spacing-5 u-text u-v-spacing-15"><?php echo $caption; ?></h5><?php endif; ?><!--/block_header--><!--block_content-->
                      <?php if ($hasContent) : ?><div class="u-align-justify u-block-content u-spacing-5 u-text"><?php echo $content; ?></div><?php endif; ?><!--/block_content-->
                    </div>
                  </div>
            <?php
            return ob_get_clean();
        }
function block_3($caption, $content) {
            $hasCaption = (null !== $caption && strlen(trim($caption)) > 0);
            $hasContent = (null !== $content && strlen(trim($content)) > 0);
            if (!$hasCaption && !$hasContent)
                return '';
            ob_start();
            ?>
            <div class="u-block">
                    <div class="u-block-container u-clearfix"><!--block_header-->
                      <?php if ($hasCaption) : ?><h5 class="u-align-center u-block-header u-h-spacing-5 u-text u-v-spacing-15"><?php echo $caption; ?></h5><?php endif; ?><!--/block_header--><!--block_content-->
                      <?php if ($hasContent) : ?><div class="u-align-justify u-block-content u-spacing-5 u-text"><?php echo $content; ?></div><?php endif; ?><!--/block_content-->
                    </div>
                  </div>
            <?php
            return ob_get_clean();
        }
function block_4($caption, $content) {
            $hasCaption = (null !== $caption && strlen(trim($caption)) > 0);
            $hasContent = (null !== $content && strlen(trim($content)) > 0);
            if (!$hasCaption && !$hasContent)
                return '';
            ob_start();
            ?>
            <div class="u-block u-indent-0 u-spacing-0">
                    <div class="u-block-container u-clearfix"><!--block_header-->
                      <?php if ($hasCaption) : ?><h5 class="u-align-center u-block-header u-text u-v-spacing-2"><?php echo $caption; ?></h5><?php endif; ?><!--/block_header--><!--block_content-->
                      <?php if ($hasContent) : ?><div class="u-align-center u-block-content u-text"><?php echo $content; ?></div><?php endif; ?><!--/block_content-->
                    </div>
                  </div>
            <?php
            return ob_get_clean();
        }
function block_sidebar_blog_1($caption, $content) {
            $hasCaption = (null !== $caption && strlen(trim($caption)) > 0);
            $hasContent = (null !== $content && strlen(trim($content)) > 0);
            if (!$hasCaption && !$hasContent)
                return '';
            ob_start();
            ?>
            <div class="u-block u-indent-8 u-palette-5-base u-block-0e53-2">
      <div class="u-block-container u-border-1 u-border-grey-10 u-clearfix">
        <?php if ($hasCaption) : ?><h5 class="u-block-header u-h-spacing-5 u-palette-1-dark-1 u-text u-v-spacing-5 u-block-0e53-3"><?php echo $caption; ?></h5><?php endif; ?>
        <?php if ($hasContent) : ?><div class="u-block-content u-spacing-5 u-text u-block-0e53-4"><?php echo $content; ?></div><?php endif; ?>
      </div>
    </div>
            <?php
            return ob_get_clean();
        }
function block_sidebar_post_1($caption, $content) {
            $hasCaption = (null !== $caption && strlen(trim($caption)) > 0);
            $hasContent = (null !== $content && strlen(trim($content)) > 0);
            if (!$hasCaption && !$hasContent)
                return '';
            ob_start();
            ?>
            <div class="u-block u-indent-30 u-palette-5-base u-block-0e53-2">
      <div class="u-block-container u-border-1 u-border-grey-10 u-clearfix">
        <?php if ($hasCaption) : ?><h5 class="u-block-header u-h-spacing-5 u-palette-1-dark-1 u-text u-v-spacing-5 u-block-0e53-3"><?php echo $caption; ?></h5><?php endif; ?>
        <?php if ($hasContent) : ?><div class="u-block-content u-spacing-5 u-text u-block-0e53-4"><?php echo $content; ?></div><?php endif; ?>
      </div>
    </div>
            <?php
            return ob_get_clean();
        }
function block_sidebar_login_1($caption, $content) {
            $hasCaption = (null !== $caption && strlen(trim($caption)) > 0);
            $hasContent = (null !== $content && strlen(trim($content)) > 0);
            if (!$hasCaption && !$hasContent)
                return '';
            ob_start();
            ?>
            <div class="u-block u-block-0e53-2 u-indent-30 u-palette-5-base">
      <div class="u-block-container u-border-1 u-border-grey-10 u-clearfix">
        <?php if ($hasCaption) : ?><h5 class="u-block-0e53-3 u-block-header u-h-spacing-5 u-palette-1-dark-1 u-text u-v-spacing-5"><?php echo $caption; ?></h5><?php endif; ?>
        <?php if ($hasContent) : ?><div class="u-block-0e53-4 u-block-content u-spacing-5 u-text"><?php echo $content; ?></div><?php endif; ?>
      </div>
    </div>
            <?php
            return ob_get_clean();
        }


    function funcLinkButton($data = array())
    {
        return '<a class="u-button" href="' . $data['link'] . '">' . $data['content'] . '</a>';
    }

    function funcTagBuilder($tag, $attributes = array(), $content = '') {
        $result = '<' . $tag;
        foreach ($attributes as $name => $value) {
            if (is_string($value)) {
                if (!empty($value))
                    $result .= ' ' . $name . '="' . $value . '"';
            } else if (is_array($value)) {
                $values = array_filter($value);
                if (count($values))
                    $result .= ' ' . $name . '="' . implode(' ', $value) . '"';
            }
        }
        $result .= '>' . $content . '</' . $tag . '>';
        return $result;
    }

    function getThemeParams($name) {
        $site = Factory::getApplication();
        $template = $site->getTemplate();
        $db = Factory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id, params')
            ->from('#__template_styles')
            ->where('template = ' . $db->quote($template))
            ->where('client_id = 0');
        $db->setQuery($query);
        $templates = $db->loadObjectList('id');

        if (count($templates) < 1)
            return '';

        $menu = $site->getMenu('site');
        $item = $menu->getActive();

        $id         = is_object($item) ? $item->template_style_id : 0;
        $template   = isset($templates[$id]) ? $templates[$id] : array_shift($templates);

        $registry = new Registry();
        $registry->loadString($template->params);
        return $registry->get($name, '');
    }

    function getLogoInfo($defaults = array(), $setThemeSizes = false)
    {
        $app = Factory::getApplication();
        $rootPath = str_replace(DIRECTORY_SEPARATOR, '/', JPATH_ROOT);

        $info = array();
        $info['src'] = isset($defaults['src']) ? $defaults['src'] : '';
        $info['src_path'] = '';
        if ($info['src']) {
            $info['src'] = preg_match('#^(http:|https:|//)#', $info['src']) ? $info['src'] :
                Uri::root() . 'templates/' . $app->getTemplate() . $info['src'];
            $info['src_path'] = $rootPath . '/templates/' . $app->getTemplate() . $defaults['src'];
        }
        $info['href'] = isset($defaults['href']) ? $defaults['href'] : JUri::base(true);

        $themeParams = $app->getTemplate(true)->params;
        if ($themeParams->get('logoFile')) {
            $info['src'] = Uri::root() . $themeParams->get('logoFile');
            $info['src_path'] = $rootPath . '/' . $themeParams->get('logoFile');
        }
        if ($themeParams->get('logoLink')) {
            $info['href'] = $themeParams->get('logoLink');
        }

        $parts = explode(".", $info['src_path']);
        $extension = end($parts);
        $isSvgFile = strtolower($extension) == 'svg' ? true : false;

        if ($setThemeSizes) {
            $style = '';
            $themeLogoWidth = $themeParams->get('logoWidth', '');
            $themeLogoHeight = $themeParams->get('logoHeight', '');
            if ($themeLogoWidth) {
                $style .= "max-width: " . $themeLogoWidth . "px !important;\n";
            }
            if ($themeLogoHeight) {
                $style .= "max-height: " . $themeLogoHeight . "px !important;\n";
            }

            if ($isSvgFile) {
                if ($themeLogoWidth > $themeLogoHeight && $themeLogoWidth) {
                    $style .= "width: " . $themeLogoWidth . "px  !important\n";
                }
                if ($themeLogoWidth <= $themeLogoHeight && $themeLogoHeight) {
                    $style .= "height: " . $themeLogoHeight . "px  !important\n";
                }
            }

            if ($style) {
                $document = $app->getDocument();
                $document->addStyleDeclaration('.u-logo img {' . $style . '}');
            }
        }
        return $info;
    }

    $balanceStorage = array();
    $balanceIndex = 0;

    function balanceReplacer($match) {
        global $balanceStorage;
        global $balanceIndex;
        $balanceIndex++;
        $key = '[[BDSCRIPT' . $balanceIndex . ']]';
        $balanceStorage[$key] = $match[0];
        return $key;
    }

    function balanceReplacer2($match) {
        global $balanceStorage;
        return $balanceStorage[$match[0]];
    }

    function funcBalanceTags($text) {

        $text = preg_replace_callback('/<script[^>]*>([\s\S]*?)<\/script>/', 'balanceReplacer' , $text);

        $singleTags = array('area', 'base', 'basefont', 'br', 'col', 'command', 'embed', 'frame', 'hr', 'img', 'input', 'isindex', 'link', 'meta', 'param', 'source');
        $nestedTags = array('blockquote', 'div', 'object', 'q', 'span');

        $stack = array();
        $size = 0;
        $queue = '';
        $output = '';

        while (preg_match("/<(\/?[\w:]*)\s*([^>]*)>/", $text, $match)) {
            $output .= $queue;

            $i = strpos($text, $match[0]);
            $l = strlen($match[0]);

            $queue = '';

            if (isset($match[1][0]) && '/' == $match[1][0]) {
                // processing of the end tag
                $tag = strtolower(substr($match[1],1));

                if($size <= 0) {
                    $tag = '';
                } else if ($stack[$size - 1] == $tag) {
                    $tag = '</' . $tag . '>';
                    array_pop($stack);
                    $size--;
                } else {
                    for ($j = $size-1; $j >= 0; $j--) {
                        if ($stack[$j] == $tag) {
                            for ($k = $size-1; $k >= $j; $k--) {
                                $queue .= '</' . array_pop($stack) . '>';
                                $size--;
                            }
                            break;
                        }
                    }
                    $tag = '';
                }
            } else {
                // processing of the begin tag
                $tag = strtolower($match[1]);

                if (substr($match[2], -1) == '/') {
                    if (!in_array($tag, $singleTags))
                        $match[2] = trim(substr($match[2], 0, -1)) . "></$tag";
                } elseif (in_array($tag, $singleTags)) {
                    $match[2] .= '/';
                } else {
                    if ($size > 0 && !in_array($tag, $nestedTags) && $stack[$size - 1] == $tag) {
                        $queue = '</' . array_pop($stack) . '>';
                        $size--;
                    }
                    $size = array_push($stack, $tag);
                }

                // attributes
                $attributes = $match[2];
                if(!empty($attributes) && $attributes[0] != '>')
                    $attributes = ($tag ? ' ' : '') . $attributes;

                $tag = '<' . $tag . $attributes . '>';

                if (!empty($queue)) {
                    $queue .= $tag;
                    $tag = '';
                }
            }
            $output .= substr($text, 0, $i) . $tag;
            $text = substr($text, $i + $l);
        }

        $output .= ($queue . $text);

        while($t = array_pop($stack))
            $output .= '</' . $t . '>';

        $output = preg_replace_callback('/\[\[BDSCRIPT[0-9]+\]\]/', 'balanceReplacer2', $output);
        return $output;
    }

    function stylingDefaultControls($content) {
        $content = preg_replace('/<form([\s\S]+?)class="form/', '<form$1class="u-form form', $content);
        $content = preg_replace('/<input([\s\S]+?)class="input/', '<input$1class="u-input input', $content);
        $content = preg_replace('/<button([\s\S]+?)class="btn/', '<button$1class="u-btn u-button-style btn', $content);
        return $content;
    }

    function getProportionImage(&$images, &$etalons) {
        if (count($images) < 1) {
            return '';
        }
        for ($i = 0; $i < count($images); $i++) {
            $image = $images[$i];
            for ($j = 0; $j < count($etalons); $j++) {
                $etalon = $etalons[$j];
                if ($image['width'] >= $etalon['width']) {
                    $image = $image['name'];
                    array_splice($images, $i, 1);
                    array_splice($etalons, $j, 1);
                    return $image;
                }
            }
        }
        return $images[0]['name'];
    }

    $GLOBALS['themeBlocks'] = array();

    function processPositions($content) {
        $content = preg_replace_callback(
            '/<\!--position-->([\s\S]+?)<\!--\/position-->/',
            function ($match) {
                $block = $match[1];
                preg_match('/data-position="([^"]*)"/', $block, $match2);
                $position = $match2[1];
                $i = count($GLOBALS['themeBlocks']) + 1;
                $GLOBALS['themeBlocks'][$i] = $block;
                $document = Factory::getApplication()->getDocument();
                if ($position && $document->countModules($position) !== 0) {
                    $attr = array(
                        'style' => 'upstylefromtheme',
                        'iterator' => $i,
                        'id' => $i,
                        'name' => $position
                    );
                    return $document->getBuffer('modules', $position, $attr);
                } else {
                    return '';
                }
            },
            $content
        );
        return $content;
    }

    function createGuid()
    {
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    function getGridAutoRowsStyles($json, $itemsCount)
    {
        $options = json_decode($json, true);
        $gridProps = isset($options['gridProps']) ? $options['gridProps'] : array();
        return buildGridAutoRowsStyles($gridProps, $itemsCount);
    }

    function buildGridAutoRowsStyles($props, $itemsCount)
    {
        $stylesResult = '';
        foreach ($props as $prop) {
            $autoRows = calcGridAutoRows(
                array(
                    'items' => $itemsCount,
                    'columns' => $prop['columns'],
                    'gap' => $prop['gap']
                )
            );
            $stylesResult .= str_replace('[[' . $prop['mode'] . '_VALUE]]', $autoRows, $prop['styles']);
        }
        return $stylesResult ? '<style>' . $stylesResult . '</style>' : '';
    }

    function calcGridAutoRows($params = array()) {
        $rows = isset($params['rows']) ? $params['rows'] : null;
        $columns = isset($params['columns']) ? $params['columns'] : 1;

        if (!$rows) {
            $rows = ceil($params['items'] / $columns);
        }

        $gap = floatval($params['gap']);
        $gapMultiplier = $gap * ($rows - 1) / $rows;
        $autoRowsValue = (floor(100 / $rows * 100) / 100) . '%';

        return $gapMultiplier > 0 ? 'calc(' . $autoRowsValue . ' - ' . $gapMultiplier . 'px)' : $autoRowsValue;
    }

    function outputErrorPage($context) {
        $app = Factory::getApplication();
        $format = $app->input->getCmd('format', 'html');
        ?>
        <div id="errorboxbody">
            <h2>
                <?php echo Text::_('JERROR_LAYOUT_PAGE_NOT_FOUND'); ?>
            </h2>
            <h3><?php echo Text::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?></h3>
            <p><?php echo Text::_('JERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?></p>
            <ul>
                <li><?php echo Text::_('JERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?></li>
                <li><?php echo Text::_('JERROR_LAYOUT_MIS_TYPED_ADDRESS'); ?></li>
                <li><?php echo Text::_('JERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?></li>
                <li><?php echo Text::_('JERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_THIS_PAGE'); ?></li>
            </ul>
            <?php if ($format === 'html' && ModuleHelper::getModule('mod_search')) : ?>
                <div id="searchbox">
                    <h3 class="unseen">
                        <?php echo Text::_('TPL_PAGE404_SEARCH'); ?>
                    </h3>
                    <p>
                        <?php echo Text::_('JERROR_LAYOUT_SEARCH'); ?>
                    </p>
                    <?php $module = ModuleHelper::getModule('mod_search'); ?>
                    <?php echo ModuleHelper::renderModule($module); ?>
                </div><!-- end searchbox -->
            <?php endif; ?>
            <div><!-- start goto home page -->
                <p>
                    <a href="<?php echo $context->baseurl; ?>/index.php" title="<?php echo Text::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?>"><?php echo Text::_('JERROR_LAYOUT_HOME_PAGE'); ?></a>
                </p>
            </div><!-- end goto home page -->
            <h3>
                <?php echo Text::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?>
            </h3>
            <h2>
                #<?php echo $context->error->getCode(); ?>&nbsp;<?php echo htmlspecialchars($context->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?>
            </h2>
            <?php if ($context->debug) : ?>
                <br/><?php echo htmlspecialchars($context->error->getFile(), ENT_QUOTES, 'UTF-8');?>:<?php echo $context->error->getLine(); ?>
            <?php endif; ?>
            <br />
        </div>
        <?php
    }
}