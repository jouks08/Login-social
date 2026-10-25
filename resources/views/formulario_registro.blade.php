@extends('layouts.main_layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card p-4 shadow-sm">

                <div class="text-center mb-4">
                    <h3 class="text-primary fw-bold">Criar Conta</h3>
                    <p class="text-secondary small">Preencha os dados abaixo para se cadastrar</p>
                </div>

                @if (session('register_error'))
                <div class="alert alert-danger text-center p-2">
                    {{ session('register_error') }}
                </div>
                @endif

                <form action="{{ route('register.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="text_name" class="form-label">Nome</label>
                        <input type="text"
                            name="text_name"
                            id="text_name"
                            class="form-control @error('text_name') is-invalid @enderror"
                            value="{{ old('text_name') }}"
                            required>
                        @error('text_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="text_username" class="form-label">E-mail</label>
                        <input type="email"
                            name="text_username"
                            id="text_username"
                            class="form-control @error('text_username') is-invalid @enderror"
                            value="{{ old('text_username') }}"
                            required>
                        @error('text_username')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="text_password" class="form-label">Senha</label>
                        <input type="password"
                            name="text_password"
                            id="text_password"
                            class="form-control @error('text_password') is-invalid @enderror"
                            required>
                        @error('text_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="text_password_repeat" class="form-label">Confirmar Senha</label>
                        <input type="password"
                            name="text_password_repeat"
                            id="text_password_repeat"
                            class="form-control @error('text_password_repeat') is-invalid @enderror"
                            required>
                        @error('text_password_repeat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-user-plus me-2"></i> Cadastrar
                        </button>
                    </div>

                </form>                

            </div>
        </div>
    </div>
</div>
@endsection