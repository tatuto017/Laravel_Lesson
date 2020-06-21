<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TasksRequest;

class TaskController extends Controller {
    public function index(TasksRequest $request) {
        $current_folder = Folder::find($request->id);

        return view('tasks/index', [
            'folders'           => Folder::all(),
            'current_folder_id' => $current_folder->id,
            'tasks'             => $current_folder->tasks()->get(),
        ]);
    }
}
