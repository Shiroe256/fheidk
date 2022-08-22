@include('includes.header')
<div class="container-fluid">
    <h5 class="text-dark mb-4">FHE Management / <span class="badge badge-pill badge-info">AY
            2020-2021</span>&nbsp;/&nbsp;<span class="badge badge-pill badge-info">1st Semester</span> / <span
            class="badge badge-pill badge-info">1st Tranche</span></h5>
    <div>
        <div class="card shadow">
            <div class="card-header">
                Billing "Other School Fees" Settings
            </div>
            <div class="card-body">
                @include('elements.settings')
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" id="btn_save">Save All</button>
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




{{-- <script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js')}}"></script> --}}
<script type="text/javascript" src="{{ url('js\jquery.min.js') }}"></script>
<script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js') }}"></script>
<script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js') }}">
</script>
<script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
<script type="text/javascript" src="{{ url('js\chart.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js\bs-init.js') }}"></script>
<script type="text/javascript" src="{{ url('js\bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js\theme.js') }}"></script>
<script type="text/javascript" src="{{ url('js\showandhide.js') }}"></script>
<script type="text/javascript" src="{{ url('js\datatables.js') }}"></script>
<script type="text/javascript" src="{{ url('js\student_crud.js') }}"></script>
<script type="text/javascript" src="{{ url('js\dateformat.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ url('https://unpkg.com/xlsx/dist/xlsx.full.min.js') }}"></script>
{{-- <script type="text/javascript" src="{{ url('js/batchbilling.js') }}"></script> --}}
<script>
    $('#select_course').change(function() {
        $(".course-settings").each(function() {
            $(this).addClass("d-none");
        });
        console.log($(this).val());
        $('#course_' + $(this).val()).removeClass("d-none");
    });
    $('.toggleall').change(function() {
        var toggle = $(this).is(":checked");
        $('#settings_' + $(this).attr('id').substring(10) + ' input:checkbox').prop("checked", toggle);
        console.log($('#settings_' + $(this).attr('id').substring(10) + ' > input:checkbox'));
    });

    $('#btn_save').click(function() {
        var on = [];
        var off = [];
        $('[id^="switch_"]').each(function(index) {
            if ($(this).is(':checked')) {
                on.push($(this).val());
            } else {
                off.push($(this).val());
            }
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: window.location.origin + "/save-settings",
            type: "PUT",
            data: {
                on: on,
                off: off
            },
            success: function(data) {
                window.location.href = "/billing/" + data;
            }
        });
    });
</script>

</body>

</html>
