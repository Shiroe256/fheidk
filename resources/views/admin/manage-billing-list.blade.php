@include('admin.includes.header')

<body>
    <nav class="navbar navbar-light navbar-expand-md clean-navbar">
        <div class="container-fluid"><a class="navbar-brand logo" href="#" style="font-weight: bold;"><img width="50px" height="50px" src="{{url('img/UnifastLogo.png')}}">&nbsp;FHE ABS</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{route('managebillinglist')}}">Manage Billing</a></li>
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
    <main class="page faq-page">
        <section class="clean-block clean-faq dark">
            <div class="container-fluid">
                <div class="block-heading">
                    <h4 class="text-left text-info">MANAGE BILLING</h4>
                </div>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold m-0">List of Billings</h6>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-lg-3 col-xl-3 mb-2"><label>Academic Year</label><select class="form-control">
                                            <optgroup label="This is a group">
                                                <option value="12" selected="">This is item 1</option>
                                                <option value="13">This is item 2</option>
                                                <option value="14">This is item 3</option>
                                            </optgroup>
                                        </select></div>
                                    <div class="col-lg-3 col-xl-3 mb-2"><label>Semester</label><select class="form-control">
                                            <optgroup label="This is a group">
                                                <option value="12" selected="">This is item 1</option>
                                                <option value="13">This is item 2</option>
                                                <option value="14">This is item 3</option>
                                            </optgroup>
                                        </select></div>
                                    <div class="col-lg-3 col-xl-3 mb-2"><label>Billing Status</label><select class="form-control">
                                            <optgroup label="This is a group">
                                                <option value="12" selected="">This is item 1</option>
                                                <option value="13">This is item 2</option>
                                                <option value="14">This is item 3</option>
                                            </optgroup>
                                        </select></div>
                                    <div class="col align-self-end mb-2"><button class="btn btn-outline-info btn-block border rounded-pill border-info" type="button"><i class="fas fa-search"></i>Search</button></div>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive table-bordered table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table class="table table-bordered my-0" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>REGION</th>
                                        <th>HEI NAME</th>
                                        <th>REFERENCE NO.</th>
                                        <th><strong>DATE OF BILLING</strong><br></th>
                                        <th class="text-right">BENEFICIARIES</th>
                                        <th class="text-right">AMOUNT</th>
                                        <th>STATUS</th>
                                        <th class="text-center">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>I- Ilocos Region</td>
                                        <td>Ilocos Sur Polytechnic College</td>
                                        <td>01-01040-2021-2022-1</td>
                                        <td>2008/11/28<br></td>
                                        <td class="text-right">123,456</td>
                                        <td class="text-right">100,000,000.00</td>
                                        <td><span class="badge badge-pill badge-success billing-status-badge">Paid via LDDAP-ADA<br></span></td>
                                        <td class="text-center"><a class="btn btn-outline-info btn-block btn-sm border rounded-pill" role="button" href="manage-billing-hei-submission-page.php">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>II- Cagayan Valley<br></td>
                                        <td>University of Eastern Pangasinan<br></td>
                                        <td>01-01040-2021-2022-1<br></td>
                                        <td>2008/11/28<br></td>
                                        <td class="text-right">123,456<br></td>
                                        <td class="text-right">10,000,000.00</td>
                                        <td><span class="badge badge-pill badge-primary billing-status-badge">Pre-audit of CHED AFMS<br></span></td>
                                        <td class="text-center"><button class="btn btn-outline-info btn-block btn-sm border rounded-pill" type="button">View</button></td>
                                    </tr>
                                    <tr>
                                        <td>III- Central Luzon<br></td>
                                        <td>Binalatongan Community College<br></td>
                                        <td>01-01040-2021-2022-1<br></td>
                                        <td>2008/11/28<br></td>
                                        <td class="text-right">123,456<br></td>
                                        <td class="text-right">1,000,000.00</td>
                                        <td><span class="badge badge-pill badge-danger billing-status-badge">With Compliance Issues<br></span></td>
                                        <td class="text-center"><button class="btn btn-outline-info btn-block btn-sm border rounded-pill" type="button">View</button></td>
                                    </tr>
                                    <tr>
                                        <td>IV- Calabarzon<br></td>
                                        <td>Gordon College<br></td>
                                        <td>01-01040-2021-2022-1<br></td>
                                        <td>2008/11/28<br></td>
                                        <td class="text-right">123,456<br></td>
                                        <td class="text-right">100,000,00</td>
                                        <td><span class="badge badge-pill badge-warning billing-status-badge">Pre-audit of UniFAST Secretariat<br></span><br></td>
                                        <td class="text-center"><button class="btn btn-outline-info btn-block btn-sm border rounded-pill" type="button">View</button></td>
                                    </tr>
                                    <tr>
                                        <td>V- Bicol Region<br></td>
                                        <td>Limay Polytechnic College<br></td>
                                        <td>01-01040-2021-2022-1<br></td>
                                        <td>2008/11/28<br></td>
                                        <td class="text-right">123,456<br></td>
                                        <td class="text-right">10,000.00</td>
                                        <td><span class="badge badge-pill badge-success billing-status-badge">Paid via LDDAP-ADA<br></span><br></td>
                                        <td class="text-center"><button class="btn btn-outline-info btn-block btn-sm border rounded-pill" type="button">View</button></td>
                                    </tr>
                                    <tr>
                                        <td>VI- Western Visayas<br></td>
                                        <td>Kolehiyo ng Subic<br></td>
                                        <td>01-01040-2021-2022-1<br></td>
                                        <td>2008/11/28<br></td>
                                        <td class="text-right">123,456<br></td>
                                        <td class="text-right">1,000.00</td>
                                        <td><span class="badge badge-pill badge-warning billing-status-badge">Pre-audit of UniFAST Secretariat<br></span><br></td>
                                        <td class="text-center"><button class="btn btn-outline-info btn-block btn-sm border rounded-pill" type="button">View</button></td>
                                    </tr>
                                    <tr>
                                        <td>VII- Central Visayas</td>
                                        <td>Airi Satou</td>
                                        <td>01-01040-2021-2022-1<br></td>
                                        <td>2008/11/28<br></td>
                                        <td class="text-right">123,456<br></td>
                                        <td class="text-right">100.00</td>
                                        <td><span class="badge badge-pill badge-success billing-status-badge">Paid via LDDAP-ADA<br></span><br></td>
                                        <td class="text-center"><button class="btn btn-outline-info btn-block btn-sm border rounded-pill" type="button">View</button></td>
                                    </tr>
                                    <tr>
                                        <td>VIII- Eastern Visayas<br></td>
                                        <td>Eduardo L. Joson Memorial College<br></td>
                                        <td>01-01040-2021-2022-1<br></td>
                                        <td>2008/11/28<br></td>
                                        <td class="text-right">123,456<br></td>
                                        <td class="text-right">10.00</td>
                                        <td><span class="badge badge-pill badge-primary billing-status-badge">Pre-audit of CHED AFMS<br></span><br><span class="badge badge-pill badge-primary billing-status-badge"></span></td>
                                        <td class="text-center"><button class="btn btn-outline-info btn-block btn-sm border rounded-pill" type="button">View</button></td>
                                    </tr>
                                    <tr>
                                        <td>IX- Zamboanga Peninsula<br></td>
                                        <td>Mabalacat City College<br></td>
                                        <td>01-01040-2021-2022-1<br></td>
                                        <td>2008/11/28<br></td>
                                        <td class="text-right">123,456<br></td>
                                        <td class="text-right">1.00</td>
                                        <td><span class="badge badge-pill badge-success billing-status-badge">Paid via LDDAP-ADA<br></span><br></td>
                                        <td class="text-center"><button class="btn btn-outline-info btn-block btn-sm border rounded-pill" type="button">View</button></td>
                                    </tr>
                                    <tr>
                                        <td>X- Cagayan de Oro<br></td>
                                        <td>Polytechnic College of the City of Meycauayan<br></td>
                                        <td>01-01040-2021-2022-1<br></td>
                                        <td>2008/11/28<br></td>
                                        <td class="text-right">123,456<br></td>
                                        <td class="text-right">10.00</td>
                                        <td><span class="badge badge-pill badge-danger billing-status-badge">With Compliance Issues<br></span><br></td>
                                        <td class="text-center"><button class="btn btn-outline-info btn-block btn-sm border rounded-pill" type="button">View</button></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><strong>REGION</strong><br></td>
                                        <td><strong>HEI NAME</strong><br></td>
                                        <td><strong>REFERENCE NO.</strong><br></td>
                                        <td><strong>DATE OF BILLING</strong></td>
                                        <td class="text-right"><strong>BENEFICIARIES</strong></td>
                                        <td class="text-right"><strong>AMOUNT</strong></td>
                                        <td><strong>STATUS</strong></td>
                                        <td class="text-center"><strong>ACTION</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@include('admin.includes.modal')    
@include('admin.includes.footer')