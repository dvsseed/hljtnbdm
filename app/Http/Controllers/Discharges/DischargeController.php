<?php namespace App\Http\Controllers\Discharges;

use App\Patientprofile;
use App\User;
use App\Discharge;
use DB;
use Auth;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Event\EventController;
use Illuminate\Http\Request;

class DischargeController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$search = urldecode($request->search);
		$category = $request->category;
		if ($search) {
			$categoryList = [
				1 => "discharges.discharge_at",
				2 => "users.name",
			];
			$field = in_array($category, array_keys($categoryList)) ? $categoryList[$category] : "other";
			if($field!="other") {
				$result = DB::table('discharges')
					->leftjoin('users', 'users.id', '=', 'discharges.residencies')
					->select('discharges.id', 'discharges.user_id', 'discharges.doctor', 'discharges.residencies', 'discharges.discharge_at', 'users.name')->where($field, 'like', '%' . $search . '%')->orderBy('discharge_at', 'desc');
			} else {
				$result = DB::table('discharges')
					->leftjoin('users', 'users.id', '=', 'discharges.residencies')
					->select('discharges.id', 'discharges.user_id', 'discharges.doctor', 'discharges.residencies', 'discharges.discharge_at', 'users.name')->orderBy('discharge_at', 'desc');
			}
		} else {
			$result = DB::table('discharges')
				->leftjoin('users', 'users.id', '=', 'discharges.residencies')
				->select('discharges.id', 'discharges.user_id', 'discharges.doctor', 'discharges.residencies', 'discharges.discharge_at', 'users.name')->orderBy('discharge_at', 'desc');
		}

		$count = $result->count();
		$discharges = $result->paginate(10)->appends(['search' => $search, 'category' => $category]);
		return view('discharge.index', compact('discharges', 'count', 'search', 'category'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($patientid)
	{
		$pps = Patientprofile::where('pp_patientid', '=', $patientid)->first();
		if (is_null($pps)) {
			$err_msg = "患者资料不存在!!<br>請先建立患者资料後才能新增出院指导...";
			return view('discharge.create', compact('err_msg'));
		} else {
			$sex = $pps->pp_sex;
			$uid = $pps->user_id;
			$ppname = User::find($pps->user_id)->name;
			$today = Carbon::today()->toDateString();
			$year = Carbon::today()->year;
			$patientprofiles = Patientprofile::where('pp_patientid', '=', $patientid)->first();
			$residencies = User::where('position', '=', '住院医生')->orderBy('name', 'ASC')->lists('name', 'id');
			$residencies = array('' => '请选择') + $residencies;
			$err_msg = null;

			EventController::SaveEvent('discharge', 'create(创建)');
			return view('discharge.create', compact('err_msg', 'year', 'today', 'patientprofiles', 'sex', 'uid', 'ppname', 'patientid', 'residencies'));
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$discharge = new Discharge();
		$discharge->pp_id = $request->pp_id;
		$discharge->user_id = $request->user_id;
		$discharge->doctor = Auth::user()->id;
		$discharge->residencies = $request->residencies;
		$discharge->instruction = $request->instruction;
		$discharge->discharge_at = $request->discharge_at;
		$discharge->save();

		$msg = '出院指导创建成功。';
		EventController::SaveEvent('discharge', 'store(保存)');
		return redirect()->route('discharge.index')->with('message', $msg);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$discharge = Discharge::findOrFail($id);
		$ppname = User::find($discharge->user_id)->name;
		$patientid = User::find($discharge->user_id)->pid;
		$today = Carbon::today()->toDateString();
		$year = Carbon::today()->year;
		$residencies = User::where('position', '=', '住院医生')->orderBy('name', 'ASC')->lists('name', 'id');
		$residencies = array('' => '请选择') + $residencies;

		EventController::SaveEvent('discharge', 'edit(编辑)');
		return view('discharge.edit', compact('discharge', 'year', 'today', 'ppname', 'patientid', 'residencies'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$discharge = Discharge::findOrFail($id);
		$discharge->residencies = $request->residencies;
		$discharge->instruction = $request->instruction;
		$discharge->discharge_at = $request->discharge_at;
		$discharge->save();

		$msg = '出院指导更新成功。';
		EventController::SaveEvent('discharge', 'update(更新)');
		return redirect()->route('discharge.index')->with('message', $msg);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$casecare = Discharge::find($id);
		$casecare->delete();
		$msg = '出院指导删除成功。';
		EventController::SaveEvent('discharge', 'destroy(删除)');
		return redirect()->back()->with('message', $msg);
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function about()
	{
		return view('discharge.about');
	}

	public function history(Request $request, $patientid)
	{
		$userid = User::where('pid', '=', $patientid)->firstOrFail()->id;
		$search = urldecode($request->search);
		$category = $request->category;
		if ($search) {
			$categoryList = [
				1 => "discharges.discharge_at",
				2 => "users.name",
			];
			$field = in_array($category, array_keys($categoryList)) ? $categoryList[$category] : "other";
			if($field!="other") {
				$result = DB::table('discharges')
					->leftjoin('users', 'users.id', '=', 'discharges.residencies')
					->select('discharges.id', 'discharges.user_id', 'discharges.doctor', 'discharges.residencies', 'discharges.discharge_at', 'users.name')->where('discharges.user_id', '=', $userid)->where($field, 'like', '%' . $search . '%')->orderBy('discharge_at', 'desc');
			} else {
				$result = DB::table('discharges')
					->leftjoin('users', 'users.id', '=', 'discharges.residencies')
					->select('discharges.id', 'discharges.user_id', 'discharges.doctor', 'discharges.residencies', 'discharges.discharge_at', 'users.name')->where('discharges.user_id', '=', $userid)->orderBy('discharge_at', 'desc');
			}
		} else {
			$result = DB::table('discharges')
				->leftjoin('users', 'users.id', '=', 'discharges.residencies')
				->select('discharges.id', 'discharges.user_id', 'discharges.doctor', 'discharges.residencies', 'discharges.discharge_at', 'users.name')->where('discharges.user_id', '=', $userid)->orderBy('discharge_at', 'desc');
		}

		$count = $result->count();
		$discharges = $result->paginate(10)->appends(['search' => $search, 'category' => $category]);
		return view('discharge.index', compact('discharges', 'count', 'search', 'category'));
	}
}
