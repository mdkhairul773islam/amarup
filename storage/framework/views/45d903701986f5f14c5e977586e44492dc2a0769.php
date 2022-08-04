<?php $__env->startSection('content'); ?>
    <!-- body container start -->
    <div class="body_container">
        <?php echo $__env->make('member.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>সদস্যের প্রফাইল</h4>
                    <a id="print" class="print_btn"><i class="icon ion-md-print"></i> প্রিন্ট</a>
                </div>
                <div class="panel_body">
                    <?php echo $__env->make('components.print', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="table-responsive">
                        <table class="table table-bordered list-table">
                            <?php ($division = $divisions->where('id', $info->division_id)->first()); ?>
                            <?php ($district = $districts->where('id', $info->district_id)->first()); ?>
                            <?php ($upazila  = $upazilas->where('id', $info->upazila_id)->first()); ?>
                            <?php ($union    = $unions->where('id', $info->union_id)->first()); ?>
                            <?php ($ward     = $wards->where('id', $info->ward_id)->first()); ?>
                            <tr>
                                <th>তারিখ</th>
                                <td colspan="2"><?php echo e(numberFilter($info->created,'bn')); ?></td>
                                <th rowspan="4" class="text-right">
                                    <?php if(!empty($info->path)): ?>
                                        <img class="img-fluid img-thumbnail" src="<?php echo e(asset($info->path)); ?>" style="max-width: 120px; max-height:120px;" alt="">
                                    <?php endif; ?>
                                </th>
                            </tr>
                            <tr>
                                <th>খানা প্রধানের নাম</th>
                                <td colspan="2"><?php echo e($info->householder); ?></td>
                            </tr>
                            <tr>
                                <th>খানা প্রধানের স্ত্রীর নাম</th>
                                <td colspan="2"><?php echo e($info->householder_wife); ?></td>
                            </tr>
                            <tr>
                                <th>পিতা/স্বামীর নাম</th>
                                <td><?php echo e($info->father_name); ?></td>
                            </tr>
                            <tr>
                                <th>মাতার নাম</th>
                                <td><?php echo e($info->mother_name); ?></td>
                                <th>হোল্ডিং নং</th>
                                <td colspan="2"><?php echo e(numberFilter($info->holding_no,'bn')); ?></td>
                            </tr>
                            <tr>
                                <th style="width: 20%;">এন.আই.ডি নং</th>
                                <td><?php echo e(numberFilter($info->nid_no,'bn')); ?></td>
                                <th style="width: 20%;">মোবাইল নং</th>
                                <td><?php echo e(numberFilter($info->mobile_no,'bn')); ?></td>
                            </tr>
                            <tr>
                                <th>ধর্ম</th>
                                <td><?php echo e($info->religion); ?></td>
                                <th>ইউনিয়ন</th>
                                <td><?php echo e((!empty($union) ? $union->bn_name : " ")); ?></td>
                            </tr>
                            <tr>
                                <th>ঠিকানা</th>
                                <td>
                                    <?php echo e(numberFilter($info->holding_no,'bn')); ?>, 
                                    <?php echo e($info->village); ?>, 
                                    <?php echo e((!empty($ward) ? $ward->name_bn : " " )); ?>, 
                                    <?php echo e((!empty($union) ? $union->bn_name : " ")); ?>,  
                                    <?php echo e((!empty($upazila) ? $upazila->bn_name : " ")); ?>, 
                                    <?php echo e((!empty($district) ? $district->bn_name : " ")); ?>.
                                </td>
                                <th>খানার সদস্য</th>
                                <td>
                                    পুরুষ(<?php echo e(numberFilter($info->member_male,'bn')); ?>)-মহিলা(<?php echo e(numberFilter($info->member_female,'bn')); ?>)
                                </td>
                            </tr>
                            <tr>
                                <th>পেশা</th>
                                <td><?php echo e($info->profession); ?></td>
                                <th>বসতের মেঝের পরিমান</th>
                                <td><?php echo e(numberFilter($info->floor_size,'bn')); ?> ফুট</td>
                            </tr>
                            <tr>
                                <th>আবাদী জমির পরিমান</th>
                                <td><?php echo e(numberFilter($info->cultivable_land,'bn')); ?> শতাংশ</td>
                                <th>অনাবাদী জমির পরিমান</th>
                                <td><?php echo e(numberFilter($info->uncultivated_land,'bn')); ?> শতাংশ</td>
                            </tr>
                            <tr>
                                <th>খানার কোন সদস্য প্রতিবন্ধী কিনা?</th>
                                <td><?php echo e($info->handicapped); ?></td>
                                <th>বসতের ধরন</th>
                                <td><?php echo e($info->settlement_type); ?></td>
                            </tr>
                            <tr>
                                <th>প্রতিবন্ধী খানার নাম</th>
                                <td><?php echo e($info->handicapped_name); ?></td>
                                <th>বসত ভিটার জমির মালিকানার ধরন</th>
                                <td><?php echo e($info->ownership_type); ?></td>
                            </tr>
                            <tr>
                                <th colspan="3">খানার কোন সদস্য বর্তমানে সামাজিক নিরাপত্তা বেষ্টনী কোন কর্মসূচীর আওতায় আছে কিনা ?</th>
                                <td> <?php echo e($info->social_security_act); ?> </td>
                            </tr>
                            <tr>
                                <th>খানার কোন সদস্য মুক্তিযোদ্ধা কিনা?</th>
                                <td><?php echo e($info->freedom_fighters); ?></td>
                                
                                <th>মুক্তিযোদ্ধার নাম</th>
                                <td><?php echo e($info->freedom_fighters); ?></td>
                            </tr>
                            <tr>
                                <th>মুক্তিযোদ্ধার সাথে খানা প্রধানের সম্পর্ক</th>
                                <td><?php echo e($info->freedom_fighters); ?></td>
                                <th>দারিদ্রসীমা</th>
                                <td><?php echo e($info->poverty_line); ?></td>
                            </tr>
                            <tr>
                                <th>টিউবওয়েল আছে কিনা ?</th>
                                <td><?php echo e($info->tubewell); ?></td>
                                <th>স্যানিটারী ল্যাট্রিন আছে কিনা ?</th>
                                <td><?php echo e($info->latrine); ?></td>
                            </tr>
                            <tr>
                                <th>বার্ষিক কর/ ট্যাক্সের পরিমাণ</th>
                                <td><?php echo e(numberFilter($info->taxes,'bn')); ?></td>
                                <th>বার্ষিক মূল্যায়ণ</th>
                                <td><?php echo e(numberFilter($info->annual_assessment,'bn')); ?></td>
                            </tr>
                            <tr>
                                <th>বসত ঘরের আনুমানিক মূল্য</th>
                                <td><?php echo e(numberFilter($info->estimated_value,'bn')); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="panel_footer"></div>
            </div>
        </div>
        <!-- body content end -->
    </div>
    <!-- body container end -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-style'); ?>
<style>
    table.table.table-bordered tbody tr th, table.table.table-bordered tbody tr td {vertical-align:middle;}
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kajodrsv/amaruptax.com/resources/views/member/view.blade.php ENDPATH**/ ?>