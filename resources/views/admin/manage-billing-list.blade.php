@include('admin.includes.header')

<body>
    <nav class="navbar navbar-light navbar-expand-md clean-navbar">
        <div class="container-fluid"><a class="navbar-brand logo" href="#" style="font-weight: bold;"><img
                    width="50px" height="50px" src="{{ url('img/UnifastLogo.png') }}">&nbsp;FHE ABS</a><button
                data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle
                    navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('managebillinglist') }}">Manage
                            Billing</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('manageuserslist') }}">Manage Users</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="nav-item dropdown"><a aria-expanded="false" data-toggle="dropdown" class="nav-link"
                                href="#">Carlo molina&nbsp;</a>
                            <div class="dropdown-menu"><a class="dropdown-item navbar-dropdown" data-toggle="modal"
                                    data-target="#modal_profile" href="#"><i class="fas fa-user"></i>&nbsp;
                                    &nbsp;Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"><i
                                        class="fas fa-sign-out-alt"></i>
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="page faq-page">
        <section class="clean-block clean-faq dark">
            <div class="container-fluid">
                <div class="block-heading">
                    <h4 class="text-left text-info">MANAGE BILLING</h4>
                </div>
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between align-items-center align-content-center py-3">
                        <h6 class="font-weight-bold m-0">List of Billings</h6>
                        <div role="group" class="btn-group btn-group-sm"><button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#mod_open_billing"><i class="fas fa-plus"></i> Open New Billing</button></div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table mt-2" id="tbl_billing_list_admin" role="grid"
                            aria-describedby="dataTable_info">
                            <!---Billing List Here--->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @include('admin.includes.manage-billing-list-modal')
    @include('admin.includes.footer')
    <script src="{{url('admin\js\billinglist.js')}}"></script>
</body>

</html>