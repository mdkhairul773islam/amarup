<?php $__env->startSection('content'); ?>
    <!-- body container start -->
    <div class="body_container" ng-controller="appController" ng-cloak>
        
        <?php echo $__env->make('bazar_member.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>বাজারের সদস্য যোগ করুন</h4>
                </div>
                <div class="panel_body">
                    <form action="<?php echo e(route('admin.bazar_member.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            
                            <div class="col-md-6">
                                <label>দোকান / কারখানার মালিকের নাম<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="holder_name" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>পিতা/স্বামীর নাম <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="father_name" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>মাতার নাম <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <input type="text" name="mother_name" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>মোবাইল নং <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="tel" placeholder="" name="mobile_no" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>ব্যবসার নাম <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="business_name" class="form-control" required>
                                </div>
                            </div>
                            
                            <?php if($userInfo->privilege != 'user'): ?>
                            <div class="col-md-6">
                                <label>জেলা <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select name="district_id" id="districtId" onchange="getUpazilaFn()" class="form-control" data-live-search="true" required>
                                        <option value="" selected> জেলা নির্বাচন করুন</option>
                                        <option value="39">সুনামগঞ্জ</option>
                                        <option value="45">কিশোরগঞ্জ</option>
                                        <option value="62">ময়মনসিংহ</option>
                                        <option value="64">নেত্রকোণা</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>উপজেলা <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select name="upazila_id" id="upazilaId" onchange="getUnionFn()" class="form-control" data-live-search="true" required>
                                        <option value="" selected> উপজেলা নির্বাচন করুন</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>ইউনিয়ন <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select name="union_id" id="unionId" class="form-control" data-live-search="true" required>
                                        <option value="" selected> ইউনিয়ন নির্বাচন করুন</option>
                                    </select>
                                </div>
                            </div>
                            <?php else: ?>
                                <input type="hidden" name="district_id" value="<?php echo e($userInfo->district_id); ?>" id="districtId">
                                <input type="hidden" name="upazila_id" value="<?php echo e($userInfo->upazila_id); ?>" id="upazilaId">
                                <input type="hidden" name="union_id" value="<?php echo e($userInfo->union_id); ?>" id="unionId">
                            <?php endif; ?>
                            
                            <div class="col-md-6">
                                <label>ওয়ার্ড নং <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select name="ward_id" id="wardNo" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <?php $__currentLoopData = $wards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->name_bn); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>হোল্ডিং নং <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" id="holdingNo" name="holding_no" onkeyup="uniqeHoldingNo()" class="form-control yes" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>ভাড়াটিয়া আছে কিনা ? <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select name="tenant" id="tenant" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="হ্যাঁ">হ্যাঁ</option>
                                        <option value="না">না</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6" id="tenantName">
                                <label>ভাড়াটিয়ার নাম <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <input type="text" name="tenant_name" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-6" id="tenantFatherName">
                                <label>ভাড়াটিয়ার পিতার নাম <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <input type="text" name="tenant_father_name" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-6" id="tenantBusinessAssets">
                                <label>ভাড়াটিয়ার ব্যবসার মোট পুঁজি<span class="text-danger"></span></label>
                                <div class="form-group">
                                    <input type="text" name="tenant_business_assets" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>কারখানা/দোকান ঘর সহ মোট জমি কত শতাংশ<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="total_land" class="form-control" placeholder="" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>বাজারের নাম<span class="text-danger"></span></label>
                                <div class="form-group">
                                    <input type="text" name="bazar_name" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>ঘর নির্মাণ সহ ব্যবসার মোট পুঁজি<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="total_assets" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>বার্ষিক ব্যবসার আয়<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="business_income" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>বার্ষিক মূল্যায়ণ<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="annual_assessment" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>বার্ষিক করের পরিমাণ<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="total_taxes" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>ছবি (৩০০ X ৩০০)</label>
                                <div class="form-group">
                                    <input type="file" name="member_image" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group text-right">
                                    <button type="submit" class="btn submit_btn" name="save">সেইভ করুন</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
        .hr_style {
            display: block;
            width: 100%;
            border-top: 1px solid #0B499D !important;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('footer-script'); ?>
    <script>

        $(document).ready(function () {
            $('#tenantName').hide();
            $('#tenantFatherName').hide();
            $('#tenantBusinessAssets').hide();

            $('#tenant').on('change', function () {
                var _tenant = $(this).val();
                if (_tenant === "হ্যাঁ") {
                    $('#tenantName').show();
                    $('#tenantFatherName').show();
                    $('#tenantBusinessAssets').show();
                } else {
                    $('#tenantName').hide();
                    $('#tenantFatherName').hide();
                    $('#tenantBusinessAssets').hide();
                }
            });
        });

        $('#divisionId').selectpicker();

        // get distric list
        function getDistrictFn() {
            $('#districtId').empty();
            var _divisionId = $('#divisionId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.district-list')); ?>",
                data: {id: _divisionId, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#districtId').append(response);
                $('#districtId').selectpicker('refresh');
            });
        }

        // get Upazila list
        function getUpazilaFn() {
            $('#upazilaId').empty();
            var _districtId = $('#districtId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.upazila-list')); ?>",
                data: {id: _districtId, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#upazilaId').append(response);
                $('#upazilaId').selectpicker('refresh');
            });
        }

        // get Upazila list
        function getUnionFn() {
            $('#unionId').empty();
            var _upazilaId = $('#upazilaId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.union-list')); ?>",
                data: {id: _upazilaId, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#unionId').append(response);
                $('#unionId').selectpicker('refresh');
            });
        }

        /* angular script */
        /*app.controller('appController', function ($scope) {
            $scope.getAnnualAsset = function () {
                var taxes = (!isNaN(parseFloat($scope.taxes)) ? parseFloat($scope.taxes) : 0);
                var amount = Math.ceil((taxes * 14.28));
                return amount;
            };
            $scope.getEstimatedValue = function () {
                var taxes = (!isNaN(parseFloat($scope.taxes)) ? parseFloat($scope.taxes) : 0);
                var amount = Math.ceil((taxes * 284.78));
                return amount;
            };
        });*/
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kajodrsv/amaruptax.com/resources/views/bazar_member/create.blade.php ENDPATH**/ ?>