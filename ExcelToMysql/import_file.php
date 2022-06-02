<?php
include 'db.php';

$uploadfile=$_FILES['uploadfile']['tmp_name'];
require 'PHPExcel/Classes/PHPExcel.php';
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';

$objExcel=PHPExcel_IOFactory::load($uploadfile);
foreach($objExcel->getWorksheetIterator() as $worksheet)
$id=null;
{
	$highestrow=$worksheet->getHighestRow();

	for($row=2;$row<=$highestrow;$row++)
	{
		$moisture_reading=$worksheet->getCellByColumnAndRow(0,$row)->getValue();
		$discount_factor=$worksheet->getCellByColumnAndRow(1,$row)->getValue();


		if($moisture_reading!='')
		{
			$insertqry="INSERT INTO moisture_table(moisture_reading,discount_factor) 
            VALUES ('$moisture_reading','$discount_factor')";

			$insertres=mysqli_query($con,$insertqry);
		}
	}
}
?>