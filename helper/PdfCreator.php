<?php
require_once ("./vendor/dompdf/autoload.inc.php");

use Dompdf\Dompdf;
class PdfCreator
{
    public function create($html){
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A3', "landscape");
        $dompdf->render();
        $dompdf->stream("Reporte-Mistery-Quiz", ['Attachment' => 0]);
    }

}