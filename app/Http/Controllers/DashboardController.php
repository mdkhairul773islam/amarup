<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\SignName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['asideMenu']    = 'dashboard';
        $data['asideSubmenu'] = '';

        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['upazilas']  = DB::table('upazilas')->get();
        $data['unions']    = DB::table('unions')->get();

        $unionId       = Auth::user()->union_id;
        $data['wards'] = DB::select("SELECT members.union_id, members.ward_id, wards.name_bn, IFNULL(COUNT(*), 0) AS total_member FROM `members` JOIN wards ON members.ward_id=wards.id WHERE members.union_id='$unionId' AND members.deleted_at IS NULL GROUP BY members.ward_id ORDER BY members.ward_id");
        
        
        // get total member
       $where = [];
        if(Auth::user()->privilege == 'user'){
           $where[] = ['union_id', Auth::user()->union_id];
        }
        
        $data['chairman'] = SignName::where($where)->get();
        
        $memberList = Member::where($where)->get();

        $data['allMember']   = count($memberList);
        $data['allUpazila']  = count($data['upazilas']);
        $data['allUnion']    = count($data['unions']);
        
        $data['lowerClass']  = count($memberList->where('poverty_line', 'নিম্নবিত্ত'));
        $data['middleClass'] = count($memberList->where('poverty_line', 'মধ্যবিত্ত'));
        $data['upplerClass'] = count($memberList->where('poverty_line', 'উচ্চবিত্ত'));
        $data['totalMale']   = $memberList->sum('member_male');
        $data['totalFemale'] = $memberList->sum('member_female');
        $data['totalTaxes']  = $memberList->sum('taxes');

        return view('dashboard', $data);
    }
}
