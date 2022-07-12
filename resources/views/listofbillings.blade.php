@include('includes.header');
            <div class="container-fluid">
                <h5 class="text-dark mb-4">FHE Billing Management</h5>
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="text-dark mb-0">List of FHE Billings per Academic Year</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col text-right"><button class="btn btn-outline-info btn-sm" type="button" data-toggle="modal" data-target="#mod_add_new_ay"><i class="fas fa-plus"></i>&nbsp;New Billing</button></div>
                        </div>
                        <div class="table-responsive table mt-2 table-style" role="grid" aria-describedby="dataTable_info">
                            <table class="table table-bordered table-hover table-sm dataTable my-0 table-style" id="tbl_listofbillings">
                                <thead>
                                    <tr>
                                        <th class="text-center">NO.</th>
                                        <th class="text-center">REFERENCE NO.</th>
                                        <th class="text-center">ACADEMIC YEAR</th>
                                        <th class="text-center">SEMESTER</th>
                                        <th class="text-center">TRANCHE</th>
                                        <th class="text-center">TOTAL AMOUNT</th>
                                        <th class="text-center">TOTAL BENEFICIARIES</th>
                                        <th class="text-center">STATUS</th>
                                        <th class="text-center">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td class="text-center">FHE-UP-2020-2021-1-1</td>
                                        <td class="text-center">2020-2021</td>
                                        <td class="text-center">1st</td>
                                        <td class="text-center">1st</td>
                                        <td class="text-center">1,234,567</td>
                                        <td class="text-center">1,234,567</td>
                                        <td class="text-center"><span class="badge badge-pill badge-primary span-size">Submitted</span></td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group"><a class="btn btn-outline-info" role="button" data-toggle="tooltip" data-bs-tooltip="" data-placement="bottom" title="Edit" href="{{route('billingmanagement')}}"><i class="far fa-eye"></i></a></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2</td>
                                        <td class="text-center">FHE-UP-2019-2020-1-1<br></td>
                                        <td class="text-center">2019-2020</td>
                                        <td class="text-center">1st</td>
                                        <td class="text-center">1st</td>
                                        <td class="text-center">1,234,567</td>
                                        <td class="text-center">1,234,567</td>
                                        <td class="text-center text-success"><span class="badge badge-pill badge-success span-size">Paid</span></td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group"><a class="btn btn-outline-info" role="button" data-toggle="tooltip" data-bs-tooltip="" data-placement="bottom" title="Edit" href="{{route('billingmanagement')}}"><i class="far fa-eye"></i></a></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">3</td>
                                        <td class="text-center">FHE-UP-2019-2020-1-1<br></td>
                                        <td class="text-center">2019-2020</td>
                                        <td class="text-center">2nd</td>
                                        <td class="text-center">2nd</td>
                                        <td class="text-center">1,234,567</td>
                                        <td class="text-center">1,234,567</td>
                                        <td class="text-center text-warning"><span class="badge badge-pill badge-warning span-size">Ongoing</span></td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group"><a class="btn btn-outline-info" role="button" data-toggle="tooltip" data-bs-tooltip="" data-placement="bottom" title="Edit" href="{{route('billingmanagement')}}"><i class="far fa-edit"></i></a><button class="btn btn-outline-danger"
                                                    data-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button" title="Remove" data-target="#mod_remove"><i class="far fa-trash-alt"></i></button></div>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr></tr>
                                </tfoot>
                            </table>
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
    <div class="modal fade" role="dialog" tabindex="-1" id="mod_remove">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h6 class="modal-title">Remove Student Confirmation</h6><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                    <div class="modal-body"><label>Are you sure you want to remove this student from the list?</label></div>
                    <div class="modal-footer"><button class="btn btn-light card-button-style" type="button" data-dismiss="modal">Close</button><button class="btn btn-danger card-button-style" type="button">Confirm</button></div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="mod_add_new_ay">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h6 class="modal-title">FHE Management</h6><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                    <div class="modal-body">
                        <div class="form-group input-style">
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label>Academic Year</label><select class="form-control input-style"><option value="" selected="">--Select Academic Year--</option><option value="2020-2021">2020-2021</option><option value="2021-2022">2021-2022</option></select></div>
                                    <div
                                        class="form-group"><label>Semester</label><select class="form-control input-style"><option value="" selected="">--Select Semester--</option><option value="1st">1st</option><option value="2nd">2nd</option><option value="3rd">3rd</option><option value="Summer">Summer</option></select></div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer"><button class="btn btn-light card-button-style" type="button" data-dismiss="modal">Close</button><a class="btn btn-primary card-button-style" role="button" href="{{route('billingmanagement')}}">Next</a></div>
            </form>
        </div>
    </div>
    </div>
   
	@include('includes.footer');

</body>

</html>