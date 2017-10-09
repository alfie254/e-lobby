<?php

$fname=$_POST['fname'];
$lname=$_POST['lname'];
$idnum=$_POST['idnum'];
$typ=$_POST['typ'];
$dept=$_POST['dept'];
$staff=$_POST['staff'];



$picname=$_FILES['image']['tmp_name'];




require('fpdf/fpdf.php');
$pdf= new fpdf('P', 'mm', array(120,145));
$pdf-> AddPage();
$pdf-> SetFont("Arial", "", 25);
$pdf-> cell(100,10, "VISITOR'S BADGE",1,1,"C");

$pdf-> image("$picname",30,20,60,40,'jpg');

$pdf-> cell(50,10, "",0,1);
$pdf-> cell(50,10, "",0,1);
$pdf-> cell(50,10, "",0,1);
$pdf-> cell(50,10, "",0,1);

$pdf-> SetFont("Arial", "", 13);
$pdf-> cell(50,10, "Name:",1,0);
$pdf-> cell(50,10, "{$fname}",1,1);



$pdf-> cell(50,10, "Last Name:",1,0);
$pdf-> cell(50,10, "{$lname}",1,1);

$pdf-> cell(50,10, "Id Number:",1,0);
$pdf-> cell(50,10, "{$idnum}",1,1);

$pdf-> cell(50,10, "Type:",1,0);
$pdf-> cell(50,10, "{$typ}",1,1);

$pdf-> cell(50,10, "Department:",1,0);
$pdf-> cell(50,10, "{$dept}",1,1);

$pdf-> cell(50,10, "Staff:",1,0);
$pdf-> cell(50,10, "{$staff}",1,1);

$pdf-> output();


?>