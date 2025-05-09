<?php
defined('_JEXEC') or die;
?>

<?php
    require_once dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . 'functions.php';
?>
<div class=" bd-shoppingcarttable-1">
<div class="table-responsive">
<table class=" bd-table-24">
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th><?php echo JText::_ ('COM_VIRTUEMART_CART_NAME') ?></th>
            <th><?php echo JText::_ ('COM_VIRTUEMART_CART_SKU') ?></th>
            <th><?php echo JText::_ ('COM_VIRTUEMART_CART_PRICE') ?></th>
            <th><?php echo JText::_ ('COM_VIRTUEMART_CART_QUANTITY') ?> / <?php echo JText::_ ('COM_VIRTUEMART_CART_ACTION') ?></th>
            <?php if (VmConfig::get ('show_tax')) : ?>
                <th><?php  echo "<span  class='priceColor2'>" . JText::_ ('COM_VIRTUEMART_CART_SUBTOTAL_TAX_AMOUNT') ?></th>
            <?php endif; ?>
            <th><?php echo "<span  class='priceColor2'>" . JText::_ ('COM_VIRTUEMART_CART_SUBTOTAL_DISCOUNT_AMOUNT') ?></th>
            <th><?php echo JText::_ ('COM_VIRTUEMART_CART_TOTAL') ?></th>
            <th>&nbsp;</th>
        </tr>
    </thead>
<?php $i = 1; ?>
<tbody>
<tr>
    <td colspan="<?php echo VmConfig::get ('show_tax') ? 9 : 8; ?>">&nbsp;</td>
</tr>
<?php $index = 1; ?>
<?php foreach ($this->cart->products as $pkey => $prow) : ?>
<tr <?php if ($index % 2 === 0): ?> class="alt" <?php endif ?>>
	<td>
        <a href="<?php echo $prow->url; ?>">
            <?php if ($prow->virtuemart_media_id && $prow->virtuemart_media_id[0]) : ?>
                <?php
                    if (!class_exists ('TableMedias'))
                        require(JPATH_VM_ADMINISTRATOR . DS . 'tables' . DS . 'medias.php');
                    $db = JFactory::getDBO ();
                    $data = new TableMedias($db);
                    $data->load((int)$prow->virtuemart_media_id[0]);
                    if (!class_exists ('VmMediaHandler'))
                        require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'mediahandler.php');
                    $media = VmMediaHandler::createMedia ($data, 'product');
                    echo $media->displayMediaThumb ('class=" bd-imagestyles"', FALSE);
                ?>
            <?php else: ?>
                <?php
                    $themeUrl = VmConfig::get('vm_themeurl',0);
                    if(empty($themeUrl)) {
                        $themeUrl = JURI::root().'components/com_virtuemart/';
                    }
                    $src = $themeUrl.'assets/images/vmgeneral/' . VmConfig::get('no_image_set');
                    $alt = JText::_('COM_VIRTUEMART_NO_IMAGE_SET');
                    echo '<img class=" bd-imagestyles" src="' . $src . '" alt="' . $alt . '" />';
                ?>
            <?php endif; ?>
        </a>
    </td>
    <td>
        <div class=" bd-producttext-14">
    <?php
        echo JHTML::link($prow->url, $prow->product_name);
        if (is_string($prow->customfields))
            echo $prow->customfields;
        else
            echo $this->customfieldsModel->CustomsFieldCartDisplay ($prow);
    ?>
