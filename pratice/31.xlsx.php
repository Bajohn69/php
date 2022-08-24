<?php

$name = isset($_GET['n'])? $_GET['n']:'泥豪';

require './../vendor/autoload.php';
// 位置很重要!!!!

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello World !');
$sheet->setCellValue('B2', $name);

$writer = new Xlsx($spreadsheet);
$writer->save('hello_world.xlsx');

echo 'Okay';