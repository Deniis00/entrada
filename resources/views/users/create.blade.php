@extends('layouts.layout')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('entradas') }}">Entradas</a></li>
                        <li class="breadcrumb-item active">@lang('Create User')</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>@lang('Create User')</h3>
                </div>
                <div class="card-body">
                    <form id="userQuickForm" class="form-material form-horizontal" action="{{ route('users.store') }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">
                                        <h4>Nombre<b class="ambitious-crimson">*</b></h4>
                                    </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                        </div>

                                        <input
                                            class="form-control ambitious-form-loading @error('name') is-invalid @enderror"
                                            name="name" value="{{ old('name') }}" id="name" type="text"
                                            placeholder="@lang('Type Your Name Here')" autofocus>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {!! $message !!}
                                            </div>
                                        @enderror

                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">
                                        <h4>Usuario<b class="ambitious-crimson">*</b></h4>
                                    </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input
                                            class="form-control ambitious-form-loading @error('user') is-invalid @enderror"
                                            name="user" value="{{ old('user') }}" id="user" type="text"
                                            placeholder="@lang('Type Your User Here')">
                                        @error('user')
                                            <div class="invalid-feedback">
                                                {!! $message !!}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">
                                        <h4>Correo</h4>
                                    </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-at"></i></span>
                                        </div>
                                        
                                        <input
                                            class="form-control ambitious-form-loading @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" id="email" type="email"
                                            placeholder="@lang('Type Your Email Here')">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {!! $message !!}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">
                                        <h4>@lang('Role')</h4>
                                    </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                        </div>
                                        <select
                                            class="form-control ambitious-form-loading @error('roles') is-invalid @enderror"
                                            name="roles" id="roles">
                                            @foreach ($roles as $key => $role)
                                                <option value="{{ $role->id }}"
                                                    {{ old('roles', 'default') === $role->id ? 'selected' : ($role->name == 'User' ? 'selected' : '') }}>
                                                    {{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('roles')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>

                        <br><br>
                        <div class="form-group row justify-content-center">

                            <div>
                                <input type="submit" value="Guardar" class="btn btn-outline btn-info btn-lg" />
                                <a href="{{ route('entradas') }}" class="btn btn-outline btn-warning btn-lg">Salir</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