</div>
	</td>
	<td><?php  echo $prow->product_sku ?></td>
	<td>
		<?php
            echo $this->currencyDisplay->createPriceDiv ('basePriceVariant', '', $this->cart->pricesUnformatted[$pkey], FALSE);
		?>
	</td>
	<td>
        <?php if ($prow->step_order_level) : ?>
            <?php $step=$prow->step_order_level; ?>
        <?php else : ?>
            <?php $step=1; ?>
        <?php endif; ?>
        <?php if($step==0) : ?>
            <?php $step=1; ?>
        <?php endif; ?>
        <?php $alert = JText::sprintf ('COM_VIRTUEMART_WRONG_AMOUNT_ADDED', $step); ?> 
        <script type="text/javascript">
        function check<?php echo $step?>(obj) {
        // use the modulus operator '%' to see if there is a remainder
        remainder=obj.value % <?php echo $step?>;
        quantity=obj.value;
        if (remainder  != 0) {
            alert('<?php echo $alert?>!');
            obj.value = quantity-remainder;
            return false;
        }
        return true;
        }
        </script> 
        <input type="text" onblur="check<?php echo $step?>(this);" onclick="check<?php echo $step?>(this);" onchange="check<?php echo $step?>(this);" onsubmit="check<?php echo $step?>(this);" title="<?php echo  JText::_('COM_VIRTUEMART_CART_UPDATE') ?>" class=" bd-bootstrapinput form-control" size="3" maxlength="4" name="quantity[<?php echo $pkey; ?>]" value="<?php echo $prow->quantity ?>" />
        <div class=" bd-container-42 bd-tagstyles">
            <button class=" bd-button" type="submit" name="updatecart.<?php echo $pkey ?>" title="<?php echo  JText::_ ('COM_VIRTUEMART_CART_UPDATE') ?>" >
                <span><span><?php echo  JText::_ ('COM_VIRTUEMART_CART_UPDATE') ?></span></span>
            </button>
        </div>
	</td>

	<?php if (VmConfig::get ('show_tax')) : ?>
        <td>
            <?php echo "<span class='priceColor2'>" . $this->currencyDisplay->createPriceDiv ('taxAmount', '', $this->cart->pricesUnformatted[$pkey], FALSE, FALSE, $prow->quantity) . "</span>" ?>
        </td>
	<?php endif; ?>
	<td>
        <?php echo "<span class='priceColor2'>" . $this->currencyDisplay->createPriceDiv ('discountAmount', '', $this->cart->pricesUnformatted[$pkey], FALSE, FALSE, $prow->quantity) . "</span>" ?>
    </td>
	<td>
		<?php
		if (VmConfig::get ('checkout_show_origprice', 1) && !empty($this->cart->pricesUnformatted[$pkey]['basePriceWithTax']) && $this->cart->pricesUnformatted[$pkey]['basePriceWithTax'] != $this->cart->pricesUnformatted[$pkey]['salesPrice']) {
			echo '<span class="line-through">' . $this->currencyDisplay->createPriceDiv ('basePriceWithTax', '', $this->cart->pricesUnformatted[$pkey], TRUE, FALSE, $prow->quantity) . '</span><br />';
		}
		echo $this->currencyDisplay->createPriceDiv ('salesPrice', '', $this->cart->pricesUnformatted[$pkey], FALSE, FALSE, $prow->quantity) ?>
    </td>
    <td>
        <a class="removelink" name="delete.<?php echo $pkey ?>" title="<?php echo JText::_ ('COM_VIRTUEMART_CART_DELETE') ?>" href="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=cart&task=delete&cart_virtuemart_product_id=' . $prow->cart_item_id) ?>">
            <span class="
 bd-icon-68 bd-icon "></span>
        </a>
    </td>
</tr>
<?php $index++; ?>
<?php endforeach; ?>

<!--Begin of SubTotal, Tax, Shipment, Coupon Discount and Total listing -->
<tr>
	<td colspan="5"><?php echo JText::_ ('COM_VIRTUEMART_ORDER_PRINT_PRODUCT_PRICES_TOTAL'); ?></td>
	<?php if (VmConfig::get ('show_tax')) : ?>
        <td>
            <?php echo "<span  class='priceColor2'>" . $this->currencyDisplay->createPriceDiv ('taxAmount', '', $this->cart->pricesUnformatted, FALSE) . "</span>" ?>
        </td>
	<?php endif; ?>
	<td>
        <?php echo "<span  class='priceColor2'>" . $this->currencyDisplay->createPriceDiv ('discountAmount', '', $this->cart->pricesUnformatted, FALSE) . "</span>" ?>
    </td>
	<td>
        <?php echo $this->currencyDisplay->createPriceDiv ('salesPrice', '', $this->cart->pricesUnformatted, FALSE) ?>
    </td>
    <td>&nbsp;</td>
</tr>

