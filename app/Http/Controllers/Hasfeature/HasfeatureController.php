<?php namespace App\Http\Controllers\Hasfeature;

use Input;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Hasfeature;
use App\User;
use App\Feature;

use Illuminate\Http\Request;

class HasfeatureController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$result = Hasfeature::orderBy('id', 'ASC');
		$count = $result->count();
		$hasfeatures = $result->paginate(10);
		return view('Hasfeature.index', compact('hasfeatures', 'count'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$result = Hasfeature::orderBy('id', 'ASC');
		$count = $result->count();
		$users = User::where('is_admin', 0)->lists('name', 'id');
		$features = Feature::all(); // lists('innerhtml', 'id');
		return view('Hasfeature.create', compact('count', 'users', 'features'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$featureids = Input::get('feature_ids', true);
		if(is_array($featureids))
		{
			foreach($featureids as $featureid)
			{
		                $hasfeature = new Hasfeature;
				$hasfeature->user_id = $request->user_id;
		                $hasfeature->feature_id = $featureid;
		                $hasfeature->save();
			}
		}
        	session()->flash('message', "操作添加成功");
		return Redirect::to('hasfeature');
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
		$rows = Hasfeature::where('id', '=', $id)->delete();
		session()->flash('message', "操作已经被移除");
		return Redirect::back();
	}

	public function upload_hasfeature(Request $request)
	{
		$this->validate($request, Hasfeature::rules());
		$hasfeature = Hasfeature::where('id', $request->hasfeature_id)->first();
		$hasfeature->user_id = $request->user_id;
		$hasfeature->feature_id = $request->feature_id;
		$hasfeature->save();
		session()->flash('message', '操作更新成功');
		return Redirect::back();
	}

}
