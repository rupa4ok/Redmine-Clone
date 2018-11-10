<?php

namespace App\Http\Controllers;

use App\Task;
use App\TaskStatus;
use App\User;
use Illuminate\Http\Request;
use TYPO3\CMS\Reports\Status;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::paginate(12);

        return view('tasks.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = TaskStatus::all('id', 'name');
        $users = User::all('id', 'name');
        return view('tasks.create', ['statuses' => $statuses, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|min:3',
            'description' => 'required|min:3',
            'status_id' => 'required',
            'executor_id' => 'required'
        ]);
        $taskStatus = TaskStatus::find($request->input('status_id'));
        $user = auth()->user();
        $task = $user->tasks()->create([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);
        $task->status()->associate($taskStatus)->executor()->associate($request->input('executor_id'))->save();
        $task->syncTags($request->input('tags'));
        $task ? session()->flash('notifications', 'Task Created') : session()->flash('error', 'error');
        return redirect(route('tasks.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $status = $task->status()->get(['name'])->first();
        $executor = $task->executor()->get(['name', 'email'])->first();
        $tags = $task->tags()->get();
        return view('tasks.show', ['task' => $task,
            'status' => $status,
            'executor' => $executor,
            'tags' => $tags]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $status = $task->status()->get(['name', 'id'])->first();
        $executor = $task->executor()->get(['name', 'email', 'id'])->first();
        $freeStatuses = TaskStatus::except($status->id)->get(['name', 'id']);
        $freeUsers = User::except($executor->id)->get(['name', 'email', 'id']);
        return view('tasks.edit', [
            'task' => $task,
            'status' => $status,
            'executor' => $executor,
            'freeStatuses' => $freeStatuses,
            'freeUsers' => $freeUsers
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required|max:255|min:3',
            'description' => 'required|min:3',
            'status_id' => 'required',
            'executor_id' => 'required'
        ]);
        $taskStatus = TaskStatus::find($request->input('status_id'));
        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $updated = $task->status()->associate($taskStatus)
            ->executor()->associate($request->input('executor_id'))
            ->save();
        $updated ? session()->flash('notifications', 'Task Updated') : session()->flash('error', 'error');
        return redirect(route('tasks.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
