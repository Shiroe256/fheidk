@include('includes.header')

{{-- <div id="mod_new_student_info" class="modal fade" role="dialog" tabindex="-1" data-bs-keyboard="false"
        data-bs-backdrop="static"> --}}
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <form id='frm_add_student' method="POST">
            <div class="modal-header">
                <h6 class="modal-title text-primary">ADD STUDENT</h6><button type="button" class="close"
                    data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <input type="hidden" id="studuid">
            </div>
            <div class="modal-body">
                <div class="custom-control custom-switch">
                    <input type="hidden" name="" id="stud_uid" value="sample">
                    <input type="checkbox" class="custom-control-input toggle" id="switch" value="69">
                    <label class="custom-control-label" for="switch">Some Fee<small class="text-muted"> +
                            100</small>
                        <div id="loader"></div>
                    </label>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-light card-button-style" type="button"
                    data-bs-dismiss="modal">Close</button><button id="btn_add_student"
                    class="add_student btn btn-primary card-button-style" type="submit">Add Student</button>
            </div>
        </form>
    </div>
</div>
{{-- </div> --}}
<script src="js/studsettings.js"></script>
@include('includes.footer');
<script src="{{ url('js\listofbilling.js') }}"></script>
</body>
<style>
    .check {
        display: inline-block;
        transform: rotate(45deg);
        height: 12px;
        width: 6px;
        border-bottom: 2px solid #78b13f;
        border-right: 2px solid #78b13f;
        margin-left: .5rem;
    }
    
    .spinner {
        margin-left: .5rem;
        border: 2px solid #f3f3f3;
        /* Light grey */
        border-top: 2px solid #3498db;
        /* Blue */
        border-radius: 50%;
        width: 12px;
        height: 12px;
        animation: spin 1s linear infinite;
        display: inline-block;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

</html>
