<nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
    <div class="container-fluid d-flex flex-column p-0">
        <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0"
            data-bs-hover-animate="jello" href="#">
            <div class="sidebar-brand-icon"><img src="{{ url('img\UnifastLogo.png') }}" width="50px" height="50px"></div>
            <div class="sidebar-brand-text mx-3"><span>FHE Portal</span></div>
        </a>
        <hr class="sidebar-divider my-0">
        <ul class="nav navbar-nav text-light" id="accordionSidebar">
            <li class="nav-item" role="presentation"><a class="nav-link" href="{{ route('dashboard') }}"><i
                        class="fas fa-home"></i><span>Home</span></a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" href="{{ route('billings') }}"><i
                        class="fas fa-users"></i><span>FHE Billing</span></a></li>
        </ul>
        <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle"
                type="button"></button></div>
    </div>
</nav>
