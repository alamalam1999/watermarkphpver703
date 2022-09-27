<?php
require('rotation.php');

class PDF extends PDF_Rotate
{
    protected $_outerText1; // dynamic text
    protected $_outerText2;

    function setWaterText($txt1 = "", $txt2 = "")
    {
        $this->_outerText1 = $txt1;
        $this->_outerText2 = $txt2;
    }

    function Header()
    {
        //Put the watermark
        $this->SetFont('Arial', 'B', 70);
        $this->SetTextColor(255, 192, 203);
        $this->SetAlpha(0.5);
        $this->RotatedText(55, 180, $this->_outerText1, 45);
        $this->RotatedText(75, 190, $this->_outerText2, 45);
        // $this->Image('fpdf/myoldfhoto.jpg', 0, 0);
        $this->Image('fpdf/myoldfhoto.jpg', 160, 240, 30, 40, 'JPG', '');
    }

    function RotatedText($x, $y, $txt, $angle)
    {
        //Text rotated around its origin
        $this->Rotate($angle, $x, $y);
        $this->Text($x, $y, $txt);
        $this->Rotate(0);
    }

    // Page footer

}

class PDFF extends FPDF
{
    // Page header

}

$file = "fpdf/SPK_Pengadaan_Server1.pdf"; // path: file name
$pdf = new PDF();

//$pdf->AddPage();
if (file_exists($file)) {
    $pagecount = $pdf->setSourceFile($file);
} else {
    return FALSE;
}

$pdf->setWaterText("DO NOT COPY", "");

/* loop for multipage pdf */
for ($i = 1; $i <= $pagecount; $i++) {
    $tpl = $pdf->importPage($i);
    $pdf->addPage();
    $pdf->useTemplate($tpl, 1, 1, 0, 0, TRUE);
}


//$pdf->SetMargins(10, 60, 10);
//$pdf->AliasNbPages();

// $pdf->SetFont('Times', '', 12);
// for ($i = 1; $i <= 40; $i++)
//     $pdf->Cell(0, 10, 'This is line number ' . $i, 0, 1);

$pdf->Output(); //specify path filename to save or keep as it is to view in browser
