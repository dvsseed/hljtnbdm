<?php namespace App\Http\Controllers\Quality;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QualityController extends Controller {

	// 对象
	public static $_objects = array(
		"" => "请选择", "0" => "新登录::基本资料(总表)", "1" => "新登录::生理与习惯(总表)", "2" => "新登录::品质指标(总表)", "3" => "新登录::并发症(总表)", "4" => "新登录::生理与习惯明细", "5" => "新登录::并发症明细",
		"6" => "新登录::品质指标明细", "7" => "二年内::基本资料(总表)", "8" => "二年内::生理与习惯(总表)", "9" => "二年内::品质指标(总表)", "10" => "二年内::并发症(总表)", "11" => "二年内::生理与习惯明细", "12" => "二年内::并发症明细",
		"13" => "二年内::品质指标明细", "14" => "区间日期::基本资料(总表)", "15" => "区间日期::生理与习惯(总表)", "16" => "区间日期::品质指标(总表)", "17" => "区间日期::并发症(总表)", "18" => "区间日期::生理与习惯明细",
		"19" => "区间日期::并发症明细", "20" => "区间日期::品质指标明细"
	);

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$objects = self::$_objects;
		return view('quality.statistics', compact('objects'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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

}
