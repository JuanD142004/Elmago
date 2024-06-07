<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use App\Models\Route;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::paginate();

        return view('employee.index', compact('employees'))
            ->with('i', (request()->input('page', 1) - 1) * $employees->perPage());
    }

    public function create()
    {
        $employee = new Employee();
        $users = User::all(); // Obtener todos los usuarios con sus datos
        $routes = Route::pluck('route_name', 'id');
        

        return view('employee.create', compact('employee', 'users', 'routes'));
    }

    public function store(Request $request)
    {
        


    $request->validate([
        // Aquí van tus reglas de validación para los campos del formulario
    ]);

    // Obtener el correo electrónico del formulario
    $email = $request->input('user_email');

    // Verificar si ya existe un empleado con este correo electrónico
    $existingEmployee = Employee::whereHas('user', function ($query) use ($email) {
        $query->where('email', $email);
    })->exists();

    if ($existingEmployee) {
        // Si el empleado ya existe, redirigir de vuelta al formulario con un mensaje de error
        return redirect()->back()->withErrors(['user_email' => 'El empleado ya está registrado.'])->withInput();
    }
    $validatedData = $request->validate([
        'users_id' => 'required|exists:users,id',
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'document_number' => 'required|string|max:255',
        'gender' => 'required|string|max:10',
        'civil_status' => 'required|string|max:255',
        'eps' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'children' => 'required|integer',
        'home' => 'required|string|max:255',
        'routes_id' => 'required|exists:routes,id',
    ]);

    $employee = new Employee($validatedData);
    $employee->save();

    return redirect()->route('employee.index')->with('success', 'Empleado Creado con Exito.');
    }
    public function show($id)
    {
        $employee = Employee::find($id);

        return view('employee.show', compact('employee'));
    }

    public function edit($id)
    {
        $employee = Employee::find($id);
        $users = User::all(); // Obtener todos los usuarios con sus datos
        $routes = Route::pluck('route_name', 'id');

        return view('employee.edit', compact('employee', 'users', 'routes'));
    }

    public function update(Request $request, Employee $employee)
    {
        request()->validate(Employee::$rules);

        $employee->update($request->all());

        return redirect()->route('employee.index')
            ->with('success', 'Empleado actualizado con éxito.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->enabled = $request->input('status');
        $employee->save();

        $action = $employee->enabled ? 'habilitado' : 'inhabilitado';

        return redirect()->back()->with('success', "El Empleado ha sido $action correctamente.");
    }

    public function destroy($id)
    {
        Employee::find($id)->delete();

        return redirect()->route('employee.index')
            ->with('success', 'Employee deleted successfully.');
    }
}
