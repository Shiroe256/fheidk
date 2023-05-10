<div class="table-responsive table mt-2" id="tbl_user_list_div" role="grid" aria-describedby="dataTable_info">
    <table class="table table-bordered my-0" id="tbl_user_list">
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
            @foreach($heis as $hei)
            <tr>
                <td>{{ $hei->hei_region_nir }}</td>
                <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/UnifastLogo.png">{{ $hei->hei_name }}</td>
                <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/UnifastLogo.png">{{ $hei->hei_focal }}</td>
                <td>{{ $hei->hei_focal_contact }}<br></td>
                <td><a href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to=someone@example.com" target="_blank">{{ $hei->hei_focal_email }}</a></td>
                <td><span class="text-success"><i class="fas fa-circle"></i>&nbsp;Online</span></td>
                <td class="text-center"><a class="btn btn-outline-info btn-block btn-sm border rounded-pill" role="button" href="{{route('manageuserpage')}}">View</a></td>
            </tr>
            @endforeach 
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