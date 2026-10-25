@extends('layouts.main_layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-8">
            <div class="card p-5">
                <div class="text-center p-3">
                    <h1 class="display-4 fw-bold">Login</h1>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-10 col-12">
                        <form action="{{ route('login.submit') }}" method="POST" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="text_username" class="form-label">E-mail</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark text-info">
                                        <i class="fa-solid fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control bg-dark text-info" name="text_username" value="{{ old('text_username') }}">
                                </div>
                                @error('text_username')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="text_password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark text-info">
                                        <i class="fa-solid fa-key"></i>
                                    </span>
                                    <input type="password" class="form-control bg-dark text-info" name="text_password" value="{{ old('text_password') }}">
                                </div>
                                @error('text_password')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-secondary w-100">
                                    <i class="fa-solid fa-right-to-bracket"></i> &nbsp; LOGIN</button>
                            </div>

                            <div class="d-flex align-items-center my-3">
                                <hr class="flex-grow-1">
                                <span class="px-2 text-muted small">ou entre com</span>
                                <hr class="flex-grow-1">
                            </div>

                            <div class="d-grid gap-2">
                                <a class="btn btn-dark border-secondary" href="{{ route('social.login', ['provider' => 'github']) }}">
                                    <i class="fa-brands fa-github"></i> &nbsp; Login com GitHub
                                </a>

                                <a class="btn btn-light border" href="{{ route('social.login', ['provider' => 'google']) }}">
                                    <i class="fa-brands fa-google text-danger"></i> &nbsp; Login com Google
                                </a>

                                <a class="btn btn-light border" href="{{ route('social.login', ['provider' => 'facebook']) }}">
                                    <i class="fa-brands fa-facebook text-danger"></i> &nbsp; Login com facebook
                                </a>
                            </div>

                        </form>
                        @if(session('login_error'))
                        <div class="alert alert-danger text-center">
                            {{ session('login_error') }}
                        </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection