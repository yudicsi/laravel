<?php
namespace App\__aaa\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserAccessible
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
 		if (NotOKUser() || (empty($_SESSION['key']) || !IsToken(3,$_SESSION['key']))) return redirect('NaN');
		return $next($request);
	}
}

