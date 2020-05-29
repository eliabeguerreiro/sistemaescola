<?php
session_start();
require ('dompdf/vendor/autoload.php');
$dompdf = new Dompdf\Dompdf;
$dompdf->loadhtml($_SESSION['html']);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream();
