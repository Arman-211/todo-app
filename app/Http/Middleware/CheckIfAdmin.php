<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class CheckIfAdmin
{
    /**
     * Проверка, является ли пользователь администратором.
     *
     * @param  Authenticatable|null  $user
     * @return bool
     */
    private function checkIfUserIsAdmin($user): bool
    {
        if (!$user) {
            Log::warning('Backpack: Попытка входа без пользователя.');
            return false;
        }

        // Используем Spatie hasRole()
        if (!$user->hasRole('admin')) {
            Log::warning("Backpack: У пользователя ID {$user->id} нет роли 'admin'.");
            return false;
        }

        return true;
    }

    /**
     * Ответ на неавторизованный доступ.
     *
     * @param  Request  $request
     * @return Response|RedirectResponse
     */
    private function respondToUnauthorizedRequest($request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            return response(trans('backpack::base.unauthorized'), 401);
        } else {
            return redirect()->guest(backpack_url('login'));
        }
    }

    /**
     * Обработчик входящего запроса.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (backpack_auth()->guest()) {
            Log::warning('Backpack: Неавторизованный доступ (гость).');
            return $this->respondToUnauthorizedRequest($request);
        }

        $user = backpack_user();

        if (!$this->checkIfUserIsAdmin($user)) {
            return $this->respondToUnauthorizedRequest($request);
        }

        return $next($request);
    }
}
