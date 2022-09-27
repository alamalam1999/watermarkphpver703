<?php

require('fpdf/fpdf.php');
$pdf = new FPDF();

$pdf->AddPage();
$pdf->Image('fpdf/myoldfhoto.jpg', 10, 30, 150, 50, 'JPG', 'www.avicenna.com');
//$pdf->Output();
