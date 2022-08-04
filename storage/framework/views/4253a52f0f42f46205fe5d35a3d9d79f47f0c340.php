<!-- body nav start -->
<?php ($siteInfo = settings()); ?>
<?php ($privilege = Auth::user()->privilege); ?>
<?php ($accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : '')); ?>
<div class="body_nav">
    <ul>
        <!--<?php if(Auth::user()->privilege == 'super'): ?>
        <li><a class="addMember" href="<?php echo e(route('admin.member.create')); ?>">Add Member</a></li>
        <?php endif; ?>-->
        
        <?php if( ($privilege == 'super') || (!empty($accessList->affidavit->submenu->add_affidavit) && $accessList->affidavit->submenu->add_affidavit == "add_affidavit")): ?>
        <li><a class="addAffidavit" href="<?php echo e(route('admin.affidavit.create')); ?>">নতুন নোটিশ</a></li>
        <?php endif; ?>
        <?php if( ($privilege == 'super') || ( !empty($accessList->affidavit->submenu->all_affidavit) && $accessList->affidavit->submenu->all_affidavit == "all_affidavit")): ?>
        <li><a class="allAffidavit" href="<?php echo e(route('admin.affidavit')); ?>" >সকল নোটিশ</a></li>
        <?php endif; ?>
    </ul>
</div>
<!-- body nav start -->
<?php /**PATH /home/kajodrsv/amaruptax.com/resources/views/affidavit/nav.blade.php ENDPATH**/ ?>