@php
use Barryvdh\DomPDF\Facade as PDF;

function exportPDF() {
    $pdf = app('dompdf.wrapper');
    $pdf->loadHTML('<h1>Styde.net</h1>');

    return $pdf->download('mi-archivo.pdf');
}

exportPDF();   

/*
$dompdf = new Facade();
dd(PDF);
$dompdf->loadHtml('<h1>Hola mundo</h1><br><a href="https://parzibyte.me/blog">By Parzibyte</a>');
$dompdf->render();
$contenido = $dompdf->output();
$nombreDelDocumento = "1_hola.pdf";
$bytes = file_put_contents($nombreDelDocumento, $contenido);*/
@endphp