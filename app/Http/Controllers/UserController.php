<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;


/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate();

        return view('user.index', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = new User();
        return view('user.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        // Crea el usuario con los datos validados
        $user = User::create($request->validated());
    
        // Envía el correo de bienvenida al nuevo usuario
        Mail::to($user->email)->send(new WelcomeMail());
    
        // Redirecciona al usuario a la lista de usuarios con un mensaje de éxito
        return redirect()->route('users.index')
            ->with('success', 'User created successfully and welcome email sent.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->validated());

        return redirect()->route('user.index')
            ->with('success', 'User updated successfully');
    }
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean', // Asegura que 'status' sea un valor booleano
        ]);
    
        $user  = User::findOrFail($id);
        $user->enabled = $request->input('status');
        $user->save();
    
        $action = $user->enabled ? 'habilitado' : 'inhabilitado';
    
        return redirect()->route('user.index')->with('success', "El Usuario ha sido $action correctamente.");
    }

    public function destroy($id)
    {
        User::find($id)->delete();

        return redirect()->route('user.index')
            ->with('success', 'User deleted successfully');
    }
}
