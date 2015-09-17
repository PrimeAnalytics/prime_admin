<?php
require_once dirname(__FILE__) . '/Classes/PHPExcel/IOFactory.php';

$inputFileName = 'example.xlsx';
$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'HTML');
$objWriter->save('example.html');