<?php namespace App\Http\Controllers\Event;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;
use Auth;

use Illuminate\Http\Request;

class EventController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$result = DB::table('events')
			->join('users', 'events.user_id', '=', 'users.id')
			->select('events.id', 'events.tablename', 'events.action', 'events.user_id', 'users.name', 'events.updated_at')
			->orderBy('events.updated_at', 'DESC');
                $countstr = '纪录';
                $count = $result->count();
                $events = $result->paginate(10);
		return view('Event.index', compact('events', 'countstr', 'count'));
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

	public static function SaveEvent($tablename, $action)
	{
		$event = new Event;
		$event->tablename = $tablename;
		$event->action = $action;
		$event->user_id = Auth::user()->id;
		$event->save();
	}

}
