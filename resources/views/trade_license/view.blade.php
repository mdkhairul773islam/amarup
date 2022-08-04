@extends('layouts.backend')

@section('content')
    <!-- body container start -->
    <div class="body_container">
        @include('trade_license.nav')

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>ট্রেড লাইসেন্স</h4>
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
                            <h2><strong>ট্রেড লাইসেন্স</strong></h2>
                            <p>[ ইউনিয়ন পরিষদ আদর্শ কর তফসিল ২০১৩ মোতাবেক ]</p>
                        </div>
                        
                        <div class="license_body">
                            <div class="row">
                                <div class="col col-sm-5">
                                    <p>
                                        <strong>লাইসেন্স নংঃ </strong>
                                        {{ numberFilter($info->license_no,'bn') }}
                                    </p>
                                </div>
                                <div class="col">
                                    <p>
                                        <strong>অর্থ বছরঃ </strong>
                                        {{ numberFilter($info->finance_year,'bn') }}
                                    </p>
                                </div>
                                <div class="col col-sm-3">
                                    <p>
                                        <strong>ইস্যু তারিখঃ </strong>
                                        {{ numberFilter($info->created,'bn') }}
                                    </p>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="table-responsive" style="margin: 0 4px;">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="30%">ব্যবসা প্রতিষ্ঠানের নাম</th>
                                            <th width="3%" class="text-center">:</th>
                                            <td colspan="4"> {{ $info->business_name }} </td>
                                        </tr>
                                        <tr>
                                            <th>স্বত্বাধিকারী/লাইসেন্সধারীর নাম</th>
                                            <th class="text-center">:</th>
                                            <td colspan="4"> {{ $info->license_owner }} </td>
                                        </tr>
                                        <tr>
                                            <th>পিতা/স্বামী</th>
                                            <th class="text-center">:</th>
                                            <td colspan="4"> {{ $info->father_name }} </td>
                                        </tr>
                                        <tr>
                                            <th>মাতা</th>
                                            <th class="text-center">:</th>
                                            <td colspan="4"> {{ $info->mother_name }} </td>
                                        </tr>
                                        <tr>
                                            <th>মোবাইল নাম্বার</th>
                                            <th class="text-center">:</th>
                                            <td colspan="4"> {{ $info->mobile }} </td>
                                        </tr>
                                        <tr>
                                            <th>জাতীয় পরিচয়পত্র নম্বর</th>
                                            <th class="text-center">:</th>
                                            <td colspan="4"> {{ numberFilter($info->nid,'bn') }} </td>
                                        </tr>
                                        <tr>
                                            <th>ঠিকানা</th>
                                            <th class="text-center">:</th>
                                            <td colspan="4"> {{ $info->address }} </td>
                                        </tr>
                                        <tr>
                                            <th>ব্যবসা প্রতিষ্ঠানের ঠিকানা</th>
                                            <th class="text-center">:</th>
                                            <td colspan="4"> {{ $info->business_address }} </td>
                                        </tr>
                                        <tr>
                                            <th>ব্যবসার/পেশার ধরণ</th>
                                            <th class="text-center">:</th>
                                            <td colspan="4"> {{ $info->business_type }} </td>
                                        </tr>
                                        <tr>
                                            <th>ফি ও করের পরিমাণ</th>
                                            <th class="text-center">:</th>
                                            <th class="text-center" colspan="2">ফি এবং করের নাম</th>
                                            <th class="text-right">টাকার পরিমাণ</th>
                                            <td width="15%"></td>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>লাইসেন্স ফি</th>
                                            <th width="3%" class="text-center">:</th>
                                            <td class="text-right"> {{ numberFilter($info->license_fee,'bn') }} </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>ভ্যাট</th>
                                            <th class="text-center">:</th>
                                            <td class="text-right"> {{ numberFilter($info->vat,'bn') }} </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>পেশা ব্যবসা ও বৃত্তির উপর কর-২</th>
                                            <th class="text-center">:</th>
                                            <td class="text-right"> {{ numberFilter($info->tax_2,'bn') }} </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>সার্ভিস চার্জ</th>
                                            <th class="text-center">:</th>
                                            <td class="text-right"> {{ numberFilter($info->service_charge,'bn') }} </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th class="text-right">মোট</th>
                                            <th class="text-center"></th>
                                            <th class="text-right"> {{ numberFilter($info->total,'bn') }} </th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>কথায়</th>
                                            <th class="text-center">:</th>
                                            <td colspan="4" style="text-transform: capitalize;">{{ $obj->numToWord($info->total) }} টাকা মাত্র।</td>
                                        </tr>
                                        
                                        <tr>
                                            <th>বৈধতার মেয়াদ</th>
                                            <th class="text-center">:</th>
                                            <td colspan="4">
                                                {{ numberFilter($info->validity_period,'bn') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan="6">
                                                উপরিউক্ত ফি ও কর প্রাপ্ত হয়ে তাঁর ব্যবসা চালিয়ে যাওয়ার জন্য এই লাইসেন্স প্রধান করা হলো।
                                            </th>
                                        </tr>
                                    </table>
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
                                <p>ক)&nbsp;&nbsp;&nbsp;&nbsp; {{ numberFilter($info->license_no,'bn') }} লিখে SMS করুন ৯৯৯৯৯ নাম্বারে।</p>
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