<!-- contenedor-sidebar -->
<!-- Top Bar Start -->
<style>
    .modal-backdrop{
        z-index: 1;
    }
</style>
<div class="topbar">
    <!-- LOGO -->
    @mobile
        <div class="topbar-left" style="margin-bottom: -144px !important;">
            <span class="logo-sm">
                <a href="{{ route('home') }}"><img class="img-fluid p-1" src="{{ asset('assets/images/logo-empresa.png') }}"
                        ></a>
            </span>
        </div>
        @elsenotmobile
        @tablet
            <div class="topbar-left" style="margin-bottom: -144px !important;">
                <span class="logo-sm">
                    <a href="{{ route('home') }}"><img class="img-fluid p-1" src="{{ asset('assets/images/logo-empresa.png') }}"
                            ></a>
                </span>
            </div>
        @elsetablet
            <div class="topbar-left" style="margin-bottom: -144px !important;">
                <span class="logo-light">
                    <a href="{{ route('home') }}"><img class="img-fluid p-4" src="{{ asset('assets/images/logo-empresa.png') }}"
                           ></a>
                    {{-- <i class="mdi mdi-camera-control"></i> La Fabrica --}}
                </span>
            </div>
        @endtablet

    @endmobile

    <nav class="navbar-custom">
        <ul class="navbar-right list-inline float-right mb-0">
            <!-- language-->
            {{-- <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="https://crm.fabricandoeventosjerez.com/assets/images/flags/us_flag.jpg" class="mr-2" height="12" alt="" /> English <span class="mdi mdi-chevron-down"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated language-switch">
                            <a class="dropdown-item" href="#"><img src="https://crm.fabricandoeventosjerez.com/assets/images/flags/french_flag.jpg" alt="" height="16" /><span> French </span></a>
                            <a class="dropdown-item" href="#"><img src="https://crm.fabricandoeventosjerez.com/assets/images/flags/spain_flag.jpg" alt="" height="16" /><span> Spanish </span></a>
                            <a class="dropdown-item" href="#"><img src="https://crm.fabricandoeventosjerez.com/assets/images/flags/russia_flag.jpg" alt="" height="16" /><span> Russian </span></a>
                            <a class="dropdown-item" href="#"><img src="https://crm.fabricandoeventosjerez.com/assets/images/flags/germany_flag.jpg" alt="" height="16" /><span> German </span></a>
                            <a class="dropdown-item" href="#"><img src="https://crm.fabricandoeventosjerez.com/assets/images/flags/italy_flag.jpg" alt="" height="16" /><span> Italian </span></a>
                        </div>
                    </li> --}}

            <!-- full screen -->
            <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                    <i class="mdi mdi-arrow-expand-all noti-icon"></i>
                </a>
            </li>
            <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                <div class="col-1 col-md-1 header_user text-left">
                    <a class="alert-button" data-toggle="modal" data-target="#modalAlertas" style="position:relative; color:white;">
                        <i class="fa-regular fa-bell fa-xl"></i>
                        <span class="badge badge-secondary" id="alertasPendientes"
                            style="position: absolute;
                                        top: -9px;
                                        right: -11px;">{{count($notificaciones)}}</span>
                    </a>
                   
                </div>
            </li>
           



            <li class="dropdown notification-list list-inline-item">
                <div class="dropdown notification-list nav-pro-img">
                    <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="mdi mdi-dots-horizontal-circle-outline noti-icon"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        @if (Auth::user()->role == 1)
                            <a class="dropdown-item" href="{{ route('usuarios.index') }}"><i
                                    class="mdi mdi-user"></i>Gestionar usuarios</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('notes.users') }}"><i
                                    class="mdi mdi-user"></i>Notas</a>
                            <div class="dropdown-divider"></div>
                        @else
                            <a class="dropdown-item" href="{{ route('notes.from', Auth::user()->id) }}"><i
                                    class="mdi mdi-user"></i>Notas</a>
                            <div class="dropdown-divider"></div>
                        @endif
                        {{-- Formulario invisible para que Laravel detecte el cierre de sesión como POST. --}}
                        @auth

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endauth

                        {{-- El mismo enlace, con un evento onclick para que haga submit del formulario y cierre sesión.  --}}
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                class="mdi mdi-power text-danger"></i>Cerrar sesión</a>
                    </div>
                </div>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            {{-- <li class="d-none d-md-inline-block">
                        <form role="search" class="app-search">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" placeholder="Search..">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </li> --}}
        </ul>

    </nav>

    <div class="modal fade" id="modalAlertas" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="form-title">Alertas de hoy:</h3>
                </div>
                <div class="modal-body" tabindex="-1">
                    @livewire('lista-alertas')
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top Bar End -->
