@extends('layouts.backend')

@section('content')
    <!-- body container start -->
    <div class="body_container">
        @include('affidavit.citizenship_certificate_nav')

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>নাগরিকত্ব সনদ পত্র</h4>
                    <a id="print" title="Page: A4; Scale: (Firefox: Custom(112) & Chrome: Default);" class="print_btn">
                        <i class="icon ion-md-print"></i> প্রিন্ট 
                    </a>
                </div>
                <div class="panel_body">
                    <div class="trade_license position-relative">
                        <div class="position-absolute justify-content-center align-items-center h-100 w-100 bg_photo">
                            <img class="bg_img" src="{{asset('public/license/govbd.png')}}" alt="Photo Not Found!">
                        </div>
                        
                        <div class="print_header_info print_only">
                            
                            <div class="row justify-content-end">
                                <div class="col-4">
                                    <img class="govbd" src="{{asset('public/license/govbd.png')}}" alt="Photo Not Found!">
                                </div>
                                <div class="col-4">
                                    <img class="mujib" src="{{asset('public/license/mujib.png')}}" alt="Photo Not Found!">
                                </div>
                            </div>
                            @php($union_name     = $unions->where('id', $info->union_id)->first())
                            @php($upazilas_name  = $upazilas->where('id', $info->upazila_id)->first())
                            @php($districts_name = $districts->where('id', $info->district_id)->first())
                            
                            <h1>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h1>
                            <h4>{{ (!empty($union_name) ? $union_name->bn_name : " ") }}  ইউনিয়ন পরিষদ কার্যালয়</h4>
                            <h4>{{ (!empty($upazilas_name) ?  $upazilas_name->bn_name : " ") }}, {{ (!empty($districts_name) ? $districts_name->bn_name : " ") }}</h4>
                            <h2><strong>নাগরিকত্ব সনদ পত্র</strong></h2>
                            <p>[ ইউনিয়ন পরিষদ আদর্শ কর তফসিল ২০১৩ মোতাবেক ]</p>
                        </div>
                        
                        
                        <div class="license_body">
                            <div class="row">
                                <div class="col col-sm-5">
                                    <p>
                                        <strong>সনদ নংঃ </strong>
                                        {{ numberFilter($info->affidavit_no,'bn') }}
                                    </p>
                                </div>
                                <div class="col">
                                    <p>
                                        <strong>স্মারক নংঃ </strong>
                                        {{ numberFilter($info->memorial_no,'bn') }}
                                    </p>
                                </div>
                                <div class="col col-sm-3">
                                    <p>
                                        <strong>ইস্যু তারিখঃ </strong>
                                        {{ numberFilter($info->created,'bn') }}
                                    </p>
                                </div>
                            </div>
                            
                            @php($division = $divisions->where('id', $info->division_id)->first())
                            @php($district = $districts->where('id', $info->district_id)->first())
                            @php($upazila  = $upazilas->where('id', $info->upazila_id)->first())
                            @php($union    = $unions->where('id', $info->union_id)->first())
                            @php($ward     = $wards->where('id', $info->ward_id)->first())
                            
                            <div class="row">
                                <div class="table-responsive" style="margin: 0 4px;">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th colspan="3">নাগরিক তথ্যঃ</th>
                                        </tr>
                                        <tr>
                                            <th>নাম</th>
                                            <th>:</th>
                                            <th>{{ $info->name }}</th>
                                        </tr>
                                        <tr>
                                            <th>পিতা</th>
                                            <th>:</th>
                                            <th>{{ $info->father_name }}</th>
                                        </tr>
                                        <tr>
                                            <th>মাতা</th>
                                            <th>:</th>
                                            <th>{{ $info->mother_name }}</th>
                                        </tr>
                                        <tr>
                                            <th>মোবাইল নং</th>
                                            <th>:</th>
                                            <th>{{ $info->mobile_no }}</th>
                                        </tr>
                                        <tr>
                                            <th>জাতীয় পরিচয়পত্র নম্বর</th>
                                            <th>:</th>
                                            <th>{{ $info->nid_no }}</th>
                                        </tr>
                                        <tr>
                                            <th>ঠিকানা</th>
                                            <th>:</th>
                                            <th>
                                                {{ numberFilter($info->holding_no,'bn') }}, 
                                                {{ $info->village }}, 
                                                {{ (!empty($ward) ? $ward->name_bn : " " ) }}, 
                                                {{ (!empty($union) ? $union->bn_name : " ")  }},  
                                                {{ (!empty($upazila) ? $upazila->bn_name : " ")  }}, 
                                                {{ (!empty($district) ? $district->bn_name : " ")  }} ।
                                            </th>
                                        </tr>
                                    </table>
                                    <div class="col-xs-12">
                                        <p style="margin-left: 10px;">
                                            এই মর্মে প্রত্যয়ন করা যাইতেছে যে, উপরিউক্ত ব্যক্তি অত্র ইউনিয়নের একজন স্থায়ী বাসিন্দা হিসেবে আমার 
                                            নিকট পরিচিত এবং জন্মসূত্রে বাংলাদেশের নাগরিক। তার নৈতিক চরিত্র ভাল।<br>
                                            আমি তাঁর জীবনের সর্বাঙ্গীন উন্নতি ও মঙ্গল কামনা করি।
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="footer_signature">
                            <div class="signature_box">
                                
                                <?php if(!empty($sign_name)){
                                    $ministers = $sign_name->where('union_id', $info->union_id)->first();
                                ?>
                                <?php if(!empty($ministers)) { ?>
                                    <p>{{ (!empty($ministers) ? $ministers->minister : "") }}</p>
                                    <p><strong>সচিব</strong></p>
                                    
                                        @php($district = $districts->where('id', $ministers->district_id)->first())
                                        @php($upazila  = $upazilas->where('id', $ministers->upazila_id)->first())
                                        @php($union    = $unions->where('id', $ministers->union_id)->first())
                                    
                                    <p>{{ (!empty($union) ? $union->bn_name : " ")  }} ইউনিয়ন পরিষদ কার্যালয়</p>
                                    <p>
                                        {{ (!empty($upazila) ? $upazila->bn_name : " ")  }},
                                        {{ (!empty($district) ? $district->bn_name : " ")  }}।
                                    </p>
                                <?php }else{ ?>
                                
                                <p>&nbsp;</p>
                                <p><strong>সচিব</strong></p>
                                <p>{{(!empty($union_name) ? $union_name->bn_name : " ")}} ইউনিয়ন পরিষদ কার্যালয়</p>
                                <p>{{(!empty($upazilas_name) ? $upazilas_name->bn_name : " ")}}, {{(!empty($districts_name) ? $districts_name->bn_name : " ")}}।</p>
                                
                                <?php } } ?>
                                
                            </div>
                            <div class="signature_box">
                                
                                <?php if(!empty($sign_name)){
                                    $chairmans = $sign_name->where('union_id', $info->union_id)->first();
                                ?>
                                <?php if(!empty($chairmans)) { ?>
                                    <p>{{ (!empty($chairmans) ? $chairmans->chairman : "") }}</p>
                                    <p><strong>চেয়ারম্যান</strong></p>
                                    
                                        @php($district = $districts->where('id', $chairmans->district_id)->first())
                                        @php($upazila  = $upazilas->where('id', $chairmans->upazila_id)->first())
                                        @php($union    = $unions->where('id', $chairmans->union_id)->first())
                                    
                                    <p>{{ (!empty($union) ? $union->bn_name : " ")  }} ইউনিয়ন পরিষদ কার্যালয়</p>
                                    <p>
                                        {{ (!empty($upazila) ? $upazila->bn_name : " ")  }},
                                        {{ (!empty($district) ? $district->bn_name : " ")  }}।
                                    </p>
                                <?php }else{ ?>
                                
                                <p>&nbsp;</p>
                                <p><strong>চেয়ারম্যান</strong></p>
                                <p>{{(!empty($union_name) ? $union_name->bn_name : " ")}} ইউনিয়ন পরিষদ কার্যালয়</p>
                                <p>{{(!empty($upazilas_name) ? $upazilas_name->bn_name : " ")}}, {{(!empty($districts_name) ? $districts_name->bn_name : " ")}}।</p>
                                
                                <?php } } ?>
                                
                            </div>
                        </div>
                        <!--<div class="row footer_middle">
                            <div class="col-sm-9">
                                <p>সনদ যাচাইঃ</p>
                                <p>ক)&nbsp;&nbsp;&nbsp;&nbsp; 254875487454 লিখে SMS করুন ৯৯৯৯৯ নাম্বারে।</p>
                                <p>খ)&nbsp;&nbsp;&nbsp;&nbsp; ভিজিট করুন: <a href="https://amaruptax.com/" class="btn-link">amaruptax.com</a></p>
                                <p>গ)&nbsp;&nbsp;&nbsp;&nbsp; QR স্ক্যান করুন।</p>
                            </div>
                            <div class="col-sm-3">
                                <img class="qr_code" src="{{asset('public/license/qr_code.webp')}}" alt="Photo Not Found!">
                            </div>
                        </div>
                        <div class="row footer_bottom">
                            <p class="text-center">
                                <strong>সফটওয়্যার নির্মাণ, রক্ষনাবেক্ষনঃ ফ্রিলেন্স আইটি ল্যাব।</strong>
                            </p>
                        </div>-->
                    </div>
                </div>
                <div class="panel_footer"></div>
            </div>
        </div>
        <!-- body content end -->
    </div>
    <!-- body container end -->
