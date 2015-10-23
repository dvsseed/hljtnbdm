<?php namespace App\Http\Controllers\Feature;

use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Feature;

use Illuminate\Http\Request;

class FeatureController extends Controller {

	public function __construct()
	{
		$this->middleware('admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
             	$result = Feature::orderBy('id', 'ASC');
                $countstr = '功能';
                $count = $result->count();
               	$features = $result->paginate(10);
                return view('Feature.index', compact('features', 'countstr', 'count'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	        $result = Feature::orderBy('id', 'ASC');
                $countstr = '功能';
        	$count = $result->count();
        	return view('Feature.create', compact('countstr', 'count'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
//	        $this->validate($request, [
//        	    'id' => 'required|numeric|unique:features',
//	            ]);
        	$feature = new Feature;
//        	$feature->id = $request->id;
        	$feature->href = $request->href;
               	$feature->btnclass = $request->btnclass;
               	$feature->innerhtml = $request->innerhtml;
        	$feature->save();
        	session()->flash('message', $feature->innerhtml."功能添加成功");
        	return Redirect::to('feature');
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
	        $rows = Feature::where('id', '=', $id)->delete();
	        session()->flash('message', "功能已经被移除");
	        return Redirect::back();
	}

	public function upload_feature(Request $request)
	{
        	$this->validate($request, Feature::rules());
	        $feature = Feature::where('id', $request->feature_id)->first();
	        $feature->href = $request->href;
	        $feature->btnclass = $request->btnclass;
	       	$feature->innerhtml = $request->innerhtml;
	        $feature->save();
	        session()->flash('message', '功能更新成功');
	        return Redirect::back();
	}

	public function hasonefeature()
	{
		return $this->hasOne('App\Hasfeature');
	}

}
