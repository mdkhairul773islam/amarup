<?php $__env->startSection('content'); ?>
    <!-- body container start -->
    <div class="body_container" ng-controller="appController" ng-cloak>
        <?php echo $__env->make('tax-collection.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>সদস্যের কর-সংগ্রহ পরিবর্তন করুন</h4>
                </div>
                
                <div class="panel_body">
                    <form action="<?php echo e(route('admin.tax-collection.update')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" value="<?php echo e($info->id); ?>" >
                        <div class="row">
                            <div class="col-md-6">
                                <label>তারিখ <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="created" value="<?php echo e($info->created); ?>" class="form-control datepicker" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>রসিদ নং <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="receipt_no" value="<?php echo e($info->receipt_no); ?>" class="form-control" required>
                                </div>
    						</div>
                            
                            <?php if($userInfo->privilege != 'user'): ?>
                            <div class="col-md-6">
                                <label>জেলা <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select name="district_id" id="districtId" onchange="getUpazilaFn()" class="form-control" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="39" <?php echo e(($info->memberInfo->district_id=='39' ? "selected" : " ")); ?> >
                                            সুনামগঞ্জ
                                        </option>
                                        <option value="45" <?php echo e(($info->memberInfo->district_id=='45' ? "selected" : " ")); ?> >
                                            কিশোরগঞ্জ
                                        </option>
                                        <option value="62" <?php echo e(($info->memberInfo->district_id=='62' ? "selected" : " ")); ?> >
                                            ময়মনসিংহ
                                        </option>
                                        <option value="64" <?php echo e(($info->memberInfo->district_id=='64' ? "selected" : " ")); ?> >
                                            নেত্রকোণা
                                        </option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>উপজেলা <span class="text-danger">*</span></label>
                                <div class="form-group" >
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
                                <div class="form-group" >
                                    <select name="ward_id" id="wardNo" onchange="getWardWiseFn()" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <?php $__currentLoopData = $wards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>" <?php echo e((($info->memberInfo->ward_id==$value->id) ? "selected" : " ")); ?>><?php echo e($value->name_bn); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
    						
                            <div class="col-md-6">
                                <label>সদস্যের নাম <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select name="member_id" id="memberName" class="form-control" data-live-search="true" required>
                                        <option value="" selected>সদস্য নির্বাচন করুন </option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>হোল্ডিং নং</label>
                                <div class="form-group">
                                    <input type="text" id="holdingNo" value="<?php echo e((!empty($info->memberInfo) ? $info->memberInfo->holding_no : " ")); ?>" class="form-control" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>পিতা/স্বামীর নাম</label>
                                <div class="form-group">
                                    <input type="text" id="fatherName" value="<?php echo e((!empty($info->memberInfo) ? $info->memberInfo->father_name : " ")); ?>" class="form-control" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>মোবাইল নং</label>
                                <div class="form-group">
                                    <input type="text" id="mobileNo" class="form-control" value="<?php echo e((!empty($info->memberInfo) ? $info->memberInfo->mobile_no : " ")); ?>" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>বার্ষিক কর/ ট্যাক্সের পরিমাণ</label>
                                <div class="form-group">
                                    <input type="text" id="taxes" name="taxes" class="form-control" ng-init="taxes=<?php echo e($info->taxes); ?>" ng-model="taxes" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>বার্ষিক মূল্যায়ণ</label>
                                <div class="form-group">
                                    <input type="text" name="annual_assessment" class="form-control" ng-value="getAnnualAsset()" readonly>
                                </div>
                            </div>
						
                            <div class="col-md-6">
                                <label>বসত ঘরের আনুমানিক মূল্য</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" ng-value="getEstimatedValue()" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>পূর্বের জমাকৃত ট্যাক্স</label>
                                <div class="form-group">
                                    <input type="text" id="previousPaid" class="form-control" value="<?php echo e($previousPaid); ?>" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label> অর্থ বছর </label>
                                <div class="form-group">
                                    <select name="finence_year" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <?php for($i = date('Y'); $i >= (date('Y')-4); $i--): ?>
                                        <?php $finenceYear = ($i . '-' . ($i+1));
                                              $currentYear = date('Y') . '-' . (date('Y')+1);
                                        ?>
                                            <option value="<?php echo e($finenceYear); ?>" <?php echo e((($finenceYear==$currentYear) ? 'selected' : '')); ?>><?php echo e($finenceYear); ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>ট্যাক্স জমা</label>
                                <div class="form-group">
                                    <input inputmode="numeric" ng-init="paid=<?php echo e($info->paid); ?>" ng-model="paid" pattern="[0-9]*" type="number" name="paid" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>জরিমানা</label>
                                <div class="form-group">
                                    <input inputmode="numeric" ng-init="fine=<?php echo e($info->fine); ?>" ng-model="fine" pattern="[0-9]*" type="number" name="fine" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label> মোট টাকা </label>
                                <div class="form-group">
                                    <input type="text" name="total" id="totalAmount" class="form-control" ng-value="paid + fine" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group text-right">
                                    <button type="submit" class="btn submit_btn" name="save"> আপডেট করুন </button>
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

<?php $__env->startPush('footer-script'); ?>
<script>
    $('#memberName').on('change', function(){

        var holdingNo        = "";
        var fatherInfo       = "";
        var mobileNo         = "";
        var taxes            = "";
        var previousPaid     = "";

        var _memberId = $(this).val();

        $.ajax({
            method : "POST",
            url    : "<?php echo e(route('admin.tax-collection.member-info')); ?>",
            data   : { id: _memberId, _token: "<?php echo e(csrf_token()); ?>" }
        }).then(function(response){

            fatherInfo       = response.father_name;
            holdingNo        = response.holding_no;
            mobileNo         = response.mobile_no;
            taxes            = response.taxes
            previousPaid     = response.previous_paid

            $('#holdingNo').val(holdingNo);
            $('#fatherName').val(fatherInfo);
            $('#mobileNo').val(mobileNo);
            $('#taxes').val(taxes);
            $('#previousPaid').val(previousPaid);
        });
    });
    
    // get Ward Wise Member Info
    $('#memberName').selectpicker();
    function getWardWiseFn() {
        $('#memberName').empty();
        var _wardNo = ($('#wardNo').val()) ? $('#wardNo').val() : '<?php echo e($info->memberInfo->ward_id); ?>';
        var _unionId = ($('#unionId').val()) ? $('#unionId').val() : '<?php echo e($info->memberInfo->union_id); ?>';
        $.ajax({
            method: "POST",
            url: "<?php echo e(route('admin.tax-collection.ward-wise-member')); ?>",
            data: {ward_id: _wardNo, select_id: "<?php echo e($info->memberInfo->id); ?>",union_id: _unionId, _token: "<?php echo e(csrf_token()); ?>"}
        }).then(function (response) {
            $('#memberName').append(response);
            $('#memberName').selectpicker('refresh');
        });
    }
    getWardWiseFn();

    $('#divisionId').selectpicker();
    $('#districtId').selectpicker();
    
    // get Upazila list
    function getUpazilaFn (){
        $('#upazilaId').empty();
        var _districtId = ($('#districtId').val()) ? $('#districtId').val() : '<?php echo e($info->memberInfo->district_id); ?>';
        $.ajax({
            method: "POST",
            url: "<?php echo e(route('admin.member.upazila-list')); ?>",
            data: { id: _districtId, select_id: "<?php echo e($info->memberInfo->upazila_id); ?>", _token: "<?php echo e(csrf_token()); ?>" }
        }).then(function(response){
            $('#upazilaId').append(response);
            $('#upazilaId').selectpicker('refresh');
        });
    }
    getUpazilaFn();
    // get Upazila list
    function getUnionFn (){
        $('#unionId').empty();
        var _upazilaId = ($('#upazilaId').val()) ? $('#upazilaId').val() : '<?php echo e($info->memberInfo->upazila_id); ?>';
        $.ajax({
            method: "POST",
            url: "<?php echo e(route('admin.member.union-list')); ?>",
            data: { id: _upazilaId, select_id: "<?php echo e($info->memberInfo->union_id); ?>", _token: "<?php echo e(csrf_token()); ?>" }
        }).then(function(response){
            $('#unionId').append(response);
            $('#unionId').selectpicker('refresh');
        });
    }
    getUnionFn();
    
    app.controller('appController', function($scope) {
       $scope.getAnnualAsset = function(){
           var taxes = (!isNaN(parseFloat($scope.taxes)) ? parseFloat($scope.taxes) : 0);
           var amount = Math.ceil((taxes*14.28));
           return amount;
       };
       $scope.getEstimatedValue = function(){
           var taxes = (!isNaN(parseFloat($scope.taxes)) ? parseFloat($scope.taxes) : 0);
           var amount = Math.ceil((taxes*284.78));
           return amount;
       };
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kajodrsv/amaruptax.com/resources/views/tax-collection/edit.blade.php ENDPATH**/ ?>