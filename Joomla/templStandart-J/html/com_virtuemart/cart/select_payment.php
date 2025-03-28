<?php
defined('_JEXEC') or die;
?>

<?php
$addClass = "";

if (VmConfig::get('oncheckout_show_steps', 1)) {
    echo '<div class="checkoutStep" id="checkoutStep3">' . vmText::_('COM_VIRTUEMART_USER_FORM_CART_STEP3') . '</div>';
}

if ($this->layoutName != 'default') {
    $headerLevel = 4;
    if($this->cart->getInCheckOut()) {
        $buttonclass = 'button  bd-button';
    } else {
        $buttonclass = 'default';
    }
    ?>
    <form method="post" id="paymentForm" name="choosePaymentRate" action="<?php echo JRoute::_('index.php'); ?>" class="form-validate <?php echo $addClass ?>">
<?php } else {
    $headerLevel = 6;
    $buttonclass = ' bd-button';
}

echo "<h" . $headerLevel . ">" . vmText::_('COM_VIRTUEMART_CART_SELECT_PAYMENT') . "</h" . $headerLevel . ">";

if ($this->found_payment_method ) {
    echo "<fieldset>";
    foreach ($this->paymentplugins_payments as $paymentplugin_payments) {
        if (is_array($paymentplugin_payments)) {
            foreach ($paymentplugin_payments as $paymentplugin_payment) {
                echo $paymentplugin_payment . '<br />';
            }
        }
    }
    echo "</fieldset>";
} else {
    echo "<h1>" . $this->payment_not_found_text . "</h1>";
}
?>
    <div class=" bd-container-42 bd-tagstyles">
        <button name="updatecart" class="<?php echo $buttonclass ?>" type="submit"><?php echo vmText::_('COM_VIRTUEMART_SAVE'); ?></button>
        &nbsp;
        <?php   if ($this->layoutName != 'default') { ?>
            <button class="<?php echo $buttonclass ?>" type="reset" onClick="window.location.href='<?php echo JRoute::_('index.php?option=com_virtuemart&view=cart&task=cancel'); ?>'" ><?php echo vmText::_('COM_VIRTUEMART_CANCEL'); ?></button>
        <?php  } ?>
    </div>
<?php
if ($this->layoutName != 'default') {
    ?>    <input type="hidden" name="option" value="com_virtuemart" />
    <input type="hidden" name="view" value="cart" />
    <input type="hidden" name="task" value="updatecart" />
    <input type="hidden" name="controller" value="cart" />
    </form>
    <?php
}
?>
