<?php $__env->startSection('content'); ?>
    <!-- body container start -->
    <div class="body_container" ng-controller="appController" ng-cloak>
        
        <?php echo $__env->make('member.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>সদস্য যোগ করুন</h4>
                </div>
                <div class="panel_body">
                    <form action="<?php echo e(route('admin.member.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <label>খানা প্রধানের নাম <span class="text-danger">*</span></label>
                                <div class="form-group" tabindex="1">
                                    <input type="text" name="householder" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>খানা প্রধানের স্ত্রীর নাম <span class="text-danger">*</span></label>
                                <div class="form-group" tabindex="2">
                                    <input type="text" name="householder_wife" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>পিতা/স্বামীর নাম <span class="text-danger">*</span></label>
                                <div class="form-group" tabindex="4">
                                    <input type="text" name="father_name" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>মাতার নাম <span class="text-danger">*</span></label>
                                <div class="form-group" tabindex="5">
                                    <input type="text" name="mother_name" class="form-control" required>
                                </div>
                            </div>
                            
                            <?php if($userInfo->privilege != 'user'): ?>
                            <div class="col-md-6">
                                <label>জেলা <span class="text-danger">*</span></label>
                                <div class="form-group" tabindex="6">
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
                                <div class="form-group" tabindex="7">
                                    <select name="upazila_id" id="upazilaId" onchange="getUnionFn()" class="form-control" data-live-search="true" required>
                                        <option value="" selected> উপজেলা নির্বাচন করুন</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>ইউনিয়ন <span class="text-danger">*</span></label>
                                <div class="form-group" tabindex="8">
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
                                <div class="form-group" tabindex="9">
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
                                <div class="form-group" tabindex="3">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" id="holdingNo" name="holding_no" onkeyup="uniqeHoldingNo()" class="form-control yes" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>গ্রাম <span class="text-danger">*</span></label>
                                <div class="form-group" tabindex="10">
                                    <input type="text" name="village" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>এন.আই.ডি নং <span class="text-danger">*</span></label>
                                <div class="form-group" tabindex="11">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="nid_no" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>ধর্ম <span class="text-danger">*</span></label>
                                <div class="form-group" tabindex="12">
                                    <select name="religion" class="form-control selectpicker" data-live-search="true">
                                        <option value="" selected>নির্বাচন করুন</option>
                                        <option value="ইসলাম">ইসলাম</option>
                                        <option value="হিন্দু">হিন্দু</option>
                                        <option value="খ্রীষ্টান">খ্রীষ্টান</option>
                                        <option value="বৌদ্ধ">বৌদ্ধ</option>
                                        <option value="অন্যান্য">অন্যান্য</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>মোবাইল নং <span class="text-danger">*</span></label>
                                <div class="form-group" tabindex="13">
                                    <input type="tel" placeholder="" name="mobile_no" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>পেশা <span class="text-danger">*</span></label>
                                <div class="form-group" tabindex="14">
                                    <select name="profession" class="form-control selectpicker" data-live-search="true">
                                        <option value="" selected>নির্বাচন করুন</option>
                                        <option value="কৃষক">কৃষক</option>
                                        <option value="সরকারি চাকুরি">সরকারি চাকুরি</option>
                                        <option value="বেসরকারি চাকুরি">বেসরকারি চাকুরি</option>
                                        <option value="ক্ষুদ্র ব্যবসায়ী">ক্ষুদ্র ব্যবসায়ী</option>
                                        <option value="ব্যবসায়ী">ব্যবসায়ী</option>
                                        <option value="ডাক্তার">ডাক্তার</option>
                                        <option value="ইঞ্জিনিয়ার">ইঞ্জিনিয়ার</option>
                                        <option value="দিন মুজুর">দিন মুজুর</option>
                                        <option value="শ্রমিক">শ্রমিক</option>
                                        <option value="জেলে">জেলে</option>
                                        <option value="তাঁতী">তাঁতী</option>
                                        <option value="অন্যান্য">অন্যান্য</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>লিঙ্গ <span class="text-danger">*</span></label>
                                <div class="form-group" tabindex="15">
                                    <select name="gender" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="পুরুষ">পুরুষ</option>
                                        <option value="মহিলা">মহিলা</option>
                                        <option value="অন্যান্য">অন্যান্য</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>খানার সদস্য সংখ্যা <span class="text-danger">*</span></label>
                                <div class="form-group" tabindex="16">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input inputmode="numeric" tabindex="16" pattern="[0-9]*" type="number" name="member_male" class="form-control" placeholder="পুরুষ" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input inputmode="numeric" tabindex="17" pattern="[0-9]*" type="number" name="member_female" class="form-control" placeholder="মহিলা" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>বসতের মেঝের পরিমাপ (ফুট) <span class="text-danger">*</span></label>
                                <div class="form-group" tabindex="18">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="floor_size" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>আবাদী জমির পরিমান (শতাংশ) <span class="text-danger">*</span></label>
                                <div class="form-group" tabindex="19">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="cultivable_land" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>অনাবাদী জমির পরিমান (শতাংশ) <span class="text-danger">*</span></label>
                                <div class="form-group" tabindex="20">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="uncultivated_land" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>বসতের ধরন <span class="text-danger">*</span></label>
                                <div class="form-group" tabindex="21">
                                    <select name="settlement_type" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="ঝুপরী">ঝুপরী</option>
                                        <option value="কুড়েঘর">কুড়েঘর</option>
                                        <option value="আধা কাচা">আধা কাচা</option>
                                        <option value="কাচা">কাচা</option>
                                        <option value="ছাপড়া">ছাপড়া</option>
                                        <option value="দৌচালা টিনের">দৌচালা টিনের</option>
                                        <option value="চৌচালা টিনের">চৌচালা টিনের</option>
                                        <option value="আধা পাকা">আধা পাকা</option>
                                        <option value="পাকা">পাকা</option>
                                        <option value="বহুতল">বহুতল</option>
                                        <option value="অন্যান্য">অন্যান্য</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>বসত ভিটার জমির মালিকানার ধরন <span class="text-danger">*</span></label>
                                <div class="form-group" tabindex="22">
                                    <select name="ownership_type" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="নিজস্ব">নিজস্ব</option>
                                        <option value="খাস জমি">খাস জমি</option>
                                        <option value="বস্তি">বস্তি</option>
                                        <option value="বেড়ী বাদ">বেড়ী বাদ</option>
                                        <option value="বিনা ভাড়ায় অন্যের জমি">বিনা ভাড়ায় অন্যের জমি</option>
                                        <option value="ভাড়া জমি">ভাড়া জমি</option>
                                        <option value="অন্যান্য">অন্যান্য</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>খানার কোন সদস্য প্রতিবন্ধী কিনা ? <span class="text-danger">*</span></label>
                                <div class="form-group" tabindex="23">
                                    <select name="handicapped" id="handicapped" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="হ্যাঁ">হ্যাঁ</option>
                                        <option value="না">না</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6" id="handicappedName">
                                <label>প্রতিবন্ধী খানার নাম<span class="text-danger">*</span></label>
                                <div class="form-group" tabindex="23">
                                    <input type="text" name="handicapped_name" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>খানার কোন সদস্য বর্তমানে সামাজিক নিরাপত্তা বেষ্টনী কোন কর্মসূচীর আওতায় আছে কিনা ? <span class="text-danger">*</span></label>
                                <div class="form-group" tabindex="24">
                                    <select name="social_security_act" id="socialSecurityAct" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="হ্যাঁ">হ্যাঁ</option>
                                        <option value="না">না</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6" id="securityAct">
                                <label>সামাজিক নিরাপত্তা বেষ্টনী কর্মসূচীর নাম <span class="text-danger">*</span></label>
                                <div class="form-group" tabindex="25">
                                    <select name="social_act_name" class="form-control selectpicker" data-live-search="true">
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="ভিজিডি">ভিজিডি</option>
                                        <option value="ভিজিএফ">ভিজিএফ</option>
                                        <option value="বয়স্ক ভাতা">বয়স্ক ভাতা</option>
                                        <option value="মাতৃত্ব ভাতা">মাতৃত্ব ভাতা</option>
                                        <option value="বিধবা ভাতা">বিধবা ভাতা</option>
                                        <option value="প্রতিবন্ধী ভাতা">প্রতিবন্ধী ভাতা</option>
                                        <option value="মুক্তিযোদ্ধা ভাতা">মুক্তিযোদ্ধা ভাতা</option>
                                        <option value="গর্ভবতী ভাতা">গর্ভবতী ভাতা</option>
                                        <option value="অন্যান্য">অন্যান্য</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>খানার কোন সদস্য মুক্তিযোদ্ধা কিনা ? <span class="text-danger">*</span></label>
                                <div class="form-group" tabindex="26">
                                    <select name="freedom_fighters" id="freedomFighters" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="হ্যাঁ">হ্যাঁ</option>
                                        <option value="না">না</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6" id="fighterName">
                                <label>মুক্তিযোদ্ধার নাম <span class="text-danger">*</span></label>
                                <div class="form-group" tabindex="27">
                                    <input type="text" name="fighter_name" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-6" id="fighterReletion">
                                <label>মুক্তিযোদ্ধার সাথে খানা প্রধানের সম্পর্ক <span class="text-danger">*</span></label>
                                <div class="form-group" tabindex="28">
                                    <input type="text" name="fighter_reletion" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>দারিদ্রসীমা <span class="text-danger">*</span></label>
                                <div class="form-group" tabindex="29">
                                    <select name="poverty_line" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="নিম্নবিত্ত">নিম্নবিত্ত</option>
                                        <option value="মধ্যবিত্ত">মধ্যবিত্ত</option>
                                        <option value="উচ্চবিত্ত">উচ্চবিত্ত</option>
                                    </select>
                                </div>
                            </div>
                            
                            <!--<div class="col-md-6">
                                <label>বাজার কিনা ? <span class="text-danger"></span></label>
                                <div class="form-group" tabindex="">
                                    <select name="bazar" id="bazar" class="form-control selectpicker" data-live-search="true">
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="হ্যাঁ">হ্যাঁ</option>
                                        <option value="না">না</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6" id="businessAssets">
                                <label> ব্যবসা প্রতিষ্ঠানের মূলধন <span class="text-danger"></span></label>
                                <div class="form-group" tabindex="">
                                    <input type="text" name="business_assets" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-6" id="tradeLicense">
                                <label> ট্রেড লাইসেন্স নং <span class="text-danger"></span></label>
                                <div class="form-group" tabindex="">
                                    <input type="text" name="trade_license_no" class="form-control" >
                                </div>
                            </div>-->
                            
                            <div class="col-md-6" > <!--id="tubewell"-->
                                <label>টিউবওয়েল আছে কিনা ? <span class="text-danger"></span></label>
                                <div class="form-group" tabindex="30">
                                    <select name="tubewell" class="form-control selectpicker" data-live-search="true" >
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="হ্যাঁ">হ্যাঁ</option>
                                        <option value="না">না</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6" >  <!--id="latrine"-->
                                <label>স্যানিটারী ল্যাট্রিন আছে কিনা ? <span class="text-danger"></span></label>
                                <div class="form-group" tabindex="31">
                                    <select name="latrine" class="form-control selectpicker" data-live-search="true" >
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="হ্যাঁ">হ্যাঁ</option>
                                        <option value="না">না</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>বার্ষিক কর/ ট্যাক্সের পরিমাণ <span class="text-danger">*</span></label>
                                <div class="form-group" tabindex="32">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="taxes" ng-model="taxes" class="form-control" autocomplete="off" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>বার্ষিক মূল্যায়ণ</label>
                                <div class="form-group" tabindex="33">
                                    <input type="text" name="annual_assessment" ng-value="getAnnualAsset()" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>বসত ঘরের আনুমানিক মূল্য</label>
                                <div class="form-group" tabindex="34">
                                    <input type="text" name="estimated_value" ng-value="getEstimatedValue()" class="form-control" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>ছবি (৩০০ X ৩০০)</label>
                                <div class="form-group" tabindex="35">
                                    <input type="file" name="member_image" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-12" id="submitBtn">
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
        .no {
            border-color: red !important;
        }
        .yes {
            border-color: green !important;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('footer-script'); ?>
    <script>

        $(document).ready(function () {
            
            /*$('#businessAssets').hide();
            $('#tradeLicense').hide();
            
            $('#tubewell').show();
            $('#latrine').show();

            $('#bazar').on('change', function () {
                var _bazar = $(this).val();
                if (_bazar === "হ্যাঁ") {
                    $('#businessAssets').show();
                    $('#tradeLicense').show();
                    
                    $('#tubewell').hide();
                    $('#latrine').hide();
                } else {
                    $('#businessAssets').hide();
                    $('#tradeLicense').hide();
                    
                    $('#tubewell').show();
                    $('#latrine').show();
                }
            });*/
            
            $('#handicappedName').hide();
            $('#handicapped').on('change', function(){
                var _handicapped = $(this).val();
                if(_handicapped === "হ্যাঁ"){
                    $('#handicappedName').show();
                }else{
                    $('#handicappedName').hide();
                }
            });
            
            
            $('#fighterName').hide();
            $('#fighterReletion').hide();

            $('#freedomFighters').on('change', function () {
                var _freedomFighters = $(this).val();
                if (_freedomFighters === "হ্যাঁ") {
                    $('#fighterName').show();
                    $('#fighterReletion').show();
                } else {
                    $('#fighterName').hide();
                    $('#fighterReletion').hide();
                }
            });

            $('#securityAct').hide();
            $('#socialSecurityAct').on('change', function () {
                var _socialSecurityAct = $(this).val();
                if (_socialSecurityAct === "হ্যাঁ") {
                    $('#securityAct').show();
                } else {
                    $('#securityAct').hide();
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

        // Uniqe Holding No
        function uniqeHoldingNo() {
            var _holdingNo = $('#holdingNo').val();
            var _wardNo = $('#wardNo').val();
            var _unionId = $('#unionId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.get-holding-no')); ?>",
                data: {union_id : _unionId, holding_no : _holdingNo, ward_id : _wardNo, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                if(response.union_id == _unionId && response.ward_id == _wardNo && response.holding_no == _holdingNo) {
                    $("#holdingNo").addClass("no");
                    $("#holdingNo").removeClass("yes");
                    $('#submitBtn').hide();
                }else{
                    $("#holdingNo").removeClass("no");
                    $("#holdingNo").addClass("yes");
                    $('#submitBtn').show();
                }
            });
        }

        /* angular script */
        app.controller('appController', function ($scope) {

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
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kajodrsv/amaruptax.com/resources/views/member/create.blade.php ENDPATH**/ ?>