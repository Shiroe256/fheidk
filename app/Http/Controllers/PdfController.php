<?php

namespace App\Http\Controllers;

use Fpdf\Fpdf;
use FPDFunifast;
use Illuminate\Http\Request;
use App\Models\Billing;
use App\Models\Hei;
use Illuminate\Support\Facades\DB;

require '../app/Libraries/FPDFscripts/FPDFunifast.php';
require '../vendor/autoload.php';

class PdfController extends Controller
{
    private $carlo_columns = "(
        SUM(
            (
                CASE WHEN(
                    (
                        `tbl_other_school_fees`.`type_of_fee` = 'tuition'
                    ) AND(
                        (
                            `tbl_other_school_fees`.`coverage` = 'per unit'
                        ) OR(
                            `tbl_other_school_fees`.`coverage` = 'per subject'
                        )
                    )
                ) THEN(
                    `students_sub`.`academic_unit` * `tbl_other_school_fees`.`amount`
                ) ELSE 0
            END
        )
    ) + SUM(
        (
            CASE WHEN(
                (
                    `tbl_other_school_fees`.`type_of_fee` = 'tuition'
                ) AND(
                    `tbl_other_school_fees`.`coverage` = 'per student'
                )
            ) THEN `tbl_other_school_fees`.`amount` ELSE 0
        END
    )
)
) AS `tuition_fee`,
(
    SUM(
        (
            CASE WHEN(
                `tbl_other_school_fees`.`type_of_fee` = 'entrance'
            ) THEN `tbl_other_school_fees`.`amount` ELSE 0
        END
    )
) + SUM(
    (
        CASE WHEN(
            `tbl_other_school_fees`.`type_of_fee` = 'admission'
        ) THEN `tbl_other_school_fees`.`amount` ELSE 0
    END
)
)
) AS `entrance_and_admission_fee`,
SUM(
    (
        CASE WHEN(
            `tbl_other_school_fees`.`type_of_fee` = 'athletic'
        ) THEN `tbl_other_school_fees`.`amount` ELSE 0
    END
)
) AS `athletic_fee`,
(
    SUM(
        (
            CASE WHEN(
                (
                    `tbl_other_school_fees`.`type_of_fee` = 'computer'
                ) AND(
                    (
                        `tbl_other_school_fees`.`coverage` = 'per unit'
                    ) OR(
                        `tbl_other_school_fees`.`coverage` = 'per subject'
                    )
                )
            ) THEN(
                `students_sub`.`comp_lab_unit` * `tbl_other_school_fees`.`amount`
            ) ELSE 0
        END
    )
) + SUM(
    (
        CASE WHEN(
            (
                `tbl_other_school_fees`.`type_of_fee` = 'computer'
            ) AND(
                `tbl_other_school_fees`.`coverage` = 'per student'
            )
        ) THEN `tbl_other_school_fees`.`amount` ELSE 0
    END
)
)
) AS `computer_fee`,
SUM(
    (
        CASE WHEN(
            `tbl_other_school_fees`.`type_of_fee` = 'cultural'
        ) THEN `tbl_other_school_fees`.`amount` ELSE 0
    END
)
) AS `cultural_fee`,
SUM(
    (
        CASE WHEN(
            `tbl_other_school_fees`.`type_of_fee` = 'development'
        ) THEN `tbl_other_school_fees`.`amount` ELSE 0
    END
)
) AS `development_fee`,
SUM(
    (
        CASE WHEN(
            `tbl_other_school_fees`.`type_of_fee` = 'guidance'
        ) THEN `tbl_other_school_fees`.`amount` ELSE 0
    END
)
) AS `guidance_fee`,
SUM(
    (
        CASE WHEN(
            `tbl_other_school_fees`.`type_of_fee` = 'handbook'
        ) THEN `tbl_other_school_fees`.`amount` ELSE 0
    END
)
) AS `handbook_fee`,
(
    SUM(
        (
            CASE WHEN(
                (
                    `tbl_other_school_fees`.`type_of_fee` = 'laboratory'
                ) AND(
                    (
                        `tbl_other_school_fees`.`coverage` = 'per unit'
                    ) OR(
                        `tbl_other_school_fees`.`coverage` = 'per subject'
                    )
                )
            ) THEN(
                `students_sub`.`lab_unit` * `tbl_other_school_fees`.`amount`
            ) ELSE 0
        END
    )
) + SUM(
    (
        CASE WHEN(
            (
                `tbl_other_school_fees`.`type_of_fee` = 'laboratory'
            ) AND(
                `tbl_other_school_fees`.`coverage` = 'per student'
            )
        ) THEN `tbl_other_school_fees`.`amount` ELSE 0
    END
)
)
) AS `laboratory_fee`,
SUM(
    (
        CASE WHEN(
            `tbl_other_school_fees`.`type_of_fee` = 'library'
        ) THEN `tbl_other_school_fees`.`amount` ELSE 0
    END
)
) AS `library_fee`,
SUM(
    (
        CASE WHEN(
            `tbl_other_school_fees`.`type_of_fee` = 'medical and dental'
        ) THEN `tbl_other_school_fees`.`amount` ELSE 0
    END
)
) AS `medical_and_dental_fee`,
SUM(
    (
        CASE WHEN(
            `tbl_other_school_fees`.`type_of_fee` = 'registration'
        ) THEN `tbl_other_school_fees`.`amount` ELSE 0
    END
)
) AS `registration_fee`,
SUM(
    (
        CASE WHEN(
            `tbl_other_school_fees`.`type_of_fee` = 'school id'
        ) THEN `tbl_other_school_fees`.`amount` ELSE 0
    END
)
) AS `school_id_fee`,
(
    SUM(
        (
            CASE WHEN(
                (
                    `tbl_other_school_fees`.`type_of_fee` = 'nstp'
                ) AND(
                    (
                        `tbl_other_school_fees`.`coverage` = 'per unit'
                    ) OR(
                        `tbl_other_school_fees`.`coverage` = 'per subject'
                    )
                )
            ) THEN(
                `students_sub`.`nstp_unit` * `tbl_other_school_fees`.`amount`
            ) ELSE 0
        END
    )
) + SUM(
    (
        CASE WHEN(
            (
                `tbl_other_school_fees`.`type_of_fee` = 'nstp'
            ) AND(
                `tbl_other_school_fees`.`coverage` = 'per student'
            )
        ) THEN `tbl_other_school_fees`.`amount` ELSE 0
    END
)
)
) AS `nstp_fee`,
(
    (
        (
            (
                (
                    (
                        (
                            (
                                (
                                    (
                                        (
                                            (
                                                (
                                                    (
                                                        (
                                                            SUM(
                                                                (
                                                                    CASE WHEN(
                                                                        (
                                                                            `tbl_other_school_fees`.`type_of_fee` = 'tuition'
                                                                        ) AND(
                                                                            (
                                                                                `tbl_other_school_fees`.`coverage` = 'per unit'
                                                                            ) OR(
                                                                                `tbl_other_school_fees`.`coverage` = 'per subject'
                                                                            )
                                                                        )
                                                                    ) THEN(
                                                                        `students_sub`.`academic_unit` * `tbl_other_school_fees`.`amount`
                                                                    ) ELSE 0
                                                                END
                                                            )
                                                        ) + SUM(
                                                            (
                                                                CASE WHEN(
                                                                    (
                                                                        `tbl_other_school_fees`.`type_of_fee` = 'tuition'
                                                                    ) AND(
                                                                        `tbl_other_school_fees`.`coverage` = 'per student'
                                                                    )
                                                                ) THEN `tbl_other_school_fees`.`amount` ELSE 0
                                                            END
                                                        )
                                                    )
                                                ) + SUM(
                                                    (
                                                        CASE WHEN(
                                                            `tbl_other_school_fees`.`type_of_fee` = 'entrance'
                                                        ) THEN `tbl_other_school_fees`.`amount` ELSE 0
                                                    END
                                                )
                                            )
                                        ) + SUM(
                                            (
                                                CASE WHEN(
                                                    `tbl_other_school_fees`.`type_of_fee` = 'admission'
                                                ) THEN `tbl_other_school_fees`.`amount` ELSE 0
                                            END
                                        )
                                    )
                                ) + SUM(
                                    (
                                        CASE WHEN(
                                            `tbl_other_school_fees`.`type_of_fee` = 'athletic'
                                        ) THEN `tbl_other_school_fees`.`amount` ELSE 0
                                    END
                                )
                            )
                        ) +(
                            SUM(
                                (
                                    CASE WHEN(
                                        (
                                            `tbl_other_school_fees`.`type_of_fee` = 'computer'
                                        ) AND(
                                            (
                                                `tbl_other_school_fees`.`coverage` = 'per unit'
                                            ) OR(
                                                `tbl_other_school_fees`.`coverage` = 'per subject'
                                            )
                                        )
                                    ) THEN(
                                        `students_sub`.`comp_lab_unit` * `tbl_other_school_fees`.`amount`
                                    ) ELSE 0
                                END
                            )
                        ) + SUM(
                            (
                                CASE WHEN(
                                    (
                                        `tbl_other_school_fees`.`type_of_fee` = 'computer'
                                    ) AND(
                                        `tbl_other_school_fees`.`coverage` = 'per student'
                                    )
                                ) THEN `tbl_other_school_fees`.`amount` ELSE 0
                            END
                        )
                    )
                )
            ) + SUM(
                (
                    CASE WHEN(
                        `tbl_other_school_fees`.`type_of_fee` = 'cultural'
                    ) THEN `tbl_other_school_fees`.`amount` ELSE 0
                END
            )
        )
    ) + SUM(
        (
            CASE WHEN(
                `tbl_other_school_fees`.`type_of_fee` = 'development'
            ) THEN `tbl_other_school_fees`.`amount` ELSE 0
        END
    )
)
) + SUM(
    (
        CASE WHEN(
            `tbl_other_school_fees`.`type_of_fee` = 'guidance'
        ) THEN `tbl_other_school_fees`.`amount` ELSE 0
    END
)
)
) + SUM(
    (
        CASE WHEN(
            `tbl_other_school_fees`.`type_of_fee` = 'handbook'
        ) THEN `tbl_other_school_fees`.`amount` ELSE 0
    END
)
)
) +(
    SUM(
        (
            CASE WHEN(
                (
                    `tbl_other_school_fees`.`type_of_fee` = 'laboratory'
                ) AND(
                    (
                        `tbl_other_school_fees`.`coverage` = 'per unit'
                    ) OR(
                        `tbl_other_school_fees`.`coverage` = 'per subject'
                    )
                )
            ) THEN(
                `students_sub`.`lab_unit` * `tbl_other_school_fees`.`amount`
            ) ELSE 0
        END
    )
) + SUM(
    (
        CASE WHEN(
            (
                `tbl_other_school_fees`.`type_of_fee` = 'laboratory'
            ) AND(
                `tbl_other_school_fees`.`coverage` = 'per student'
            )
        ) THEN `tbl_other_school_fees`.`amount` ELSE 0
    END
)
)
)
) + SUM(
    (
        CASE WHEN(
            `tbl_other_school_fees`.`type_of_fee` = 'library'
        ) THEN `tbl_other_school_fees`.`amount` ELSE 0
    END
)
)
) + SUM(
    (
        CASE WHEN(
            `tbl_other_school_fees`.`type_of_fee` = 'medical and dental'
        ) THEN `tbl_other_school_fees`.`amount` ELSE 0
    END
)
)
) + SUM(
    (
        CASE WHEN(
            `tbl_other_school_fees`.`type_of_fee` = 'registration'
        ) THEN `tbl_other_school_fees`.`amount` ELSE 0
    END
)
)
) + SUM(
    (
        CASE WHEN(
            `tbl_other_school_fees`.`type_of_fee` = 'school id'
        ) THEN `tbl_other_school_fees`.`amount` ELSE 0
    END
)
)
) +(
    SUM(
        (
            CASE WHEN(
                (
                    `tbl_other_school_fees`.`type_of_fee` = 'nstp'
                ) AND(
                    (
                        `tbl_other_school_fees`.`coverage` = 'per unit'
                    ) OR(
                        `tbl_other_school_fees`.`coverage` = 'per subject'
                    )
                )
            ) THEN(
                `students_sub`.`nstp_unit` * `tbl_other_school_fees`.`amount`
            ) ELSE 0
        END
    )
) + SUM(
    (
        CASE WHEN(
            (
                `tbl_other_school_fees`.`type_of_fee` = 'nstp'
            ) AND(
                `tbl_other_school_fees`.`coverage` = 'per student'
            )
        ) THEN `tbl_other_school_fees`.`amount` ELSE 0
    END
)
)
)
) AS `total_fee`";
    function computeCellHeight(Fpdf $pdf, $text, $cellWidth, $fontFamily = '', $fontSize = 0)
    {
        $pdf->SetFont($fontFamily, '', $fontSize);
        $cellHeight = ceil($pdf->GetStringWidth($text) / $cellWidth) * ($fontSize / 2);
        return $cellHeight;
    }

    private function getForm2Data($reference_no)
    {
        //students sub query. Dito ung pagination
        $students_sub = DB::table('tbl_billing_details_temp')->where('tbl_billing_details_temp.reference_no', '=', $reference_no)
            ->where('exam_result', '!=', 'Failed')
            ->orWhere('total_exam_taken', 'IS', DB::raw('NULL'));
        //dito jinojoin ung information about the fees and computation
        $students = DB::table(DB::raw("({$students_sub->toSql()}) AS students_sub"))
            ->mergeBindings($students_sub)
            ->select(
                'students_sub.stud_id',
                'students_sub.stud_lname',
                'students_sub.stud_fname',
                'students_sub.stud_mname',
                'students_sub.year_level',
                'students_sub.stud_sex',
                'students_sub.lab_unit',
                'students_sub.comp_lab_unit',
                'students_sub.academic_unit',
                'students_sub.nstp_unit',
                'students_sub.hei_name',
                'students_sub.stud_email',
                'students_sub.fhe_award_no',
                'students_sub.degree_program',
                DB::raw($this->carlo_columns)
            )
            ->leftJoin('tbl_other_school_fees', function ($join) {
                $join->on('tbl_other_school_fees.course_enrolled', '=', 'students_sub.degree_program')
                    ->on('tbl_other_school_fees.semester', '=', 'students_sub.semester')
                    ->on('tbl_other_school_fees.year_level', '=', 'students_sub.year_level')
                    ->on('tbl_other_school_fees.form', '=', DB::raw(2));
            })
            // ->join('tbl_billing_settings', 'tbl_billing_settings.bs_reference_no', '=', 'students_sub.reference_no')
            ->leftJoin('tbl_billing_settings', function ($join) {
                $join->on('tbl_billing_settings.bs_osf_uid', '=', 'tbl_other_school_fees.uid')
                    ->on('tbl_billing_settings.bs_reference_no', '=', 'students_sub.reference_no');
            })
            ->leftJoin('tbl_billing_stud_settings', function ($join) {
                $join->on('tbl_billing_stud_settings.bs_reference_no', '=', 'students_sub.reference_no')
                    ->on('tbl_billing_stud_settings.bs_student', '=', 'students_sub.uid')
                    ->on('tbl_billing_settings.bs_osf_uid', '=', 'tbl_billing_stud_settings.bs_osf_uid');
            })
            ->where(function ($query) {
                $query->where('tbl_billing_stud_settings.bs_status', '=', 1)
                    ->where('tbl_billing_settings.bs_status', '=', 1)
                    ->orWhere(function ($query) {
                        $query->whereNull('tbl_billing_stud_settings.bs_status')
                            ->where('tbl_billing_settings.bs_status', '=', 1);
                    });
            })
            ->orderBy('degree_program')
            //!kailangan lagyan dito ng para sa mga pumasa lang
            ->groupBy('students_sub.uid')->get();

        return $students;
    }
    function getHEIInfo($reference_no)
    {
        $billing = Billing::where('reference_no', $reference_no)->first();
        $heiinfo = Hei::where('hei_uii', $billing->hei_uii)->first();

        $pdf_data['term'] = $billing->semester == 1 ? 'First' : 'Second';
        $pdf_data['ay'] = $billing->ac_year;
        $pdf_data['date'] = now()->toDateString();
        $pdf_data['ref_no'] = $billing->reference_no;
        $pdf_data['college_name'] = $heiinfo->hei_name;
        $pdf_data['college_address'] = '(Address of State/ Local University or College)';
        $pdf_data['printed_name'] = "??";

        $signatories['prep1'] = $heiinfo->hei_focal;
        $signatories['pos_prep1'] = 'Project Technical Assistant I';
        $signatories['cert1'] = $heiinfo->hei_ao_name;
        $signatories['pos_cert1'] = 'Project Technical Assistant II';
        $signatories['cert2'] = $heiinfo->hei_ac_name;
        $signatories['pos_cert2'] = 'Project Technical Assistant III';
        $signatories['appr'] = $heiinfo->hei_head;
        $signatories['pos_appr'] = $heiinfo->hei_head_pos;

        return array('hei_info' => $pdf_data, 'signatories' => $signatories);
    }
    public function generatePDF()
    {
        $reference_no = '03-03236-2021-2022-1-1';
        $hei_info = $this->getHEIInfo($reference_no);
        $grantees = $this->getForm2Data($reference_no);
        // print_r($grantees->toArray());

        // $grantees[] =
        //     array(
        //         'last_name' => 'Bohol',
        //         'given_name' => 'Froilan',
        //         'middle_initial' => 'L',
        //         'sex' => 'M',
        //         'birthdate' => 'November 22, 1994',
        //         'degree' => 'Bachelor of Science in Information Technology',
        //         'year_level' => '4',
        //         'email_address' => 'sample@gmail.com',
        //         'phone_number' => '09955167998',
        //         'admission_fees' => '350.00',
        //         'remarks' => 'Passed'
        //     );
        // $grantees[] =
        //     array(
        //         'last_name' => 'Bohol',
        //         'given_name' => 'Froilan',
        //         'middle_initial' => 'L',
        //         'sex' => 'M',
        //         'birthdate' => 'November 22, 1994',
        //         'degree' => 'Bachelor of Science in Information Technology',
        //         'year_level' => '4',
        //         'email_address' => 'sample@gmail.com',
        //         'phone_number' => '09955167998',
        //         'admission_fees' => '350.00',
        //         'remarks' => 'Passed'
        //     );

        // $this->generateForm2($hei_info['signatories'], $hei_info['hei_info'],  $grantees);
        $this->generateForm2($hei_info['hei_info'], $hei_info['signatories'], $grantees);
        exit;
    }

    private function generateForm1($pdf_data, $signatories)
    {
        // $pdf_dataterm = "First";
        // $pdf_dataay = "2022";
        // $pdf_datadate = "2023/1/12";
        // $pdf_dataref_no = 'XX - XXXXXX - 2018 - X - X';
        // $pdf_datacollege_name = '(Name of State / Local University or College)';
        // $pdf_datacollege_address = '(Address of State/ Local University or College)';
        // $pdf_dataprinted_name = "";
        $pdf = new FPDFunifast('P', 'mm', 'A4');
        $pdf->AddPage('P');
        $pdf->SetFont('Arial', '', 10);

        $pdf->Cell(0, 5, 'FORM 1', 0, 1, 'R', 0);
        $pdf->Cell(0, 5, 'Republic of the Philippines', 0, 1, 'C', 0);
        $pdf->Cell(0, 5, $pdf_data['college_name'], 0, 1, 'C', 0);
        $pdf->Cell(0, 5, $pdf_data['college_address'], 0, 1, 'C', 0);
        $pdf->Cell(0, 5, 'CONSOLIDATED FREE HE BILLING DETAILS', 0, 1, 'C', 0);
        // Line break
        $pdf->Ln(10);
        $margin = 10;
        $pdf->SetMargins($margin, $margin, $margin);
        $pdf->Cell($pdf->GetPageWidth() - $margin - 60, 4, 'Free HE Billing Details Reference Number:', 0, 0, 'R');
        $pdf->Cell(0, 4, $pdf_data['ref_no'], 0, 1, 'R');
        $pdf->Cell($pdf->GetPageWidth() - $margin - 60, 4, 'Date:', 0, 0, 'R');
        $pdf->Cell(0, 4, $pdf_data['date'], 0, 1, 'R');
        $pdf->Ln();
        $pdf->Cell(30, 5, 'To', 1, 0, 'R');
        $pdf->Cell(0, 5, 'CHED - Central Office', 1, 1, 'L');
        $pdf->Cell(30, 10, 'Address', 1, 0, 'R');
        $pdf->MultiCell(0, 5, 'Higher Education Development Center Building, C.P. Garcia Ave, UP Campus, Diliman, Quezon City, Metro Manila', 1, 'L', false, 1);
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->SetX($pdf->GetX() + 130);
        $pdf->Cell(30, 8, 'Account Code', 0, 0, 'C', 0, 0);
        $pdf->Cell(0, 8, 'Amount', 0, 0, 'C', 0, 0);
        $pdf->SetX($x);
        $pdf->SetY($y);
        $pdf->MultiCell(30, 5, 'Responsibility Center', 0, 'C', 0);
        $pdf->Line($x + 30, $y, $x + 30, $pdf->GetPageHeight() - 10 - 60);
        $pdf->Line($x + 130, $y, $x + 130, $pdf->GetPageHeight() - 10 - 60);
        $pdf->Line($x + 160, $y, $x + 160, $pdf->GetPageHeight() - 10 - 60);
        $pdf->SetY($y + 20);
        $pdf->SetX(40);
        $pdf->MultiCell(100, 4, "Request for payment of tuiton fees and other school fees (TOSF) for the __________ Term AY _____________ to be charged against the Free Higher Education for CHED under Republic Act 10931 otherwise known as the Universal Access to Quality Tertiary Education(UAQTE), and as per CHED-UniFAST Guidelines for Free HE per attached supporting documents. ", 0);
        $pdf->SetY($y + 24);
        $pdf->SetX($x + 52);
        //Term
        $pdf->Cell(30, 4, $pdf_data['term'], 0, 0, "C");
        $pdf->SetY($y + 24);
        $pdf->SetX($x + 91);
        //Year
        $pdf->Cell(30, 4, $pdf_data['ay'], 0, 0, "C");
        $pdf->SetX($x);
        $pdf->SetY($y);
        $pdf->Cell($pdf->GetPageWidth() - $pdf->getRightMargin() * 2, 155, '', 1, 1, 'C', 0, 0);
        $pdf->SetX(10);
        $pdf->SetY($pdf->GetPageHeight() - 10 - 60);
        //signature
        $cell_height = 12;
        $pdf->Cell(30, $cell_height, "Signature", 1, 0, "C");
        $pdf->Cell($pdf->GetPageWidth() / 2 - 40, $cell_height, "", 1, 0, "C");
        $pdf->Cell(30, $cell_height, "Signature", 1, 0, "C");
        $pdf->Cell($pdf->GetPageWidth() / 2 - 40, $cell_height, "", 1, 1, "C");
        //signature
        $pdf->Cell(30, $cell_height, "Printed Name", 1, 0, "C");
        $pdf->Cell($pdf->GetPageWidth() / 2 - 40, $cell_height, strtoupper($signatories['cert2']), 1, 0, "C");
        $pdf->Cell(30, $cell_height, "Printed Name", 1, 0, "C");
        $pdf->Cell($pdf->GetPageWidth() / 2 - 40, $cell_height, strtoupper($signatories['appr']), 1, 1, "C");
        //signature
        $pdf->Cell(30, $cell_height, "Position", 1, 0, "C");
        $pdf->Cell($pdf->GetPageWidth() / 2 - 40, $cell_height, "Accountant", 1, 0, "C");
        $pdf->Cell(30, $cell_height, "Position", 1, 0, "C");
        $pdf->Cell($pdf->GetPageWidth() / 2 - 40, $cell_height, $signatories['pos_appr'], 1, 1, "C");
        //signature
        $pdf->Cell(30, $cell_height, "Date", 1, 0, "C");
        $pdf->Cell($pdf->GetPageWidth() / 2 - 40, $cell_height, now()->toDateString(), 1, 0, "C");
        $pdf->Cell(30, $cell_height, "Date", 1, 0, "C");
        $pdf->Cell($pdf->GetPageWidth() / 2 - 40, $cell_height, now()->toDateString(), 1, 1, "C");
        $pdf->Output();
    }
    function generateForm2($pdf_data,$signatories,  $grantees)
    {

        // $row[] = "hello world";
        // $row[] = array('term' => "first", 'ay' => '2022');
        // $row[] = array('term' => "first", 'ay' => '2022');

        // echo $row[1]['ay'] lalabas ung acad year lang sa row index 1 (or ung pangalawa kasi arrays start at index 0)

        $pdf = new FPDFunifast('L', 'mm', array(215.9, 330.2));
        $pdf->AddPage('L');
        $pdf->setHeaderFunction($pdf->form2header());
        $pdf->signatories = $signatories;
        $pdf->AliasNbPages();
        $margin = 5;
        $pdf->SetMargins($margin, $margin, $margin);
        $pdf->SetFont('Arial', '', 10);

        $pagetitleheight = $pdf->GetY();
        $pdf->Cell(0, 5, 'FORM 2', 0, 1, 'R', 0);
        $pdf->Cell(0, 5, 'Republic of the Philippines', 0, 1, 'C', 0);
        $pdf->Cell(0, 5, $pdf_data['college_name'], 0, 1, 'C', 0);
        $pdf->Cell(0, 5, $pdf_data['college_address'], 0, 1, 'C', 0);
        $pdf->Cell(0, 5, 'FREE HIGHER EDUCATION BILLING DETAILS', 0, 1, 'C', 0);

        $pdf->Ln(5);
        $pdf->Cell($pdf->GetPageWidth() - $margin - 60, 4, 'Free HE Billing Details Reference Number:', 0, 0, 'R');
        $pdf->Cell(0, 4, $pdf_data['ref_no'], 0, 1, 'R');
        $pdf->Cell($pdf->GetPageWidth() - $margin - 60, 4, 'Date:', 0, 0, 'R');
        $pdf->Cell(0, 4, $pdf_data['date'], 0, 1, 'R');
        $pdf->Ln(10);
        $pdf->Cell(320, 5, 'TUITION AND OTHER SCHOOL FEES (Based on Section 7, Rule II of the IRR of RA 10931)', 0, 0, 'C', 0);
        $pdf->Ln(5);
        // $pdf->Cell(320, 5, 'Degree Program', 1, 0, 'L', 0);
        $pdf->Ln();
        //set font kasi maliit
        $pdf->SetFont('Arial', '', 6);
        //headers
        $pagetitleheight = $pdf->GetY() - $pagetitleheight;
        $pagewidth_withborders = $pdf->GetPageWidth() - $margin * 2;

        //!for the first page
        $pdf->currentCourse = $grantees[0]->degree_program;
        $pdf->Cell(0, 5, $pdf->currentCourse, 1, 1);
        $headers[] = '#';
        $headers[] = 'Stud. Number';
        $headers[] = 'Last Name';
        $headers[] = 'Given Name';
        $headers[] = 'Middle Initial';
        $headers[] = 'Year Level';
        $headers[] = 'Sex';
        $headers[] = 'Lab Units';
        $headers[] = 'Comp Lab Units';
        $headers[] = 'Academic Units';
        $headers[] = 'NSTP Units';
        $headers[] = 'Tuition Fee';
        $headers[] = 'NSTP Fee';
        $headers[] = 'Athletic Fees';
        $headers[] = 'Computer Fees';
        $headers[] = 'Cultural Fees';
        $headers[] = 'Devt. Fees';
        $headers[] = 'Admission/Entrance Fees';
        $headers[] = 'Guidance Fees';
        $headers[] = 'Handbook Fees';
        $headers[] = 'Laboratory Fees';
        $headers[] = 'Library Fee';
        $headers[] = 'Medical Fees';
        $headers[] = 'Registration Fees';
        $headers[] = 'School ID Fees';
        $headers[] = 'TOTAL TOSF';

        foreach ($headers as $key => $header) {
            if ($key == 0)
                $widths[] = 9; //#
            elseif ($key == 1)
                $widths[] = 13; //Stud. Number
            elseif ($key == 2)
                $widths[] = 25; //Last Name
            elseif ($key == 3)
                $widths[] = 24.4; //Given Name
            elseif ($key == 4)
                $widths[] = 9; //Middle Name
            elseif ($key == 5)
                $widths[] = 8; //Year Level
            elseif ($key == 6)
                $widths[] = 6; //Sex at Birth
            elseif ($key == 7)
                $widths[] = 7; //Labo Units
            elseif ($key == 8)
                $widths[] = 11; //Comp Lab Units
            elseif ($key == 9)
                $widths[] = 12; //Academic Units
            elseif ($key == 10)
                $widths[] = 9; //NSTP Units
            elseif ($key == 11)
                $widths[] = 13; //Tuition Fee'
            elseif ($key == 12)
                $widths[] = 12.3; //NSTP Fee
            elseif ($key == 13)
                $widths[] = 14; //Athletic Fees
            elseif ($key == 14)
                $widths[] = 12; //Computer Fees
            elseif ($key == 15)
                $widths[] = 12; //Cultural Fees
            elseif ($key == 16)
                $widths[] = 12; //Development Fees
            elseif ($key == 17)
                $widths[] = 12; //Admission Fees
            elseif ($key == 18)
                $widths[] = 12; //Guidance Fees
            elseif ($key == 19)
                $widths[] = 12; //Handbook Fees
            elseif ($key == 20)
                $widths[] = 13; //Laboratory Fees
            elseif ($key == 21)
                $widths[] = 12; //Library Fee
            elseif ($key == 22)
                $widths[] = 12; //Medical Fees
            elseif ($key == 23)
                $widths[] = 14; //Registration Fees
            elseif ($key == 24)
                $widths[] = 12; //School ID Fees  
            else
                $widths[] = $pagewidth_withborders / count($headers);
        }

        $pdf->SetWidths($widths);

        // $values[] = ['data' => '1', 'alignment' => 'L'];
        $alignments[] = 'L';
        $alignments[] = 'L';
        $alignments[] = 'L';
        $alignments[] = 'L';
        $alignments[] = 'C';
        $alignments[] = 'C';
        $alignments[] = 'C';
        $alignments[] = 'C';
        $alignments[] = 'C';
        $alignments[] = 'C';
        $alignments[] = 'C';
        $alignments[] = 'R';
        $alignments[] = 'R';
        $alignments[] = 'R';
        $alignments[] = 'R';
        $alignments[] = 'R';
        $alignments[] = 'R';
        $alignments[] = 'R';
        $alignments[] = 'R';
        $alignments[] = 'R';
        $alignments[] = 'R';
        $alignments[] = 'R';
        $alignments[] = 'R';
        $alignments[] = 'R';
        $alignments[] = 'R';
        $alignments[] = 'R';
        $pdf->SetAligns($alignments);
        $headerHeight = $pdf->GetY();
        $headerHeight = $pdf->GetY() - $headerHeight;
        $pdf->Row($headers, 3, $alignments);

        // Compute Total TOSF
        $totalTosf = 0;
        //prints the signature at the bottom always and cuts the page if there are no records in the signature page so laging may records na kasama ung signature
        // $total = count($grantees);
        // $grantees = array();

        // for ($i = 0; $i < $total; $i++) {
        //     if ($pdf->GetY() + 20 >= $pdf->GetPageBreakTrigger() && ($total - $i) * 3 + $headerHeight + $pagetitleheight <= $pdf->GetPageBreakTrigger() && $pdf->PageNo() == 1) {
        //         $pdf->AddPage('L');
        //         $pdf->Row($headers, 3, $alignments);
        //     } else if ($pdf->GetY() + 30 >= $pdf->GetPageBreakTrigger() && ($total - $i) * 3 + 300 + $headerHeight <= $pdf->GetPageBreakTrigger() && $pdf->PageNo() != 1) {
        //         $pdf->AddPage('L');
        //         $pdf->Row($headers, 3, $alignments);
        //     } else if ($pdf->GetY() + 3 >= $pdf->GetPageBreakTrigger()) {
        //         //print headers if a new page will be created by adding a row
        //         $pdf->Row($headers, 3, $alignments);
        //     }
        //     // // Sequence Number
        //     // $rowData = array_merge([$sequenceNumber], $grantee_info);
        //     // $pdf->Row($rowData, 3, $alignments);
        //     // $sequenceNumber++;
        //     // // Calculate the sum of "TOTAL TOSF"
        //     // $totalTosf += (float) str_replace('', '', $grantee_info[24]);
        // }

        // $rowData = array_merge([$key + 1], array_values($grantees[0]));
        // $pdf->Row($rowData, 3, $alignments);

        // $pdf->Cell(0, 5, $pdf->currentCourse, 1, 1);
        foreach ($grantees as $key => $grantee) {
            // $rowData = array_merge([$sequenceNumber], $grantees);
            if ($pdf->currentCourse != $grantee->degree_program) {
                $pdf->currentCourse = $grantee->degree_program;
                $pdf->AddPage();
            }
            $granteeRow =     array(
                'stud_number' => $grantee->stud_id,
                'last_name' => $grantee->stud_lname,
                'given_name' => $grantee->stud_fname,
                'middle_initial' => $grantee->stud_mname != '' ? substr($grantee->stud_mname, 0, 1) : '',
                'year_level' => $grantee->year_level,
                'sex' => substr($grantee->stud_sex, 0, 1),
                'lab_units' => $grantee->lab_unit,
                'comp_lab_units' => $grantee->comp_lab_unit,
                'academic_units' => $grantee->academic_unit,
                'nstp_units' => $grantee->nstp_unit,
                'tuition_fee' => number_format($grantee->tuition_fee, 2),
                'nstp_fee' => number_format($grantee->nstp_fee, 2),
                'athletic_fees' => number_format($grantee->athletic_fee, 2),
                'computer_fees' => number_format($grantee->computer_fee, 2),
                'cultural_fees' => number_format($grantee->cultural_fee, 2),
                'devt_fees' => number_format($grantee->development_fee, 2),
                'admission_fees' => number_format($grantee->entrance_and_admission_fee, 2),
                'guidance_fees' => number_format($grantee->guidance_fee, 2),
                'handbook_fees' => number_format($grantee->handbook_fee, 2),
                'laboratory_fees' => number_format($grantee->laboratory_fee, 2),
                'library_fee' => number_format($grantee->library_fee, 2),
                'medical_fees' => number_format($grantee->medical_and_dental_fee, 2),
                'registration_fees' => number_format($grantee->registration_fee, 2),
                'school_id_fees' => number_format($grantee->school_id_fee, 2),
                'total_tosf' => number_format($grantee->total_fee - $grantee->tuition_fee, 2)
            );
            $rowData = array_merge([$key + 1], array_values($granteeRow));
            $pdf->Row($rowData, 3, $alignments);
            // Calculate the sum of "TOTAL TOSF"
            $totalTosf += (float) str_replace('', '', $grantee->total_fee);
        };
        // Display the Sum of TOTAL TOSF
        $pdf->SetFont('Arial', 'BI', 7);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->Cell(298, 5, 'TOTAL:', 0, 0, 'R', 0);
        $pdf->Cell(22, 5, number_format($totalTosf, 2), 0, 0, 'R', 0);

        //signature
        $pdf->isLast = true;

        $pdf->Output();
    }

    function generateForm3($pdf_data, $signatories, $grantees)
    {
        $pdf = new FPDFunifast('L', 'mm', array(215.9, 330.2));
        $pdf->AddPage('L');
        $pdf->AliasNbPages();
        $margin = 5;
        $pdf->SetMargins($margin, $margin, $margin);
        $pdf->SetFont('Arial', '', 10);

        $pagetitleheight = $pdf->GetY();
        $pdf->Cell(0, 5, 'FORM 3', 0, 1, 'R', 0);
        $pdf->Cell(0, 5, 'Republic of the Philippines', 0, 1, 'C', 0);
        $pdf->Cell(0, 5, $pdf_data['college_name'], 0, 1, 'C', 0);
        $pdf->Cell(0, 5, $pdf_data['college_address'], 0, 1, 'C', 0);
        $pdf->Cell(0, 5, 'FREE HIGHER EDUCATION BILLING DETAILS', 0, 1, 'C', 0);

        $pdf->Ln(5);
        $pdf->Cell($pdf->GetPageWidth() - $margin - 60, 4, 'Free HE Billing Details Reference Number:', 0, 0, 'R');
        $pdf->Cell(0, 4, $pdf_data['ref_no'], 0, 1, 'R');
        $pdf->Cell($pdf->GetPageWidth() - $margin - 60, 4, 'Date:', 0, 0, 'R');
        $pdf->Cell(0, 4, $pdf_data['date'], 0, 1, 'R');
        $pdf->Ln(10);
        $pdf->Cell(320, 5, 'ADMISSION FEES (Based on Section 7, Rule II of the IRR of RA 10931)', 0, 0, 'C', 0);
        $pdf->Ln();
        //set font kasi maliit
        $pdf->SetFont('Arial', '', 6);
        //headers
        $pagetitleheight = $pdf->GetY() - $pagetitleheight;
        $pagewidth_withborders = $pdf->GetPageWidth() - $margin * 2;


        $headers[] = 'Seq Number';
        $headers[] = 'Last Name';
        $headers[] = 'Given Name';
        $headers[] = 'Middle Initial';
        $headers[] = 'Sex';
        $headers[] = 'Birthdate';
        $headers[] = 'Degree';
        $headers[] = 'Year Level';
        $headers[] = 'Email Address';
        $headers[] = 'Phone Number';
        $headers[] = 'Admission/Entrance Fees';
        $headers[] = 'Remarks (Passed/Failed)';


        foreach ($headers as $key => $header) {
            if ($key == 0)
                $widths[] = 10; //#
            elseif ($key == 1)
                $widths[] = 45; //Last Name
            elseif ($key == 2)
                $widths[] = 45; //Given Name
            elseif ($key == 3)
                $widths[] = 9; //Middle Initial
            elseif ($key == 4)
                $widths[] = 6; //Sex at Birth
            elseif ($key == 5)
                $widths[] = 29; //Birthdate
            elseif ($key == 6)
                $widths[] = 77; //Degree
            elseif ($key == 7)
                $widths[] = 8; //Year Level
            elseif ($key == 8)
                $widths[] = 35; //Email Address
            elseif ($key == 9)
                $widths[] = 18; //Phone Number
            elseif ($key == 10)
                $widths[] = 21; //Entrance/Admission Fees
            elseif ($key == 11)
                $widths[] = 17; //Entrance/Admission Fees
        }

        $pdf->SetWidths($widths);

        $alignments[] = 'L';
        $alignments[] = 'L';
        $alignments[] = 'L';
        $alignments[] = 'C';
        $alignments[] = 'C';
        $alignments[] = 'C';
        $alignments[] = 'C';
        $alignments[] = 'C';
        $alignments[] = 'C';
        $alignments[] = 'C';
        $alignments[] = 'R';
        $alignments[] = 'C';
        $pdf->SetAligns($alignments);
        $headerHeight = $pdf->GetY();
        $headerHeight = $pdf->GetY() - $headerHeight;
        $pdf->Row($headers, 3, $alignments,);

        // Compute Total TOSF
        $totalFees = 0;
        $total = count($grantees);
        $headerHeight = 20;
        $pagetitleheight = 30;
        $sequenceNumber = 1;
        foreach ($grantees as $index => $grantee) {
            if ($pdf->GetY() + 20 >= $pdf->GetPageBreakTrigger() && ($total - $index) * 3 + $headerHeight + $pagetitleheight <= $pdf->GetPageBreakTrigger() && $pdf->PageNo() == 1) {
                $pdf->AddPage('L');
                $pdf->Row($headers, 3, $alignments);
            } else if ($pdf->GetY() + 30 >= $pdf->GetPageBreakTrigger() && ($total - $index) * 3 + 300 + $headerHeight <= $pdf->GetPageBreakTrigger() && $pdf->PageNo() != 1) {
                $pdf->AddPage('L');
                $pdf->Row($headers, 3, $alignments);
            } else if ($pdf->GetY() + 3 >= $pdf->GetPageBreakTrigger()) {
                // Print headers if a new page will be created by adding a row
                $pdf->Row($headers, 3, $alignments);
            }
            //Sequence Number that start with '0'
            // $rowData = array_merge([sprintf('%05d', $sequenceNumber++)], array_values($grantee));
            $rowData = array_merge([$sequenceNumber++], array_values($grantee));
            $pdf->Row($rowData, 3, $alignments);
            // Calculate the sum of "TOTAL TOSF"
            $totalFees += (float) str_replace('', '', $grantee['admission_fees']);
        };

        // Display the Sum of TOTAL TOSF
        $pdf->SetFont('Arial', 'BI', 7);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->Cell(298, 5, 'TOTAL:', 0, 0, 'R', 0);
        $pdf->Cell(22, 5, number_format($totalFees, 2), 0, 0, 'R', 0);

        //signature
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetTextColor(0, 0, 0);
        $sigwidths = array($pagewidth_withborders / 3, $pagewidth_withborders / 3, $pagewidth_withborders / 3);
        $pdf->SetWidths($sigwidths);
        $pdf->SetY($pdf->GetPageHeight() - 50);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->RowWithBorder(array('Prepared & Certified By:', 'Certified By:', 'Approved By:'), 2, 'L', 0);
        $pdf->RowWithBorder(array('', '', ''), 10, 'C', 0);
        $pdf->RowWithBorder(array($signatories['prep1'], $signatories['cert1'], $signatories['cert2']), 3, 'C', 0);
        $pdf->RowWithBorder(array($signatories['pos_prep1'], $signatories['pos_cert1'], $signatories['pos_cert2']), 3, 'C', 0);

        $pdf->Output();
    }


}
