<?php 
require("./pdf/fpdf.php");
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont("Arial","B",16);
    $pdf->Cell(0,20,'Terms & Conditions',10,1,'C');
    $pdf->Cell(0,10,'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit necessitatibus amet veniam ',10,1,'C');
    $pdf->Cell(0,10,"aspernatur! Facilis totam ad inventore autem commodi quis natus porro molestiae impedit ",10,1,'C');
    $pdf->Cell(0,10," obcaecati blanditiis necessitatibus quo fugit eligendi laudantium, repellat, pariatur od",10,1,'C');
    $pdf->Cell(0,10,"similique dolore tempore",10,1,'C');
    $pdf->output();




