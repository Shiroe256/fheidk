@include('includes.header');

            <div class="container-fluid">
                <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <h4 class="text-dark mb-0">Dashboard</h4><a class="btn btn-outline-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download"></i>&nbsp;Generate Report</a></div>
                <div class="row">
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-primary py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>fhe beneficiaries</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span>5,000</span></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-user-friends fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-success py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>with tes/tdp</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span>150</span></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-pencil-ruler fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-info py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span class="text-info">with student loan</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span>50</span></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-warning py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>graduated</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span>300</span></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-user-graduate fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-7 col-xl-12">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="text-dark font-weight-bold m-0">Total No. of Enrollees</h6>
                                <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle text-dark border rounded-0 border-light" data-toggle="dropdown" aria-expanded="false" type="button"><i class="fas fa-bars"></i></button>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in"
                                        role="menu">
                                        <p class="text-center dropdown-header">Options:</p><a class="dropdown-item" role="presentation" data-toggle="tooltip" data-bs-tooltip="" href="#" title="Add New Student"><i class="fas fa-plus fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Add student</a>
                                        <a
                                            class="dropdown-item" role="presentation" data-toggle="tooltip" data-bs-tooltip="" href="#" title="Upload List of Student"><i class="fas fa-file-excel fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Upload List</a><a class="dropdown-item" role="presentation" data-toggle="tooltip" data-bs-tooltip="" href="#" title="Download List of Student"><i class="fas fa-file-download fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Download List</a>
                                            <div
                                                class="dropdown-divider"></div><a class="dropdown-item" role="presentation" data-toggle="tooltip" data-bs-tooltip="" href="#" title="Download FHE Template"><i class="fas fa-file-download fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;FHE Template</a></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-area"><canvas data-bs-chart="{&quot;type&quot;:&quot;line&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;2018&quot;,&quot;2019&quot;,&quot;2020&quot;,&quot;2021&quot;,&quot;2022&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Enrollees&quot;,&quot;fill&quot;:true,&quot;data&quot;:[&quot;0&quot;,&quot;10000&quot;,&quot;5000&quot;,&quot;15000&quot;,&quot;10000&quot;,&quot;20000&quot;,&quot;15000&quot;,&quot;25000&quot;],&quot;backgroundColor&quot;:&quot;rgba(78, 115, 223, 0.05)&quot;,&quot;borderColor&quot;:&quot;rgba(78, 115, 223, 1)&quot;}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false,&quot;reverse&quot;:false},&quot;title&quot;:{},&quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:true,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;2&quot;],&quot;zeroLineBorderDash&quot;:[&quot;2&quot;],&quot;drawOnChartArea&quot;:true},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;beginAtZero&quot;:false,&quot;padding&quot;:20}}],&quot;yAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:true,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;2&quot;],&quot;zeroLineBorderDash&quot;:[&quot;2&quot;]},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;beginAtZero&quot;:false,&quot;padding&quot;:20}}]}}}"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 col-xl-12">
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="text-dark font-weight-bold m-0">FHE Beneficiaries</h6>
                            <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle text-dark border rounded-0 border-light" data-toggle="dropdown" aria-expanded="false" type="button"><i class="fas fa-bars"></i></button>
                                <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in"
                                    role="menu">
                                    <p class="text-center dropdown-header">Options:</p><a class="dropdown-item" role="presentation" data-toggle="tooltip" data-bs-tooltip="" href="#" title="Add New Student"><i class="fas fa-plus fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Add student</a><a class="dropdown-item"
                                        role="presentation" data-toggle="tooltip" data-bs-tooltip="" href="#" title="Upload List of Student"><i class="fas fa-file-excel fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Upload List</a><a class="dropdown-item" role="presentation"
                                        data-toggle="tooltip" data-bs-tooltip="" href="#" title="Download List of Student"><i class="fas fa-file-download fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Download List</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" role="presentation" data-toggle="tooltip" data-bs-tooltip="" href="#" title="Download FHE Template"><i class="fas fa-file-download fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;FHE Template</a></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-area"><canvas data-bs-chart="{&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Enrolled&quot;,&quot;On LOA&quot;,&quot;Dropped&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;&quot;,&quot;backgroundColor&quot;:[&quot;#4e73df&quot;,&quot;#f6c23e&quot;,&quot;#e74a3b&quot;],&quot;borderColor&quot;:[&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;],&quot;data&quot;:[&quot;80&quot;,&quot;10&quot;,&quot;10&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false},&quot;title&quot;:{}}}"></canvas></div>
                            <div
                                class="text-center small mt-4"><span class="mr-2"><i class="fas fa-circle text-primary"></i>&nbsp;Enrolled</span><span class="mr-2"><i class="fas fa-circle text-warning"></i>&nbsp;On LOA</span><span class="mr-2"><i class="fas fa-circle text-danger"></i>&nbsp;Dropped</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <footer class="bg-white sticky-footer">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © FHE Portal 2022</span></div>
        </div>
    </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
   
    
</body>
@include('includes.footer')
</html>