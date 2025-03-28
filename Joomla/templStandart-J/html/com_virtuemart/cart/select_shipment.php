<?php
defined('_JEXEC') or die;
?>

<?php
if (VmConfig::get('oncheckout_show_steps', 1)) {
    echo '<div class="checkoutStep" id="checkoutStep2">' . vmText::_('COM_VIRTUEMART_USER_FORM_CART_STEP2') . '</div>';
}

if ($this->layoutName != 'default') {
    $headerLevel = 4;
    if($this->cart->getInCheckOut()) {
        $buttonclass = 'button  bd-button';
    } else {
        $buttonclass = 'default';
    }
?>
<form method="post" id="userForm" name="chooseShipmentRate" action="<?php echo JRoute::_('index.php'); ?>" class="form-validate">
<?php
} else {
    $headerLevel = 6;
    $buttonclass = ' bd-button';
}

    echo "<h" . $headerLevel . ">" . vmText::_('COM_VIRTUEMART_CART_SELECT_SHIPMENT') . "</h" . $headerLevel . ">";

    if ($this->found_shipment_method) {

        echo "<fieldset>\n";
        // if only one Shipment , should be checked by default
        foreach ($this->shipments_shipment_rates as $shipment_shipment_rates) {
            if (is_array($shipment_shipment_rates)) {
                foreach ($shipment_shipment_rates as $shipment_shipment_rate) {
                    echo $shipment_shipment_rate . "<br />\n";
                }
            }
        }
        echo "</fieldset>\n";
    } else {
        echo "<h".$headerLevel.">".$this->shipment_not_found_text."</h".$headerLevel.">";
    }
?>
    <div class=" bd-container-42 bd-tagstyles">

        <button  name="updatecart" class="<?php echo $buttonclass ?>" type="submit" ><?php echo vmText::_('COM_VIRTUEMART_SAVE'); ?></button>  &nbsp;
        <?php   if ($this->layoutName != 'default') { ?>
            <button class="<?php echo $buttonclass ?>" type="reset" onClick="window.location.href='<?php echo JRoute::_('index.php?option=com_virtuemart&view=cart&task=cancel'); ?>'" ><?php echo vmText::_('COM_VIRTUEMART_CANCEL'); ?></button>
        <?php  } ?>
    </div>
<?php
if ($this->layoutName != 'default') {
?> <input type="hidden" name="option" value="com_virtuemart" />
   <input type="hidden" name="view" value="cart" />
   <input type="hidden" name="task" value="updatecart" />
   <input type="hidden" name="controller" value="cart" />
</form>
<?php
}
?>
