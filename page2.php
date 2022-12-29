<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('PDF_Rotate.php');


$fontPath = getcwd().'/reports_templates/fonts/';
$path = getcwd().'/reports_templates/2.png';
$gaugeCursor = getcwd().'/reports_templates/cursor-final.png';
//$gaugeCursor = getcwd().'/reports_templates/test3cursor.png';

define('FPDF_FONTPATH', $fontPath);


// DATA variables here

$overall_score_percentage = 0;

$fitness_madam_percentage = 60;
$fitness_mister_percentage = 40;

$nutritional_madam_percentage = 90;
$nutritional_mister_percentage = 100;



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
$pdf->SetFont('MontserratLight','',8);
$pdf->SetY(27);
$pdf->Cell(0,5,iconv('UTF-8', 'windows-1252', "Recorded on XX/XX/XXXX"), 0, 0, 'C');

$pdf->SetFont('MontserratLight','',16);
$pdf->SetY(40);
$pdf->Cell(0,5,iconv('UTF-8', 'windows-1252', "Overall Score"), 0, 0, 'C');


// Overall score
$pdf->SetFont('MontserratBold','',20);
$pdf->Text(99,80, $overall_score_percentage."%");
// Gauge
$percentG1 = $overall_score_percentage; // percentage variable
$angle = (233/100)*$percentG1;
$angle = 208 - $angle;
$x_origin = 106;
$y_origin = 80;
$pdf->Rotate($angle, $x_origin,$y_origin);
$pdf->Image($gaugeCursor, $x_origin, $y_origin, 31, 2);

// for($i=-25;$i<215;$i=$i+1){
//     $pdf->Rotate($i,$x_origin,$y_origin);
//     $pdf->Image($gaugeCursor, $x_origin, $y_origin, 31, 2);
// }
$pdf->Rotate(0);

$pdf->SetFont('MontserratSemiBold','',12);

writeScoreSentence($pdf, $pdf->GetPageWidth()/2-33.5, 90, '100');

// ========= Fitness and metabolism

$pdf->setXY(90,115);
$pdf->MultiCell(30,5,"Fitness and metabolism",0,'C');


// Mister Gauge

$pdf->setXY(135,130);
$pdf->Cell(10,5,'Mister');

$pdf->SetFont('MontserratSemiBold','',15);
$pdf->SetXY(110, 160);
$pdf->Cell(67,5,$fitness_mister_percentage."%", 0, 0, 'C');
$fitnessG_mister = $fitness_mister_percentage; // percentage variable
$angle = (227/100)*$fitnessG_mister;
$angle = 206 - $angle;
$x_origin = 143;
$y_origin = 164;
$pdf->Rotate($angle, $x_origin,$y_origin);
$pdf->Image($gaugeCursor, $x_origin, $y_origin, 22, 2);
$pdf->Rotate(0);
$pdf->SetFont('MontserratSemiBold','',12);
writeScoreSentence($pdf, 33, 175, 'XX');

// Madam Gauge
$pdf->setXY(58,130);
$pdf->Cell(10,5,'Madam');

$pdf->SetFont('MontserratSemiBold','',15);
$pdf->setXY(34,160);
$pdf->Cell(67,5,$fitness_madam_percentage."%", 0, 0, 'C');
$fitnessG_madam = $fitness_madam_percentage; // percentage variable
$angle = (227/100)*$fitnessG_madam;
$angle = 206 - $angle;
$x_origin = 67;
$y_origin = 164;

$pdf->Rotate($angle, $x_origin,$y_origin);
$pdf->Image($gaugeCursor, $x_origin, $y_origin, 22, 2);
$pdf->Rotate(0);
$pdf->SetFont('MontserratSemiBold','',12);
writeScoreSentence($pdf, 110, 175, 'XX');


// ========= Nutritional balance

$pdf->SetFont('MontserratSemiBold','',12);
$pdf->setXY(90,205);
$pdf->MultiCell(32,5,"Nutritional balance",0,'C');


// Mister Gauge

$pdf->setXY(135,215);
$pdf->Cell(10,5,'Mister');

$pdf->SetFont('MontserratSemiBold','',15);
$pdf->SetXY(110, 245);
$pdf->Cell(67,5,$nutritional_mister_percentage."%", 0, 0, 'C');

$fitnessG_mister = $nutritional_mister_percentage; 
$angle = (227/100)*$fitnessG_mister;
$angle = 206 - $angle;
$x_origin = 143;
$y_origin = 248;
$pdf->Rotate($angle, $x_origin,$y_origin);
$pdf->Image($gaugeCursor, $x_origin, $y_origin, 22, 2);
$pdf->Rotate(0);
$pdf->SetFont('MontserratSemiBold','',12);
writeScoreSentence($pdf, 110, 260, 'XX');

// Madam Gauge

$pdf->setXY(58,215);
$pdf->Cell(10,5,'Madam');
$pdf->SetFont('MontserratSemiBold','',15);
$pdf->setXY(34,245);
$pdf->Cell(67,5,$nutritional_madam_percentage."%", 0, 0, 'C');
$nutritionalG_madam = $nutritional_madam_percentage; 
$angle = (227/100)*$nutritionalG_madam;
$angle = 206 - $angle;
$x_origin = 67;
$y_origin = 248;
$pdf->Rotate($angle, $x_origin,$y_origin);
$pdf->Image($gaugeCursor, $x_origin, $y_origin, 22, 2);
$pdf->Rotate(0);
$pdf->SetFont('MontserratSemiBold','',12);
writeScoreSentence($pdf, 33, 260, 'XX');


$pdf->Output('I', 'page2.pdf');

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