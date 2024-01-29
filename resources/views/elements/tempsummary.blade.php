<?php $format = new NumberFormatter('en_PH', NumberFormatter::CURRENCY); //currency formatter
$cnt = 1;
?>
<table class="table table-bordered table-hover table-sm dataTable my-0 table-style tbl_summary" id="tbl_summary">
    <thead>
        <tr>
            <th class="text-center">NO.</th>
            <th>HEI CAMPUS</th>
            <th class="text-center">TOTAL BENEFICIARIES<br></th>
            <th class="text-center">TOTAL AMOUNT<br></th>
        </tr>
    </thead>
    <tbody id="tbl_list_of_students_form_1">
            <tr>
                <td class="text-center"></td>
                <td>{{ $hei_name }}</td>
                <td class="text-center">{{ $total_beneficiaries }}</td>
                <td class="text-center">{{ $format->format($total_fee) }}</td>
            </tr>
    </tbody>
</table>
