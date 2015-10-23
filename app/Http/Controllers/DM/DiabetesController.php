<?php namespace App\Http\Controllers\DM;

use DB;
use Auth;
use Redirect;
use Hash;
use App\Http\Requests\DiabetesMesRequest;
use App\Http\Controllers\Event\EventController;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DiabetesController extends Controller {

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
       	public function home()
    {
//	$diabetes = Auth::user()->diabetes;
//	return view('dm.home', compact('diabetes'));
        $users = Auth::user();
//	$hasfeatures = Hasfeature::where('user_id', '=', $users->id)->get();
	$features = DB::table('users')
            ->join('hasfeatures', 'users.id', '=', 'hasfeatures.user_id')
            ->join('features', 'hasfeatures.feature_id', '=', 'features.id')
            ->select('features.href', 'features.btnclass', 'features.innerhtml')
            ->where('users.id', '=', $users->id)
            ->get();
        return view('dm.home', compact('users', 'features'));
    }

    /**
     * 返回修改资料页面
     * @return [type] [description]
     */
    public function edit()
    {
     	return view('dm.edit');
    }

    public function update(DiabetesMesRequest $request)
    {
        // Auth::user()->update($request->all());
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

}
