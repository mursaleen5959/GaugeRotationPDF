<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('PDF_Rotate.php');


$fontPath = getcwd().'/reports_templates/fonts/';
$path = getcwd().'/reports_templates/3.png';
$field_img = getcwd().'/reports_templates/input_group.png';
$gaugeCursor = getcwd().'/reports_templates/cursor-final.png';
//$gaugeCursor = getcwd().'/reports_templates/test3cursor.png';

define('FPDF_FONTPATH', $fontPath);


// =================
$pdf = new PDF_Rotate();

$pdf->AddFont('MontserratLight', '', "Montserrat-Light.php");
$pdf->AddFont('MontserratRegular', '', "Montserrat-Regular.php");
$pdf->AddFont('MontserratSemiBold', '', "Montserrat-SemiBold.php");
$pdf->AddFont('MontserratBold', '', "Montserrat-Bold.php");

$pdf->AddPage();
$pdf->Image($path, 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());
$pdf->SetTextColor(0,0,0);

// Recorded on
$pdf->SetFont('MontserratBold','',10);
$pdf->SetY(27);
$pdf->Cell(0,5,iconv('UTF-8', 'windows-1252', "Data recorded on:"), 0, 0, 'C');
$pdf->Ln();
$pdf->SetFont('MontserratSemiBold','',10);
//$pdf->SetY(27);
$pdf->Cell(0,5,iconv('UTF-8', 'windows-1252', "05/03/2022 - 14:57"), 0, 0, 'C');


$pdf->SetFont('MontserratRegular','',10);
$y_axis = 60;
$x_axis = 60;

$pdf->setXY($x_axis,$y_axis);
$pdf->Image($field_img, $x_axis, $y_axis, 90,15);
$pdf->Cell(33,10,"vitamin E alpha", 0, 0, 'C');
$pdf->Cell(23,10,"100", 0, 0, 'R');
$pdf->Cell(30,10,"centimeters", 0, 0, 'C');
$y_axis += 13;
$pdf->setXY($x_axis,$y_axis);
$pdf->Image($field_img, $x_axis, $y_axis, 90,15);
$pdf->Cell(33,10,"vitamin E alpha", 0, 0, 'C');
$pdf->Cell(23,10,"100", 0, 0, 'R');
$pdf->Cell(30,10,"centimeters", 0, 0, 'C');
$y_axis += 13;
$pdf->setXY($x_axis,$y_axis);
$pdf->Image($field_img, $x_axis, $y_axis, 90,15);
$pdf->Cell(33,10,"vitamin E alpha", 0, 0, 'C');
$pdf->Cell(23,10,"100", 0, 0, 'R');
$pdf->Cell(30,10,"centimeters", 0, 0, 'C');
$y_axis += 13;
$pdf->setXY($x_axis,$y_axis);
$pdf->Image($field_img, $x_axis, $y_axis, 90,15);
$pdf->Cell(33,10,"vitamin E alpha", 0, 0, 'C');
$pdf->Cell(23,10,"100", 0, 0, 'R');
$pdf->Cell(30,10,"centimeters", 0, 0, 'C');

$pdf->Output('I', 'page4.pdf');
?>