<!-- body nav start -->
@php($siteInfo = settings())
@php($privilege = Auth::user()->privilege)
@php($accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : ''))
<div class="body_nav">
    <ul>
        @if( ($privilege == 'super') || (!empty($accessList->report->submenu->tax_report) && $accessList->report->submenu->tax_report == "tax_report"))
        <li><a class="taxReport" href="{{route('admin.reports.tax')}}">ট্যাক্স রিপোর্ট</a></li>
        @endif
        @if( ($privilege == 'super') || (!empty($accessList->report->submenu->union_report) && $accessList->report->submenu->union_report == "union_report"))
        <li><a class="unionReport" href="{{route('admin.reports.union_report')}}">ইউনিয়ন রিপোর্ট</a></li>
        @endif
        @if( ($privilege == 'super') || (!empty($accessList->report->submenu->member_wise_tax_report) && $accessList->report->submenu->member_wise_tax_report == "member_wise_tax_report"))
        <li><a class="memberReport" href="{{route('admin.reports.member')}}" >সদস্য ওয়াইজ ট্যাক্স রিপোর্ট</a></li>
        @endif
        @if( ($privilege == 'super') || (!empty($accessList->report->submenu->ward_wise_tax_report) && $accessList->report->submenu->ward_wise_tax_report == "ward_wise_tax_report"))
        <li><a class="wardReport" href="{{route('admin.reports.ward')}}" >ওয়ার্ড ওয়াইজ ট্যাক্স রিপোর্ট</a></li>
        @endif
        @if( ($privilege == 'super') || (!empty($accessList->report->submenu->daily_tax_report) && $accessList->report->submenu->daily_tax_report == "daily_tax_report"))
        <li><a class="collectionReport" href="{{route('admin.reports.collection')}}" >দৈনিক ট্যাক্স সংগ্রহ রিপোর্ট</a></li>
        @endif
    </ul>
</div>
<!-- body nav start -->