<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('PDF_Rotate.php');


$fontPath = getcwd().'/reports_templates/fonts/';
$path = getcwd().'/reports_templates/1.png';
$gaugeCursor = getcwd().'/reports_templates/cursor-final.png';
//$gaugeCursor = getcwd().'/reports_templates/test3cursor.png';

define('FPDF_FONTPATH', $fontPath);


// DATA variables Here

$overall_percentage     = 77;
$nutritional_percentage = 43;
$fitness_percentage     = 94;

// =================

$pdf = new PDF_Rotate();

$pdf->AddFont('MontserratLight', '', "Montserrat-Light.php");
$pdf->AddFont('MontserratRegular', '', "Montserrat-Regular.php");
$pdf->AddFont('MontserratSemiBold', '', "Montserrat-SemiBold.php");
$pdf->AddFont('MontserratBold', '', "Montserrat-Bold.php");

$pdf->AddPage();
$pdf->Image($path, 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());
$pdf->SetTextColor(7,0,101);

// Recorded on
$pdf->SetFont('MontserratLight','',10);
$pdf->SetY(30);
$pdf->Cell(0,5,iconv('UTF-8', 'windows-1252', "Recorded on XX/XX/XXXX"), 0, 0, 'C');

$pdf->SetFont('MontserratLight','',14);
$pdf->SetY(80);
$pdf->Cell(0,5,iconv('UTF-8', 'windows-1252', "Overall Score"), 0, 0, 'C');


// Overall score
$pdf->SetFont('MontserratBold','',20);
$pdf->Text(99,120, $overall_percentage."%");

// Gauge
$percentG1 = $overall_percentage; // percentage variable
$angle = (235/100)*$percentG1;
$angle = 210 - $angle;
$x_origin = 106;
$y_origin = 118;
$pdf->Rotate($angle, $x_origin,$y_origin);
$pdf->Image($gaugeCursor, $x_origin, $y_origin, 31, 2);
$pdf->Rotate(0);

$pdf->SetFont('MontserratSemiBold','',12);
writeScoreSentence($pdf, $pdf->GetPageWidth()/2-33.5, 130, '100');


// Nutritional balance
$pdf->setXY(52,165);
$pdf->MultiCell(30,5,"Nutritional balance",0,'C');
$pdf->SetFont('MontserratSemiBold','',15);
$pdf->setXY(34,203);
$pdf->Cell(67,5,$nutritional_percentage."%", 0, 0, 'C');
// Gauge

$percentG2 = $nutritional_percentage; // percentage variable
$angle = (227/100)*$percentG2;
$angle = 206 - $angle;
$x_origin = 67;
$y_origin = 205;

$pdf->Rotate($angle, $x_origin,$y_origin);
$pdf->Image($gaugeCursor, $x_origin, $y_origin, 22, 2);
$pdf->Rotate(0);

$pdf->SetFont('MontserratSemiBold','',12);
writeScoreSentence($pdf, 33, 218, 'XX');

// Fitness and metabolism
$pdf->setXY(127,165);
$pdf->MultiCell(30,5,"Fitness and metabolism",0,'C');
$pdf->SetFont('MontserratSemiBold','',15);
$pdf->SetXY(110, 203);
$pdf->Cell(67,5,$fitness_percentage."%", 0, 0, 'C');
// Gauge

$percentG3 = $fitness_percentage; // percentage variable
$angle = (227/100)*$percentG3;
$angle = 206 - $angle;
$x_origin = 143;
$y_origin = 205;

$pdf->Rotate($angle, $x_origin,$y_origin);
$pdf->Image($gaugeCursor, $x_origin, $y_origin, 22, 2);

// for($i=-23;$i<210;$i=$i+1){
//     $pdf->Rotate($i, $x_origin,$y_origin);
//     $pdf->Image($gaugeCursor, $x_origin, $y_origin, 22, 2);
// }
$pdf->Rotate(0);
$pdf->SetFont('MontserratSemiBold','',12);
writeScoreSentence($pdf, 110, 218, 'XX');

$pdf->Output('I', 'page1.pdf');

function writeScoreSentence($pdf, $x, $y, $score){

    $sentence = 'sentence';
    if(strpos($sentence, ' ') !== false){
        /** 2 LINES PRINT */
        $pdf->SetXY($x, $y);
        $pdf->Cell(67,5, iconv('UTF-8', 'windows-1252', explode(' ', $sentence)[0]), 0, 0, 'C');
        $pdf->SetXY($x, $y+5);
        $pdf->Cell(67,5, iconv('UTF-8', 'windows-1252', explode(' ', $sentence)[1]), 0, 0, 'C');
    }else{
        /** 1 LINE PRINT */
        $pdf->SetXY($x, $y);
        $pdf->Cell(67,5, iconv('UTF-8', 'windows-1252', $sentence), 0, 0, 'C');
    }
}

?>