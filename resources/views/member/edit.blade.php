@extends('layouts.backend')

@section('content')
    <!-- body container start -->
    <div class="body_container" ng-controller="appController" ng-cloak>
    @include('member.nav')

    <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>সদস্য পরিবর্তন করুন</h4>
                </div>

                <div class="panel_body">
                    <form action="{{route('admin.member.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$info->id}}">
                        <div class="row">
                            <div class="col-md-6">
                                <label>খানা প্রধানের নাম <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="householder" value="{{$info->householder}}" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>খানা প্রধানের স্ত্রীর নাম</label>
                                <div class="form-group">
                                    <input type="text" name="householder_wife" value="{{$info->householder_wife}}" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>পিতা/স্বামীর নাম <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="father_name" value="{{$info->father_name}}" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>মাতার নাম <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="mother_name" value="{{$info->mother_name}}" class="form-control" required>
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
                                <label>গ্রাম <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="village" value="{{$info->village}}" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>এন.আই.ডি নং <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="nid_no" value="{{$info->nid_no}}" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>ধর্ম <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select name="religion" class="form-control selectpicker" data-live-search="true">
                                        <option value="" selected>নির্বাচন করুন</option>
                                        <option value="ইসলাম" {{ ($info->religion == "ইসলাম" ? "selected" : "") }}>
                                            ইসলাম
                                        </option>
                                        <option value="হিন্দু" {{ ($info->religion == "হিন্দু" ? "selected" : "") }}>
                                            হিন্দু
                                        </option>
                                        <option
                                            value="খ্রীষ্টান" {{ ($info->religion == "খ্রীষ্টান" ? "selected" : "") }}>
                                            খ্রীষ্টান
                                        </option>
                                        <option value="বৌদ্ধ" {{ ($info->religion == "বৌদ্ধ" ? "selected" : "") }}>
                                            বৌদ্ধ
                                        </option>
                                        <option
                                            value="অন্যান্য" {{ ($info->religion == "অন্যান্য" ? "selected" : "") }}>
                                            অন্যান্য
                                        </option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>মোবাইল নং <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="tel" placeholder="Without +88" name="mobile_no" value="{{$info->mobile_no}}" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>পেশা <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select name="profession" class="form-control selectpicker" data-live-search="true">
                                        <option value="" selected>নির্বাচন করুন</option>
                                        <option value="কৃষক" {{ ($info->profession=="কৃষক" ? "selected" : " ") }}>
                                            কৃষক
                                        </option>
                                        <option
                                            value="সরকারি চাকুরি" {{ ($info->profession=="সরকারি চাকুরি" ? "selected" : " ") }}>
                                            সরকারি চাকুরি
                                        </option>
                                        <option
                                            value="বেসরকারি চাকুরি" {{ ($info->profession=="বেসরকারি চাকুরি" ? "selected" : " ") }}>
                                            বেসরকারি চাকুরি
                                        </option>
                                        <option
                                            value="ক্ষুদ্র ব্যবসায়ী" {{ ($info->profession=="ক্ষুদ্র ব্যবসায়ী" ? "selected" : " ") }}>
                                            ক্ষুদ্র ব্যবসায়ী
                                        </option>
                                        <option
                                            value="ব্যবসায়ী" {{ ($info->profession=="ব্যবসায়ী" ? "selected" : " ") }}>
                                            ব্যবসায়ী
                                        </option>
                                        <option value="ডাক্তার" {{ ($info->profession=="ডাক্তার" ? "selected" : " ") }}>
                                            ডাক্তার
                                        </option>
                                        <option value="ইঞ্জিনিয়ার" {{ ($info->profession=="ইঞ্জিনিয়ার" ? "selected" : " ") }}>
                                            ইঞ্জিনিয়ার
                                        </option>
                                        <option value="দিন মুজুর" {{ ($info->profession=="দিন মুজুর" ? "selected" : " ") }}>
                                            দিন মুজুর
                                        </option>
                                        <option value="শ্রমিক" {{ ($info->profession=="শ্রমিক" ? "selected" : " ") }}>
                                            শ্রমিক
                                        </option>
                                        <option value="জেলে" {{ ($info->profession=="জেলে" ? "selected" : " ") }}>
                                            জেলে
                                        </option>
                                        <option value="তাঁতী" {{ ($info->profession=="তাঁতী" ? "selected" : " ") }}>
                                            তাঁতী
                                        </option>
                                        <option
                                            value="অন্যান্য" {{ ($info->profession=="অন্যান্য" ? "selected" : " ") }}>
                                            অন্যান্য
                                        </option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>লিঙ্গ <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select name="gender" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="পুরুষ" {{ ($info->gender=="পুরুষ" ? "selected" : "") }}>পুরুষ</option>
                                        <option value="মহিলা" {{ ($info->gender=="মহিলা" ? "selected" : "") }}>মহিলা</option>
                                        <option value="অন্যান্য" {{ ($info->gender=="অন্যান্য" ? "selected" : "") }}>অন্যান্য</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>খানার সদস্য সংখ্যা <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input inputmode="numeric" pattern="[0-9]*" type="number" name="member_male" value="{{$info->member_male}}" class="form-control" placeholder="পুরুষ" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input inputmode="numeric" pattern="[0-9]*" type="number" name="member_female" value="{{$info->member_female}}" class="form-control" placeholder="মহিলা" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>বসতের মেঝের পরিমান (ফুট) <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number"" name="floor_size" value="{{$info->floor_size}}" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>আবাদী জমির পরিমান (শতাংশ) <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="cultivable_land" value="{{$info->cultivable_land}}" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>অনাবাদী জমির পরিমান (শতাংশ) <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="uncultivated_land" value="{{$info->uncultivated_land}}" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>বসতের ধরন <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select name="settlement_type" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="ঝুপরী" {{ ($info->settlement_type=="ঝুপরী" ? "selected" : "") }}>
                                            ঝুপরী
                                        </option>
                                        <option value="কুড়েঘর" {{ ($info->settlement_type=="কুড়েঘর" ? "selected" : "") }}>
                                            কুড়েঘর
                                        </option>
                                        <option value="আধা কাচা" {{ ($info->settlement_type=="আধা কাচা" ? "selected" : "") }}>
                                            আধা কাচা
                                        </option>
                                        <option value="কাচা" {{ ($info->settlement_type=="কাচা" ? "selected" : "") }}>
                                            কাচা
                                        </option>
                                        <option value="ছাপড়া" {{ ($info->settlement_type=="ছাপড়া" ? "selected" : "") }}>
                                            ছাপড়া
                                        </option>
                                        <option value="দৌচালা টিনের" {{ ($info->settlement_type=="দৌচালা টিনের" ? "selected" : "") }}>
                                            দৌচালা টিনের
                                        </option>
                                        <option value="চৌচালা টিনের" {{ ($info->settlement_type=="চৌচালা টিনের" ? "selected" : "") }}>
                                            চৌচালা টিনের
                                        </option>
                                        <option value="আধা পাকা" {{ ($info->settlement_type=="আধা পাকা" ? "selected" : "") }}>
                                            আধা পাকা
                                        </option>
                                        <option value="পাকা" {{ ($info->settlement_type=="পাকা" ? "selected" : "") }}>
                                            পাকা
                                        </option>
                                        <option value="বহুতল" {{ ($info->settlement_type=="বহুতল" ? "selected" : "") }}>
                                            বহুতল
                                        </option>
                                        <option value="অন্যান্য" {{ ($info->settlement_type=="অন্যান্য" ? "selected" : "") }}>
                                            অন্যান্য
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>বসত ভিটার জমির মালিকানার ধরন <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select name="ownership_type" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="নিজস্ব" {{ ($info->ownership_type == "নিজস্ব" ? "selected" : "") }} >
                                            নিজস্ব
                                        </option>
                                        <option value="খাস জমি" {{ ($info->ownership_type == "খাস জমি" ? "selected" : "") }} >
                                            খাস জমি
                                        </option>
                                        <option value="বস্তি" {{ ($info->ownership_type == "বস্তি" ? "selected" : "") }} >
                                            বস্তি
                                        </option>
                                        <option value="বেড়ী বাদ" {{ ($info->ownership_type == "বেড়ী বাদ" ? "selected" : "") }}>
                                            বেড়ী বাদ
                                        </option>
                                        <option value="বিনা ভাড়ায় অন্যের জমি" {{ ($info->ownership_type == "বিনা ভাড়ায় অন্যের জমি" ? "selected" : "") }} >
                                            বিনা ভাড়ায় অন্যের জমি
                                        </option>
                                        <option value="ভাড়া জমি" {{ ($info->ownership_type == "ভাড়া জমি" ? "selected" : "") }} >
                                            ভাড়া জমি
                                        </option>
                                        <option value="অন্যান্য" {{ ($info->ownership_type == "অন্যান্য" ? "selected" : "") }} >
                                            অন্যান্য
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>খানার কোন সদস্য প্রতিবন্ধী কিনা ? <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select name="handicapped" id="handicapped" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="হ্যাঁ" {{ ($info->handicapped == "হ্যাঁ" ? "selected" : "") }}>হ্যাঁ</option>
                                        <option value="না" {{ ($info->handicapped == "না" ? "selected" : "") }}>না</option>
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
                                <div class="form-group">
                                    <select name="social_security_act" id="socialSecurityAct" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option
                                            value="হ্যাঁ" {{ ($info->social_security_act == "হ্যাঁ" ? "selected" : "") }}>
                                            হ্যাঁ
                                        </option>
                                        <option value="না" {{ ($info->social_security_act == "না" ? "selected" : "") }}>
                                            না
                                        </option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6" id="securityAct">
                                <label>সামাজিক নিরাপত্তা বেষ্টনী কর্মসূচীর নাম</label>
                                <div class="form-group">
                                    <select name="social_act_name" class="form-control selectpicker" data-live-search="true">
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="ভিজিডি" {{ ($info->social_act_name == "বিজিবি" ? "selected" : "") }}>
                                            ভিজিডি
                                        </option>
                                        <option value="ভিজিএফ" {{ ($info->social_act_name == "ভিজিএফ" ? "selected" : "") }}>
                                            ভিজিএফ
                                        </option>
                                        <option value="বয়স্ক ভাতা" {{ ($info->social_act_name == "বয়স্ক ভাতা" ? "selected" : "") }}>
                                            বয়স্ক ভাতা
                                        </option>
                                        <option value="মাতৃত্ব ভাতা" {{ ($info->social_act_name == "মাতৃত্ব ভাতা" ? "selected" : "") }}>
                                            মাতৃত্ব ভাতা
                                        </option>
                                        <option value="বিধবা ভাতা" {{ ($info->social_act_name == "বিধবা ভাতা" ? "selected" : "") }}>
                                            বিধবা ভাতা
                                        </option>
                                        <option value="পঙ্গু ভাতা" {{ ($info->social_act_name == "পঙ্গু ভাতা" ? "selected" : "") }}>
                                            পঙ্গু ভাতা
                                        </option>
                                        <option value="মুক্তিযোদ্ধা ভাতা" {{ ($info->social_act_name == "মুক্তিযোদ্ধা ভাতা" ? "selected" : "") }}>
                                            মুক্তিযোদ্ধা ভাতা
                                        </option>
                                        <option value="গর্ভবতী ভাতা" {{ ($info->social_act_name == "গর্ভবতী ভাতা" ? "selected" : "") }}>
                                            গর্ভবতী ভাতা
                                        </option>
                                        <option value="অন্যান্য" {{ ($info->social_act_name == "অন্যান্য" ? "selected" : "") }}>
                                            অন্যান্য
                                        </option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>খানার কোন সদস্য মুক্তিযোদ্ধা কিনা ? <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select name="freedom_fighters" id="freedomFighters" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="হ্যাঁ" {{ ($info->freedom_fighters == "হ্যাঁ" ? "selected" : "") }}>
                                            হ্যাঁ
                                        </option>
                                        <option value="না" {{ ($info->freedom_fighters == "না" ? "selected" : "") }}>
                                            না
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6" id="fighterName">
                                <label>মুক্তিযোদ্ধার নাম</label>
                                <div class="form-group">
                                    <input type="text" name="fighter_name" value="{{$info->fighter_name}}" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-6" id="fighterReletion">
                                <label>মুক্তিযোদ্ধার সাথে খানা প্রধানের সম্পর্ক</label>
                                <div class="form-group">
                                    <input type="text" name="fighter_reletion" value="{{$info->fighter_reletion}}" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>দারিদ্রসীমা <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select name="poverty_line" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="নিম্নবিত্ত" {{ ($info->poverty_line == "নিম্নবিত্ত" ? "selected" : "" ) }}>
                                            নিম্নবিত্ত
                                        </option>
                                        <option value="মধ্যবিত্ত" {{ ($info->poverty_line == "মধ্যবিত্ত" ? "selected" : "" ) }}>
                                            মধ্যবিত্ত
                                        </option>
                                        <option value="উচ্চবিত্ত" {{ ($info->poverty_line == "উচ্চবিত্ত" ? "selected" : "" ) }}>
                                            উচ্চবিত্ত
                                        </option>
                                    </select>
                                </div>
                            </div>
                            
                               <!--<div class="col-md-6">
                                <label>বাজার কিনা ? <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <select name="bazar" id="bazar" class="form-control selectpicker" data-live-search="true">
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="হ্যাঁ" {{ ($info->bazar == "হ্যাঁ" ? "selected" : "") }}>
                                            হ্যাঁ
                                        </option>
                                        <option value="না" {{ ($info->bazar == "না" ? "selected" : "") }}>
                                            না
                                        </option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6" id="businessAssets">
                                <label> ব্যবসা প্রতিষ্ঠানের মূলধন <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <input type="text" name="business_assets" value="{{$info->business_assets}}" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-6" id="tradeLicense">
                                <label> ট্রেড লাইসেন্স নং <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <input type="text" name="trade_license_no" value="{{$info->trade_license_no}}" class="form-control" >
                                </div>
                            </div>-->
                            
                            <div class="col-md-6" > <!-- id="tubewell" -->
                                <label>টিউবওয়েল আছে কিনা ? <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <select name="tubewell" class="form-control selectpicker" data-live-search="true" >
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="হ্যাঁ" {{ ($info->tubewell == "হ্যাঁ" ? "selected" : "") }}>
                                            হ্যাঁ
                                        </option>
                                        <option value="না" {{ ($info->tubewell == "না" ? "selected" : "") }}>
                                            না
                                        </option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6" > <!-- id="latrine" -->
                                <label>স্যানিটারী ল্যাট্রিন আছে কিনা ? <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <select name="latrine" class="form-control selectpicker" data-live-search="true">
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="হ্যাঁ" {{ ($info->latrine == "হ্যাঁ" ? "selected" : "") }}>
                                            হ্যাঁ
                                        </option>
                                        <option value="না" {{ ($info->latrine == "না" ? "selected" : "") }}>
                                            না
                                        </option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>বার্ষিক কর/ ট্যাক্সের পরিমাণ <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="taxes" ng-init="taxes={{ $info->taxes }}" ng-model="taxes" class="form-control" autocomplete="off" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>বার্ষিক মূল্যায়ণ</label>
                                <div class="form-group">
                                    <input type="text" name="annual_assessment" ng-value="getAnnualAsset()" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>বসত ঘরের আনুমানিক মূল্য</label>
                                <div class="form-group">
                                    <input type="text" name="estimated_value" ng-value="getEstimatedValue()" class="form-control" readonly>
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
            
            if ("<?php echo $info->handicapped; ?>" === "হ্যাঁ") {
                $('#handicappedName').show();
            } else {
                $('#handicappedName').hide();
            }
            $('#handicapped').on('change', function(){
                var _handicapped = $(this).val();
                if(_handicapped === "হ্যাঁ"){
                    $('#handicappedName').show();
                }else{
                    $('#handicappedName').hide();
                }
            });

            if ("<?php echo $info->freedom_fighters; ?>" === "হ্যাঁ") {
                $('#fighterName').show();
                $('#fighterReletion').show();
            } else {
                $('#fighterName').hide();
                $('#fighterReletion').hide();
            }

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

            if ("<?php echo $info->social_security_act; ?>" === "হ্যাঁ") {
                $('#securityAct').show();
            } else {
                $('#securityAct').hide();
            }

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
@endpush







