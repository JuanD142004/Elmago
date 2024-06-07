@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Departament
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Departament</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('departament.update', $departament->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('departament.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
