@include('admin.includes.header')

<body>
    <nav class="navbar navbar-light navbar-expand-md clean-navbar">
        <div class="container-fluid"><a class="navbar-brand logo" href="#" style="font-weight: bold;"><img width="50px" height="50px" src="{{url('img/UnifastLogo.png')}}">&nbsp;FHE ABS</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('manageBillingListPage')}}">Manage Billing</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{route('manageuserslist')}}">Manage Users</a></li>
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
                    <h4 class="text-left text-info">MANAGE USERS</h4>
                </div>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold m-0">LIST OF BILLINGS</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-bordered table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table class="table table-bordered my-0" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>REGION</th>
                                        <th>HEI NAME</th>
                                        <th>FOCAL PERSON</th>
                                        <th>CONTACT NO.</th>
                                        <th>EMAIL ADDRESS</th>
                                        <th>STATUS</th>
                                        <th class="text-center">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>I- Ilocos Region</td>
                                        <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/UnifastLogo.png">Ilocos Sur Polytechnic College</td>
                                        <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/UnifastLogo.png">Carlo Molina</td>
                                        <td>09120799371<br></td>
                                        <td><a href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to=someone@example.com" target="_blank">cmolina.unifast@ched.gov.ph</a></td>
                                        <td><span class="text-success"><i class="fas fa-circle"></i>&nbsp;Online</span></td>
                                        <td class="text-center"><a class="btn btn-outline-info btn-block btn-sm border rounded-pill" role="button" href="manage-users-page.php">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>II- Cagayan Valley</td>
                                        <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/UnifastLogo.png">University of Eastern Pangasinan<br></td>
                                        <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/UnifastLogo.png">Carlo Molina<br></td>
                                        <td>09120799371<br></td>
                                        <td><a href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to=someone@example.com" target="_blank">cmolina.unifast@ched.gov.ph</a></td>
                                        <td><span class="text-muted"><i class="fas fa-circle"></i>&nbsp;Last online 2 days ago&nbsp;</span></td>
                                        <td class="text-center"><button class="btn btn-outline-info btn-block btn-sm border rounded-pill" type="button">View</button></td>
                                    </tr>
                                    <tr>
                                        <td>III- Central Luzon</td>
                                        <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/UnifastLogo.png">Binalatongan Community College<br></td>
                                        <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/UnifastLogo.png">Carlo Molina<br></td>
                                        <td>09120799371<br></td>
                                        <td><a href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to=someone@example.com" target="_blank">cmolina.unifast@ched.gov.ph</a><br></td>
                                        <td><span class="text-success"><i class="fas fa-circle"></i>&nbsp;Online</span></td>
                                        <td class="text-center"><button class="btn btn-outline-info btn-block btn-sm border rounded-pill" type="button">View</button></td>
                                    </tr>
                                    <tr>
                                        <td>IV- Calabarzon</td>
                                        <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/UnifastLogo.png">Gordon College<br></td>
                                        <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/UnifastLogo.png">Carlo Molina<br></td>
                                        <td>09120799371<br></td>
                                        <td><a href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to=someone@example.com" target="_blank">cmolina.unifast@ched.gov.ph</a><br></td>
                                        <td><span class="text-muted"><i class="fas fa-circle"></i>&nbsp;Last online 2 days ago&nbsp;</span></td>
                                        <td class="text-center"><button class="btn btn-outline-info btn-block btn-sm border rounded-pill" type="button">View</button></td>
                                    </tr>
                                    <tr>
                                        <td>V- Bicol Region</td>
                                        <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/UnifastLogo.png">Limay Polytechnic College<br></td>
                                        <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/UnifastLogo.png">Carlo Molina<br></td>
                                        <td>09120799371<br></td>
                                        <td><a href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to=someone@example.com" target="_blank">cmolina.unifast@ched.gov.ph</a><br></td>
                                        <td><span class="text-success"><i class="fas fa-circle"></i>&nbsp;Online</span></td>
                                        <td class="text-center"><button class="btn btn-outline-info btn-block btn-sm border rounded-pill" type="button">View</button></td>
                                    </tr>
                                    <tr>
                                        <td>VI- Western Visayas</td>
                                        <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/UnifastLogo.png">Kolehiyo ng Subic<br></td>
                                        <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/UnifastLogo.png">Carlo Molina<br></td>
                                        <td>09120799371<br></td>
                                        <td><a href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to=someone@example.com" target="_blank">cmolina.unifast@ched.gov.ph</a><br></td>
                                        <td><span class="text-muted"><i class="fas fa-circle"></i>&nbsp;Last online 2 days ago&nbsp;</span></td>
                                        <td class="text-center"><button class="btn btn-outline-info btn-block btn-sm border rounded-pill" type="button">View</button></td>
                                    </tr>
                                    <tr>
                                        <td>VII- Central Luzon</td>
                                        <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/UnifastLogo.png">Airi Satou</td>
                                        <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/UnifastLogo.png">Carlo Molina<br></td>
                                        <td>09120799371<br></td>
                                        <td><a href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to=someone@example.com" target="_blank">cmolina.unifast@ched.gov.ph</a></td>
                                        <td><span class="text-success"><i class="fas fa-circle"></i>&nbsp;Online</span></td>
                                        <td class="text-center"><button class="btn btn-outline-info btn-block btn-sm border rounded-pill" type="button">View</button></td>
                                    </tr>
                                    <tr>
                                        <td>VII- Eastern Visayas</td>
                                        <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/UnifastLogo.png">Eduardo L. Joson Memorial College<br></td>
                                        <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/UnifastLogo.png">Carlo Molina<br></td>
                                        <td>09120799371<br></td>
                                        <td><a href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to=someone@example.com" target="_blank">cmolina.unifast@ched.gov.ph</a><br></td>
                                        <td><span class="text-muted"><i class="fas fa-circle"></i>&nbsp;Last online 2 days ago&nbsp;</span></td>
                                        <td class="text-center"><button class="btn btn-outline-info btn-block btn-sm border rounded-pill" type="button">View</button></td>
                                    </tr>
                                    <tr>
                                        <td>IX- Zamboanga Peninsula</td>
                                        <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/UnifastLogo.png">Mabalacat City College<br></td>
                                        <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/UnifastLogo.png">Carlo Molina<br></td>
                                        <td>09120799371<br></td>
                                        <td><a href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to=someone@example.com" target="_blank">cmolina.unifast@ched.gov.ph</a><br></td>
                                        <td><span class="text-success"><i class="fas fa-circle"></i>&nbsp;Online</span></td>
                                        <td class="text-center"><button class="btn btn-outline-info btn-block btn-sm border rounded-pill" type="button">View</button></td>
                                    </tr>
                                    <tr>
                                        <td>X- Cagayan de Oro</td>
                                        <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/UnifastLogo.png">Polytechnic College of the City of Meycauayan<br></td>
                                        <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/UnifastLogo.png">Carlo Molina<br></td>
                                        <td>09120799371<br></td>
                                        <td><a href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to=someone@example.com" target="_blank">cmolina.unifast@ched.gov.ph</a><br></td>
                                        <td><span class="text-muted"><i class="fas fa-circle"></i>&nbsp;Last online 2 days ago&nbsp;</span></td>
                                        <td class="text-center"><button class="btn btn-outline-info btn-block btn-sm border rounded-pill" type="button">View</button></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><strong>REGION</strong><br></td>
                                        <td><strong>HEI NAME</strong><br></td>
                                        <td><strong>FOCAL PERSON</strong><br></td>
                                        <td><strong>CONTACT NO.</strong></td>
                                        <td><strong>EMAIL ADDRESS</strong></td>
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