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
        <?php
        $total_total_amount = 0;
        $grand_total_beneficiaries = 0;
        ?>
        @foreach ($hei_summary as $summary)
            <?php
            $total_total_amount += $summary['total_amount'];
            $grand_total_beneficiaries += $summary['total_beneficiaries']; ?>
            <tr>
                <td class="text-center">{{ $cnt++ }}</td>
                <td>{{ $summary['hei_name'] }}</td>
                <td class="text-center">{{ $summary['total_beneficiaries'] }}</td>
                <td class="text-center">{{ $format->format($summary['total_amount']) }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="2" class="text-center">GRAND TOTAL</th>
            <th class="text-center">{{ $grand_total_beneficiaries }}</th>
            <th class="text-center">{{ $format->format($total_total_amount) }}</th>
        </tr>
    </tfoot>
</table>
