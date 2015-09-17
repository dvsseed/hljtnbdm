<?php namespace App\Http\Controllers\Admin;

use DB;
use Redirect;
use Input;
use Hash;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminController extends Controller {

    public function __construct()
    {
        $this->middleware('admin');
    }
/*
    public function index()
    {
        $result = User::where('is_admin', 0);
        $count = $result->count();
        $users = $result->paginate(10);
        return view('Admin.index', compact('users', 'count'));
    }
*/
    public function index(Request $request)
    {
        // Gets the query string from our form submission 
        // $query = Input::get('search', '');
        $query = $request->search;
        // Returns an array of users that have the query string located somewhere within 
        // our users names. Paginates them so we can break up lots of search results.
        if (count($query) >= 1)
  	   $result = User::where('is_admin', 0)->where('name', 'like', '%' . $query . '%');
        else
           $result = User::where('is_admin', 0);
        $count = $result->count();
        $users = $result->paginate(10);
	// returns a view and passes the view the list of users and the original query.
        return view('Admin.index', compact('users', 'count'));
    }

    public function create(){
        $result = User::where('is_admin', 0);
        $count = $result->count();
        return view('Admin.create', compact('count'));
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
/*
        $grade = new Grade;
	    $grade->user_id = $request->id;
	    $grade->save();
*/
        return Redirect::to('admin');
    }

    public function destroy(User $user)
    {
        $name = $user->name;
        $user->delete();
        session()->flash('message', $name."人员已经被移除");
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
        return Redirect::back();
    }

}
