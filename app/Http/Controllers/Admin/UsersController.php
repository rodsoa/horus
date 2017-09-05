<?php

namespace Horus\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Horus\Http\Controllers\Controller;

use Horus\User;

class UsersController extends Controller
{
    public function index (Request $request) {
        // Realizando filtro
        if ($request->input('search')) {
            $users= User::where('name', 'like','%'.$request->input('search').'%')
                                   ->orWhere('email', 'like','%'.$request->input('search').'%')
                                   ->orderBy('id', 'desc')->get();
            
            if ( count($users) )                       
                return view('admin.users.index', [ 'users' => $users ]);
        }
        
        $users = User::orderBy('id', 'desc')->paginate(10);

        return view('admin.users.index', [ 'users' => $users ]);
    }

    public function view () {
        
    }

    public function edit () {

    }

    public function update () {

    }

    public function new () {

    }

    public function add () {

    }

    public function delete() {

    }
}
