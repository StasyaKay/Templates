<?php
defined('_JEXEC') or die;
?>

<!--COMPONENT common -->
<?php ob_start(); ?>

<div class=" bd-products"  >
    <div class="bd-container-inner">
    <?php if (!empty($this->keyword)) : ?>
        <h3><?php echo $this->keyword; ?></h3>
    <?php endif; ?>
    
    <div class=" bd-container-52 bd-tagstyles">
    <h2><?php echo $this->category->category_name; ?></h2>
</div>
    
    <div class=" bd-categories-24">
    
    
</div>
    <?php if (!empty($this->products)) : ?>
    <div class=" bd-productsgridbar-28">
    <div class="bd-container-inner">
        <div class=" bd-layoutcontainer-27 bd-columns bd-no-margins">
    <div class="bd-container-inner">
        <div class="container-fluid">
            <div class="row ">
                <div class=" bd-columnwrapper-57 
 col-md-4">
    <div class="bd-layoutcolumn-57 bd-column" ><div class="bd-vertical-align-wrapper"><div class=" bd-typeselector-1">
    
</div></div></div>
</div>
	
		<div class=" bd-columnwrapper-58 
 col-md-5">
    <div class="bd-layoutcolumn-58 bd-column" ><div class="bd-vertical-align-wrapper"><?php if ($this->orderByList) : ?>
<div class=" bd-productssorter-1">
    <?php echo JText::_ ('COM_VIRTUEMART_ORDERBY'); ?>
    <?php
        $content = $this->orderByList['orderby'];
        $result = '';
    ?>
    <?php
            if (preg_match_all('/<a title="([^"]*)" href="([^"]*)">(.*?)<\/a>/', $content, $matches, PREG_SET_ORDER)) {
    $result = '<select onchange="location.href=this.options[this.selectedIndex].value">';
    foreach($matches as $value) {
    $selected = '';
    $name = $value[3];
    if ($value[1] !== $value[3]) {
    $name = str_replace($value[1],'', $name);
    $selected = ' selected="selected"';
    }
    $result .= '<option value="' . $value[2] . '"' . $selected .'>' . $name . '</option>';
    }
    $result .= '</select>';
    } else {
    $result = $content;
    }
    echo $result;
    ?>
</div>
<?php endif; ?></div></div>
</div>
	
		<div class=" bd-columnwrapper-59 
 col-md-3">
    <div class="bd-layoutcolumn-59 bd-column" ><div class="bd-vertical-align-wrapper"><div class=" bd-productsperpage-1">
    <?php echo $this->vmPagination->getResultsCounter();?>
    <?php echo str_replace( 'window.top.location', 'location',  $this->vmPagination->getLimitBox()); ?>

</div></div></div>
</div>
            </div>
        </div>
    </div>
</div>
	
		<?php renderTemplateFromIncludes('products_grid_pagination_1', array($this)); ?>
    </div>
