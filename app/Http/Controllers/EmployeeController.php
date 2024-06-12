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
        'users_id' => 'required|exists:users,id',
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'document_number' => [
            'required',
            'string',
            'max:255',
            function ($attribute, $value, $fail) {
                // Normalizar el número de documento para comparar con la base de datos
                $normalizedValue = preg_replace('/\s+/', '', $value);

                // Verificar si ya existe un empleado con este número de documento
                $existingEmployee = Employee::where('document_number', $normalizedValue)->exists();

                // Si ya existe un empleado con este número de documento, fallar la validación
                if ($existingEmployee) {
                    $fail('El número de documento ya está registrado.');
                }
            },
        ],
        'gender' => 'required|string|max:10',
        'civil_status' => 'required|string|max:255',
        'eps' => 'required|string|max:255',
        'phone' => [
            'required',
            'string',
            'max:10',
            'unique:employees,phone',
            function ($attribute, $value, $fail) {
                // Normalizar el número de teléfono para comparar con la base de datos
                $normalizedValue = preg_replace('/\s+/', '', $value);

                // Verificar si ya existe un empleado con este número de teléfono
                $existingEmployee = Employee::where('phone', $normalizedValue)->exists();

                // Si ya existe un empleado con este número de teléfono, fallar la validación
                if ($existingEmployee) {
                    $fail('El número de teléfono ya está registrado.');
                }
            },
        ],
        'children' => 'required|integer',
        'home' => 'required|string|max:255',
        'routes_id' => 'required|exists:routes,id',
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

    // Crear el empleado con los datos validados
    $employee = new Employee($request->validated());
    $employee->save();

    return redirect()->route('employee.index')->with('success', 'Empleado Creado con Exito.');
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
        $request->validate([
            'users_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'document_number' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($employee) {
                    // Normalizar el número de documento para comparar con la base de datos
                    $normalizedValue = preg_replace('/\s+/', '', $value);

                    // Verificar si ya existe otro empleado con este número de documento
                    $existingEmployee = Employee::where('id', '!=', $employee->id)
                        ->where('document_number', $normalizedValue)
                        ->exists();

                    // Si ya existe otro empleado con este número de documento, fallar la validación
                    if ($existingEmployee) {
                        $fail('El número de documento ya está registrado.');
                    }
                },
            ],
            'gender' => 'required|string|max:10',
            'civil_status' => 'required|string|max:255',
            'eps' => 'required|string|max:255',
            'phone' => [
                'required',
                'string',
                'max:10',
                function ($attribute, $value, $fail) use ($employee) {
                    // Verificar si ya existe otro empleado con este número de teléfono
                    $existingEmployee = Employee::where('id', '!=', $employee->id)
                        ->where('phone', $value)
                        ->exists();

                    // Si ya existe otro empleado con este número de teléfono, fallar la validación
                    if ($existingEmployee) {
                        $fail('El número de teléfono ya está registrado.');
                    }
                },
            ],
            'children' => 'required|integer',
            'home' => 'required|string|max:255',
            'routes_id' => 'required|exists:routes,id',
        ]);

        // Actualizar el empleado con los datos validados
        $employee->update($request->validated());

        return redirect()->route('employee.index')->with('success', 'Empleado actualizado con éxito.');
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
