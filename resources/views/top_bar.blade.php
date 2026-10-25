<div class="row mb-4">
    <div class="col d-flex justify-content-between align-items-center bg-light p-3 rounded shadow-sm">
        
        <div>
            <a href="{{ route('dashboard') }}" class="text-decoration-none text-dark fw-bold fs-4">
                <i class="fa-solid text-primary me-2"></i>Login Social
            </a>
        </div>

        <div>
            @if (session()->has('user'))
                <span class="me-3 text-secondary">
                    <i class="fa-regular fa-user me-1"></i> Olá, <strong>{{ session('user')['username'] ?? session('user')['name'] ?? 'Usuário' }}</strong>
                </span>

                <a href="{{ route('logout') }}" class="btn btn-outline-danger btn-sm">
                    <i class="fa-solid fa-right-from-bracket me-1"></i> Sair
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm me-1">
                    <i class="fa-solid fa-right-to-bracket me-1"></i> Entrar
                </a>
                <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-user-plus me-1"></i> Registrar
                </a>
            @endif
        </div>

    </div>
</div>