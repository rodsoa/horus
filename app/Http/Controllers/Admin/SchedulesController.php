<?php

namespace Horus\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Horus\Http\Controllers\Controller;

use Horus\Models\Schedule;

class SchedulesController extends Controller
{
    public function index () {
        $schedules = Schedule::orderBy('id', 'desc')->get();
        return view('admin.schedules.index',['schedules' => $schedules]);
    }

    public function new () {
        return view('admin.schedules.new');
    }

    public function add (Request $request) {
        
    }
}
