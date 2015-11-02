<?php namespace App\Http\Controllers\Admin;

use Redirect;
use Input;
use Hash;
use Auth;
//use Session;
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
        // Gets the query string from our form submission 
        $search = urldecode($request->search);
        $category = $request->category;

        // Returns an array of users that have the query string located somewhere within
        // our users names. Paginates them so we can break up lots of search results.
        if ($search) {
            switch ($category) {
                case 1:
                    $field = 'name';
                    break;
                case 2:
                    $field = 'department';
                    break;
                case 3:
                    $field = 'position';
                    break;
            }
            $result = User::where('is_admin', 0)->where($field, 'like', '%' . $search . '%');
        } else {
            $result = User::where('is_admin', 0);
        }
        $countstr = '人';
        $count = $result->count();
        $users = $result->paginate(10)->appends(['search' => $search, 'category' => $category]);
        // returns a view and passes the view the list of users and the original query.
        $categories = array('' => '请选择', '1' => '姓名', '2' => '部门', '3' => '职务');
        return view('Admin.index', compact('users', 'countstr', 'count', 'categories', 'search', 'category'));
    }

    public function create()
    {
        $result = User::where('is_admin', 0);
        $countstr = '人';
        $count = $result->count();
        EventController::SaveEvent('users', 'create(创建)');
        return view('Admin.create', compact('countstr', 'count'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'account' => 'required|alpha_num|unique:users,account',
        ]);
        $user = new User;
        $user->account = $request->account;
        $user->name = $request->name;
        $user->password = Hash::make($user->account);
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
