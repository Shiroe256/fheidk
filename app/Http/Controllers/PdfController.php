<?php

namespace App\Http\Controllers;

use Fpdf\Fpdf;
use FPDFunifast;
use Illuminate\Http\Request;

require '../app/Libraries/FPDFscripts/FPDFunifast.php';
require '../vendor/autoload.php';

class PdfController extends Controller
{
    function computeCellHeight(Fpdf $pdf, $text, $cellWidth, $fontFamily = '', $fontSize = 0)
    {
        $pdf->SetFont($fontFamily, '', $fontSize);
        $cellHeight = ceil($pdf->GetStringWidth($text) / $cellWidth) * ($fontSize / 2);
        return $cellHeight;
    }

    public function generatePDF()
    {

        $pdf_data['term'] = "First";
        $pdf_data['ay'] = "2022";
        $pdf_data['date'] = "2023/1/12";
        $pdf_data['ref_no'] = 'XX - XXXXXX - 2018 - X - X';
        $pdf_data['college_name'] = '(Name of State / Local University or College)';
        $pdf_data['college_address'] = '(Address of State/ Local University or College)';
        $pdf_data['printed_name'] = "";

        // $this->generateForm1($pdf_data);
        $signatories['prep1'] = 'Jason A. Bahil';
        $signatories['cert1'] = 'Jason A. Bahil';
        $signatories['cert2'] = 'Jason A. Bahil';
        $signatories['appr'] = 'Jason A. Bahil';
        $signatories['pos_prep1'] = 'Project Technical Assistant III';
        $signatories['pos_cert1'] = 'Project Technical Assistant III';
        $signatories['pos_cert2'] = 'Project Technical Assistant III';
        $signatories['pos_appr'] = 'Project Technical Assistant III';

        $this->generateForm2($pdf_data, $signatories);

        exit;
    }

