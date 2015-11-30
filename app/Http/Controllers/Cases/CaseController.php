<?php namespace App\Http\Controllers\Cases;

use App\Caselist;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Event\EventController;

use Illuminate\Http\Request;

class CaseController extends Controller {

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
				1 => "cl_patientid",
				2 => "cl_patientname",
				3 => "cl_case_date",
			];
			$field = in_array($category, array_keys($categoryList)) ? $categoryList[$category] : "other";
			$result = Caselist::where($field, 'like', '%' . $search . '%')->orderBy('created_at', 'desc');
		} else {
			$result = Caselist::orderBy('created_at', 'desc');
		}

		$count = $result->count();
		$caselists = $result->paginate(10)->appends(['search' => $search, 'category' => $category]);
//		$current_user_id = Auth::user()->id;
		return view('case.index', compact('caselists', 'count', 'search', 'category'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
//		$carbon = Carbon::today();
		// $format = $carbon->format('Y-m-d H:i:s');
//		$year = $carbon->year;
//		$bsms = BSM::orderBy('bm_order')->get();
//		$areas = Patientprofile::$_area;
//		$doctors = Patientprofile::$_doctor;
//		$sources = Patientprofile::$_source;
//		$occupations = Patientprofile::$_occupation;
//		$languages = Patientprofile::$_language;
//		$patientid = null;

		$casetypes = array('' => '请选择', '1' => '初诊', '2' => '复诊', '3' => '年度检查', '4' => '一般');
		EventController::SaveEvent('caselist', 'create(创建)');
//		return view('case.create', compact('year', 'bsms', 'areas', 'doctors', 'sources', 'occupations', 'languages', 'patientid'));
		return view('case.create', compact('casetypes'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function about()
	{
		return view('case.about');
	}

}
