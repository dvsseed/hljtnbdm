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

class AdminController extends Controller {

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        // Gets the query string from our form submission 
        // $query = Input::get('search', '');
        $query = $request->search;
        $category = $request->category;
        // Returns an array of users that have the query string located somewhere within 
        // our users names. Paginates them so we can break up lots of search results.
        if (count($query) >= 1)
        {
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
           $result = User::where('is_admin', 0)->where($field, 'like', '%' . $query . '%');
        }
        else
           $result = User::where('is_admin', 0);
        $countstr = '人';
        $count = $result->count();
        $users = $result->paginate(10);
	// returns a view and passes the view the list of users and the original query.
        $categories = array('0' => '请选择', '1' => '姓名', '2' => '部门', '3' => '职务');
        return view('Admin.index', compact('users', 'countstr', 'count', 'categories'));
    }

    public function create(){
        $result = User::where('is_admin', 0);
        $countstr = '人';
        $count = $result->count();
        EventController::SaveEvent('users', 'create(创建)');
        return view('Admin.create', compact('countstr', 'count'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric|unique:users',
            ]);
        $user = new User;
        $user->id = $request->id;
        $user->name = $request->name;
        $user->password = Hash::make($user->id);
        $user->save();
        session()->flash('message', $user->name."人员添加成功");
        EventController::SaveEvent('users', 'store(保存)');
        return Redirect::to('admin');
    }

    public function destroy(User $user)
    {
        $name = $user->name;
        $user->delete();
        session()->flash('message', $name."人员已经被移除");
        EventController::SaveEvent('users', 'destroy(删除)');
        return Redirect::back();
    }

    public function upload_user(Request $request)
    {
        $this->validate($request, User::rules());
        $user = User::where('id', $request->user_id)->first();
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

}
