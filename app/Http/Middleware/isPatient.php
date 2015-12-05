<?php namespace App\Http\Middleware;

use Auth;
use Redirect;
use Closure;
use App\Hasfeature;

class isPatient {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
                if (!Auth::check()) {
                        return Redirect::route('login');
                } else {
                        $ispatient = Hasfeature::where('user_id', Auth::user()->id)->where('feature_id', 1)->count();
                        if (!$ispatient) {
                                session()->flash('message_warning', '您不是合法使用者！无法进入相关区域');
                                return Redirect::route('dm_home');
                        }
                }

		return $next($request);
	}

}
