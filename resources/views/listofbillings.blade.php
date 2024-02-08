@include('includes.header')
<div class="container-fluid">
    <h5 class="text-dark mb-4">FHE Billing Management</h5>
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="text-dark mb-0">List of FHE Billings per Academic Year</h6>
        </div>
        <div class="card-body">
            @if (isset($_GET['queued']))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Billing Queued for checking!</strong>
                    <p>The billing with reference number <strong>{{ $_GET['queued'] }}</strong> has successfully been
                        queued for checking.
                    </p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @include('elements.billingtable')
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
                    <h6 class="modal-title">Remove Student Confirmation</h6><button type="button" class="close"
                        data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body"><label>Are you sure you want to remove this student from the list?</label></div>
                <div class="modal-footer"><button class="btn btn-light card-button-style" type="button"
                        data-dismiss="modal">Close</button><button class="btn btn-danger card-button-style"
                        type="button">Confirm</button></div>
            </form>
        </div>
    </div>
</div>
@include('modals.newbilling');
</div>

@include('includes.footer');
</body>

</html>
