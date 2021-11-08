@php
use App\Http\Controllers\AsistenciaController; 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
//$sheet = $spreadsheet->getActiveSheet();
/*$sheet->setCellValue('A1', 'Cargando sistemas !');

$writer = new Xlsx($spreadsheet);
$writer->save('hello world.xlsx');
*/

$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('hello world.xlsx');
$worksheet = $spreadsheet->getActiveSheet();

$worksheet->getCell('A3')->setValue('John');
$worksheet->getCell('A4')->setValue('Smith');

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('write.xls');
@endphp