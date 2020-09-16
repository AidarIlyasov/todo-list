<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    private $user = null;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function setBackground(Request $request)
    {
        dump($request->user());
        dd($request->image);
    }
}
