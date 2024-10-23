<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class DashboardController extends Controller
{
    public function view() {
        return view('dashboard', [
            'tasks' => Task::all()
        ]);
    }
}
