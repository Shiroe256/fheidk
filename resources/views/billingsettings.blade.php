<?php $f = new NumberFormatter('en', NumberFormatter::ORDINAL);
//need mo ayusin at tanggalin ung ; sa extension=intl sa php.ini file mo para dito
?>
@include('includes.header')
<div class="container-fluid">
    <h5 class="text-dark mb-4">FHE Management / <span class="badge badge-pill badge-info">AY
            {{ $ac_year }}</span>&nbsp;/&nbsp;<span class="badge badge-pill badge-info">{{ $f->format($semester) }}
            Semester</span> / <span class="badge badge-pill badge-info">{{ $f->format($tranche) }} Tranche</span></h5>
    <div>
        <div class="card shadow">
            <div class="card-header">
                <a class="btn btn-outline-dark btn-sm" role="button" href="{{ route('billings') }}"><i
                        class="fas fa-arrow-left"></i>&nbsp;Return to the
                    previous page</a>
                Billing "Other School Fees" Settings
            </div>
            <div class="card-body">
                @include('elements.settings')
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" id="btn_save" value="{{ $reference_no }}">Save All</button>
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
<script type="text/javascript" src="{{ url('js\settings.js') }}"></script>
</body>

</html>
