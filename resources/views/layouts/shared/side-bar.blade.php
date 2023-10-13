<aside class="main-sidebar sidebar-dark-primary ">

    <a href="" class="brand-link">
        <img src="{{ asset('assets/web-images/main-logo-sm.png') }}" alt="AdminLTE Logo" class="brand-image "
            style="opacity: .8">
        <span class="brand-text font-weight-light">APKS</span>
    </a>


    <div class="sidebar">

      {{--    <div class="user-panel mt-2 pb-2 mb-2 d-flex">

           <div class="info text-center">
                <a href="#" class=" text-center ml-4">Nav links</a>
            </div>
        </div>--}}



        <nav class="mt-2">



            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                @if (Auth::user()->is_admin != '1')
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link ">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="fas fa-tools"></i>
                        <p>
                            3rd Party Digging
                            <i class="right fas fa-angle-left"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('third-party-digging.create', app()->getLocale()) }}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/{{app()->getLocale()}}/create-patrolling" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Patrolling</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('third-party-digging.index', app()->getLocale()) }}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Index</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/{{app()->getLocale()}}/map-1" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Map</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/{{app()->getLocale()}}/get-all-work-packages" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SBUM Approval and Deatil</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="/pencawang" class="nav-link ">
                        <i class="fas fa-building"></i>
                        <p>Substation</p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('substation.create', app()->getLocale()) }}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('substation.index', app()->getLocale()) }}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Index</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/{{app()->getLocale()}}/substation-map" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Map</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/feeder-pillar" class="nav-link ">
                        <i class="fas fa-cube"></i>
                        <p>Feeder Pillar</p>
                        <i class="right fas fa-angle-left"></i>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('feeder-pillar.create', app()->getLocale()) }}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('feeder-pillar.index', app()->getLocale()) }}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Index</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/{{app()->getLocale()}}/feeder-pillar-map" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Map</p>
                            </a>
                        </li>
                    </ul>

                </li>

                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="fas fa-bolt"></i>
                        <p>
                            Tiang + Talian VT & VR
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('tiang-talian-vt-and-vr.create', app()->getLocale())}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('tiang-talian-vt-and-vr.index', app()->getLocale())}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Index</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/{{app()->getLocale()}}/tiang-talian-vt-and-vr-map" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Map</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="fas fa-link"></i>
                        <p>
                            Link Box Pelbagai Voltan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('link-box-pelbagai-voltan.create', app()->getLocale())}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>create</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('link-box-pelbagai-voltan.index', app()->getLocale())}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Index</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/{{app()->getLocale()}}/link-box-pelbagai-voltan-map" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Map</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="fas fa-road"></i>
                        <p>
                            Cable Bridge
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('cable-bridge.create', app()->getLocale())}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('cable-bridge.index', app()->getLocale())}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Index</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/{{app()->getLocale()}}/cable-bridge-map" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Map</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="fas fa-road"></i>
                        <p>
                            PO
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('po.create', app()->getLocale())}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('po.index', app()->getLocale())}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Index</p>
                            </a>
                        </li>
                    </ul>
                </li>


{{--
                <li class="nav-item">
                    <a href="/map-2" class="nav-link ">
                        <i class="fa fa-map"></i>
                        <p>Map</p>
                    </a>
                </li> --}}


                @else
                <li class="nav-item">
                    <a href="{{route('team.index', app()->getLocale())}}" class="nav-link ">
                        <i class="fa fa-map"></i>
                        <p>Team</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('team-users.index', app()->getLocale())}}" class="nav-link ">
                        <i class="fa fa-user"></i>
                        <p>Users</p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>



    </div>

</aside>
<style>
    .nav-link p {
        color: #818896 !important;
    }

    .nav-item:hover .nav-link,
    .nav-item:hover .nav-link>p {
        color: #16c7ff !important;
    }

    nav .active {
        background-color: rgb(99 99 99 / 46%) !important;
    }
</style>
