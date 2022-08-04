@extends('layouts.backend')

@section('content')
    <!-- body container start -->
    <div class="body_container" ng-controller="appController" ng-cloak>
    @include('bazar_member.nav')

    <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>বাজারের সদস্য পরিবর্তন করুন</h4>
                </div>

                <div class="panel_body">
                    <form action="{{route('admin.bazar_member.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$info->id}}">
                        <div class="row">
                            <div class="col-md-6">
                                <label>দোকান / কারখানার মালিকের নাম<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="holder_name" value="{{$info->holder_name}}" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>পিতা/স্বামীর নাম <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="father_name" value="{{$info->father_name}}" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>মাতার নাম <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <input type="text" name="mother_name" value="{{$info->mother_name}}" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>মোবাইল নং <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="tel" placeholder="" name="mobile_no" value="{{$info->mobile_no}}" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>ব্যবসার নাম <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="business_name" value="{{$info->business_name}}" class="form-control" required>
                                </div>
                            </div>
                            
                            @if($userInfo->privilege != 'user')
                            <div class="col-md-6">
                                <label>জেলা <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select name="district_id" id="districtId" onchange="getUpazilaFn()" class="form-control" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="39" {{ ($info->district_id=='39' ? "selected" : " ") }} >
                                            সুনামগঞ্জ
                                        </option>
                                        <option value="45" {{ ($info->district_id=='45' ? "selected" : " ") }} >
                                            কিশোরগঞ্জ
                                        </option>
                                        <option value="62" {{ ($info->district_id=='62' ? "selected" : " ") }} >
                                            ময়মনসিংহ
                                        </option>
                                        <option value="64" {{ ($info->district_id=='64' ? "selected" : " ") }} >
                                            নেত্রকোণা
                                        </option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>উপজেলা <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select name="upazila_id" id="upazilaId" onchange="getUnionFn()" class="form-control" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>ইউনিয়ন <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select name="union_id" id="unionId" class="form-control" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                    </select>
                                </div>
                            </div>
                            @else
                                <input type="hidden" name="district_id" value="{{$info->district_id}}" id="districtId">
                                <input type="hidden" name="upazila_id" value="{{$info->upazila_id}}" id="upazilaId">
                                <input type="hidden" name="union_id" value="{{$info->union_id}}" id="unionId">
                            @endif
                            <div class="col-md-6">
                                <label>ওয়ার্ড নং <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select name="ward_id" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        @foreach($wards as $key => $value)
                                            <option value="{{ $value->id }}" {{($info->ward_id == $value->id ? 'selected' : '')}}>{{$value->name_bn}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>হোল্ডিং নং <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="holding_no" value="{{$info->holding_no}}" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>ভাড়াটিয়া আছে কিনা ? <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select name="tenant" id="tenant" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="হ্যাঁ" {{ ($info->tenant == "হ্যাঁ" ? "selected" : "") }}>
                                            হ্যাঁ
                                        </option>
                                        <option value="না" {{ ($info->tenant == "না" ? "selected" : "") }}>
                                            না
                                        </option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6" id="tenantName">
                                <label>ভাড়াটিয়ার নাম <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <input type="text" name="tenant_name" value="{{$info->tenant_name}}" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-6" id="tenantFatherName">
                                <label>ভাড়াটিয়ার পিতার নাম <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <input type="text" name="tenant_father_name" value="{{$info->tenant_father_name}}" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-6" id="tenantBusinessAssets">
                                <label>ভাড়াটিয়ার ব্যবসার মোট পুঁজি<span class="text-danger"></span></label>
                                <div class="form-group">
                                    <input type="text" name="tenant_business_assets" value="{{$info->tenant_business_assets}}" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>কারখানা/দোকান ঘর সহ মোট জমি কত শতাংশ<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="total_land" value="{{$info->total_land}}" class="form-control" placeholder="" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>বাজারের নাম<span class="text-danger"></span></label>
                                <div class="form-group">
                                    <input type="text" name="bazar_name" value="{{$info->bazar_name}}" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>ঘর নির্মাণ সহ ব্যবসার মোট পুঁজি<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="total_assets" value="{{$info->total_assets}}" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>বার্ষিক ব্যবসার আয়<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="business_income" value="{{$info->business_income}}" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>বার্ষিক মূল্যায়ণ<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="annual_assessment" value="{{$info->annual_assessment}}" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>বার্ষিক করের পরিমাণ<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="total_taxes" value="{{$info->total_taxes}}" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                @if(!empty($info->path))
                                    <img class="img-thumbnail" src="{{asset($info->path)}}" style="width: 120px;" alt=""> <br/>
                                @endif
                                <label>ছবি (৩০০ X ৩০০)</label>
                                <div class="form-group">
                                    <input type="file" name="member_image" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group text-right">
                                    <button type="submit" class="btn submit_btn" name="save">আপডেট করুন</button>
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
@endsection

@push('footer-script')
    <script>
        $(document).ready(function () {

            if ("<?php echo $info->tenant; ?>" === "হ্যাঁ") {
                $('#tenantName').show();
                $('#tenantFatherName').show();
                $('#tenantBusinessAssets').show();
            } else {
                $('#tenantName').hide();
                $('#tenantFatherName').hide();
                $('#tenantBusinessAssets').hide();
            }

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
        $('#districtId').selectpicker();
        
        // get Upazila list
        function getUpazilaFn() {
            $('#upazilaId').empty();
            var _districtId = ($('#districtId').val()) ? $('#districtId').val() : '{{$info->district_id}}';
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.upazila-list')}}",
                data: {id: _districtId, select_id: "{{$info->upazila_id}}", _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#upazilaId').append(response);
                $('#upazilaId').selectpicker('refresh');
            });
        }

        getUpazilaFn();

        // get Upazila list
        function getUnionFn() {
            $('#unionId').empty();
            var _upazilaId = ($('#upazilaId').val()) ? $('#upazilaId').val() : '{{$info->upazila_id}}';
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.union-list')}}",
                data: {id: _upazilaId, select_id: "{{$info->union_id}}", _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#unionId').append(response);
                $('#unionId').selectpicker('refresh');
            });
        }

        getUnionFn();

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
@endpush
