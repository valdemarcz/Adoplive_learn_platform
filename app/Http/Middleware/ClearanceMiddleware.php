<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ClearanceMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {        
        if (Auth::user()->hasPermissionTo('Administer roles & permissions')) //If user has this //permission
    {
            return $next($request);
        }

        if ($request->is('posts/create'))//If user is creating a post
         {
            if (!Auth::user()->hasPermissionTo('Create Post'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('posts/*/edit')) //If user is editing a post
         {
            if (!Auth::user()->hasPermissionTo('Edit Post')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('questions/create'))//If user is creating a post
         {
            if (!Auth::user()->hasPermissionTo('Create Questions'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('questions'))//If user is creating a post
         {
            if (!Auth::user()->hasPermissionTo('Show Questions'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('roles'))//If user is creating a post
         {
            if (!Auth::user()->hasPermissionTo('Show Roles'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('roles/create'))//If user is creating a post
         {
            if (!Auth::user()->hasPermissionTo('Create Roles'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('roles/*/edit'))//If user is creating a post
         {
            if (!Auth::user()->hasPermissionTo('Edit Roles'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('permissions'))//If user is creating a post
         {
            if (!Auth::user()->hasPermissionTo('Show permissions'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('permissions/create'))//If user is creating a post
         {
            if (!Auth::user()->hasPermissionTo('Create Permissions'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('permissions/*/edit'))//If user is creating a post
         {
            if (!Auth::user()->hasPermissionTo('Edit Permissions'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

         if ($request->is('lessons'))//If user is creating a post
         {
            if (!Auth::user()->hasPermissionTo('Show Lessons'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('lessons/create'))//If user is creating a post
         {
            if (!Auth::user()->hasPermissionTo('Create Lessons'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('lessons/*/edit')) //If user is editing a post
         {
            if (!Auth::user()->hasPermissionTo('Edit Lessons')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('questions/*/edit')) //If user is editing a post
         {
            if (!Auth::user()->hasPermissionTo('Edit Questions')) {
                abort('401');
            } else {
                return $next($request);
            }
        }


        if ($request->isMethod('Delete')) //If user is deleting a post
         {
            if (!Auth::user()->hasPermissionTo('Delete')) {
                abort('401');
            } 
         else 
         {
                return $next($request);
            }
        }

        return $next($request);
    }
}