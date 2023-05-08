@include('admin.includes.header')

<body>
    <nav class="navbar navbar-light navbar-expand-md clean-navbar">
        <div class="container-fluid"><a class="navbar-brand logo" href="#" style="font-weight: bold;"><img width="50px" height="50px" src="{{url('img/UnifastLogo.png')}}">&nbsp;FHE ABS</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="{{route('dashboard')}}">Dashboard</a></li>
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
    <main class="page faq-page">
        <section class="clean-block clean-faq dark">
            <div class="container">
                <div class="block-heading">
                    <h4 class="text-left text-info">MANAGE USERS</h4>
                </div> 
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="font-weight-bold m-0">HEI Profile</h6><a class="text-dark" data-toggle="tooltip" data-bss-tooltip="" href="#" title="Edit Information"><i class="far fa-edit"></i></a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-5 text-center mt-1 mb-4"><img class="rounded-circle mb-2" src=" {{url('admin/img/UP-Seal.png')}}" width="200" height="200">
                                        <h6 class="font-weight-bold">Governor Mariano E. Villafuerte Community College</h6>
                                    </div>
                                    <div class="col-lg-7 col-xl-7">
                                        <form>
                                            <div class="form-group">
                                                <div class="form-row">
                                                    <div class="col"><label>HEI UII</label><input class="form-control" type="text"></div>
                                                    <div class="col"><label>HEI Type</label><input class="form-control" type="text"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-row">
                                                    <div class="col"><label>HEI Address</label><input class="form-control" type="text"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-row">
                                                    <div class="col"><label>HEI Email</label><input class="form-control" type="text"></div>
                                                    <div class="col"><label>HEI Contact</label><input class="form-control" type="text"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-row">
                                                    <div class="col"><label>Website</label><input class="form-control" type="text"></div>
                                                </div>
                                            </div>
                                            <div class="form-group d-none">
                                                <div class="form-row">
                                                    <div class="col text-right">
                                                        <div class="btn-group" role="group"><button class="btn btn-outline-danger" type="button">Cancel</button><button class="btn btn-outline-success" type="button">Update</button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="font-weight-bold m-0">President Profile</h6><a class="text-dark" data-toggle="tooltip" data-bss-tooltip="" href="#" title="Edit Information"><i class="far fa-edit"></i></a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-5 text-center mt-1 mb-4"><img class="rounded-circle mb-2" src="{{url('admin/img/29513133_2090719884273325_673072045147924405_n.jpg')}}" width="200" height="200"></div>
                                    <div class="col-lg-7 col-xl-7">
                                        <form>
                                            <div class="form-group">
                                                <div class="form-row">
                                                    <div class="col"><label>Lastname</label><input class="form-control" type="text"></div>
                                                    <div class="col"><label>Firstname</label><input class="form-control" type="text"></div>
                                                    <div class="col"><label>Middlename</label><input class="form-control" type="text"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-row">
                                                    <div class="col"><label>Email</label><input class="form-control" type="text"></div>
                                                    <div class="col"><label>Contact</label><input class="form-control" type="text"></div>
                                                </div>
                                            </div>
                                            <div class="form-group d-none">
                                                <div class="form-row">
                                                    <div class="col text-right">
                                                        <div class="btn-group" role="group"><button class="btn btn-outline-danger" type="button">Cancel</button><button class="btn btn-outline-success" type="button">Update</button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="font-weight-bold m-0">Focal Person Profile</h6><a class="text-dark" data-toggle="tooltip" data-bss-tooltip="" href="#" title="Edit Information"><i class="far fa-edit"></i></a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-5 text-center mt-1 mb-4"><img class="rounded-circle mb-2" src="{{url('admin/img/293228345_5209578979160533_6724701494728557606_n.jpg')}}" width="200" height="200"></div>
                                    <div class="col-lg-7 col-xl-7">
                                        <form>
                                            <div class="form-group">
                                                <div class="form-row">
                                                    <div class="col"><label>Lastname</label><input class="form-control" type="text"></div>
                                                    <div class="col"><label>Firstname</label><input class="form-control" type="text"></div>
                                                    <div class="col"><label>Middlename</label><input class="form-control" type="text"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-row">
                                                    <div class="col"><label>Email</label><input class="form-control" type="text"></div>
                                                    <div class="col"><label>Contact</label><input class="form-control" type="text"></div>
                                                </div>
                                            </div>
                                            <div class="form-group d-none">
                                                <div class="form-row">
                                                    <div class="col text-right">
                                                        <div class="btn-group" role="group"><button class="btn btn-outline-danger" type="button">Cancel</button><button class="btn btn-outline-success" type="button">Update</button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="font-weight-bold m-0">Tuition and Other School Fees</h6><a class="text-dark" data-toggle="modal" data-bss-tooltip="" href="#" title="Upload list of TOSF" data-target="#modal_tosf"><i class="fas fa-upload"></i></a>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-12 col-md-4 col-lg-3 col-xl-4 mb-2"><label>Degree Program</label><select class="form-control">
                                                    <option value="" selected="">-- Select Degree Program--</option>
                                                    <option value="Bachelor of Science in Information and Technology">Bachelor of Science in Information and Technology</option>
                                                    <option value="Bachelor of Elementary Education">Bachelor of Elementary Education</option>
                                                </select></div>
                                            <div class="col-12 col-md-4 col-lg-3 col-xl-3 mb-2"><label>Year Level</label><select class="form-control">
                                                    <option value="undefined" selected="">-- Select Year Level --</option>
                                                    <option value="1st">1st</option>
                                                    <option value="2nd">2nd</option>
                                                    <option value="3rd">3rd</option>
                                                    <option value="4th Year">4th</option>
                                                </select></div>
                                            <div class="col-md-4 col-lg-3 col-xl-3 mb-2"><label>Semester</label><select class="form-control">
                                                    <option value="">-- Select Semester --</option>
                                                    <option value="1st">1st</option>
                                                    <option value="2nd">2nd</option>
                                                </select></div>
                                            <div class="col text-center align-self-end mb-2"><button class="btn btn-outline-info btn-block border rounded-pill border-info" type="button"><i class="fas fa-search"></i>Search</button></div>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-responsive table mt-2" id="tbl_user_page_admin" role="grid" aria-describedby="dataTable_info">
                                    <table class="table table-bordered" id="tbl_tosf">
                                        <thead>
                                            <tr>
                                                <th class="text-left">DEGREE PROGRAM</th>
                                                <th class="text-center">YEAR LEVEL</th>
                                                <th class="text-center">SEMESTER</th>
                                                <th class="text-left">TYPE OF FEE</th>
                                                <th class="text-left">CATEGORY</th>
                                                <th class="text-left">COVERAGE</th>
                                                <th class="text-left">REMARKS</th>
                                                <th class="text-right">AMOUNT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($fees as $fee)
                                            <tr>
                                                <td class="text-left">{{ $fee->course_enrolled }}</td>
                                                <td class="text-center">{{ $fee->year_level }}</td>
                                                <td class="text-center">{{ $fee->semester }}</td>
                                                <td class="text-left">{{ $fee->type_of_fee }}</td>
                                                <td class="text-left">{{ $fee->category }}</td>
                                                <td class="text-left">{{ $fee->coverage }}</td>
                                                <td class="text-left">{{ $fee->is_optional }}</td>
                                                <td class="text-right">{{ $fee->amount }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="font-weight-bold m-0">Audit Trail</h6>
                                <div class="dropdown no-arrow"><button class="btn btn-sm" aria-expanded="false" data-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in">
                                        <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another action</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-12 col-md-12 col-lg-5 col-xl-5 mb-2"><label>From</label><input class="form-control" type="date"></div>
                                            <div class="col-12 col-md-12 col-lg-5 col-xl-5 mb-2"><label>To</label><input class="form-control" type="date"></div>
                                            <div class="col align-self-end mb-2"><button class="btn btn-outline-info btn-block border rounded-pill border-info" type="button"><i class="fas fa-search"></i>Search</button></div>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-responsive table-bordered table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                                    <table class="table table-bordered my-0" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th class="text-left">ACTION TAKEN</th>
                                                <th class="text-left">OLD VALUE</th>
                                                <th class="text-left">NEW VALUE</th>
                                                <th class="text-left">DATE TAKEN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr></tr>
                                            <tr></tr>
                                            <tr>
                                                <td>updated</td>
                                                <td>name: carltzy</td>
                                                <td class="text-left">name:carlo</td>
                                                <td class="text-left">04/15/1997</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
@include('admin.includes.modal')
@include('admin.includes.footer')