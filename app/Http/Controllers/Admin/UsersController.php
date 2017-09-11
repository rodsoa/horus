<?php

namespace Horus\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Horus\Http\Controllers\Controller;

use Horus\User;

class UsersController extends Controller
{
    
    public function index (Request $request) {
        // Realizando filtro
        if ($request->input('search')) {
            $users= User::where('name', 'like','%'.$request->input('search').'%')
                                   ->orWhere('email', 'like','%'.$request->input('search').'%')
                                   ->orderBy('id', 'desc')->paginate(7);
            
            if ( count($users) )                       
                return view('admin.users.index', [ 'users' => $users ]);
        }
        
        $users = User::orderBy('id', 'desc')->paginate(7);

        return view('admin.users.index', [ 'users' => $users ]);
    }

    public function view ($id) {
        $user = User::findOrFail($id);
        return view('admin.users.view', ['user' => $user]);
    }

    public function edit ($id) {
        $user = User::findOrFail($id);
        return view('admin.users.edit', ['user' => $user]);
    }

    public function update (Request $request, $id) {
        $user = User::findOrFail($id);
        
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        if ( $user->save() ) {
            return redirect()->action('Admin\UsersController@index')->with([
                'status' => 'Usuario atualizado com sucesso!',
                'type' => 'success'
            ]);
        } else {
            return redirect()->action('Admin\UsersController@new')->with([
                'status' => 'Ocorreu algum erro. Tente novamente',
                'type' => 'error'
            ]);
        }
    }

    public function new () {
        return view('admin.users.new');
    }

    public function add (Request $request) {
        $user = new User( $request->all() );
        $user->password = bcrypt( $user->password );

        if ( $user->save() ) {
            return redirect()->action('Admin\UsersController@index')->with([
                'status' => 'Usuario criado com sucesso!',
                'type' => 'success'
            ]);
        } else {
            return redirect()->action('Admin\UsersController@new')->with([
                'status' => 'Ocorreu algum erro. Tente novamente',
                'type' => 'error'
            ]);
        }
    }

    public function delete($id) {       
        $user = User::findOrFail($id);

        if ( $user->employee ) {          
            return redirect()->action('Admin\UsersController@index')->with([
                'status' => 'Usuário vinculado a um empregado.',
                'type' => 'error'
            ]);
        } else {
            $user->delete();
            return redirect()->action('Admin\UsersController@index')->with([
                'status' => 'Usuario atualizado apagado sucesso!',
                'type' => 'success'
            ]);
        }
    }
}