</div>
    <?php foreach ($this->products as $type => $products ) : ?>
    <?php if (count($products) < 1) continue; ?>
    <div class=" bd-grid-53">
      <div class="container-fluid">
        <div class="separated-grid row">
          <?php foreach ($products as $product ) : ?>
    <?php
        $customfieldsModel = VmModel::getModel('customfields');
        $product->customfields = $customfieldsModel->getCustomEmbeddedProductCustomFields($product->allIds, 0, 1);
        if ($product->customfields){
            $customfieldsModel->displayProductCustomfieldFE($product, $product->customfields);
        }
        //create product title decorator object
        $productTitleDecorator = new stdClass();
        $productTitleDecorator->link = $product->link;
        $productTitleDecorator->name = $product->product_name;
        //create product desc decorator object
        $productDescDecorator = new stdClass();
        $productDescDecorator->desc = $product->product_s_desc;
        //create product manufacturer decorator object
        $productManufacturerDecorator = new stdClass();
        $productManufacturerDecorator->name = $product->mf_name;
        //create product price decorator object
        $productPriceDecorator = new stdClass();
        $productPriceDecorator->show_prices = $this->show_prices;
        $productPriceDecorator->currency = $this->currency;
        $productPriceDecorator->prices = $product->prices;
        $productPriceDecorator->imagesExists = isset($product->images) ? true : false;
        $productPriceDecorator->image = $productPriceDecorator->imagesExists ? $product->images[0] : null;
        //create product image decorator object
        $productImageDecorator = new stdClass();
        $productImageDecorator->imagesExists = isset($product->images) ? true : false;
        $productImageDecorator->image = $productImageDecorator->imagesExists ? $product->images[0] : null;
        $productImageDecorator->link = $product->link;
        //create product buy decorator object
        $productBuyDecorator = new stdClass();
        $productBuyDecorator->prices = $product->prices;
        $productBuyDecorator->min_order_level = isset($product->min_order_level) ? $product->min_order_level : null;
        $productBuyDecorator->step_order_level = isset($product->step_order_level) ? $product->step_order_level : null;
        $productBuyDecorator->product_in_stock = isset($product->product_in_stock) ? $product->product_in_stock : 0;
        $productBuyDecorator->product_ordered = isset($product->product_ordered) ? $product->product_ordered : 0;
        $productBuyDecorator->orderable = $product->orderable;
        $productBuyDecorator->link = $product->link;
        $productBuyDecorator->product_name = $product->product_name;
        $productBuyDecorator->virtuemart_product_id = $product->virtuemart_product_id;
        //create product sale decorator object
        $productSaleDecorator = new stdClass();
        $productSaleDecorator->prices = $product->prices;
        //create product out of stock decorator object
        $productOutOfStockDecorator = new stdClass();
        if (isset($product->product_in_stock) && isset($product->product_ordered)) {
            $productOutOfStockDecorator->product_in_stock = $product->product_in_stock;
            $productOutOfStockDecorator->product_ordered = $product->product_ordered;
        } else {
            $productOutOfStockDecorator = null;
        }
        //create products items collection
        $productItems = new stdClass();
        $productItems->productTitle = $productTitleDecorator;
        $productItems->productDesc  = $productDescDecorator;
        $productItems->productManufacturer = $productManufacturerDecorator;
        $productItems->productPrice = $productPriceDecorator;
        $productItems->productImage = $productImageDecorator;
        $productItems->productBuy   = $productBuyDecorator;
        $productItems->productSale = $productSaleDecorator;
        $productItems->productOutOfStock = $productOutOfStockDecorator;

        $defaultLayoutName = "grid";
        $activeLayoutName = empty($_COOKIE['layoutType']) ? $defaultLayoutName : $_COOKIE['layoutType'];
    ?>
    
    <div class="separated-item-5 col-lg-3 col-md-4 col-sm-6 grid vm-product-item"<?php if ('grid' !== $activeLayoutName): ?> style="display: none;"<?php endif ?>>
        <div class=" bd-griditem-5">
            <?php if (isset($productItems->productImage)) : ?>
    <?php if ($productItems->productImage->imagesExists) : ?>
    <?php
        $offsetHeight = isset($productItems->productImage->offsetHeight) ? $productItems->productImage->offsetHeight : 0;
        $offsetWidth = isset($productItems->productImage->offsetWidth) ? $productItems->productImage->offsetWidth : 0;
        $height = 'height:' . (VmConfig::get ('img_height') + $offsetHeight) . 'px;';
        $width ='width:' . (VmConfig::get ('img_width') + $offsetWidth) . 'px;';
        if (is_object($productItems->productImage->image))
            $imgHtml = $productItems->productImage->image->displayMediaThumb('class=" bd-imagestyles"', false);
        else
            $imgHtml = str_replace('<img', '<img class=" bd-imagestyles" ', $productItems->productImage->image);
    ?>
    <a class=" bd-productimage-4" href="<?php echo $productItems->productImage->link; ?>">
        <?php echo $imgHtml; ?>
    </a>
    <?php endif; ?>
<?php endif; ?>
	
		<?php if (isset($productItems->productTitle)) : ?>
<div class=" bd-producttitle-8">
    <?php
    if ('' !== $productItems->productTitle->link)
        echo JHTML::link($productItems->productTitle->link, $productItems->productTitle->name);
    else 
        echo $productItems->productTitle->name;
    ?>
</div>
<?php endif; ?>
	
		<?php if (isset($productItems->productPrice)) : ?>
