@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Employee
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="d-flex justify-content-center">
            <div class="col-md-8">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Editar') }} Empleado</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('employee.update', $employee->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('employee.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
