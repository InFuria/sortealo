<div class="sticky-top shadow-lg border-top" style="background-color: #1e3d59;">
    <div class="d-flex flex-sm-column flex-row flex-nowrap align-items-center sticky-top" style="background-color: #1e3d59;">
        <ul class="nav nav-pills nav-flush flex-sm-column flex-row flex-nowrap mb-auto mx-auto text-center align-items-center">
            <li class="nav-item">
                <a href="{{ route('panel.index') }}" class="nav-link p-3 py-5 {{ \Route::currentRouteName() == 'panel.index' ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Inicio">
                    <i class="fas fa-tachometer-alt fa-2x" title="Inicio"></i>
                </a>
            </li>
            @if(Auth::user()->role_id !== 2)
            <li class="nav-item sidebar-link">
                <a href="{{ route('users.index') }}" class="nav-link p-3 py-5 {{ \Route::currentRouteName() == 'users.index' ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Usuarios">
                    <i class="fas fa-users fa-2x" title="Usuarios"></i>
                </a>
            </li>
            @endif
            @if(Auth::user()->role_id !== 2)
            <li class="nav-item sidebar-link">
                <a href="{{ route('companies.index') }}" class="nav-link p-3 py-5 {{ \Route::currentRouteName() == 'companies.index' ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Empresas">
                    <i class="far fa-building fa-2x" title="Empresas"></i>
                </a>
            </li>
            @endif
            <li class="nav-item sidebar-link">
                <a href="{{ route('raffles.index') }}" class="nav-link p-3 py-5 {{ \Route::currentRouteName() == 'raffles.index' ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Sorteos">
                    <i class="fas fa-award fa-2x" title="Sorteos"></i>
                </a>
            </li>
            @if(Auth::user()->role_id !== 2)
            <li class="nav-item sidebar-link">
                <a href="{{ route('faqs.manage') }}" class="nav-link p-3 py-5 {{ \Route::currentRouteName() == 'faqs.manage' ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Preguntas Frecuentes">
                    <i class="fas fa-question fa-2x" title="Preguntas Frecuentes"></i>
                </a>
            </li>
            @endif
            @if(Auth::user()->role_id !== 2)
            <li class="nav-item sidebar-link">
                <a href="{{ route('support.index') }}" class="nav-link p-3 py-5 {{ \Route::currentRouteName() == 'support.index' ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Soporte">
                    <i class="fas fa-ticket-alt fa-2x" title="Soporte"></i>
                </a>
            </li>
            @endif
            @if(Auth::user()->role_id == 2)
            <li class="nav-item sidebar-link">
                <a href="{{ route('users.profile', ['user' => Auth::user()->id]) }}" class="nav-link p-3 py-5 {{ \Route::currentRouteName() == 'users.profile' ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Perfil personal">
                    <i class="fas fa-user-alt fa-2x" title="Perfil personal"></i>
                </a>
            </li>
            @endif
            <li class="nav-item sidebar-link">
                <a href="{{ route('reports.index') }}" class="nav-link p-3 py-5 {{ \Route::currentRouteName() == 'reports.index' ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Reportes">
                    <i class="fas fa-file-alt fa-2x" title="Reportes"></i>
                </a>
            </li>
        </ul>
    </div>
</div>