    private function generateForm1($pdf_data)
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
        $pdf->Cell($pdf->GetPageWidth() / 2 - 40, $cell_height, $pdf_data['printed_name'], 1, 0, "C");
        $pdf->Cell(30, $cell_height, "Printed Name", 1, 0, "C");
        $pdf->Cell($pdf->GetPageWidth() / 2 - 40, $cell_height, $pdf_data['printed_name'], 1, 1, "C");
        //signature
        $pdf->Cell(30, $cell_height, "Position", 1, 0, "C");
        $pdf->Cell($pdf->GetPageWidth() / 2 - 40, $cell_height, "", 1, 0, "C");
        $pdf->Cell(30, $cell_height, "Position", 1, 0, "C");
        $pdf->Cell($pdf->GetPageWidth() / 2 - 40, $cell_height, "", 1, 1, "C");
        //signature
        $pdf->Cell(30, $cell_height, "Date", 1, 0, "C");
        $pdf->Cell($pdf->GetPageWidth() / 2 - 40, $cell_height, "", 1, 0, "C");
        $pdf->Cell(30, $cell_height, "Date", 1, 0, "C");
        $pdf->Cell($pdf->GetPageWidth() / 2 - 40, $cell_height, "", 1, 1, "C");
        $pdf->Output();
    }

    private function generateForm2($pdf_data, $signatories)
    {
        // $pdf = new FPDFunifast();
        // $pdf = new FPDFunifast('L','mm',array(215.9,279.4));
        $pdf = new FPDFunifast('L', 'mm', array(215.9, 330.2));
        $pdf->AliasNbPages();
        $margin = 5;
        $pdf->SetMargins($margin, $margin, $margin);
        $pdf->SetFont('Arial', '', 10);
        $pdf->AddPage('L');

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
        // $pdf->Ln(10);
        $pdf->Cell(0, 5, 'TUITION AND OTHER SCHOOL FEES (Based on Section 7, Rule II of the IRR of RA 10931)', 1, 1, 'L', 0);
        //set font kasi maliit
        $pdf->SetFont('Arial', '', 6);
        //headers
        // $pdf->MultiCell(4, 4, '#', 1, 'C', 0);
        $pagetitleheight = $pdf->GetY() - $pagetitleheight;
        $pagewidth_withborders = $pdf->GetPageWidth() - $margin * 2;

        $headers[] = '#';
        $headers[] = 'Stud. Number';
        $headers[] = 'LRN';
        $headers[] = 'Last Name';
        $headers[] = 'Given Name';
        $headers[] = 'Middle Name';
        $headers[] = 'Degree Program';
        $headers[] = 'Year Level';
        $headers[] = 'Sex at Birth';
        $headers[] = 'E-mail address';
        $headers[] = 'Phone Number';
        $headers[] = 'Laboratory Units / subject';
        $headers[] = 'Computer Lab Units/Subject';
        $headers[] = 'Academic Units Enrolled (credit and non-credit courses)';
        $headers[] = 'Academic Units of NSTP Enrolled (credit and non-credit courses)';
        $headers[] = 'Tuition Fee based on enrolled academic units (credit and non-credit courses)';
        $headers[] = 'NSTP Fee based on enrolled academic units (credit and non-credit courses)';
        $headers[] = 'Athletic Fees';
        $headers[] = 'Computer Fees';
        $headers[] = 'Cultural Fees';
        $headers[] = 'Development Fees';
        $headers[] = 'Entrance/Admission Fees*';
        $headers[] = 'Guidance Fees';
        $headers[] = 'Handbook Fees';
        $headers[] = 'Laboratory Fees';
        $headers[] = 'Library Fee';
        $headers[] = 'Medical and Dental Fees';
        $headers[] = 'Registration Fees';
        $headers[] = 'School ID Fees';
        $headers[] = 'TOTAL TOSF';

        foreach ($headers as $key => $header) {
            if ($key == 0)
                $widths[] = 4;
            elseif ($key == 1)
                $widths[] = 10;
            elseif ($key == 2)
                $widths[] = 8;
            elseif ($key == 3)
                $widths[] = 13;
            elseif ($key == 4)
                $widths[] = 13;
            elseif ($key == 11)
                $widths[] = 10;
            elseif ($key == 12)
                $widths[] = 10;
            elseif ($key == 13)
                $widths[] = 12;
            elseif ($key == 14)
                $widths[] = 12;
            elseif ($key == 15)
                $widths[] = 13;
            elseif ($key == 16)
                $widths[] = 12;
            elseif ($key == 18)
                $widths[] = 11;
            else
                $widths[] = $pagewidth_withborders / count($headers);
        }
        $pdf->SetWidths($widths);
        $headerHeight = $pdf->GetY();
        $pdf->Row($headers, 3, 'l');
        $headerHeight = $pdf->GetY() - $headerHeight;
        //content
        foreach ($headers as $header)
            $sample[] = '';

        // $lastpage = $pdf->PageNo();
        //prints the signature at the bottom always and cuts the page if there are no records in the signature page so laging may records na kasama ung signature
        $total = 87;
        for ($i = 0; $i < $total; $i++) {
            if ($pdf->GetY() + 32 >= $pdf->GetPageBreakTrigger() && ($total - $i) * 3 + $headerHeight + $pagetitleheight <= $pdf->GetPageBreakTrigger() && $pdf->PageNo() == 1) {
                $pdf->AddPage('L');
                $pdf->Row($headers, 3, 'l');
            } else if ($pdf->GetY() + 32 >= $pdf->GetPageBreakTrigger() && ($total - $i) * 3 + 10 + $headerHeight <= $pdf->GetPageBreakTrigger() && $pdf->PageNo() != 1) {
                $pdf->AddPage('L');
                $pdf->Row($headers, 3, 'l');
            } else if ($pdf->GetY() + 3 >= $pdf->GetPageBreakTrigger()) {
                //print headers if a new page will be created by adding a row
                $pdf->Row($headers, 3, 'l');
            }
            $pdf->Row($sample, 3, 'l');
        }

        //signature
        $sigwidths = array($pagewidth_withborders / 4, $pagewidth_withborders / 4, $pagewidth_withborders / 4, $pagewidth_withborders / 4);
        $pdf->SetWidths($sigwidths);
        $pdf->SetY($pdf->GetPageHeight() - 52);
        $pdf->RowWithBorder(array('Prepared By:', 'Certified By:', 'Certified By:', 'Approved By:'), 3, 'L', 0);
        $pdf->RowWithBorder(array('', '', '', ''), 20, 'C', 0);
        $pdf->RowWithBorder(array($signatories['prep1'], $signatories['cert1'], $signatories['cert2'], $signatories['appr']), 3, 'C', 0);
        $pdf->RowWithBorder(array($signatories['pos_prep1'], $signatories['pos_cert1'], $signatories['pos_cert2'], $signatories['pos_appr']), 5, 'C', 0);

        $pdf->Output();
    }
}
