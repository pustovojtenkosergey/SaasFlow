<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    @include('components.top-search')

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

{{--        @include('components.navbar.search-dropdown')--}}

        @include('components.navbar.alerts')

{{--        @include('components.navbar.messages')--}}

{{--        <div class="topbar-divider d-none d-sm-block"></div>--}}

{{--        @include('components.navbar.profile')--}}

    </ul>


</nav>
<!-- End of Topbar -->
