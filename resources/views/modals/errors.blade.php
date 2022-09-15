<div id="mod_errors" class="modal fade" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog" style="max-width: 1000px!important;">
        <div class="modal-content">
            <div class="row no-gutters" style="height: 500px;">
                <div class="col-md-4 card">
                    <div class="card-body text-dark">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" fill="currentColor"
                                class="bi bi-exclamation-octagon-fill" viewBox="0 0 16 16">
                                <path
                                    d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </svg>
                        </div>
                        <br>
                        <h1>Oh Sheet! >_< </h1>
                                <h3>There are errors in your Spreadsheet.</h3>
                                <p><u><b id='error_count'>3</b> lines</u> on your spreadsheet have errors or are missing
                                    data.</p>
                                <small class="text-muted">Pull your sheet together.</small>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-block btn-outline-dark w-3" class="close" data-bs-dismiss="modal"
                            aria-label="Close">OK</button>
                    </div>
                </div>
                <div id="error_summary" class="bg-dark col-md-8 p-3 text-white mh-100"
                    style="font-family:monospace;overflow-y: scroll;">
                </div>
            </div>
        </div>
    </div>
</div>
