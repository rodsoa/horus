<?php

namespace Horus\Http\Controllers;

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
                                   ->orWhere('category', 'like', '%'.$request->input('search').'%')
                                   ->orderBy('id', 'desc')->paginate(7);
            
            if ( count($users) )                       
                return view('users.index', [ 'users' => $users ]);
        }
        
        $users = User::orderBy('id', 'desc')->paginate(7);

        return view('users.index', [ 'users' => $users ]);
    }

    public function view ($id) {
        $user = User::findOrFail($id);
        return view('users.view', ['user' => $user]);
    }

    public function edit ($id) {
        $user = User::findOrFail($id);
        return view('users.edit', ['user' => $user]);
    }

    public function update (Request $request, $id) {
        $user = User::findOrFail($id);
        
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->category = $request->input('category');
        $user->password = bcrypt($request->input('password'));

        if ( $user->save() ) {
            return redirect()->action('UsersController@index')->with([
                'status' => 'Usuário atualizado com sucesso!',
                'type' => 'success'
            ]);
        } else {
            return redirect()->action('UsersController@new')->with([
                'status' => 'Ocorreu algum erro. Tente novamente',
                'type' => 'error'
            ]);
        }
    }

    public function new () {
        return view('users.new');
    }

    public function add (Request $request) {
        $user = new User( $request->all() );
        $user->password = bcrypt( $user->password );

        if ( $user->save() ) {
            return redirect()->action('UsersController@index')->with([
                'status' => 'Usuário criado com sucesso!',
                'type' => 'success'
            ]);
        } else {
            return redirect()->action('UsersController@new')->with([
                'status' => 'Ocorreu algum erro. Tente novamente',
                'type' => 'error'
            ]);
        }
    }

    public function delete($id) {       
        $user = User::findOrFail($id);
        
        if( $user->employee ) {
            return redirect()->action('UsersController@index')->with([
                'status' => 'Usuário correspondente a um agente. Por favor, delete o agente antes.',
                'type' => 'error'
            ]);
        }else{
            $user->delete();
            return redirect()->action('UsersController@index')->with([
                    'status' => 'Usuário deletado sucesso!',
                    'type' => 'success'
            ]);
        }
    }
}