<div class=" bd-productprice-3 product-prices">
    <?php
    if ($productItems->productPrice->show_prices == '1') {
        if (is_array($productItems->productPrice->prices) && $productItems->productPrice->prices['salesPrice']<=0
            && VmConfig::get ('askprice', 1) && $productItems->productPrice->imagesExists
            && !$productItems->productPrice->image->file_is_downloadable) {
            $askquestion_url = JRoute::_('index.php?option=com_virtuemart&view=productdetails&task=askquestion&virtuemart_product_id=' .
        $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id . '&tmpl=component', FALSE);
        ?>
        <a class="ask-a-question  bd-button" href="<?php echo $askquestion_url; ?>" rel="nofollow" >
            <?php echo JText::_ ('COM_VIRTUEMART_PRODUCT_ASKPRICE'); ?>
        </a>
        <?php
        }

        $oldPrice = false;
        $oldPriceObj = array('description' => 'COM_VIRTUEMART_PRODUCT_BASEPRICE', 'html' => '');
        $regularPriceObj = array('description' => 'COM_VIRTUEMART_PRODUCT_SALESPRICE', 'html' => '');

        if (is_array($productItems->productPrice->prices)) {
            $oldPriceObj['html'] = call_user_func_array(array(&$productItems->productPrice->currency, 'createPriceDiv'),
                array(
                    'name' => 'basePrice',
                    'description' => 'COM_VIRTUEMART_PRODUCT_BASEPRICE',
                    $productItems->productPrice->prices,
                    true
                )
            );

            $regularPriceObj['html'] =  call_user_func_array(array(&$productItems->productPrice->currency, 'createPriceDiv'),
                array(
                    'name' => 'salesPrice',
                    'description' => 'COM_VIRTUEMART_PRODUCT_SALESPRICE',
                    $productItems->productPrice->prices,
                    true
                )
            );
        }

        if (is_string($productItems->productPrice->prices)) {
            if (isset($productItems->productPrice->label))
                $regularPriceObj['description'] = $productItems->productPrice->label;
            $regularPriceObj['html'] = $productItems->productPrice->prices;
        }
    ?>
    
    <?php if (!empty($regularPriceObj['html'])) : ?>
<div class=" bd-pricetext-10">
    
    <span class=" bd-container-30 bd-tagstyles salesPrice">
        <?php echo $regularPriceObj['html']; ?>
    </span>
</div>
<?php endif; ?>
    
    <?php if (!empty($oldPriceObj['html'])) : ?>
<div class=" bd-pricetext-11">
    
    <span class=" bd-container-31 bd-tagstyles basePrice">
        <?php echo $oldPriceObj['html']; ?>
    </span>
</div>
<?php endif; ?>
    <?php } ?>
</div>
<?php endif; ?>
	
		<div class=" bd-layoutcontainer-41 bd-columns bd-no-margins">
    <div class="bd-container-inner">
        <div class="container-fluid">
            <div class="row ">
                <div class=" bd-columnwrapper-119 
 col-md-12
 col-sm-6
 col-xs-6">
    <div class="bd-layoutcolumn-119 bd-column" ><div class="bd-vertical-align-wrapper"><?php $descLength = intval('40'); ?>
<?php if (isset($productItems->productDesc)) : ?>
<div class=" bd-productdesc-9">
    <?php if (property_exists($productItems->productDesc, 'isFull') || $descLength <= 0) :
        echo $productItems->productDesc->desc;
    else :
        echo shopFunctionsF::limitStringByWord($productItems->productDesc->desc, $descLength, '...');
    ?>
    <?php endif; ?>
</div>
<?php endif; ?></div></div>
</div>
            </div>
        </div>
    </div>
</div>
	
		<?php if (isset($productItems->productBuy)) : ?>
