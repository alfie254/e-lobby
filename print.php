<?php
require("db.php");
$search = $_POST['creteria'];

$result =mysqli_query($con,"SELECT id, fname, lname, idnum, typ, dept, staff, trn_date, user, approved FROM visitors WHERE day='$search' OR fname ='$search' OR lname ='$search' OR idnum ='$search' OR user ='$search' ORDER BY Id DESC");
$header =mysqli_query($con,"SELECT `` 
FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_SCHEMA`='register' 
    AND `TABLE_NAME`='visitors'");

require('fpdf/fpdf.php');
$pdf = new FPDF('L');
$pdf->AddPage();
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',16);
$pdf-> cell(250,20, "Visitor Print-Out",0,1,"C");
$pdf-> cell(50,10, "Search Creteria : {$search}",0,1);
$pdf->SetFont('Arial','B',12);
$pdf->SetX(10);
$pdf->Cell(28,10,'Number',1,0,'C',1);
$pdf->Cell(28,10,'First Name',1,0,'C',1);
$pdf->Cell(28,10,'Last Name',1,0,'C',1);
$pdf->Cell(28,10,'ID No.',1,0,'C',1);
$pdf->Cell(28,10,'Type',1,0,'C',1);
$pdf->Cell(28,10,'Department',1,0,'C',1);
$pdf->Cell(28,10,'Staff',1,0,'C',1);
$pdf->Cell(28,10,'Date/Time',1,0,'C',1);
$pdf->Cell(28,10,'Signed-in By',1,0,'C',1);
$pdf->Cell(28,10,'Approved',1,0,'C',1);



foreach($result as $row) {
	$pdf->SetFont('Arial','',8);	
	$pdf->Ln();
	foreach($row as $column)
		$pdf->Cell(28,10,$column,1,0, "C");
}
$pdf->Output();
?>

