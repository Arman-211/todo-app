<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    /**
     * @param User|null $user
     * @return Response
     */
    public function viewAny(?User $user): Response
    {
        return $user && $user->hasRole('admin')
            ? Response::allow()
            : Response::deny('You do not have permission to view all tasks.');
    }

    /**
     * @param User $user
     * @param Task $task
     * @return Response
     */
    public function view(User $user, Task $task): Response
    {
        return $user->hasRole('admin') || $user->id === $task->user_id
            ? Response::allow()
            : Response::deny('You do not have permission to view this task.');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * @param User $user
     * @param Task $task
     * @return Response
     */
    public function update(User $user, Task $task): Response
    {
        return $user->id === $task->user_id || $user->hasRole('admin')
            ? Response::allow()
            : Response::deny('You do not have permission to update this task.');
    }

    /**
     * @param User $user
     * @param Task $task
     * @return Response
     */
    public function delete(User $user, Task $task): Response
    {
        return $user->id === $task->user_id || $user->hasRole('admin')
            ? Response::allow()
            : Response::deny('You do not have permission to delete this task.');
    }

    /**
     * @param User $user
     * @param Task $task
     * @return Response
     */
    public function restore(User $user, Task $task): Response
    {
        return $user->hasRole('admin')
            ? Response::allow()
            : Response::deny('You do not have permission to restore this task.');
    }

    /**
     * @param User $user
     * @param Task $task
     * @return Response
     */
    public function forceDelete(User $user, Task $task): Response
    {
        return $user->hasRole('admin')
            ? Response::allow()
            : Response::deny('You do not have permission to permanently delete this task.');
    }
}
