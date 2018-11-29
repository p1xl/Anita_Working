<?php 
 require('./vendor/autoload.php');
 $qr = new Endroid\QrCode\QrCode();
 $qr->setText('Find us on instagram: anita facebook: facebook/anita.com');
 $qr->setSize('100');
 $qr->setMargin('10');
 header('Content-Type: '.$qr->getContentType());
 echo $qr->writeString();