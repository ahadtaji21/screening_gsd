<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Auth;
use Session;
use App\Models\User;


class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    //-------------------------------------------------------------------------------------------------------
    //----------------------------- ROLES HINT --------------------------------------------------------------

    /*
     * In Laravel 8, could not find any method to send and custom array of roles in routes.
     * Somehow, string send in routes where middleware class define like below rout define.
        
            Route::get('user_list',[UserController::class, 'index'])
                ->middleware(['auth','roles', 'roles:Administrator:Operator'])
                ->name('user_list');
    
     * Pick middleware array 3rd element and explode it to separate and use it. As did not find any way to
     * send array. Array shift is use to delete the 1st element of array (we need only Administrator and Operator)
                $actions = $request->route()->getAction();
                $newRole = explode(':',$actions['middleware'][3]);
                $newRole2 = array_shift($newRole);
    
     * So now we using Laravel 5 way but it incorporate according to Laravel 8. like below
        
                Route::get('/user_list',array(
                    'uses'=>'App\Http\Controllers\UserController@index',
                    'as' =>'user_list',
                    'middleware' => ['auth','roles'],
                    'roles' => [Administrator, Operator])
                 );*/

    //-------------------------------------------------------------------------------------------------------
    //----------------------------- ROLES HINT --------------------------------------------------------------
    
    
    public function handle($request, Closure $next)
    {

        // Direct access is denied.
        if($request->user() === null) {
            return redirect()->guest('/login');
        }  
        

        $actions = $request->route()->getAction();
        $roles = isset($actions['roles']) ? $actions['roles'] : null;
        $roles = isset($roles) ? $roles : null;
        //dd($role);
        // Get user roles
        $user = User::where('id', '=', $request->user()->id)
                        ->where('is_deleted', '=', '0')
                        ->where('status', '=', '2')
                        ->get();

        if(count($user) <= 0)
        {
            Session::flush();
            flash('Sorry, you are not authorized to access this system!')->error();
            return redirect()->guest('/login');
        }
        else if(in_array($user[0]->user_role_id, $roles) || !$roles)
        {
            return $next($request);
        }
        else if(!in_array($user[0]->user_role_id, $roles))
        {
            flash('Sorry, you are not authorized to perform this action!')->error();
            return redirect()->back();
        }
    }
}
