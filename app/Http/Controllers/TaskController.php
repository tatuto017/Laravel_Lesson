<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller {
    public function index(int $id) {
        $current_folder = Folder::find($id);

        return view('tasks/index', [
            'folders'           => Folder::all(),
            'current_folder_id' => $current_folder->id,
            'tasks'             => $current_folder->tasks()->get(),
        ]);
    }
}
