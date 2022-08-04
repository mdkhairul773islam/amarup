<?php
namespace App\Http\Controllers;

use App\Models\SignName;
use App\Models\Member;
use App\Models\BanglaNumberToWord;
use App\Models\TradeLicense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TradeLicenseController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * All Notice
     */
    public function index(Request $request) {
        $data['asideMenu']    = 'trade_license';
        $data['asideSubmenu'] = 'all_trade';
        
        $data['divisions']  = DB::table('divisions')->get();
        $data['districts']  = DB::table('districts')->get();
        $data['upazilas']   = DB::table('upazilas')->get();
        $data['unions']     = DB::table('unions')->get();
        $data['wards']      = DB::table('wards')->get();
        
        // get user data
        $data['userInfo'] = $userInfo = Auth::user();
        
        $where = [];
        
        
        if ($userInfo->privilege == 'user') {
            if (!empty($userInfo->union_id)) {
                $where[] = ['union_id', $userInfo->union_id];
            }
        }
        
        $data['allLicense'] = TradeLicense::select('id','license_no','license_owner')->where($where)->get();

        if (!empty($request->_token)) {
            if (!empty($request->license_no)) {
                $where[] = ['license_no', $request->license_no];
            }
            
            if (!empty($request->mobile)) {
                $where[] = ['mobile', $request->mobile];
            }
    
            if (!empty($request->date_from)) {
                $where[] = ['created','>=', $request->date_from];
            }
    
            if (!empty($request->date_to)) {
                $where[] = ['created','<=', $request->date_to];
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
        } else{
            $where[] = ['created', date('Y-m-d')];
        }
        
        $data['results'] = TradeLicense::where($where)->get();

        return view('trade_license.index', $data);
    }

    /**
     * Create Notice
     */
    public function create() {
        $data['asideMenu']    = 'trade_license';
        $data['asideSubmenu'] = 'add_trade';

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();

        $where = [];
        if ($userInfo->privilege == 'user') {
            if (!empty($userInfo->union_id)) {
                $where[] = ['union_id', $userInfo->union_id];
            }
        }
        
        $data['allMember'] = Member::select('id', 'name', 'mobile_no', 'holding_no', 'ward_id', 'householder')->where($where)->get();

        $data['divisions']  = DB::table('divisions')->get();
        $data['districts']  = DB::table('districts')->get();
        $data['upazilas']   = DB::table('upazilas')->get();
        $data['unions']     = DB::table('unions')->get();
        $data['wards']      = DB::table('wards')->get();

        return view('trade_license.create', $data);
    }

    /**
     * Store member
     */
    public function store(Request $request) {

        $trade = [];

        $data = New TradeLicense();

        $data->created               = numberFilter($request->created,'en');
        $data->district_id           = $request->district_id;
        $data->upazila_id            = $request->upazila_id;
        $data->union_id              = $request->union_id;
        $data->license_no            = numberFilter($request->license_no,'en');
        $data->finance_year          = numberFilter($request->finance_year,'en');
        $data->license_owner         = $request->license_owner;
        $data->father_name           = $request->father_name;
        $data->mother_name           = $request->mother_name;
        $data->mobile                = $request->mobile;
        $data->nid                   = numberFilter($request->nid,'en');
        $data->address               = $request->address;
        $data->business_name         = $request->business_name;
        $data->business_address      = $request->business_address;
        $data->business_type         = $request->business_type;
        $data->license_fee           = numberFilter($request->license_fee,'en');
        $data->vat                   = numberFilter($request->vat,'en');
        $data->tax_2                 = numberFilter($request->tax_2,'en');
        $data->service_charge        = numberFilter($request->service_charge,'en');
        $data->total                 = numberFilter($request->total,'en');
        $data->validity_period       = numberFilter($request->validity_period,'en');

        $data->save();

        $message = ['success' => 'Trade License update successful.'];

        return redirect()->route('admin.trade_license.view',$data->id)->with($message);
    }

    /**
     * View member
     */
    public function view($id) {
        $data['asideMenu']    = 'trade_license';
        $data['asideSubmenu'] = 'all_trade';
        
        
        $data['obj'] = new BanglaNumberToWord();

        $data['divisions']  = DB::table('divisions')->get();
        $data['districts']  = DB::table('districts')->get();
        $data['upazilas']   = DB::table('upazilas')->get();
        $data['unions']     = DB::table('unions')->get();
        $data['wards']      = DB::table('wards')->get();
        
        $data['sign_name']   = SignName::get();

        $data['info'] = TradeLicense::find($id);

        return view('trade_license.view', $data);
    }

    /**
     * Edit member
     */
    public function edit($id) {
        $data['asideMenu']    = 'trade_license';
        $data['asideSubmenu'] = 'all_trade';
        
        // get user data
        $data['userInfo'] = $userInfo = Auth::user();
        
        $where = [];
        if ($userInfo->privilege == 'user') {
            if (!empty($userInfo->union_id)) {
                $where[] = ['members.union_id', $userInfo->union_id];
            }
        }
        $data['allMember'] = Member::select('id', 'name', 'mobile_no', 'holding_no', 'ward_id', 'householder')->where($where)->get();
        

        $data['divisions']  = DB::table('divisions')->get();
        $data['districts']  = DB::table('districts')->get();
        $data['upazilas']   = DB::table('upazilas')->get();
        $data['unions']     = DB::table('unions')->get();
        $data['wards']      = DB::table('wards')->get();

        //$data['info'] = Notice::find($id);

        $data['info'] = $info = TradeLicense::with('memberInfo')->find($id);

        return view('trade_license.edit', $data);
    }

    /**
     * Update member
     */
    public function update(Request $request) {
        $data = TradeLicense::find($request->id);

        $data->created               = numberFilter($request->created,'en');
        $data->district_id           = $request->district_id;
        $data->upazila_id            = $request->upazila_id;
        $data->union_id              = $request->union_id;
        $data->license_no            = numberFilter($request->license_no,'en');
        $data->finance_year          = numberFilter($request->finance_year,'en');
        $data->license_owner         = $request->license_owner;
        $data->father_name           = $request->father_name;
        $data->mother_name           = $request->mother_name;
        $data->mobile                = $request->mobile;
        $data->nid                   = numberFilter($request->nid,'en');
        $data->address               = $request->address;
        $data->business_name         = $request->business_name;
        $data->business_address      = $request->business_address;
        $data->business_type         = $request->business_type;
        $data->license_fee           = numberFilter($request->license_fee,'en');
        $data->vat                   = numberFilter($request->vat,'en');
        $data->tax_2                 = numberFilter($request->tax_2,'en');
        $data->service_charge        = numberFilter($request->service_charge,'en');
        $data->total                 = numberFilter($request->total,'en');
        $data->validity_period       = numberFilter($request->validity_period,'en');

        $data->save();
        $message = ['update' => 'Trade License update successful.'];
        return redirect()->route('admin.trade_license')->with($message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        TradeLicense::find($id)->delete();
        return redirect()->route('admin.trade_license')->with(['delete' => 'Trade License successfully deleted.']);
    }

    public function memberInfo(Request $request) {
        if(!empty($request->id)){
            $partyInfo = DB::table('members')->where('id', $request->id)->first();

            $data = [
                'id'                => $partyInfo->id,
                'name'              => $partyInfo->name,
                'father_name'       => $partyInfo->father_name,
                'holding_no'        => $partyInfo->holding_no,
                'mobile_no'         => $partyInfo->mobile_no,
                'ward_id'           => $partyInfo->ward_id,
                'annual_assessment' => $partyInfo->annual_assessment,
                //'previous_paid'   => (!empty($tranInfo) ? $tranInfo : 0),
            ];
             return (object)$data;
        }
    }


    /**
     * get All Member Ward Wise
     */
    public function wardWiseMembers(Request $request) {
        $option = '<option value="" selected>সদস্য নির্বাচন করুন</option>';
        
        if (!empty($request->ward_id)) {
            if(!empty($request->union_id)){
                $results = DB::table('trade_license')->where([['ward_id', $request->ward_id],['union_id', $request->union_id]])->get();
            }else{
                $results = DB::table('trade_license')->where('ward_id', $request->ward_id)->get();
            }
            if (!empty($results)) {
                foreach ($results as $row) {
                    if (!empty($request->select_id) && $request->select_id == $row->id) {
                        $option .= '<option value="' . $row->id . '" selected>' . '(' . $row->holding_no . ') ' . $row->name . '</option>';
                    } else {
                        $option .= '<option value="' . $row->id . '">' . '(' . $row->holding_no . ') ' . $row->name . '</option>';
                    }
                    
                }
            }
        }
        echo $option;
    }
    
}