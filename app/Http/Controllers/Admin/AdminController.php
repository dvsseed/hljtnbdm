<?php namespace App\Http\Controllers\Admin;

use Redirect;
use Input;
use Hash;
use Auth;
use App\User;
use App\Http\Controllers\Event\EventController;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $search = urldecode($request->search);
        $category = $request->category;

        if ($search) {
            $categoryList = [
                1 => "name",
                2 => "department",
                3 => "position",
            ];
            $field = in_array($category, array_keys($categoryList)) ? $categoryList[$category] : "other";
            $result = User::where('is_admin', 0)->where($field, 'like', '%' . $search . '%');
        } else {
            $result = User::where('is_admin', 0);
        }
        $countstr = '人';
        $count = $result->count();
        $users = $result->paginate(10)->appends(['search' => $search, 'category' => $category]);
        $categories = array('' => '请选择', '1' => '姓名', '2' => '部门', '3' => '职务');
        $positions = User::$_position;
        return view('Admin.index', compact('users', 'countstr', 'count', 'categories', 'search', 'category', 'positions'));
    }

    public function create()
    {
        $result = User::where('is_admin', 0);
        $countstr = '人';
        $count = $result->count();
        $positions = User::$_position;
        EventController::SaveEvent('users', 'create(创建)');
        return view('Admin.create', compact('countstr', 'count', 'positions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'account' => 'required|alpha_num|unique:users,account',
        ]);
        $user = new User;
        $user->account = $request->account;
        $user->password = Hash::make($user->account);
        $user->name = $request->name;
        $user->position = $request->position;
        $user->save();
        session()->flash('message', $user->name . "人员添加成功");
        EventController::SaveEvent('users', 'store(保存)');
        return Redirect::to('admin');
    }

    public function destroy(User $user)
    {
        $name = $user->name;
        $user->delete();
        session()->flash('message', $name . "人员已经被移除");
        EventController::SaveEvent('users', 'destroy(删除)');
        return Redirect::back();
    }

    public function upload_user(Request $request)
    {
        $this->validate($request, User::rules());
        $user = User::where('id', $request->user_id)->first();
        $user->account = $request->account;
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->departmentno = $request->departmentno;
        $user->department = $request->department;
        $user->positionno = $request->positionno;
        $user->position = $request->position;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->save();
        session()->flash('message', '人员更新成功');
        EventController::SaveEvent('users', 'update(更新)');
        return Redirect::back();
    }

    /**
     * Session forget.
     *
     * @param  int $key
     * @return Response
     */
//    public function forget($key)
//    {
//        if ($key) {
//            Session::forget('adsearch');
//            Session::forget('adcategory');
//        }
//        return redirect()->route('admin.index')->with('message', '搜寻文字已清除。');
//    }

}
