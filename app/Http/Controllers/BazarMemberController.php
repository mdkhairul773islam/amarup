<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\BazarMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BazarMemberController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * All member
     */
    public function index(Request $request) {
        $data['asideMenu']    = 'bazar_member';
        $data['asideSubmenu'] = 'allMember';

        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['upazilas']  = DB::table('upazilas')->get();
        $data['unions']    = DB::table('unions')->get();
        $data['wards']     = DB::table('wards')->get();

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();

        $where = [];

        if ($userInfo->privilege == 'user') {
            if (!empty($userInfo->union_id)) {
                $where[] = ['union_id', $userInfo->union_id];
            }
        }

        $data['allMember'] = BazarMember::select('id', 'mobile_no', 'holding_no', 'holder_name')->where($where)->get();


        if (!empty($request->_token)) {

            if (!empty($request->member_id)) {
                $where[] = ['id', $request->member_id];
            }

            if (!empty($request->holding_no)) {
                $where[] = ['holding_no', $request->holding_no];
            }

            if (!empty($request->district_id)) {
                $where[] = ['district_id', $request->district_id];
            }

            if (!empty($request->upazila_id)) {
                $where[] = ['upazila_id', $request->upazila_id];
            }

            if (!empty($request->union_id)) {
                $where[] = ['union_id', $request->union_id];
            }

            if (!empty($request->ward_id)) {
                $where[] = ['ward_id', $request->ward_id];
            }

            if (!empty($request->mobile_no)) {
                $where[] = ['mobile_no', $request->mobile_no];
            }
        } else {
            $where[] = ['created', date('Y-m-d')];
        }


        $data['results'] = BazarMember::where($where)->get();

        return view('bazar_member.index', $data);
    }

    /**
     * Create member
     */
    public function create() {
        $data['asideMenu']    = 'bazar_member';
        $data['asideSubmenu'] = 'addMember';

        // get user data
        $data['userInfo'] = Auth::user();

        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['upazilas']  = DB::table('upazilas')->get();
        $data['unions']    = DB::table('unions')->get();
        $data['wards']     = DB::table('wards')->get();


        return view('bazar_member.create', $data);
    }

    /**
     * Store member
     */
    public function store(Request $request) {
        $data = new BazarMember();

        $data->created       = date('Y-m-d');
        $data->holder_name   = $request->holder_name;
        $data->father_name   = $request->father_name;
        $data->mother_name   = $request->mother_name;
        $data->mobile_no     = $request->mobile_no;
        $data->business_name = $request->business_name;
        $data->district_id   = $request->district_id;
        $data->upazila_id    = $request->upazila_id;
        $data->union_id      = $request->union_id;
        $data->ward_id       = $request->ward_id;
        $data->holding_no    = $request->holding_no;
        
        $data->tenant                 = $request->tenant;
        $data->tenant_name            = $request->tenant_name;
        $data->tenant_father_name     = $request->tenant_father_name;
        $data->tenant_business_assets = $request->tenant_business_assets;
        
        $data->total_land        = $request->total_land;
        $data->bazar_name        = $request->bazar_name;
        $data->total_assets      = $request->total_assets;
        $data->business_income   = $request->business_income;
        $data->annual_assessment = $request->annual_assessment;
        $data->total_taxes       = $request->total_taxes;
    
        if (!empty($request->file('member_image'))) {
            $data->path = uploadFile($request->file('member_image'), 'public/uploads/member-image');
        }

        $data->save();

        $message = ['success' => 'Bazar Member update successful.'];

        return redirect()->route('admin.bazar_member.create')->with($message);
    }

    /**
     * View member
     */
    public function view($id) {
        $data['asideMenu']    = 'bazar_member';
        $data['asideSubmenu'] = 'allMember';

        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['upazilas']  = DB::table('upazilas')->get();
        $data['unions']    = DB::table('unions')->get();
        $data['wards']     = DB::table('wards')->get();

        $data['info'] = BazarMember::find($id);

        return view('bazar_member.view', $data);
    }

    /**
     * Edit member
     */
    public function edit($id) {
        $data['asideMenu']    = 'bazar_member';
        $data['asideSubmenu'] = 'allMember';

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();

        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['upazilas']  = DB::table('upazilas')->get();
        $data['unions']    = DB::table('unions')->get();
        $data['wards']     = DB::table('wards')->get();

        $data['info'] = BazarMember::find($id);

        return view('bazar_member.edit', $data);
    }

    /**
     * Edit member
     */
    public function report($id) {
        $data['asideMenu']    = 'bazar_member';
        $data['asideSubmenu'] = 'allMember';

        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['upazilas']  = DB::table('upazilas')->get();
        $data['unions']    = DB::table('unions')->get();
        $data['wards']     = DB::table('wards')->get();

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();

        $where = [];

        if (!empty($request->wno)){
            $where[] = ['ward_id', strDecode($request->wno)];
        }

        if ($userInfo->privilege == 'user') {
            if (!empty($userInfo->union_id)) {
                $where[] = ['union_id', $userInfo->union_id];
            }
        }

        $data['allMember'] = BazarMember::select('id', 'name', 'mobile_no', 'holding_no', 'householder')->where($where)->get();

        $data['info'] = BazarMember::find($id);

        return view('bazar_member.report', $data);
    }

    /**
     * Update member
     */
    public function update(Request $request) {
        $data = BazarMember::find($request->id);
        

        $data->created       = date('Y-m-d');
        $data->holder_name   = $request->holder_name;
        $data->father_name   = $request->father_name;
        $data->mother_name   = $request->mother_name;
        $data->mobile_no     = $request->mobile_no;
        $data->business_name = $request->business_name;
        $data->district_id   = $request->district_id;
        $data->upazila_id    = $request->upazila_id;
        $data->union_id      = $request->union_id;
        $data->ward_id       = $request->ward_id;
        $data->holding_no    = $request->holding_no;
        
        $data->tenant                 = $request->tenant;
        $data->tenant_name            = $request->tenant_name;
        $data->tenant_father_name     = $request->tenant_father_name;
        $data->tenant_business_assets = $request->tenant_business_assets;
        
        $data->total_land        = $request->total_land;
        $data->bazar_name        = $request->bazar_name;
        $data->total_assets      = $request->total_assets;
        $data->business_income   = $request->business_income;
        $data->annual_assessment = $request->annual_assessment;
        $data->total_taxes       = $request->total_taxes;

        if (!empty($request->file('member_image'))) {
            if (file_exists($data->path)) unlink($data->path);
            $data->path = uploadFile($request->file('member_image'), 'public/uploads/bazar_member');
        }
        $data->save();
        $message = ['update' => 'Bazar Member update successful.'];
            
        return redirect()->route('admin.bazar_member')->with($message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        BazarMember::find($id)->delete();

        return redirect()->route('admin.bazar_member')->with(['delete' => 'Member successfully deleted.']);
    }

    /**
     * get district list
     */
    public function districtList(Request $request) {
        $option = '<option value="" selected>জেলা নির্বাচন করুন</option>';
        if (!empty($request->id)) {
            $results = DB::table('districts')->where('division_id', $request->id)->get();
            if (!empty($results)) {
                foreach ($results as $row) {
                    if (!empty($request->select_id) && $request->select_id == $row->id) {
                        $option .= '<option value="' . $row->id . '" selected>' . $row->bn_name . '</option>';
                    } else {
                        $option .= '<option value="' . $row->id . '">' . $row->bn_name . '</option>';
                    }
                }
            }
        }
        echo $option;
    }

    /**
     * get Upazila list
     */
    public function upazilaList(Request $request) {
        $option = '<option value="" selected>উপজেলা নির্বাচন করুন</option>';
        if (!empty($request->id)) {
            $results = DB::table('upazilas')->where('district_id', $request->id)->get();
            if (!empty($results)) {
                foreach ($results as $row) {
                    if (!empty($request->select_id) && $request->select_id == $row->id) {
                        $option .= '<option value="' . $row->id . '" selected>' . $row->bn_name . '</option>';
                    } else {
                        $option .= '<option value="' . $row->id . '">' . $row->bn_name . '</option>';
                    }
                }
            }
        }
        echo $option;
    }

    /**
     * get Union list
     */
    public function unionList(Request $request) {
        $option = '<option value="" selected>ইউনিয়ন নির্বাচন করুন</option>';
        if (!empty($request->id)) {
            $results = DB::table('unions')->where('upazilla_id', $request->id)->get();
            if (!empty($results)) {
                foreach ($results as $row) {
                    if (!empty($request->select_id) && $request->select_id == $row->id) {
                        $option .= '<option value="' . $row->id . '" selected>' . $row->bn_name . '</option>';
                    } else {
                        $option .= '<option value="' . $row->id . '">' . $row->bn_name . '</option>';
                    }
                }
            }
        }
        echo $option;
    }
    
    /**
    * get All Member Ward Wise
    */
    public function wardWiseMembers(Request $request) {
        $option = '<option value="" selected>সদস্য নির্বাচন করুন</option>';
        
        if (!empty($request->ward_id)) {
            if(!empty($request->union_id)){
                $results = DB::table('bazar_members')->where([['ward_id', $request->ward_id],['union_id', $request->union_id]])->get();
            }else{
                $results = DB::table('bazar_members')->where('ward_id', $request->ward_id)->get();
            }
            if (!empty($results)) {
                foreach ($results as $row) {
                    $option .= '<option value="' . $row->id . '">' . $row->name . '</option>';
                }
            }
        }
        echo $option;
    }

}
