<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Task;
use App\TaskStatus;
use App\User;
use Illuminate\Http\Request;

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
    public function index(Request $request)
    {
        $tasks = Task::filter($request->all())->paginate(12);
        $statuses = TaskStatus::get(['name', 'id']);
        $executors = User::get(['name', 'id']);
        $tags = Tag::get(['name', 'id']);
        return view('tasks.index', ['tasks' => $tasks,
            'statuses' => $statuses,
            'executors' => $executors,
            'tags' => $tags]);
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
        $tags = Tag::all('id', 'name');
        return view('tasks.create', ['statuses' => $statuses, 'users' => $users, 'tags' => $tags]);
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
        $task->syncTags($request->input('tags') ?? []);
        session()->flash('notifications', 'Task Created');
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
        $status = $task->status;
        $executor = $task->executor;
        $tags = $task->tags;
        $creator = $task->user;
        return view('tasks.show', ['task' => $task,
            'status' => $status,
            'executor' => $executor,
            'tags' => $tags,
            'creator' => $creator]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $status = $task->status;
        $executor = $task->executor;
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

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect(route('tasks.index'));
    }
}
