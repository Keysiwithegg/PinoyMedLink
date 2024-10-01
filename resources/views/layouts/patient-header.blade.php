<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">{{ config('app.name', 'Laravel') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ Request::is('patient.index') ? 'active' : '' }}">
            <a href="{{route('patient.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Doctor Section -->

        <!-- Patients Section -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">My Records</span></li>
        <li class="menu-item {{ Request::routeIs('patient.record.index') ? 'active' : '' }}">
            <a href="{{ route('patient.record.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-folder"></i>
                <div data-i18n="Patient Records">Patient Records</div>
            </a>
        </li>
        <li class="menu-item {{ Request::routeIs('patient.prescription.index') ? 'active' : '' }}">
            <a href="{{ route('patient.prescription.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-notepad"></i>
                <div data-i18n="Patient Prescription">Patient Prescription</div>
            </a>
        </li>

        <!-- Relationship Section -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Relationship</span></li>
        <li class="menu-item {{ Request::is('chatify') ? 'active' : '' }}">
            <a href="{{ url('/chatify') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-chat"></i>
                <div data-i18n="Chat">Chat</div>
            </a>
        </li>
    </ul>
</aside>
