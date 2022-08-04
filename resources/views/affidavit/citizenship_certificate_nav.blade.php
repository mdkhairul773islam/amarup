<!-- body nav start -->
@php($siteInfo = settings())
@php($privilege = Auth::user()->privilege)
@php($accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : ''))
<div class="body_nav">
    <ul>
        <!--@if(Auth::user()->privilege == 'super')
        <li><a class="addMember" href="{{route('admin.member.create')}}">Add Member</a></li>
        @endif-->
        
        @if( ($privilege == 'super') || (!empty($accessList->affidavit->submenu->add_affidavit) && $accessList->affidavit->submenu->add_affidavit == "add_affidavit"))
        <li><a class="addAffidavit" href="{{route('admin.affidavit.create')}}">নতুন সনদ পত্র</a></li>
        @endif
        @if( ($privilege == 'super') || ( !empty($accessList->affidavit->submenu->all_affidavit) && $accessList->affidavit->submenu->all_affidavit == "all_affidavit"))
        <li><a class="allAffidavit" href="{{route('admin.affidavit')}}" >সকল সনদ পত্র</a></li>
        @endif
    </ul>
</div>
<!-- body nav start -->
