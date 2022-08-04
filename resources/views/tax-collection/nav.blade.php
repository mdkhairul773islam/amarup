<!-- body nav start -->
@php($siteInfo = settings())
@php($privilege = Auth::user()->privilege)
@php($accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : ''))
<div class="body_nav">
    <ul>
        <!--@if(Auth::user()->privilege == 'super')
        <li><a  class="addTaxCollection" href="{{route('admin.tax-collection.create')}}">Add Tax Collection</a></li>
        @endif-->
        @if( ($privilege == 'super') || (!empty($accessList->tax_collection->submenu->add_tax) && $accessList->tax_collection->submenu->add_tax == "add_tax"))
        <li><a  class="addTaxCollection" href="{{route('admin.tax-collection.create')}}">নতুন কর-সংগ্রহ করুন</a></li>
        @endif
        @if( ($privilege == 'super') || (!empty($accessList->tax_collection->submenu->all_tax) && $accessList->tax_collection->submenu->all_tax == "all_tax"))
        <li><a  class="allTaxCollection" href="{{route('admin.tax-collection')}}">সকল কর দেখুন</a></li>
        @endif
    </ul>
</div>
<!-- body nav start -->
