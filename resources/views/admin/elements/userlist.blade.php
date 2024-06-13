    <table class="table table-bordered my-0" id="tbl_user_list" style="width: 100%">
        <thead>
            <tr>
                <th>REGION</th>
                <th>HEI NAME</th>
                <th>FOCAL PERSON</th>
                <th>CONTACT NO.</th>
                <th>EMAIL ADDRESS</th>
                <th rowspan="2">STATUS</th>
                <th class="text-center" rowspan="2">ACTION</th>
            </tr>
            <tr>
                <th id="search_user_region">REGION</th>
                <th id="search_user_hei_name">HEI NAME</th>
                <th id="search_user_focal_person">FOCAL PERSON</th>
                <th id="search_user_contact">CONTACT NO.</th>
                <th id="search_user_email">EMAIL ADDRESS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($heis as $hei)
            <tr>
                <td>{{ $hei->hei_region_nir }}</td>
                {{-- <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/UnifastLogo.png">{{ $hei->hei_name }}</td> --}}
                <td>{{ $hei->hei_name }}</td>
                {{-- <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/UnifastLogo.png">{{ $hei->hei_focal }}</td> --}}
                <td>{{ $hei->hei_focal }}</td>
                <td>{{ $hei->hei_focal_contact }}<br></td>
                <td><a href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to=someone@example.com" target="_blank">{{ $hei->hei_focal_email }}</a></td>
                <td><span class="text-success"><i class="fas fa-circle"></i>&nbsp;Online</span></td>
                <td class="text-center"><a id="{{ $hei->hei_uii }}"class="btn btn-outline-info btn-block btn-sm border rounded-pill" role="button" href="{{route('manageuserpage', $hei->hei_uii)}}">View</a></td>
            </tr>
            @endforeach 
        </tbody>
    </table>