<?php if (VmConfig::get ('coupons_enable')) : ?>
    <tr>
        <td colspan="5">
        <?php if (!empty($this->layoutName) && $this->layoutName == 'default') : ?>
            <?php echo $this->loadTemplate ('coupon_template'); ?>
        <?php endif; ?>
        <?php if (!empty($this->cart->cartData['couponCode'])) : ?>
            <?php
                echo $this->cart->cartData['couponCode'];
                echo $this->cart->cartData['couponDescr'] ? (' (' . $this->cart->cartData['couponDescr'] . ')') : '';
            ?>
            </td>
            <?php if (VmConfig::get('show_tax')) : ?>
            <td>
                <?php if (!empty($this->cart->cartPrices['couponTax'])) : ?>
                    <?php echo $this->currencyDisplay->createPriceDiv ('couponTax', '', $this->cart->cartPrices['couponTax'], FALSE); ?>
                <?php endif; ?>
            </td>
            <?php endif; ?>
            <td>
                <?php echo $this->currencyDisplay->createPriceDiv ('salesPriceCoupon', '', $this->cart->cartPrices['salesPriceCoupon'], FALSE); ?>
            </td>
            <td>&nbsp;</td>
        <?php else : ?>
        &nbsp;</td>
            <td colspan="<?php echo VmConfig::get('show_tax') ? 3 : 2; ?>">&nbsp;</td>
        <?php endif; ?>
        <td>&nbsp;</td>
    </tr>
<?php endif; ?>

<?php foreach ($this->cart->cartData['DBTaxRulesBill'] as $rule) : ?>
    <tr>
        <td colspan="5"><?php echo $rule['calc_name'] ?></td>
        <?php if (VmConfig::get ('show_tax')) : ?>
            <td>&nbsp;</td>
        <?php endif; ?>
        <td>
            <?php echo $this->currencyDisplay->createPriceDiv ($rule['virtuemart_calc_id'] . 'Diff', '', $this->cart->pricesUnformatted[$rule['virtuemart_calc_id'] . 'Diff'], FALSE); ?>
        </td>
        <td>
            <?php echo $this->currencyDisplay->createPriceDiv ($rule['virtuemart_calc_id'] . 'Diff', '', $this->cart->pricesUnformatted[$rule['virtuemart_calc_id'] . 'Diff'], FALSE); ?> 
        </td>
        <td>&nbsp;</td>
    </tr>
<?php endforeach; ?>

<?php foreach ($this->cart->cartData['taxRulesBill'] as $rule) : ?>
    <tr>
        <td colspan="5"><?php echo $rule['calc_name'] ?> </td>
        <?php if (VmConfig::get ('show_tax')) : ?>
            <td>
                <?php echo $this->currencyDisplay->createPriceDiv ($rule['virtuemart_calc_id'] . 'Diff', '', $this->cart->pricesUnformatted[$rule['virtuemart_calc_id'] . 'Diff'], FALSE); ?> 
            </td>
        <?php endif; ?>
        <td>&nbsp;</td>
        <td>
            <?php echo $this->currencyDisplay->createPriceDiv ($rule['virtuemart_calc_id'] . 'Diff', '', $this->cart->pricesUnformatted[$rule['virtuemart_calc_id'] . 'Diff'], FALSE); ?> 
        </td>
        <td>&nbsp;</td>
    </tr>
<?php endforeach; ?>

<?php foreach ($this->cart->cartData['DATaxRulesBill'] as $rule) : ?>
    <tr>
        <td colspan="5">
            <?php echo   $rule['calc_name'] ?> 
        </td>
        <?php if (VmConfig::get ('show_tax')) : ?>
            <td>&nbsp;</td>
        <?php endif; ?>
        <td>
            <?php echo $this->currencyDisplay->createPriceDiv ($rule['virtuemart_calc_id'] . 'Diff', '', $this->cart->pricesUnformatted[$rule['virtuemart_calc_id'] . 'Diff'], FALSE); ?>  
        </td>
        <td>
            <?php echo $this->currencyDisplay->createPriceDiv ($rule['virtuemart_calc_id'] . 'Diff', '', $this->cart->pricesUnformatted[$rule['virtuemart_calc_id'] . 'Diff'], FALSE); ?> 
        </td>
        <td>&nbsp;</td>
    </tr>
<?php endforeach; ?>

