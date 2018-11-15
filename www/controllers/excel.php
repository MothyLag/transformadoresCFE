<?php
$app->get('/get-excel/',function () use($app){
  //echo json_encode($_GET);
  $fecha = getdate();
  $mes = $fecha['mon']-1;
  $inicio = explode('/',$_GET['inicio']);
  $fin = explode('/', $_GET['fin']);
  $i = $inicio[2].$inicio[1].$inicio[0];
  $f = $fin[2].$fin[1].$fin[0];
  //$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
  $inputFileName = './plantillas/plantilla1.xls';
  $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
  $sheet = $spreadsheet->getActiveSheet();
  $st = $app->db->prepare("SELECT r.id,r.fecha,r.ubicacion,r.responsable,r.num_circuito,r.causa,r.coordenadas,r.marca,r.capacidad,r.fases,r.voltmed,r.voltbaj,r.no_serie,r.no_econo,r.tipo,r.tipo2,r.aceite,r.peso,r.causadan,r.clavedan,r.condiciones,i.marca marcai,i.capacidad capacidadi,i.fases fasesi,i.voltmed voltmedi,i.voltbaj voltbaji,i.no_serie no_seriei,i.no_econo no_econoi,i.tipo tipoi,i.tipo2 tipo2i,i.aceite aceitei,i.peso pesoi,i.causa causai FROM instalado AS i JOIN retirado AS r ON(r.id_instalado = i.id) WHERE substr(r.fecha,7)||substr(r.fecha,4,2)||substr(r.fecha,1,2) between ? and ?");
  $st->setFetchMode(PDO::FETCH_OBJ);
  $st->execute(array($i,$f));
  $data = $st->fetchAll();
  $i = 11;
  foreach($data as $value){
    //$sheet->getCell('D'.$i)->setValue($value->id);
    //$sheet->getStyle('A'.$i)->getAlignment()->setWrapText(true);
    $sheet->getCell('D'.$i)->setValue($value->no_econo);
    // $sheet->getStyle('B'.$i)->getAlignment()->setWrapText(true);
    $sheet->getCell('E'.$i)->setValue($value->no_serie);
    // $sheet->getStyle('C'.$i)->getAlignment()->setWrapText(true);
    $sheet->getCell('I'.$i)->setValue($value->fases);
    // $sheet->getStyle('G'.$i)->getAlignment()->setWrapText(true);
    $sheet->getCell('J'.$i)->setValue($value->tipo." ".$value->tipo2);
    // $sheet->getStyle('H'.$i)->getAlignment()->setWrapText(true);
    $sheet->getCell('K'.$i)->setValue($value->marca);
    // $sheet->getStyle('I'.$i)->getAlignment()->setWrapText(true);
    $sheet->getCell('M'.$i)->setValue($value->condiciones);
    // $sheet->getStyle('K'.$i)->getAlignment()->setWrapText(true);
    $sheet->getCell('N'.$i)->setValue($value->causa);
    // $sheet->getStyle('L'.$i)->getAlignment()->setWrapText(true);
    $sheet->getCell('O'.$i)->setValue($value->coordenadas);
    // $sheet->getStyle('M'.$i)->getAlignment()->setWrapText(true);
    $sheet->getCell('P'.$i)->setValue($value->ubicacion);
    // $sheet->getStyle('N'.$i)->getAlignment()->setWrapText(true);
    $sheet->getCell('Q'.$i)->setValue($value->fecha);
    // $sheet->getStyle('O'.$i)->getAlignment()->setWrapText(true);
    $i++;
  }

  $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
  header('Content-Description: File Transfer');
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment; filename="file.xlsx"');
  return $writer->save("php://output");
})->name('get-excel');

$app->get('/get-excel2/',function () use($app){
  //echo json_encode($_GET);
  $fecha = getdate();
  $mes = $fecha['mon']-1;
  $inicio = explode('/',$_GET['inicio']);
  $fin = explode('/', $_GET['fin']);
  $i = $inicio[2].$inicio[1].$inicio[0];
  $f = $fin[2].$fin[1].$fin[0];
  //$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
  $inputFileName = './plantillas/plantilla1.xls';
  $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
  $sheet = $spreadsheet->getActiveSheet();
  $st = $app->db->prepare("SELECT r.id,r.fecha,r.ubicacion,r.responsable,r.num_circuito,r.causa,r.coordenadas,r.marca,r.capacidad,r.fases,r.voltmed,r.voltbaj,r.no_serie,r.no_econo,r.tipo,r.tipo2,r.aceite,r.peso,r.causadan,r.clavedan,r.condiciones,i.marca marcai,i.capacidad capacidadi,i.fases fasesi,i.voltmed voltmedi,i.voltbaj voltbaji,i.no_serie no_seriei,i.no_econo no_econoi,i.tipo tipoi,i.tipo2 tipo2i,i.aceite aceitei,i.peso pesoi,i.causa causai FROM instalado AS i JOIN retirado AS r ON(r.id_instalado = i.id) WHERE substr(r.fecha,7)||substr(r.fecha,4,2)||substr(r.fecha,1,2) between ? and ?");
  $st->setFetchMode(PDO::FETCH_OBJ);
  $st->execute(array($i,$f));
  $data = $st->fetchAll();
  $i = 11;
  foreach($data as $value){
    //$sheet->getCell('D'.$i)->setValue($value->id);
    //$sheet->getStyle('A'.$i)->getAlignment()->setWrapText(true);
    $sheet->getCell('D'.$i)->setValue($value->no_econo);
    // $sheet->getStyle('B'.$i)->getAlignment()->setWrapText(true);
    $sheet->getCell('E'.$i)->setValue($value->no_serie);
    // $sheet->getStyle('C'.$i)->getAlignment()->setWrapText(true);
    $sheet->getCell('I'.$i)->setValue($value->fases);
    // $sheet->getStyle('G'.$i)->getAlignment()->setWrapText(true);
    $sheet->getCell('J'.$i)->setValue($value->tipo." ".$value->tipo2);
    // $sheet->getStyle('H'.$i)->getAlignment()->setWrapText(true);
    $sheet->getCell('K'.$i)->setValue($value->marca);
    // $sheet->getStyle('I'.$i)->getAlignment()->setWrapText(true);
    $sheet->getCell('M'.$i)->setValue($value->condiciones);
    // $sheet->getStyle('K'.$i)->getAlignment()->setWrapText(true);
    $sheet->getCell('N'.$i)->setValue($value->causa);
    // $sheet->getStyle('L'.$i)->getAlignment()->setWrapText(true);
    $sheet->getCell('O'.$i)->setValue($value->coordenadas);
    // $sheet->getStyle('M'.$i)->getAlignment()->setWrapText(true);
    $sheet->getCell('P'.$i)->setValue($value->ubicacion);
    // $sheet->getStyle('N'.$i)->getAlignment()->setWrapText(true);
    $sheet->getCell('Q'.$i)->setValue($value->fecha);
    // $sheet->getStyle('O'.$i)->getAlignment()->setWrapText(true);
    $i++;
  }

  $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
  header('Content-Description: File Transfer');
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment; filename="file.xlsx"');
  return $writer->save("php://output");
})->name('get-excel2');
?>
