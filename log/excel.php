<?php 
require("../vendor/autoload.php");
require_once '../core/init.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$log_sql ="SELECT * FROM products";
$log_qry =mysqli_query($db,$log_sql);
$result=mysqli_fetch_all($log_qry,MYSQLI_ASSOC);
$spreadsheet = new Spreadsheet();
$sheet= $spreadsheet->getActiveSheet();
foreach($result as $item):
$counter= $item['id'];
$title = $item['title'];
$price= $item['price'];
$devprice =$item['deliveryprice'];
$store = $item['store'];
$categories= $item['categories'];
$description = $item['description'];
$featured= $item['featured'];
$deleted = $item['deleted'];
$sheet->setCellValue("A{$counter}","".$title."");
$sheet->setCellValue("B{$counter}","".$price."");
$sheet->setCellValue("C{$counter}","".$devprice."");
$sheet->setCellValue("D{$counter}","".$store."");
$sheet->setCellValue("E{$counter}","".$categories."");
$sheet->setCellValue("F{$counter}","".$description."");
$sheet->setCellValue("G{$counter}","".$featured."");
$sheet->setCellValue("H{$counter}","".$deleted."");
endforeach;
$writer = new Xlsx($spreadsheet);
$writer->save('log.xlsx');


