<?php
require_once dirname(__FILE__).'/../core/init.php';
if(!is_logged_in()){
	 login_error_redirect();
}
include 'includes/head.php';
include 'includes/navigation.php';
require_once  '../vendor/phpoffice/phpexcel/Classes/PHPExcel.php';
$log = '../log/log.xlsx';
// reads from a xlsx file
$reader = PHPExcel_IOFactory::createReaderForFile($log);
$excel = $reader->load($log);
$worksheet = $excel->getSheet(0);
$lastrow = $worksheet->getHighestRow();
?>
<div class="text-center">
<div class='col-md-10 offset-md-1 pt-2 pb-2 col-sm-12 col-xs-12'>
<div class='card rounded shadow'>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Title</th>
      <th scope="col">Price</th>
      <th scope="col">Deliverprice</th>
      <th scope="col">Store</th>
      <th scope="col">Categories</th>
      <th scope="col">Description</th>
      <th scope="col">Featured</th>
    </tr>
  </thead>
  <tbody>
  <?php for($row =1; $row<=$lastrow; $row++){?>
    <tr>
      <th scope="row">
      <?php echo $worksheet->getCell("A{$row}")->getValue()?></th>
      <td><?php echo $worksheet->getCell("B{$row}")->getValue()?></td>
      <td><?php echo $worksheet->getCell("C{$row}")->getValue()?></td>
      <td><?php echo $worksheet->getCell("D{$row}")->getValue()?></td>
      <td><?php echo $worksheet->getCell("E{$row}")->getValue()?></td>
      <td><?php echo $worksheet->getCell("F{$row}")->getValue()?></td>
      <td><?php echo $worksheet->getCell("G{$row}")->getValue()?></td>
      <td><?php echo $worksheet->getCell("H{$row}")->getValue()?></td>
    </tr>
  <?php }?>
  </tbody>
</table>
</div>
</div>
 </div>