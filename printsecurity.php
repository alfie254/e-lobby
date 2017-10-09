<?php
require("db.php");

$result =mysqli_query($con,"SELECT id, username, email, trn_date FROM users");
$header =mysqli_query($con,"SELECT `` 
FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_SCHEMA`='register' 
    AND `TABLE_NAME`='visitors'");

require('fpdf/fpdf.php');
$pdf = new FPDF('P');
$pdf->AddPage();
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',16);
$pdf-> cell(160,20, "Security Print-Out",0,1,"C");
$pdf->SetFont('Arial','B',12);
$pdf->SetX(10);
$pdf->Cell(40,10,'Number',1,0,'C',1);
$pdf->Cell(40,10,'Username',1,0,'C',1);
$pdf->Cell(40,10,'email',1,0,'C',1);
$pdf->Cell(40,10,'Date/Time',1,0,'C',1);



foreach($result as $row) {
	$pdf->SetFont('Arial','',8);	
	$pdf->Ln();
	foreach($row as $column)
		$pdf->Cell(40,20,$column,1,0, "C");
}
$pdf->Output();
?>