<form method="post" class="product" action="<?php echo JRoute::_ ('index.php'); ?>">
    <?php
        // todo output customfields
        $buttonDataAttrs = '';
        $classNames = ' bd-productbuy-2 bd-no-margins bd-button';
    ?>
    <?php if (!VmConfig::get('use_as_catalog', 0)) : ?>
        <?php
            $quantity = 1;
            if (isset($productItems->productBuy->step_order_level) && (int)$productItems->productBuy->step_order_level > 0) {
                $quantity = $productItems->productBuy->step_order_level;
            } else if (!empty($productItems->productBuy->min_order_level)){
                $quantity = $productItems->productBuy->min_order_level;
            }
        ?>
        <?php $stockhandle = VmConfig::get ('stockhandle', 'none'); ?>
        <?php if (($stockhandle == 'disableit' or $stockhandle == 'disableadd') and ($productItems->productBuy->product_in_stock - $productItems->productBuy->product_ordered) < 1) : ?>
            <?php
                echo JHTML::link (JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&layout=notify&virtuemart_product_id=' . $productItems->productBuy->virtuemart_product_id), vmText::_ ('COM_VIRTUEMART_CART_NOTIFY'), 'class="' . $classNames . ' notify" ' . $buttonDataAttrs);
            ?>
        <?php else : ?>
            <?php
                $tmpPrice = (float)$productItems->productBuy->prices['costPrice'];
                if (!(VmConfig::get('askprice', true) and empty($tmpPrice))) {
                    if (isset($productItems->productBuy->orderable) && $productItems->productBuy->orderable) {
                        $vmLang = VmConfig::get ('vmlang_js', 1) ? '&lang=' . substr (VmConfig::$vmlang, 0, 2) : '';
                        $attributes = 'data-vmsiteurl="' . JURI::root( ) . '" ' .
                            'data-vmlang="' . $vmLang . '" ' .
                            'data-vmsuccessmsg="' . JText::_('COM_VIRTUEMART_CART_ADDED') . '" ' .
                            'title="' . $productItems->productBuy->product_name . '" ' .
                            'class="' . $classNames . ' add_to_cart_button" ' .
                            $buttonDataAttrs;
                        echo JHTML::link ('#', JText::_ ('COM_VIRTUEMART_CART_ADD_TO'), $attributes);
                    } else {
                        $button = JHTML::link ($productItems->productBuy->link, JText::_ ('COM_VIRTUEMART_CART_ADD_TO'),
                            'title="' . $productItems->productBuy->product_name . '" ' . 'class="' . $classNames . '" ' . $buttonDataAttrs);
                        if (isset($productItems->productBuy->isOne))
                            $button = JText::_('COM_VIRTUEMART_ADDTOCART_CHOOSE_VARIANT');
                        echo $button;
                    }
                }
            ?>
        <?php endif; ?>
    <?php endif; ?>
    <input type="hidden" name="quantity[]" value="<?php echo $quantity; ?>"/>
    <noscript><input type="hidden" name="task" value="add"/></noscript>
    <input type="hidden" name="option" value="com_virtuemart"/>
    <input type="hidden" name="view" value="cart"/>
    <input type="hidden" name="virtuemart_product_id[]" value="<?php echo $productItems->productBuy->virtuemart_product_id ?>"/>
    <input type="hidden" class="pname" value="<?php echo htmlentities($productItems->productBuy->product_name) ?>"/>
</form>
<?php endif; ?>
	
		<?php if (isset($productItems->productSale)) : ?>
<?php if ($productItems->productSale->prices['discountedPriceWithoutTax'] != $productItems->productSale->prices['priceWithoutTax']) : ?>
<div class=" bd-productsaleicon bd-productsale-2">
    <span>Sale!</span>
</div>
<?php endif; ?>
<?php endif; ?>
        </div>
    </div>
    <div class="separated-item-6 col-md-12 list vm-product-item"<?php if ('list' !== $activeLayoutName): ?> style="display: none;"<?php endif ?>>
        <div class=" bd-griditem-6">
            <div class=" bd-layoutcontainer-26 bd-columns bd-no-margins">
    <div class="bd-container-inner">
        <div class="container-fluid">
            <div class="row ">
                <div class=" bd-columnwrapper-54 
 col-md-2">
    <div class="bd-layoutcolumn-54 bd-column" ><div class="bd-vertical-align-wrapper"><?php if (isset($productItems->productImage)) : ?>
    <?php if ($productItems->productImage->imagesExists) : ?>
    <?php
        $offsetHeight = isset($productItems->productImage->offsetHeight) ? $productItems->productImage->offsetHeight : 0;
        $offsetWidth = isset($productItems->productImage->offsetWidth) ? $productItems->productImage->offsetWidth : 0;
        $height = 'height:' . (VmConfig::get ('img_height') + $offsetHeight) . 'px;';
        $width ='width:' . (VmConfig::get ('img_width') + $offsetWidth) . 'px;';
        if (is_object($productItems->productImage->image))
            $imgHtml = $productItems->productImage->image->displayMediaThumb('class=" bd-imagestyles"', false);
        else
            $imgHtml = str_replace('<img', '<img class=" bd-imagestyles" ', $productItems->productImage->image);
    ?>
    <a class=" bd-productimage-5" href="<?php echo $productItems->productImage->link; ?>">
        <?php echo $imgHtml; ?>
    </a>
    <?php endif; ?>
<?php endif; ?>
	
		<?php if (isset($productItems->productSale)) : ?>
<?php if ($productItems->productSale->prices['discountedPriceWithoutTax'] != $productItems->productSale->prices['priceWithoutTax']) : ?>
<div class=" bd-productsaleicon bd-productsale-3">
    <span>Sale!</span>
</div>
<?php endif; ?>
<?php endif; ?>
	
		<?php if (isset($productItems->productOutOfStock)) : ?>
<?php if (($productItems->productOutOfStock->product_in_stock - $productItems->productOutOfStock->product_ordered) < 1) : ?>
<div class="bd-productoutofstockicon  bd-productoutofstock-3">
    <?php echo JText::_('COM_VIRTUEMART_CART_OUTOFSTOCK'); ?>
</div>
<?php endif; ?>
<?php endif; ?></div></div>
</div>
	
		<div class=" bd-columnwrapper-55 
 col-md-7">
    <div class="bd-layoutcolumn-55 bd-column" ><div class="bd-vertical-align-wrapper"><?php if (isset($productItems->productTitle)) : ?>
<div class=" bd-producttitle-10">
    <?php
    if ('' !== $productItems->productTitle->link)
        echo JHTML::link($productItems->productTitle->link, $productItems->productTitle->name);
    else 
        echo $productItems->productTitle->name;
    ?>
</div>
<?php endif; ?>
	
		<?php $descLength = intval('40'); ?>
<?php if (isset($productItems->productDesc)) : ?>
<div class=" bd-productdesc-11">
    <?php if (property_exists($productItems->productDesc, 'isFull') || $descLength <= 0) :
        echo $productItems->productDesc->desc;
    else :
        echo shopFunctionsF::limitStringByWord($productItems->productDesc->desc, $descLength, '...');
    ?>
    <?php endif; ?>
</div>
<?php endif; ?></div></div>
</div>
	
		<div class=" bd-columnwrapper-56 
 col-md-3">
    <div class="bd-layoutcolumn-56 bd-column" ><div class="bd-vertical-align-wrapper"><?php if (isset($productItems->productPrice)) : ?>
<div class=" bd-productprice-4 bd-no-margins product-prices">
    <?php
    if ($productItems->productPrice->show_prices == '1') {
        if (is_array($productItems->productPrice->prices) && $productItems->productPrice->prices['salesPrice']<=0
            && VmConfig::get ('askprice', 1) && $productItems->productPrice->imagesExists
            && !$productItems->productPrice->image->file_is_downloadable) {
            $askquestion_url = JRoute::_('index.php?option=com_virtuemart&view=productdetails&task=askquestion&virtuemart_product_id=' .
        $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id . '&tmpl=component', FALSE);
        ?>
        <a class="ask-a-question  bd-button" href="<?php echo $askquestion_url; ?>" rel="nofollow" >
            <?php echo JText::_ ('COM_VIRTUEMART_PRODUCT_ASKPRICE'); ?>
        </a>
        <?php
        }

        $oldPrice = false;
        $oldPriceObj = array('description' => 'COM_VIRTUEMART_PRODUCT_BASEPRICE', 'html' => '');
        $regularPriceObj = array('description' => 'COM_VIRTUEMART_PRODUCT_SALESPRICE', 'html' => '');

        if (is_array($productItems->productPrice->prices)) {
            $oldPriceObj['html'] = call_user_func_array(array(&$productItems->productPrice->currency, 'createPriceDiv'),
                array(
                    'name' => 'basePrice',
                    'description' => 'COM_VIRTUEMART_PRODUCT_BASEPRICE',
                    $productItems->productPrice->prices,
                    true
                )
            );

            $regularPriceObj['html'] =  call_user_func_array(array(&$productItems->productPrice->currency, 'createPriceDiv'),
                array(
                    'name' => 'salesPrice',
                    'description' => 'COM_VIRTUEMART_PRODUCT_SALESPRICE',
                    $productItems->productPrice->prices,
                    true
                )
            );
        }

        if (is_string($productItems->productPrice->prices)) {
            if (isset($productItems->productPrice->label))
                $regularPriceObj['description'] = $productItems->productPrice->label;
            $regularPriceObj['html'] = $productItems->productPrice->prices;
        }
    ?>
    
    
    <?php if (!empty($oldPriceObj['html'])) : ?>
<div class=" bd-pricetext-13">
    
        <span class=" bd-label-13">
            <?php echo JText::_($oldPriceObj['description']); ?>
        </span>
    <span class=" bd-container-33 bd-tagstyles basePrice">
        <?php echo $oldPriceObj['html']; ?>
    </span>
</div>
<?php endif; ?>
    <?php if (!empty($regularPriceObj['html'])) : ?>
<div class=" bd-pricetext-12">
    
        <span class=" bd-label-12">
            <?php echo JText::_($regularPriceObj['description']); ?>
        </span>
    <span class=" bd-container-32 bd-tagstyles salesPrice">
        <?php echo $regularPriceObj['html']; ?>
    </span>
</div>
<?php endif; ?>
    <?php } ?>
</div>
<?php endif; ?>
	
		<?php if (isset($productItems->productBuy)) : ?>
<form method="post" class="product" action="<?php echo JRoute::_ ('index.php'); ?>">
    <?php
        // todo output customfields
        $buttonDataAttrs = '';
        $classNames = ' bd-productbuy-3 bd-button';
    ?>
    <?php if (!VmConfig::get('use_as_catalog', 0)) : ?>
        <?php
            $quantity = 1;
            if (isset($productItems->productBuy->step_order_level) && (int)$productItems->productBuy->step_order_level > 0) {
                $quantity = $productItems->productBuy->step_order_level;
            } else if (!empty($productItems->productBuy->min_order_level)){
                $quantity = $productItems->productBuy->min_order_level;
            }
        ?>
        <?php $stockhandle = VmConfig::get ('stockhandle', 'none'); ?>
        <?php if (($stockhandle == 'disableit' or $stockhandle == 'disableadd') and ($productItems->productBuy->product_in_stock - $productItems->productBuy->product_ordered) < 1) : ?>
            <?php
                echo JHTML::link (JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&layout=notify&virtuemart_product_id=' . $productItems->productBuy->virtuemart_product_id), vmText::_ ('COM_VIRTUEMART_CART_NOTIFY'), 'class="' . $classNames . ' notify" ' . $buttonDataAttrs);
            ?>
        <?php else : ?>
            <?php
                $tmpPrice = (float)$productItems->productBuy->prices['costPrice'];
                if (!(VmConfig::get('askprice', true) and empty($tmpPrice))) {
                    if (isset($productItems->productBuy->orderable) && $productItems->productBuy->orderable) {
                        $vmLang = VmConfig::get ('vmlang_js', 1) ? '&lang=' . substr (VmConfig::$vmlang, 0, 2) : '';
                        $attributes = 'data-vmsiteurl="' . JURI::root( ) . '" ' .
                            'data-vmlang="' . $vmLang . '" ' .
                            'data-vmsuccessmsg="' . JText::_('COM_VIRTUEMART_CART_ADDED') . '" ' .
                            'title="' . $productItems->productBuy->product_name . '" ' .
                            'class="' . $classNames . ' add_to_cart_button" ' .
                            $buttonDataAttrs;
                        echo JHTML::link ('#', JText::_ ('COM_VIRTUEMART_CART_ADD_TO'), $attributes);
                    } else {
                        $button = JHTML::link ($productItems->productBuy->link, JText::_ ('COM_VIRTUEMART_CART_ADD_TO'),
                            'title="' . $productItems->productBuy->product_name . '" ' . 'class="' . $classNames . '" ' . $buttonDataAttrs);
                        if (isset($productItems->productBuy->isOne))
                            $button = JText::_('COM_VIRTUEMART_ADDTOCART_CHOOSE_VARIANT');
                        echo $button;
                    }
                }
            ?>
        <?php endif; ?>
    <?php endif; ?>
    <input type="hidden" name="quantity[]" value="<?php echo $quantity; ?>"/>
    <noscript><input type="hidden" name="task" value="add"/></noscript>
    <input type="hidden" name="option" value="com_virtuemart"/>
    <input type="hidden" name="view" value="cart"/>
    <input type="hidden" name="virtuemart_product_id[]" value="<?php echo $productItems->productBuy->virtuemart_product_id ?>"/>
    <input type="hidden" class="pname" value="<?php echo htmlentities($productItems->productBuy->product_name) ?>"/>
</form>
<?php endif; ?></div></div>
</div>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
    <?php endforeach; ?>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
    <div class=" bd-productsgridbar-30">
    <div class="bd-container-inner">
        <?php renderTemplateFromIncludes('products_grid_pagination_2', array($this)); ?>
    </div>
</div>
    <?php elseif (!empty($this->keyword)) : ?>
        <?php echo JText::_('COM_VIRTUEMART_NO_RESULT').($this->keyword? ' : ('. $this->keyword. ')' : ''); ?>
    <?php endif; ?>
    </div>
</div>

<?php
echo ob_get_clean();
?>
<!--COMPONENT common /-->