@endsection

@push('header-style')
<style>
    .btn-link {color: #222;}
    .body_container {font-family: 'Noto Serif Bengali', serif;}
    .body_container p {
        font-size: 20px;
        color: #000;
    }
    .trade_license {
        border: 2px solid #333;
        padding: 15px 15px 0 15px;
    }
    .bg_photo {
        display: none;
    }
    .bg_img{
        width: 60%;
        opacity:0.12;
    }
    .print_header_info {
        text-align: center;
        padding-bottom: 10px;
    }
    .print_header_info img {
        max-width: 100%;
        height: 80px;
    }
    .print_header_info img.mujib {
        width: 120px;
    }
    .print_header_info img.govbd {
        width: 80px;
    }
    .print_header_info h1 {
        font-weight: bold;
        margin-top: 0;
        color: #000;
    }
    .print_header_info h2 {
        margin-top: 10px !important;
    }
    .print_header_info h2 strong {
        padding: 0 70px;
        background: #444;
        color: #fff;
        font-weight: bold;
    }
    .print_header_info h4 {
        margin: 3px 0;
        color: #000;
    }
    .footer_signature {
        justify-content: space-between;
        margin-top: 95px;
        margin-bottom: 45px;
        display: flex;
    }
    .footer_signature p {
        line-height: 22px;
        margin: 0;
        font-size: 18px;
    }
    .footer_signature .signature_box {
        border-top: 2px dashed #000;
        text-align: center;
        padding-top: 10px;
    }
    .footer_middle {
        margin: 20px 0;
    }
    .footer_middle img.qr_code {
        max-width: 100%;
        width: 120px;
    }
    .footer_middle p, .footer_bottom p {
        margin-bottom: 0;
        width: 100%;
    }
    .footer_bottom {
        border-top: 2px solid #333;
    }
    .table-bordered td, .table-bordered th, .body_content .table th {font-size: 18px !important;}
    @media print{
        .bg_photo {
            display: flex;
        }
        table.table.table-bordered tr th, table.table.table-bordered tr td,table.table.table-bordered tr, table.table.table-bordered {
            border: 1px solid transparent !important;
        }
    }
</style>
@endpush