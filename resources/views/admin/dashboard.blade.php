@include('admin.includes.header')

<body>
    <nav class="navbar navbar-light navbar-expand-md clean-navbar">
        <div class="container-fluid"><a class="navbar-brand logo" href="#" style="font-weight: bold;"><img width="50px" height="50px" src="{{url('img/UnifastLogo.png')}}">&nbsp;FHE ABS</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active" href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('managebillinglist')}}">Manage Billing</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('manageuserslist')}}">Manage Users</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="nav-item dropdown"><a aria-expanded="false" data-toggle="dropdown" class="nav-link" href="#">Carlo molina&nbsp;</a>
                            <div class="dropdown-menu"><a class="dropdown-item navbar-dropdown" data-toggle="modal" data-target="#modal_profile" href="#"><i class="fas fa-user"></i>&nbsp; &nbsp;Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>
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

    <main>
        <section class="clean-block clean-info dark">
            <div class="container">
                <div class="block-heading">
                    <h4 class="text-left text-info">FREE HIGHER EDUCATION FUNDS</h4>
                </div>
                <div class="row align-items-center mb-3">
                    <div class="col-sm-12 col-lg-4 dashboard-card-col">
                        <div class="card shadow border-left-primary py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col">
                                        <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>TOTAL fund ALLOCATED</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span>P30,000,000.00</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-4 dashboard-card-col">
                        <div class="card shadow border-left-primary py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col">
                                        <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span class="text-success">TOTAL fund utilized</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span>P20,000,000.00</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col dashboard-card-col">
                        <div class="card shadow border-left-primary py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col">
                                        <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span class="text-warning">TOTAL fund remaining</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span>P10,000,000.00</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-12 col-xl-6 dashboard-card-col">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="font-weight-bold m-0">Fund Utilization</h6>
                                <div class="dropdown no-arrow"><button class="btn btn-sm" aria-expanded="false" data-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in">
                                        <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another action</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div><canvas data-bss-chart="{&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Utilized&quot;,&quot;Remaining&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Budget Utilization&quot;,&quot;backgroundColor&quot;:[&quot;#5cb85c&quot;,&quot;#f0ad4e&quot;],&quot;borderColor&quot;:[&quot;rgba(0,0,0,0.1)&quot;,&quot;rgba(0,0,0,0.1)&quot;],&quot;data&quot;:[&quot;20000000&quot;,&quot;1000000&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:true,&quot;legend&quot;:{&quot;display&quot;:true,&quot;position&quot;:&quot;left&quot;},&quot;title&quot;:{&quot;display&quot;:false,&quot;text&quot;:&quot;Budget Utilization&quot;}}}"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-6 dashboard-card-col">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="font-weight-bold m-0">HEI Disbursement Status</h6>
                                <div class="dropdown no-arrow"><button class="btn btn-sm" aria-expanded="false" data-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in">
                                        <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another action</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div><canvas data-bss-chart="{&quot;type&quot;:&quot;bar&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Paid HEIs&quot;,&quot;On-Process&quot;,&quot;No Submission&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;No. of HEIs&quot;,&quot;backgroundColor&quot;:&quot;#4e73df&quot;,&quot;borderColor&quot;:&quot;#4e73df&quot;,&quot;data&quot;:[&quot;123&quot;,&quot;70&quot;,&quot;80&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:true,&quot;legend&quot;:{&quot;display&quot;:false,&quot;position&quot;:&quot;top&quot;},&quot;title&quot;:{&quot;display&quot;:false,&quot;text&quot;:&quot;&quot;},&quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;ticks&quot;:{&quot;beginAtZero&quot;:true}}],&quot;yAxes&quot;:[{&quot;ticks&quot;:{&quot;beginAtZero&quot;:true}}]}}}"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-12 col-xl-12 dashboard-card-col">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="font-weight-bold m-0">Top 10 Paid HEIs</h6>
                                <div class="dropdown no-arrow"><button class="btn btn-sm" aria-expanded="false" data-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in">
                                        <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another action</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div><canvas data-bss-chart="{&quot;type&quot;:&quot;horizontalBar&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Ilocos Sur Polytechnic College&quot;,&quot;Urdaneta City University&quot;,&quot;University of Eastern Pangasinan&quot;,&quot;Binalatongan Community College&quot;,&quot;Gordon College&quot;,&quot;Limay Polytechnic College&quot;,&quot;Kolehiyo ng Subic&quot;,&quot;Eduardo L. Joson Memorial College&quot;,&quot;Mabalacat City College&quot;,&quot;Norzagaray College&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Amount Paid to the HEIs&quot;,&quot;backgroundColor&quot;:&quot;#4e73df&quot;,&quot;borderColor&quot;:&quot;#4e73df&quot;,&quot;data&quot;:[&quot;10000&quot;,&quot;123000&quot;,&quot;150000&quot;,&quot;200000&quot;,&quot;160000&quot;,&quot;20000&quot;,&quot;45000&quot;,&quot;75000&quot;,&quot;80000&quot;,&quot;95000&quot;,&quot;60000&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:true,&quot;legend&quot;:{&quot;display&quot;:false,&quot;position&quot;:&quot;top&quot;},&quot;title&quot;:{&quot;display&quot;:false,&quot;text&quot;:&quot;&quot;},&quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;gridLines&quot;:{&quot;drawBorder&quot;:true,&quot;drawTicks&quot;:true,&quot;drawOnChartArea&quot;:true},&quot;ticks&quot;:{&quot;beginAtZero&quot;:true}}],&quot;yAxes&quot;:[{&quot;gridLines&quot;:{&quot;drawBorder&quot;:true,&quot;drawTicks&quot;:true,&quot;drawOnChartArea&quot;:true},&quot;ticks&quot;:{&quot;beginAtZero&quot;:true}}]}}}"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="clean-block features">
            <div class="container">
                <div class="block-heading">
                    <h4 class="text-left text-info">FREE HIGHER EDUCATION&nbsp;BENEFICIARIES</h4>
                </div>
                <div class="row align-items-center mb-3">
                    <div class="col-md-12 col-lg-3 col-xl-3 dashboard-card-col">
                        <div class="card shadow border-left-primary py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase font-weight-bold text-xs mb-1"><span class="text-primary">BENEFICIARIES</span></div>
                                        <div class="font-weight-bold h5 mb-0"><span>40,000</span></div>
                                    </div>
                                    <div class="col-auto text-muted"><i class="fas fa-user-friends fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-3 col-xl-3 dashboard-card-col">
                        <div class="card shadow border-left-primary py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase font-weight-bold text-xs mb-1"><span class="text-warning">WITH TES/TDP</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span>5,000</span></div>
                                    </div>
                                    <div class="col-auto text-muted"><i class="fas fa-pencil-ruler fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-3 col-xl-3 dashboard-card-col">
                        <div class="card shadow border-left-primary py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase font-weight-bold text-xs mb-1"><span class="text-info">WITH Slp</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span>400</span></div>
                                    </div>
                                    <div class="col-auto text-muted"><i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-3 col-xl-3 dashboard-card-col">
                        <div class="card shadow border-left-primary py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase font-weight-bold text-xs mb-1"><span class="text-success">GRADUATED</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span>7,000</span></div>
                                    </div>
                                    <div class="col-auto text-muted"><i class="fas fa-user-graduate fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center mb-3">
                    <div class="col-xl-6 dashboard-card-col">
                        <div class="card shadow">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="font-weight-bold m-0">Status of Beneficiaries</h6>
                                <div class="dropdown no-arrow"><button class="btn btn-sm" aria-expanded="false" data-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in">
                                        <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another action</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div><canvas data-bss-chart="{&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Enrolled&quot;,&quot;On-LOA&quot;,&quot;Dropped&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Total FHE Beneficiaries&quot;,&quot;backgroundColor&quot;:[&quot;#5cb85c&quot;,&quot;#f0ad4e&quot;,&quot;#d9534f&quot;],&quot;borderColor&quot;:[&quot;rgba(0,0,0,0.1)&quot;,&quot;rgba(0,0,0,0.1)&quot;,&quot;rgba(0,0,0,0.1)&quot;],&quot;data&quot;:[&quot;200000&quot;,&quot;50000&quot;,&quot;30000&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:true,&quot;legend&quot;:{&quot;display&quot;:true,&quot;position&quot;:&quot;left&quot;},&quot;title&quot;:{&quot;display&quot;:false,&quot;text&quot;:&quot;Total FHE Beneficiaries&quot;,&quot;position&quot;:&quot;top&quot;}}}"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 dashboard-card-col">
                        <div class="card shadow">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="font-weight-bold m-0">Total Grantees by Sex</h6>
                                <div class="dropdown no-arrow"><button class="btn btn-sm" aria-expanded="false" data-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in">
                                        <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another action</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div><canvas data-bss-chart="{&quot;type&quot;:&quot;bar&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;1st Semester&quot;,&quot;2nd Semester&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Male&quot;,&quot;backgroundColor&quot;:&quot;#0275d8&quot;,&quot;borderColor&quot;:&quot;#0275d8&quot;,&quot;data&quot;:[&quot;1000&quot;,&quot;900&quot;]},{&quot;label&quot;:&quot;Female&quot;,&quot;backgroundColor&quot;:&quot;#d9534f&quot;,&quot;borderColor&quot;:&quot;#d9534f&quot;,&quot;data&quot;:[&quot;1500&quot;,&quot;1350&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:true,&quot;legend&quot;:{&quot;display&quot;:true,&quot;position&quot;:&quot;left&quot;},&quot;title&quot;:{&quot;display&quot;:false,&quot;text&quot;:&quot;&quot;},&quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;ticks&quot;:{&quot;beginAtZero&quot;:true}}],&quot;yAxes&quot;:[{&quot;ticks&quot;:{&quot;beginAtZero&quot;:true}}]}}}"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-12 col-xl-12 dashboard-card-col">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="font-weight-bold m-0">Top 10 HEIs with Most Beneficiaries</h6>
                                <div class="dropdown no-arrow"><button class="btn btn-sm" aria-expanded="false" data-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in">
                                        <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another action</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div><canvas data-bss-chart="{&quot;type&quot;:&quot;horizontalBar&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Ilocos Sur Polytechnic College&quot;,&quot;Urdaneta City University&quot;,&quot;University of Eastern Pangasinan&quot;,&quot;Binalatongan Community College&quot;,&quot;Gordon College&quot;,&quot;Limay Polytechnic College&quot;,&quot;Kolehiyo ng Subic&quot;,&quot;Eduardo L. Joson Memorial College&quot;,&quot;Mabalacat City College&quot;,&quot;Norzagaray College&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Total No. of Beneficiaries&quot;,&quot;backgroundColor&quot;:&quot;#4e73df&quot;,&quot;borderColor&quot;:&quot;#4e73df&quot;,&quot;data&quot;:[&quot;10000&quot;,&quot;123000&quot;,&quot;150000&quot;,&quot;200000&quot;,&quot;160000&quot;,&quot;20000&quot;,&quot;45000&quot;,&quot;75000&quot;,&quot;80000&quot;,&quot;95000&quot;,&quot;60000&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:true,&quot;legend&quot;:{&quot;display&quot;:false,&quot;position&quot;:&quot;top&quot;},&quot;title&quot;:{&quot;display&quot;:false,&quot;text&quot;:&quot;&quot;},&quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;gridLines&quot;:{&quot;drawBorder&quot;:true,&quot;drawTicks&quot;:true,&quot;drawOnChartArea&quot;:true},&quot;ticks&quot;:{&quot;beginAtZero&quot;:true}}],&quot;yAxes&quot;:[{&quot;gridLines&quot;:{&quot;drawBorder&quot;:true,&quot;drawTicks&quot;:true,&quot;drawOnChartArea&quot;:true},&quot;ticks&quot;:{&quot;beginAtZero&quot;:true}}]}}}"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

{{-- @include('admin.includes.modal') --}}
@include('admin.includes.footer')