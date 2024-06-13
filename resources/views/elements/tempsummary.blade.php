<?php $format = new NumberFormatter('en_PH', NumberFormatter::CURRENCY); //currency formatter
$cnt = 1;
?>
<div class="table-responsive">
    <table class="table table-hover table-lg" id="tbl_summary">
        <thead>
            <tr>
                <th class="text-center">NO.</th>
                <th>HEI CAMPUS</th>
                <th class="text-center">TOTAL BENEFICIARIES<br></th>
                <th class="text-center">FORM 2<br></th>
                <th class="text-center">FORM 3<br></th>
                <th class="text-center">TOTAL AMOUNT<br></th>
            </tr>
        </thead>
        <tbody id="tbl_list_of_students_form_1">
                <tr>
                    <td class="text-center"></td>
                    <td><h4>{{ $hei_name }}</h4></td>
                    <td class="text-center"><h4>{{ $total_beneficiaries }}</h4></td>
                    <td class="text-center"><h4>{{ $format->format($form2_total) }}</h4></td>
                    <td class="text-center"><h4>{{ $format->format($form3_total) }}</h4></td>
                    <td class="text-center"><h4>{{ $format->format($total_fee) }}</h4></td>
                </tr>
        </tbody>
    </table>
</div>
