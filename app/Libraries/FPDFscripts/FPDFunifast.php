<?php

use Fpdf\Fpdf;

require '../vendor/autoload.php';
class FPDFunifast extends Fpdf
{
    public function getRightMargin()
    {
        return $this->rMargin;
    }

    public function Header()
    {
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(0, 5, 'FORM 1', 0, 1, 'R', 0);
        // $this->Cell(0, 5, 'Republic of the Philippines', 0, 1, 'C', 0);
        // $this->Cell(0, 5, '(Name of State / Local University or College)', 0, 1, 'C', 0);
        // $this->Cell(0, 5, '(Address of State/ Local University or College)', 0, 1, 'C', 0);
        // $this->Cell(0, 5, 'CONSOLIDATED FREE HE BILLING DETAILS', 0, 1, 'C', 0);
        // // Line break
        // $this->Ln(10);
    }

    function Footer()
    {
        $this->SetFont('Arial','',8);
        $this->SetY(-10);
        $this->cell(0,5, 'Page ' . $this->PageNo() . ' of {nb}',0,1,'R');
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

    function GetPageBreakTrigger(){
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
