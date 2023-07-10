<?php

use Fpdf\Fpdf;

require '../vendor/autoload.php';
class FPDFunifast extends Fpdf
{
    public $currentCourse;
    public $isLast = false;
    public $signatories;
    public function getRightMargin()
    {
        return $this->rMargin;
    }

    public function Header()
    {
        //set font kasi maliit
        $this->SetFont('Arial', '', 6);
        //headers
        if ($this->PageNo() != 1) {
            $this->Cell(0, 5, $this->currentCourse, 1, 1);
            $pagetitleheight = $this->GetY();
            $margin = 5;
            $pagetitleheight = $this->GetY() - $pagetitleheight;
            $pagewidth_withborders = $this->GetPageWidth() - $margin * 2;


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

            $this->SetWidths($widths);

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
            $this->SetAligns($alignments);
            $headerHeight = $this->GetY();
            $headerHeight = $this->GetY() - $headerHeight;
            $this->Row($headers, 3, $alignments);
            // $this->Cell(0, 5, $this->currentCourse, 1, 1);
            // $this->Row(array($this->currentCourse),3,array('L'));
        }
    }

    function Footer()
    {
        if ($this->isLast) {
            $signatories = $this->signatories;
            $pagewidth_withborders = $this->GetPageWidth() - 5 * 2;
            $this->SetFont('Arial', '', 8);
            $this->SetTextColor(0, 0, 0);
            $sigwidths = array($pagewidth_withborders / 4, $pagewidth_withborders / 4, $pagewidth_withborders / 4, $pagewidth_withborders / 4);
            $this->SetWidths($sigwidths);
            $this->SetY($this->GetPageHeight() - 50);
            $this->Ln();
            $this->Ln();
            $this->RowWithBorder(array('Prepared By:', 'Certified By:', 'Certified By:', 'Approved By:'), 2, 'L', 0);
            $this->RowWithBorder(array('', '', '', ''), 10, 'C', 0);
            $this->RowWithBorder(array(strtoupper($signatories['prep1']), strtoupper($signatories['cert1']), strtoupper($signatories['cert2']), strtoupper($signatories['appr'])), 3, 'C', 0);
            $this->RowWithBorder(array(strtoupper($signatories['pos_prep1']), strtoupper($signatories['pos_cert1']), strtoupper($signatories['pos_cert2']), strtoupper($signatories['pos_appr'])), 3, 'C', 0);
        }
        $this->SetFont('Arial', '', 8);
        $this->SetY(-10);
        $this->cell(0, 5, 'Page ' . $this->PageNo() . ' of {nb}', 0, 1, 'R');
    }

    protected $widths;
    protected $aligns;

    function SetWidths($w)
    {
        // Set the array of column widths
        $this->widths = $w;
    }

    function SetAligns($a)
    {
        // Set the array of column alignments
        $this->aligns = $a;
    }

    function GetPageBreakTrigger()
    {
        return $this->PageBreakTrigger;
    }
    function Row($data, $lineheight, $a)
    {
        // Calculate the height of the row
        $nb = 0;
        // $lineheight = 3;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = $lineheight * $nb;
        // Issue a page break first if needed
        $this->CheckPageBreak($h);
        // Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : $a;
            // Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            // Draw the border
            $this->Rect($x, $y, $w, $h);
            // Print the text
            $this->MultiCell($w, $lineheight, $data[$i], 0, $a);
            // Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        // Go to the next line
        $this->Ln($h);
    }
    function RowWithBorder($data, $lineheight, $a, $border = 0)
    {
        // Calculate the height of the row
        $nb = 0;
        // $lineheight = 3;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = $lineheight * $nb;
        // Issue a page break first if needed
        $this->CheckPageBreak($h);
        // Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : $a;
            // Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            // Draw the border
            // $this->Rect($x, $y, $w, $h);
            // Print the text
            $this->MultiCell($w, $lineheight, $data[$i], $border, $a);
            // Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        // Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h)
    {
        // If the height h would cause an overflow, add a new page immediately
        if ($this->GetY() + $h > $this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w, $txt)
    {
        // Compute the number of lines a MultiCell of width w will take
        if (!isset($this->CurrentFont))
            $this->Error('No font has been set');
        $cw = $this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', (string) $txt);
        $nb = strlen($s);
        if ($nb > 0 && $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }
}
