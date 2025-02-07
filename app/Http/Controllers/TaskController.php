<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function index(): \Illuminate\Contracts\Foundation\Application|Factory|View|Application
    {
        $tasks =  auth()->user()->hasRole('admin')
            ? Task::all()
            : Task::query()->where('user_id', auth()->id())->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|Application|View|\Illuminate\Contracts\Foundation\Application
     */
    public function create(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Task::query()->create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'new',
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('tasks.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::findOrFail($id);
        return response()->json($task);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Task $task
     * @return Factory|Application|View|\Illuminate\Contracts\Foundation\Application
     * @throws AuthorizationException
     */
    public function edit(Task $task): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('update', $task);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Task $task
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, Task $task): RedirectResponse
    {
        $this->authorize('update', $task);

        $task->update($request->all());

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param Task $task
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Task $task): RedirectResponse
    {
        $this->authorize('delete', $task);
        $task->delete();

        return redirect()->route('tasks.index');
    }

    /**
     * @return Factory|Application|View|\Illuminate\Contracts\Foundation\Application
     */
    public function dashboard(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $user = auth()->user();

        $tasks = $user->hasRole('admin') ? Task::all() : Task::where('user_id', $user->id)->get();

        $totalTasks = $tasks->count();

        $completedTasks = $tasks->where('status', 'done')->count();

        $inProgressTasks = $tasks->where('status', 'in_progress')->count();

        $newTasks = $tasks->where('status', 'new')->count();

        return view('dashboard', compact('totalTasks', 'completedTasks', 'inProgressTasks', 'newTasks'));
    }
}
