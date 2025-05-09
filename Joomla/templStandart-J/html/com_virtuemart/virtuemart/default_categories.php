<?php
defined('_JEXEC') or die;
?>

<?php require_once dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . 'functions.php'; ?>
<?php
$itemClass = 'separated-item-3 col-md-12 grid';
$mergedModes = '' . '1' . '' . '';
if ('' === $mergedModes) {
    $categories_per_row = VmConfig::get ( 'categories_per_row', 3);
    $itemClass = preg_replace('/col-(lg|md|sm|xs)-\d+/', '', $itemClass) . preg_replace('/col-(lg|md|sm|xs)-\d+/',
      'col-$1-' . round(12 / min(12, max(1, $categories_per_row))), ' col-lg-1 col-md-1 col-sm-1 col-xs-1');
}
?>
<div class=" bd-productcategories-1">
  <div class="container-fluid">
    <div class="separated-grid row">
    <div class=" bd-container-9 bd-tagstyles">
    <h4><?php echo JText::_('COM_VIRTUEMART_CATEGORIES') ?></h4>
</div>
    <?php foreach ($this->categories as $category) : ?>
    <?php
            $categoryNameDecorator = new stdClass();
            $categoryNameDecorator->link = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id=' . $category->virtuemart_category_id, FALSE);
    $categoryNameDecorator->name = $category->category_name;
    $categoryImageDecorator = new stdClass();
    $categoryImageDecorator->image = $category->images[0];
    $categoryImageDecorator->link = $categoryNameDecorator->link;
    $categoryItems = new stdClass();
    $categoryItems->categoryName = $categoryNameDecorator;
    $categoryItems->categoryImage = $categoryImageDecorator;
    ?>
    
    <div class="<?php echo $itemClass; ?>">
        <div class="bd-griditem-3">
            <?php if (isset($categoryItems->categoryName)) : ?>
<div class=" bd-categoryname-1">
    <?php
            if ('' !== $categoryItems->categoryName->link)
    echo JHTML::link($categoryItems->categoryName->link, $categoryItems->categoryName->name);
    else
    echo $categoryItems->categoryName->name;
    ?>
</div>
<?php endif; ?>
	
		<?php if (isset($categoryItems->categoryImage)) : ?>
<?php
            $height = 'height:' . VmConfig::get ('img_height') . 'px;';
            $width = 'width:' . VmConfig::get ('img_width') . 'px;';
            $size = $height . $width;
        ?>
<?php if ('' !== $categoryItems->categoryImage->link) : ?>
<a class=" bd-categoryimage-1" href="<?php echo $categoryItems->categoryImage->link; ?>">
    <?php echo $categoryItems->categoryImage->image->displayMediaThumb('class=" bd-imagestyles-32" ', false); ?>
</a>
<?php else: ?>
<div class=" bd-categoryimage-1">
    <?php echo $categoryItems->categoryImage->image->displayMediaThumb('class=" bd-imagestyles-32 "', false); ?>
</div>
<?php endif; ?>
<?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
    </div>
  </div>
</div>
