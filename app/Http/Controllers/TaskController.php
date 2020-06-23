<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TasksRequest;
use App\Http\Requests\CreateTask;

class TaskController extends Controller {
    public function index(TasksRequest $request) {
        $current_folder = Folder::find($request->id);

        return view('tasks/index', [
            'folders'           => Folder::all(),
            'current_folder_id' => $current_folder->id,
            'tasks'             => $current_folder->tasks()->get(),
        ]);
    }

    public function showCreateForm(TasksRequest $request) {
        return view('tasks/create', [ 'folder_id' => $request->id ]);
    }

    public function create(TasksRequest $urlReqest, CreateTask $fromRequest) {
        $current_folder = Folder::find($urlReqest->id);

        $task = new Task();
        $task->title    = $fromRequest->title;
        $task->due_date = $fromRequest->due_date;

        $current_folder->tasks()->save($task);

        return redirect()->route('tasks.index', [ 'id' => $current_folder->id ]);
    }
}
