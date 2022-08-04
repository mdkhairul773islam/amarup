<!-- body nav start -->
<?php ($siteInfo = settings()); ?>
<?php ($privilege = Auth::user()->privilege); ?>
<?php ($accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : '')); ?>
<div class="body_nav">
    <ul>
        <!--<?php if(Auth::user()->privilege == 'super'): ?>
        <li><a  class="addTaxCollection" href="<?php echo e(route('admin.tax-collection.create')); ?>">Add Tax Collection</a></li>
        <?php endif; ?>-->
        <?php if( ($privilege == 'super') || (!empty($accessList->tax_collection->submenu->add_tax) && $accessList->tax_collection->submenu->add_tax == "add_tax")): ?>
        <li><a  class="addTaxCollection" href="<?php echo e(route('admin.tax-collection.create')); ?>">নতুন কর-সংগ্রহ করুন</a></li>
        <?php endif; ?>
        <?php if( ($privilege == 'super') || (!empty($accessList->tax_collection->submenu->all_tax) && $accessList->tax_collection->submenu->all_tax == "all_tax")): ?>
        <li><a  class="allTaxCollection" href="<?php echo e(route('admin.tax-collection')); ?>">সকল কর দেখুন</a></li>
        <?php endif; ?>
    </ul>
</div>
<!-- body nav start -->
<?php /**PATH /home/kajodrsv/amaruptax.com/resources/views/tax-collection/nav.blade.php ENDPATH**/ ?>