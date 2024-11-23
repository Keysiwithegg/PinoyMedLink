<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ url('/home') }}" class="app-brand-link">
            <img src="{{ asset('img/logo-new.png') }}" alt="Artifact Explorer Logo" class="app-brand-logo">
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ Request::is('admin/home') ? 'active' : '' }}">
            <a href="{{route('admin.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Doctor Section -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Doctor</span></li>
        <li class="menu-item {{ Request::is('admin/appointments') ? 'active' : '' }}">
            <a href="{{ route('admin.appointments.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div data-i18n="Appointments">Appointments</div>
            </a>
        </li>

        <!-- Patients Section -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Patients</span></li>

        <li class="menu-item {{ Request::is('admin/patients') ? 'active' : '' }}">
            <a href="{{route('admin.patients.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-plus"></i>
                <div data-i18n="Patient Records">Add Patient</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('admin/doctors') ? 'active' : '' }}">
            <a href="{{route('admin.doctors.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-plus-medical"></i> <!-- Changed to a doctor icon -->
                <div data-i18n="Patient Records">Add Doctor</div>
            </a>
        </li>


        <!-- Relationship Section -->
        <li class="menu-header small text-uppercase"><span cass="menu-header-text">Relationship</span></li>
        <li class="menu-item {{ Request::is('chatify') ? 'active' : '' }}">
            <a href="{{url('/chatify')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-chat"></i>
                <div data-i18n="Chat">Chat</div>
            </a>
        </li>
    </ul>


</aside>
