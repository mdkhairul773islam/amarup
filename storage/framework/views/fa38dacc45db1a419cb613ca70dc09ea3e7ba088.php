<?php $__env->startSection('content'); ?>
    <!-- body container start -->
    <div class="body_container">
        <?php echo $__env->make('tax-collection.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>সদস্যের কর-সংগ্রহ</h4>
                    <a id="print" class="print_btn"><i class="icon ion-md-print"></i> Print</a>
                </div>
                <div class="panel_body">
                    <?php ($members  = $member->where('id', $info->member_id)->first()); ?>
                    <?php ($division = $divisions->where('id', $members->division_id)->first()); ?>
                    <?php ($district = $districts->where('id', $members->district_id)->first()); ?>
                    <?php ($upazila  = $upazilas->where('id', $members->upazila_id)->first()); ?>
                    <?php ($union    = $unions->where('id', $members->union_id)->first()); ?>
                    
                    <div class="receipt_header">
                        <p>ইউপি ফরম-৩ [ বিধি ৮ দ্রষ্টব্য ]</p>
                        <h2 class="text-center">কর ও রেইট আদায়ের রশিদ</h2>
                    </div>
                    
                    <div class="receipt_body">
                        <p class="text-right"> রসিদ নংঃ  <span style="border-bottom: 1px dashed #222;"><?php echo e(numberFilter($info->receipt_no,'bn')); ?></span></p>
                        <p>১। ইউনিয়ন পরিষদের নামঃ <span style="border-bottom: 1px dashed #222;"><?php echo e(!empty($union) ?  $union->bn_name : ''); ?></span></p>
                        <p>২। গ্রামের নামঃ <span style="border-bottom: 1px dashed #222;"><?php echo e(!empty($members) ?  $members->village : ''); ?></span></p>
                        <p>৩। মালিক বা দখলদারের নামঃ <span style="border-bottom: 1px dashed #222;"><?php echo e(!empty($members) ?  $members->householder : ''); ?></span></p>
                        <p>৪। মূল্যায়ন তালিকার ক্রমিক নংঃ <span style="width: 250px; border-bottom: 1px dashed #222;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
                        <p>৫। গৃহীত অর্থঃ  টাকা <span style="border-bottom: 1px dashed #222;"><?php echo e(numberFilter($info->paid,'bn')); ?></span>
                            (কথায়) <?php echo e($obj->numToWord($info->paid)); ?> টাকা মাত্র। </p>
                        <p>৬। জরিমানা (যদি থাকে):  টাকা <span style="border-bottom: 1px dashed #222;"><?php echo e(numberFilter($info->fine,'bn')); ?></span>
                            (কথায়) <?php echo e($obj->numToWord($info->fine)); ?> টাকা মাত্র। </p>
                        <p>৭। মোট টাকা <span style="border-bottom: 1px dashed #222;"><?php echo e(numberFilter($info->total,'bn')); ?></span>
                            (কথায়) <?php echo e($obj->numToWord($info->total)); ?> টাকা মাত্র। </p>
                    </div>
                </div>
                <div class="panel_footer"></div>
            </div>
        </div>
        <!-- body content end -->
    </div>
    <!-- body container end -->
<?php $__env->stopSection(); ?>

<!--<?php $__env->startPush('footer-style'); ?>-->
<!--<style>-->
<!--    @page  {-->
<!--        margin: 0;-->
<!--        size: A5;-->
<!--    }-->
<!--</style>-->
<!--<?php $__env->stopPush(); ?>-->

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kajodrsv/amaruptax.com/resources/views/tax-collection/view.blade.php ENDPATH**/ ?>