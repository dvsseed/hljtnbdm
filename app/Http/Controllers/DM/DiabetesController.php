<?php namespace App\Http\Controllers\DM;

use DB;
use Auth;
use Redirect;
use Hash;
use Input;
use Carbon\Carbon;
use App\User;
use App\Buildcase;
use App\Patientprofile;
use App\Model\Pdata\HospitalNo;
use App\Model\SOAP\SoaNurseClass;
use App\Http\Requests\DiabetesMesRequest;
use App\Http\Controllers\Event\EventController;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DiabetesController extends Controller
{

    /**
     * 只允许登录用户访问
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 返回DM主页
     */
    public function home(Request $request)
    {
        $users = Auth::user();
        $features = DB::table('users')
            ->join('hasfeatures', 'users.id', '=', 'hasfeatures.user_id')
            ->join('features', 'hasfeatures.feature_id', '=', 'features.id')
            ->select('features.id', 'features.href', 'features.btnclass', 'features.innerhtml')
            ->where('users.id', '=', $users->id)
            ->get();
        $doctor = ($users->position == '门诊医生' || $users->position == '住院医生') ? 1 : 0;
        if ($users->position == null || $users->position == '患者') {
            // 患者登入
//            return view('dm.personal', compact('doctor', 'users', 'features'));
            return Redirect::route("bdata");
        } else {
            $search = urldecode($request->search);
            $category = $request->category;
            if ($search) {
                $categoryList = [
                    1 => "buildcases.personid",
                    2 => "buildcases.cardid",
                ];
                $field = in_array($category, array_keys($categoryList)) ? $categoryList[$category] : "other";
                if($field!="other") {
                    $results = DB::table('buildcases')
                        ->leftjoin('users', 'users.pid', '=', 'buildcases.personid')
                        ->select('buildcases.id', 'buildcases.doctor', 'buildcases.duty', 'buildcases.nurse', 'buildcases.dietitian', 'buildcases.personid', 'buildcases.cardid', 'buildcases.build_at', 'buildcases.nurse_status', 'buildcases.duty_status', 'buildcases.dietitian', 'buildcases.dietitian_status', 'users.name')->where($field, 'like', '%' . $search . '%')->where(function($query){
                        $users = Auth::user();
                        $query->where('doctor', '=', $users->id)->orWhere('duty', '=', $users->id)->orWhere('nurse', '=', $users->id)->orWhere('dietitian', '=', $users->id);
                    })->orderBy('build_at', 'desc');
                } else {
                    $results = DB::table('buildcases')
                        ->leftjoin('users', 'users.pid', '=', 'buildcases.personid')
                        ->select('buildcases.id', 'buildcases.doctor', 'buildcases.duty', 'buildcases.nurse', 'buildcases.dietitian', 'buildcases.personid', 'buildcases.cardid', 'buildcases.build_at', 'buildcases.nurse_status', 'buildcases.duty_status', 'buildcases.dietitian', 'buildcases.dietitian_status', 'users.name')->where('doctor', '=', $users->id)->orWhere('duty', '=', $users->id)->orWhere('nurse', '=', $users->id)->orWhere('dietitian', '=', $users->id)->orderBy('build_at', 'desc');
                }
            } else {
                $results = DB::table('buildcases')
                    ->leftjoin('users', 'users.pid', '=', 'buildcases.personid')
                    ->select('buildcases.id', 'buildcases.doctor', 'buildcases.duty', 'buildcases.nurse', 'buildcases.dietitian', 'buildcases.personid', 'buildcases.cardid', 'buildcases.build_at', 'buildcases.nurse_status', 'buildcases.duty_status', 'buildcases.dietitian', 'buildcases.dietitian_status', 'users.name')->where('doctor', '=', $users->id)->orWhere('duty', '=', $users->id)->orWhere('nurse', '=', $users->id)->orWhere('dietitian', '=', $users->id)->orderBy('build_at', 'desc');
            }
            $count = $results->count();
            $buildcases = $results->paginate(10)->appends(['search' => $search, 'category' => $category]);
            $soa_nurse_classes = SoaNurseClass::orderBy('soa_nurse_class_pk')->get();

            return view('dm.home', compact('doctor', 'users', 'count', 'buildcases', 'features', 'search', 'category', 'soa_nurse_classes'));
        }
    }

    public function gobd($pid, $bid)
    {
        $pps = Patientprofile::where('pp_patientid', '=', $pid)->first();
        if(is_null($pps)) {
            return Redirect::route("bdata");
        } else {
            $ppid = $pps->id;
            $hns = HospitalNo::where('patient_profile_id', '=', $ppid)->first();
            $uuid = $hns->hospital_no_uuid;
            $buildcase = Buildcase::where('id', '=', $bid)->first();
            $buildcase->hospital_no_uuid = $uuid;
            $buildcase->save();

            return Redirect::to("/bdata/$uuid");
        }
    }

    public function gosoap($pid, $bid)
    {
        $pps = Patientprofile::where('pp_patientid', '=', $pid)->first();
        if(is_null($pps)) {
            return Redirect::route("soap");
        } else {
            $ppid = $pps->id;
            $hns = HospitalNo::where('patient_profile_id', '=', $ppid)->first();
            $uuid = $hns->hospital_no_uuid;
            $buildcase = Buildcase::where('id', '=', $bid)->first();
            $buildcase->hospital_no_uuid = $uuid;
            $buildcase->save();

            return Redirect::to("/soap/$uuid");
        }
    }

    /**
     * 返回个人信息页面
     */
    public function personal()
    {
        // $diabetes = Auth::user()->diabetes;
        // return view('dm.home', compact('diabetes'));
        $users = Auth::user();
        // $hasfeatures = Hasfeature::where('user_id', '=', $users->id)->get();
        $features = DB::table('users')
            ->join('hasfeatures', 'users.id', '=', 'hasfeatures.user_id')
            ->join('features', 'hasfeatures.feature_id', '=', 'features.id')
            ->select('features.id', 'features.href', 'features.btnclass', 'features.innerhtml')
            ->where('users.id', '=', $users->id)
            ->get();
        $doctor = ($users->position == '门诊医生' || $users->position == '住院医生') ? 1 : 0;
        return view('dm.personal', compact('doctor', 'users', 'features'));
    }

    /**
     * 返回修改资料页面
     * @return [type] [description]
     */
    public function edit()
    {
//        $positions = User::$_position;
//        return view('dm.edit', compact('positions'));
        return view('dm.edit', compact('positions'));
    }

    public function update(DiabetesMesRequest $request)
    {
        // Auth::user()->update($request->all());
        $this->validate($request, User::rules());
        $user = Auth::user();
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->department = $request->department;
        $user->position = $request->position;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->save();
        session()->flash('message', '个人信息修改成功');
        EventController::SaveEvent('users', 'update(更新)');
        return Redirect::route('dm_home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $dutys = User::where('position', '=', '院长')
            ->orWhere('position', '=', '副院长')
            ->orWhere('position', '=', '病区主任')
            ->orWhere('position', '=', '门诊医生')
            ->orWhere('position', '=', '住院医生')
            ->orWhere('position', '=', '护理师')
            ->orWhere('position', '=', '营养师')
            ->orWhere('position', '=', '医助')
            ->orderBy('name', 'ASC')
            ->lists('name', 'id');
        $dutys = array('' => '请选择') + $dutys;
        $nurses = User::where('position', '=', '护理师')->orderBy('name', 'ASC')->lists('name', 'id');
        $nurses = array('' => '请选择') + $nurses;
        $soa_nurse_classes[0] = SoaNurseClass::where('type','=',1)->orderBy('soa_nurse_class_pk')->get();
        $dietitians = User::where('position', '=', '营养师')->orderBy('name', 'ASC')->lists('name', 'id');
        $dietitians = array('' => '请选择') + $dietitians;
        $soa_nurse_classes[1] = SoaNurseClass::where('type','=',2)->orderBy('soa_nurse_class_pk')->get();
        EventController::SaveEvent('buildcases', 'create(创建)');
        return view('dm.create', compact('dutys', 'nurses', 'dietitians', 'soa_nurse_classes'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'personid' => 'required|alpha_num',
        ]);
        $buildcase = new Buildcase;
        $buildcase->personid = $request->personid;
        $buildcase->cardid = $request->cardid;
        $today = Carbon::now();
        $today->toDateTimeString();
        $buildcase->build_at = $today;
        $buildcase->doctor = Auth::user()->id;
        $buildcase->memo = $request->memo;
        if ($request->duty) {
            $buildcase->duty = $request->duty;
            $buildcase->duty_status = 0;
            $buildcase->duty_at = $today;
        }
        if ($request->nurse) {
            $buildcase->nurse = $request->nurse;
            $soa_nurse_class_pks0 = Input::get('soa_nurse_class_pks0', true);
            if (is_array($soa_nurse_class_pks0)) {
                $pks0 = implode(",", $soa_nurse_class_pks0);
            } else {
                $pks0 = array();
            }
            $buildcase->soa_nurse_class_pks0 = $pks0;
            $buildcase->nurse_status = 0;
            $buildcase->nurse_at = $today;
        }
        if ($request->dietitian) {
            $buildcase->dietitian = $request->dietitian;
            $soa_nurse_class_pks1 = Input::get('soa_nurse_class_pks1', true);
            if (is_array($soa_nurse_class_pks1)) {
                $pks1 = implode(",", $soa_nurse_class_pks1);
            } else {
                $pks1 = array();
            }
            $buildcase->soa_nurse_class_pks1 = $pks1;
            $buildcase->dietitian_status = 0;
            $buildcase->dietitian_at = $today;
        }
        $buildcase->save();
        session()->flash('message', "建案新增成功");
        EventController::SaveEvent('buildcases', 'store(保存)');
        return redirect()->route('dm_home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
//    public function show($id)
//    {
//        $patientprofile = Patientprofile::findOrFail($id);
//        $casecare = CaseCare::where('patientprofile1_id', '=', $id)->firstOrFail();
//        $carbon = Carbon::today();
//        $year = $carbon->year;
//        $bsms = BSM::orderBy('bm_order')->get();
//        $account = User::findOrFail($patientprofile->user_id)->account;
//        $areas = Patientprofile::$_area;
//        $doctors = Patientprofile::$_doctor;
//        $sources = Patientprofile::$_source;
//        $occupations = Patientprofile::$_occupation;
//        $languages = Patientprofile::$_language;
//
//        EventController::SaveEvent('buildcases', 'show(显示)');
//        return view('dm.show', compact('patientprofile', 'casecare', 'year', 'bsms', 'account', 'areas', 'doctors', 'sources', 'occupations', 'languages'));
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $rows = Buildcase::where('id', '=', $id)->delete();
        session()->flash('message', "建案已经被移除");
        EventController::SaveEvent('buildcases', 'destroy(删除)');
        return Redirect::back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function eedit($id)
    {
        $buildcase = Buildcase::findOrFail($id);
        $dutys = User::where('position', '=', '院长')
            ->orWhere('position', '=', '副院长')
            ->orWhere('position', '=', '病区主任')
            ->orWhere('position', '=', '门诊医生')
            ->orWhere('position', '=', '住院医生')
            ->orWhere('position', '=', '护理师')
            ->orWhere('position', '=', '营养师')
            ->orWhere('position', '=', '医助')
            ->orderBy('name', 'ASC')
            ->lists('name', 'id');
        $dutys = array('' => '请选择') + $dutys;
        $nurses = User::where('position', '=', '护理师')->orderBy('name', 'ASC')->lists('name', 'id');
        $nurses = array('' => '请选择') + $nurses;
        $soa_nurse_classes[0] = SoaNurseClass::where('type','=',1)->orderBy('soa_nurse_class_pk')->get();
        $dietitians = User::where('position', '=', '营养师')->orderBy('name', 'ASC')->lists('name', 'id');
        $dietitians = array('' => '请选择') + $dietitians;
        $soa_nurse_classes[1] = SoaNurseClass::where('type','=',2)->orderBy('soa_nurse_class_pk')->get();
        EventController::SaveEvent('buildcases', 'edit(编辑)');
        return view('dm.eedit', compact('buildcase', 'dutys', 'nurses', 'dietitians', 'soa_nurse_classes'));
    }

    public function uupdate(Request $request)
    {
        $this->validate($request, [
            'personid' => 'required|alpha_num',
        ]);
        $buildcase = Buildcase::where('id', $request->id)->first();
        $buildcase->personid = $request->personid;
        $buildcase->cardid = $request->cardid;
        $today = Carbon::now();
        $today->toDateTimeString();
        $buildcase->memo = $request->memo;
        if ($request->duty) {
            $buildcase->duty = $request->duty;
            $buildcase->duty_at = $today;
        }
        if ($request->nurse) {
            $buildcase->nurse = $request->nurse;
            $soa_nurse_class_pks0 = Input::get('soa_nurse_class_pks0', true);
            if (is_array($soa_nurse_class_pks0)) {
                $pks0 = implode(",", $soa_nurse_class_pks0);
            } else {
                $pks0 = array();
            }
            $buildcase->soa_nurse_class_pks0 = $pks0;
            $buildcase->nurse_at = $today;
        }
        if ($request->dietitian) {
            $buildcase->dietitian = $request->dietitian;
            $soa_nurse_class_pks1 = Input::get('soa_nurse_class_pks1', true);
            if (is_array($soa_nurse_class_pks1)) {
                $pks1 = implode(",", $soa_nurse_class_pks1);
            } else {
                $pks1 = array();
            }
            $buildcase->soa_nurse_class_pks1 = $pks1;
            $buildcase->dietitian_at = $today;
        }
        $buildcase -> soap_status = 0;
        $buildcase->save();
        session()->flash('message', "建案修改成功");
        EventController::SaveEvent('buildcases', 'update(更新)');
        return Redirect::route('dm_home');
    }

    public function ajaxget(Request $request)
    {
        $cases = DB::select('SELECT DISTINCT u.name AS teacher, count(*) AS number FROM buildcases AS b LEFT JOIN users AS u ON b.duty = u.id WHERE build_at >= ADDDATE(NOW(), -14) AND build_at < NOW() GROUP BY duty ORDER BY duty, personid');
        $tbody = "<strong>**二周内收案统计**</strong>";
        $tbody .= "<table><thead>";
        $tbody .= "<tr><td colspan='3'>--------------------</td></tr></thead>";
        $tbody .= "<tr><th>&nbsp;卫教师&nbsp;</th><th>&nbsp;</th><th>&nbsp;案数&nbsp;</th></tr></thead>";
        $tbody .= "<tr><td colspan='3'>--------------------</td></tr></thead>";
        $tbody .= "<tbody>";
        foreach ($cases as $case) {
            $tbody .= "<tr>";
            $tbody .= "<td>&nbsp;" . $case->teacher . "&nbsp;</td>";
            $tbody .= "<td>&nbsp;&nbsp;</td>";
            $tbody .= "<td align='right'>&nbsp;" . $case->number . "&nbsp;</td>";
            $tbody .= "</tr>";
        }
        $tbody .= "</tbody></table>";
        $msg = $tbody;
        $data = array(
            'status' => 'success',
            'msg' => $msg,
        );
        return response()->json($data);
    }

    public function ajaxpost(Request $request)
    {
//      $pid = Request::input('personid');
        $pid = Input::get('personid');
        if(empty($pid)) {
            $msg = "请输入: 患者[身份证]...";
        } else {
            $user = Buildcase::where('personid', '=', $pid)->orderBy('personid', 'ASC')->orderBy('build_at', 'DESC')->first();
            if($user) {
                $duty = $user->duty;
                $dutyname = '';
                $nursename = '';
                $dietitianname = '';
                if ($duty) $dutyname = '前次[责任卫教]: <strong>'.User::findOrFail($user->duty)->name.'</strong>';
                $nurse = $user->nurse;
                if ($nurse) $nursename = ', [护理卫教]: <strong>'.User::findOrFail($user->nurse)->name.'</strong>';
                $dietitian = $user->dietitian;
                if($dietitian) $dietitianname = ', [营养卫教]: <strong>'.User::findOrFail($user->dietitian)->name.'</strong>';
            }
            if(empty($duty) && empty($nurse) && empty($dietitian)){
                $msg = "该患者无建案纪录...";
            } else {
                $msg = $dutyname . $nursename . $dietitianname;
            }
        }

        $data = array(
            'status' => 'success',
            'msg' => $msg,
        );
        return response()->json($data);
    }
}
