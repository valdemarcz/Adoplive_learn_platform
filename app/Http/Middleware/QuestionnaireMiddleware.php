<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\User;

use Closure;

class QuestionnaireMiddleware
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
        $user =  Auth::user();

        if($user){
            if(empty($user->varkstyle)){
                return redirect('/varktest/create');
            }
            
            
        }
        else{
            return redirect('/allcourses');
        }

        return $next($request);
    }
}
