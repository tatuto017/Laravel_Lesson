<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\FolderRequest;
use App\Http\Requests\CreateTask;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\EditTask;


class TaskController extends Controller {
    public function index(FolderRequest $request) {
        $current_folder = Folder::find($request->id);

        return view('tasks/index', [
            'folders'           => Folder::all(),
            'current_folder_id' => $current_folder->id,
            'tasks'             => $current_folder->tasks()->get(),
        ]);
    }

    public function showCreateForm(FolderRequest $request) {
        return view('tasks/create', [ 'folder_id' => $request->id ]);
    }

    public function create(FolderRequest $urlReqest, CreateTask $fromRequest) {
        $current_folder = Folder::find($urlReqest->id);

        $task = new Task();
        $task->title    = $fromRequest->title;
        $task->due_date = $fromRequest->due_date;

        $current_folder->tasks()->save($task);

        return redirect()->route('tasks.index', [ 'id' => $current_folder->id ]);
    }

    public function showEditForm(TaskRequest $request) {
        return view('tasks/edit', [ 'task' => Task::find($request->task_id) ]);
    }

    public function edit(TaskRequest $urlRequest, EditTask $formRequest) {
        $task = Task::find($urlRequest->task_id);

        $task->title    = $formRequest->title;
        $task->status   = $formRequest->status;
        $task->due_date = $formRequest->due_date;
        $task->save();

        return redirect()->route('tasks.index', [ 'id' => $task->folder_id ]);
    }
}