<tr>
	<?php if (!$this->cart->automaticSelectedShipment) : ?>
    <td colspan="5">
        <?php echo $this->cart->cartData['shipmentName']; ?>
        <br/>
        <?php if (!$this->cart->automaticSelectedShipment && !empty($this->layoutName) && $this->layoutName == 'default') : ?>
            <?php
            if (VmConfig::get('oncheckout_opc', 0)) {
                $previouslayout = $this->setLayout('select');
                echo $this->loadTemplate('shipment');
                $this->setLayout($previouslayout);
            } else {
                echo JHtml::_('link', JRoute::_('index.php?view=cart&task=edit_shipment', $this->useXHTML, $this->useSSL), $this->select_shipment_text, 'class=""');
            }
            ?>
        <?php else : ?>
            <?php echo JText::_ ('COM_VIRTUEMART_CART_SHIPPING'); ?>
        <?php endif; ?>
    </td>
    <?php else : ?>
	<td colspan="5">
		<?php echo $this->cart->cartData['shipmentName']; ?>
	</td>
	<?php endif; ?>

	<?php if (VmConfig::get ('show_tax')) : ?>
    <td>
        <?php echo "<span  class='priceColor2'>" . $this->currencyDisplay->createPriceDiv ('shipmentTax', '', $this->cart->pricesUnformatted['shipmentTax'], FALSE) . "</span>"; ?> 
    </td>
	<?php endif; ?>
	<td>&nbsp;</td>
	<td>
        <?php echo $this->currencyDisplay->createPriceDiv ('salesPriceShipment', '', $this->cart->pricesUnformatted['salesPriceShipment'], FALSE); ?>
    </td>
    <td>&nbsp;</td>
</tr>

<?php if ($this->cart->pricesUnformatted['salesPrice'] > 0.0 ) : ?>
    <tr>
        <?php if (!$this->cart->automaticSelectedPayment) : ?>
        <td colspan="5">
            <?php echo $this->cart->cartData['paymentName']; ?>
            <br/>
            <?php if (!empty($this->layoutName) && $this->layoutName == 'default') : ?>
                <?php
                if (VmConfig::get('oncheckout_opc', 0)) {
                    $previouslayout = $this->setLayout('select');
                    echo $this->loadTemplate('payment');
                    $this->setLayout($previouslayout);
                } else {
                    echo JHtml::_('link', JRoute::_('index.php?view=cart&task=editpayment', $this->useXHTML, $this->useSSL), $this->select_payment_text, 'class=""');
                }
                ?>
            <?php else : ?>
                <?php echo JText::_ ('COM_VIRTUEMART_CART_PAYMENT'); ?>
            <?php endif; ?> 
        </td>
        <?php else : ?>
        <td colspan="5">   
            <?php echo $this->cart->cartData['paymentName']; ?> 
        </td>
        <?php endif; ?>
        <?php if (VmConfig::get ('show_tax')) : ?>
        <td>
            <?php echo "<span  class='priceColor2'>" . $this->currencyDisplay->createPriceDiv ('paymentTax', '', $this->cart->pricesUnformatted['paymentTax'], FALSE) . "</span>"; ?> 
        </td>
        <?php endif; ?>
        <td>
            <?php if($this->cart->pricesUnformatted['salesPricePayment'] < 0) : ?>
                <?php echo $this->currencyDisplay->createPriceDiv ('salesPricePayment', '', $this->cart->pricesUnformatted['salesPricePayment'], FALSE); ?>
            <?php endif; ?>
        </td>
        <td>
            <?php echo $this->currencyDisplay->createPriceDiv ('salesPricePayment', '', $this->cart->pricesUnformatted['salesPricePayment'], FALSE); ?>
        </td>
        <td>&nbsp;</td>
    </tr>
<?php endif; ?>

<?php if ($this->totalInPaymentCurrency) : ?>
    <tr>
        <td colspan="5">
            <?php echo JText::_ ('COM_VIRTUEMART_CART_TOTAL_PAYMENT') ?>
        </td>
        <?php if (VmConfig::get ('show_tax')) : ?>
            <td>&nbsp;</td>
        <?php endif; ?>
        <td>&nbsp;</td>
        <td><strong><?php echo $this->totalInPaymentCurrency;?></strong></td>
        <td>&nbsp;</td>
    </tr>
<?php endif; ?>
</tbody>
<?php if ($this->continue_link_html != '') : ?>
<tfoot>
<tr>
    <td colspan="<?php echo VmConfig::get ('show_tax') ? 9 : 8; ?>">
        <?php 
            preg_match('/href="?([^"]*)"/', $this->continue_link_html, $matches);
            $href = $matches[1];
            preg_match('/<a[^>]*>(<span[^>]*>)?(.*?)(<\/span>)?<\/a>/', $this->continue_link_html, $matches);
            $text = $matches[2];
        ?>
        <div class=" bd-container-42 bd-tagstyles">
        <a class=" bd-button" href="<?php echo $href; ?>" >
            <span>
                <span>
                    <?php echo $text; ?>
                </span>
            </span>
        </a></div>
    </td>
</tr>
</tfoot>
    
<?php endif; ?>
</table>
</div>
</div>
