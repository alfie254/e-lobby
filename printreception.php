<?php
require("db.php");

$result =mysqli_query($con,"SELECT id, username, email, dept, trn_date FROM receptionist");
$header =mysqli_query($con,"SELECT `` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='register' AND `TABLE_NAME`='staff'");

require('fpdf/fpdf.php');
$pdf = new FPDF('L');
$pdf->AddPage();
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',16);
$pdf-> cell(225,20, "Receptionist Print-Out",0,1,"C");
$pdf->SetFont('Arial','B',12);
$pdf->SetX(10);
$pdf->Cell(45,10,'Number',1,0,'C',1);
$pdf->Cell(45,10,'username',1,0,'C',1);
$pdf->Cell(45,10,'Email',1,0,'C',1);
$pdf->Cell(45,10,'Department',1,0,'C',1);
$pdf->Cell(45,10,'Date/Time',1,0,'C',1);




foreach($result as $row) {
    $pdf->SetFont('Arial','',10);    
    $pdf->Ln();
    foreach($row as $column)
        $pdf->Cell(45,10,$column,1,0, "C");
}
$pdf->Output();
?>