<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use App\UserRoleMap;
use App\User;
use Log;
class RoleAccess
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
      $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roleId)
    {
        $userId = $this->auth->user()->id;
        $roles = User::find($userId)->UserRoleMap;
        $exists = 0;

        foreach ($roles as $role) {
          if ($role->user_role_id == $roleId) {
            $exists = 1;
          }
        }
        if ($exists == 0) {
          return new RedirectResponse(url('/'));
        }

        return $next($request);
    }
}
