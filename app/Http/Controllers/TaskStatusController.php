<?php

namespace App\Http\Controllers;

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
        return view('statuses.index', ['statuses' => $statuses]);
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:task_statuses|min:3|max:255'
        ]);
        $created = TaskStatus::create(['name' => $request->input('name')]);
        $created ? session()->flash('notifications', 'Task Status Created') : session()->flash('error', 'error');
        return redirect(route('statuses.index'));
    }

    public function show($id)
    {
        $taskStatus = TaskStatus::find($id);
        return view('statuses.show', ['taskStatus' => $taskStatus]);
    }

    public function edit($id)
    {
        $taskStatus = TaskStatus::find($id);
        return view('statuses.edit', compact('taskStatus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:task_statuses|min:3|max:255'
        ]);
        $updated = TaskStatus::find($id)->update($request->all());
        $updated ? session()->flash('notifications', 'Task Status Updated') : session()->flash('error', 'error');
        return redirect(route('statuses.index'));
    }

    public function destroy($id)
    {
        $deleted = TaskStatus::find($id)->delete();
        $deleted ? session()->flash('notifications', 'Task Status deleted') : session()->flash('error', 'error');
        return redirect(route('statuses.index'));
    }
}
