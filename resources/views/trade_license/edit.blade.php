@extends('layouts.backend')

@section('content')
    <!-- body container start -->
    <div class="body_container" ng-controller="editTradeLicenseController" ng-cloak>
        @include('trade_license.nav')

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4> ট্রেড লাইসেন্স পরিবর্তন করুন</h4>
                </div>
                <div class="panel_body">
                    <form action="{{route('admin.trade_license.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$info->id}}" >
                        <div class="row">

                            <div class="col-md-6">
                                <label>ইস্যু তারিখ <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="created" value="{{ (!empty($info) ? $info->created : date('Y-m-d')) }}" class="form-control datepicker" required>
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
                            @else
                                <input type="hidden" name="district_id" value="{{$userInfo->district_id}}" id="districtId">
                                <input type="hidden" name="upazila_id" value="{{$userInfo->upazila_id}}" id="upazilaId">
                                <input type="hidden" name="union_id" value="{{$userInfo->union_id}}" id="unionId">
                            @endif

                            <div class="col-md-6">
                                <label>লাইসেন্স নং <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="license_no" value="{{ (!empty($info) ? $info->license_no : " ") }}" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label> অর্থ বছর </label>
                                <div class="form-group">
                                    <select name="finance_year" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        @for ($i = date('Y')+1; $i >= (date('Y')-3); $i--)
                                        @php($finenceYear = ($i . '-' . ($i+1)))
                                            <option value="{{ $finenceYear }}" {{ (($info->finance_year==$finenceYear) ? 'selected' : '') }}>{{ $finenceYear }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label> স্বত্বাধিকারী/লাইসেন্সধারীর নাম <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="license_owner" value="{{ (!empty($info) ? $info->license_owner : " ") }}" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label> পিতা/স্বামী <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <input type="text" name="father_name" value="{{ (!empty($info) ? $info->father_name : " ") }}" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label> মাতা <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <input type="text" name="mother_name" value="{{ (!empty($info) ? $info->mother_name : " ") }}" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label> মোবাইল নাম্বার <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <input type="text" name="mobile" value="{{ (!empty($info) ? $info->mobile : " ") }}" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label> জাতীয় পরিচয়পত্র নম্বর <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <input type="text" name="nid" value="{{ (!empty($info) ? $info->nid : " ") }}" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label> ঠিকানা <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <textarea class="form-control" name="address" rows="3" >{{ (!empty($info) ? $info->address : " ") }}</textarea>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label> ব্যবসা প্রতিষ্ঠানের নাম <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="business_name" value="{{ (!empty($info) ? $info->business_name : " ") }}" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label> ব্যবসা প্রতিষ্ঠানের ঠিকানা <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <input type="text" name="business_address" value="{{ (!empty($info) ? $info->business_address : " ") }}" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label> ব্যবসার/পেশার ধরণ <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <input type="text" name="business_type" value="{{ (!empty($info) ? $info->business_type : " ") }}" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label> লাইসেন্স ফি <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <input type="number" name="license_fee" ng-model="license_fee"  ng-change="getTotalFeeFn()" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label> ভ্যাট <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <input type="number" name="vat" ng-model="vat" ng-change="getTotalFeeFn()" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label> পেশা ব্যবসা ও বৃত্তির উপর কর-২ <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <input type="number" name="tax_2" ng-model="tax_2" ng-change="getTotalFeeFn()" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label> সার্ভিস চার্জ <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <input type="number" name="service_charge" ng-model="service_charge" ng-change="getTotalFeeFn()" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label> মোট <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <input type="number" name="total" ng-model="totalAmount" class="form-control" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label> বৈধতার মেয়াদ <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <?php
                                        $period = date('Y-06-30');
                                        if(date('Y-m-d') > $period){
                                            $year = date('Y')+1;
                                            $period = date($year . '-06-30');
                                        }
                                    ?>
                                    <input type="text" name="validity_period" value="{{ (!empty($info) ? $info->validity_period : $period }}" class="form-control" readonly>
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
        app.controller('editTradeLicenseController',function($scope){
            $scope.license_fee    = {{ (!empty($info) ? $info->license_fee : 0) }};
            $scope.vat            = {{ (!empty($info) ? $info->vat : 0) }};
            $scope.tax_2          = {{ (!empty($info) ? $info->tax_2 : 0) }};
            $scope.service_charge = {{ (!empty($info) ? $info->service_charge : 0) }};
            $scope.totalAmount    = {{ (!empty($info) ? $info->total : 0) }};
            
            $scope.getTotalFeeFn = function () {
                var total          = 0;
                var license_fee    = (!isNaN(parseFloat($scope.license_fee)) ? parseFloat($scope.license_fee) : 0);
                var vat            = (!isNaN(parseFloat($scope.vat)) ? parseFloat($scope.vat) : 0);
                var tax_2          = (!isNaN(parseFloat($scope.tax_2)) ? parseFloat($scope.tax_2) : 0);
                var service_charge = (!isNaN(parseFloat($scope.service_charge)) ? parseFloat($scope.service_charge) : 0);
                
                total = license_fee  + vat + service_charge +  tax_2;
                $scope.totalAmount = Math.ceil(total);
            }
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
    </script>
@endpush
