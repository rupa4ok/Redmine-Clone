<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStatusRequest;
use App\TaskStatus;
use Dotenv\Validator;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
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
        $statuses = TaskStatus::paginate(12);
        return view('statuses.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskStatusRequest $request)
    {
        $taskStatus = new TaskStatus($request->all());
        $taskStatus->save();
        session()->flash('notifications', 'Task Status Created');
        return redirect(route('statuses.index'));
    }

    public function show(TaskStatus $status)
    {
        return view('statuses.show', compact('status'));
    }

    public function edit(TaskStatus $status)
    {
        return view('statuses.edit', compact('status'));
    }

    public function update(TaskStatusRequest $request, TaskStatus $status)
    {
        $status->update($request->all());
        session()->flash('notifications', 'Task Status Updated');
        return redirect(route('statuses.index'));
    }

    public function destroy(TaskStatus $status)
    {
        $status->delete();
        session()->flash('notifications', 'Task Status deleted');
        return redirect(route('statuses.index'));
    }
}
