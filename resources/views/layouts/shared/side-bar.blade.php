<aside class="main-sidebar sidebar-dark-primary ">

    <a href="" class="brand-link">
        <img src="{{ asset('assets/web-images/main-logo-sm.png') }}" alt="AdminLTE Logo" class="brand-image "
            style="opacity: .8">
        <span class="brand-text font-weight-light">APKS</span>
    </a>


    <div class="sidebar">

        <div class="user-panel mt-2 pb-2 mb-2 d-flex">

            <div class="info text-center">
                <a href="#" class=" text-center ml-4">Nav links</a>
            </div>
        </div>



        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="/get-all-work-packages" class="nav-link ">
                        <i class="fa fa-book"></i>
                        <p>Work Package</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/map-1" class="nav-link ">
                        <i class="fa fa-map"></i>
                        <p>Map</p>
                    </a>
                </li>

            </ul>
        </nav>



    </div>

</aside>
<style>
    .nav-link p {
        color: #818896 !important;
    }

    .nav-item p:hover,
    .nav-item i:hover,
    nav .active i,
    nav .active p {
        color: #16c7ff !important;
    }

    nav .active {
        background-color: rgb(99 99 99 / 46%) !important;
    }
</style>
