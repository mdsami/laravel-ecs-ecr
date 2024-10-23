<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function insert() {
        $item_name = request()->get('item', 'Empty');

        $task = new Task();
        $task->name = $item_name;
        $task->save();

        return view('welcome');
    }

    public function delete($id) {
        $to_delete = Task::where('id', $id)->firstOrFail();
        $to_delete->delete();

        return view('welcome');
    }
}
