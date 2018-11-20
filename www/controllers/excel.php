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
  $st = $app->db->prepare("SELECT r.id,r.fecha,r.ubicacion,r.responsable,r.num_circuito,r.causa,r.coordenadas,r.marca,r.capacidad,r.fases,r.voltmed,r.voltbaj,r.no_serie,r.no_econo,r.tipo,r.tipo2,r.aceite,r.peso,r.causadan,r.clavedan,r.condiciones,r.f_fab,i.marca marcai,i.capacidad capacidadi,i.fases fasesi,i.voltmed voltmedi,i.voltbaj voltbaji,i.no_serie no_seriei,i.no_econo no_econoi,i.tipo tipoi,i.tipo2 tipo2i,i.aceite aceitei,i.peso pesoi,i.causa causai,i.f_fab f_fabi,i.condiciones condicionesi FROM instalado AS i JOIN retirado AS r ON(r.id_instalado = i.id) WHERE substr(r.fecha,7)||substr(r.fecha,4,2)||substr(r.fecha,1,2) between ? and ? AND (r.causa = 'Creacion de area nueva' OR r.causa='Movimiento en red') ");
  $st->setFetchMode(PDO::FETCH_OBJ);
  $st->execute(array($i,$f));
  $data = $st->fetchAll();
  $i = 11;
  if(empty($data)){
    $sheet->getCell('C'.$i)->setValue('No se encontro ningún registro coincidente');
    $sheet->getStyle('C'.$i)->getAlignment()->setWrapText(false);
  }else{
    foreach($data as $value){
      //$sheet->getStyle('A'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('C'.$i)->setValue('retirado');
      $sheet->getCell('D'.$i)->setValue($value->no_econo);
      // $sheet->getStyle('B'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('E'.$i)->setValue($value->no_serie);
      $sheet->getCell('F'.$i)->setValue($value->capacidad);
      $sheet->getCell('G'.$i)->setValue($value->voltmed);
      // $sheet->getStyle('C'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('I'.$i)->setValue($value->fases);
      $sheet->getCell('H'.$i)->setValue($value->f_fab);
      // $sheet->getStyle('G'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('J'.$i)->setValue($value->tipo." ".$value->tipo2);
      // $sheet->getStyle('H'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('K'.$i)->setValue($value->marca);
      // $sheet->getStyle('I'.$i)->getAlignment()->setWrapText(true);
      //$sheet->getCell('M'.$i)->setValue($value->condiciones);
      // $sheet->getStyle('K'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('N'.$i)->setValue($value->causa);
      $sheet->getStyle('N'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('O'.$i)->setValue($value->coordenadas);
      // $sheet->getStyle('M'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('P'.$i)->setValue($value->ubicacion);
      // $sheet->getStyle('N'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('Q'.$i)->setValue($value->fecha);
      // $sheet->getStyle('O'.$i)->getAlignment()->setWrapText(true);
      $i++;
      $sheet->getCell('C'.$i)->setValue("instalado");
      $sheet->getCell('D'.$i)->setValue($value->no_econoi);
      // $sheet->getStyle('B'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('E'.$i)->setValue($value->no_seriei);
      $sheet->getCell('F'.$i)->setValue($value->capacidadi);
      $sheet->getCell('G'.$i)->setValue($value->voltmedi);
      // $sheet->getStyle('C'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('I'.$i)->setValue($value->fasesi);
      $sheet->getCell('H'.$i)->setValue($value->f_fabi);
      // $sheet->getStyle('G'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('J'.$i)->setValue($value->tipoi." ".$value->tipo2i);
      // $sheet->getStyle('H'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('K'.$i)->setValue($value->marcai);
      // $sheet->getStyle('I'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('M'.$i)->setValue($value->condicionesi);
      // $sheet->getStyle('K'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('N'.$i)->setValue($value->causai);
      $sheet->getStyle('N'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('O'.$i)->setValue($value->coordenadas);
      // $sheet->getStyle('M'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('P'.$i)->setValue($value->ubicacion);
      // $sheet->getStyle('N'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('Q'.$i)->setValue($value->fecha);
      $i++;
    }
  }

  $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
  header('Content-Description: File Transfer');
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment; filename="anexo3.xlsx"');
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
  $inputFileName = './plantillas/plantilla2.xls';
  $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
  $sheet = $spreadsheet->getActiveSheet();
  $st = $app->db->prepare("SELECT r.f_rep,r.id,r.fecha,r.ubicacion,r.responsable,r.num_circuito,r.causa,r.coordenadas,r.marca,r.capacidad,r.fases,r.voltmed,r.voltbaj,r.no_serie,r.no_econo,r.tipo,r.tipo2,r.aceite,r.peso,r.causadan,r.clavedan,r.condiciones,r.f_fab,i.marca marcai,i.capacidad capacidadi,i.fases fasesi,i.voltmed voltmedi,i.voltbaj voltbaji,i.no_serie no_seriei,i.no_econo no_econoi,i.tipo tipoi,i.tipo2 tipo2i,i.aceite aceitei,i.peso pesoi,i.causa causai,i.f_fab f_fabi,i.condiciones condicionesi,i.f_rep f_repi FROM instalado AS i JOIN retirado AS r ON(r.id_instalado = i.id) WHERE substr(r.fecha,7)||substr(r.fecha,4,2)||substr(r.fecha,1,2) between ? and ? AND r.causa='Transformador dañado'");
  $st->setFetchMode(PDO::FETCH_OBJ);
  $st->execute(array($i,$f));
  $data = $st->fetchAll();
  $i = 12;
  if(empty($data)){
    $sheet->getCell('C'.$i)->setValue('No se encontro ningún registro coincidente');
    $sheet->getStyle('C'.$i)->getAlignment()->setWrapText(false);
  }else{
    foreach($data as $value){
      //$sheet->getStyle('A'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('C'.$i)->setValue('retirado');
      $sheet->getCell('D'.$i)->setValue($value->no_econo);
      // $sheet->getStyle('B'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('E'.$i)->setValue($value->no_serie);
      $sheet->getCell('F'.$i)->setValue($value->capacidad);
      $sheet->getCell('G'.$i)->setValue($value->voltmed);
      // $sheet->getStyle('C'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('I'.$i)->setValue($value->fases);
      $sheet->getCell('H'.$i)->setValue($value->f_fab);
      // $sheet->getStyle('G'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('J'.$i)->setValue($value->tipo." ".$value->tipo2);
      // $sheet->getStyle('H'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('K'.$i)->setValue($value->marca);
      // $sheet->getStyle('I'.$i)->getAlignment()->setWrapText(true);
      //$sheet->getCell('M'.$i)->setValue($value->condiciones);
      // $sheet->getStyle('K'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('S'.$i)->setValue($value->f_rep);
      $sheet->getStyle('S'.$i)->getAlignment()->setWrapText(false);

      $sheet->getCell('W'.$i)->setValue($value->coordenadas);
      // $sheet->getStyle('M'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('X'.$i)->setValue($value->ubicacion);
      $sheet->getStyle('X'.$i)->getAlignment()->setWrapText(false);
      $sheet->getCell('O'.$i)->setValue($value->fecha);
      $sheet->getStyle('O'.$i)->getAlignment()->setWrapText(false);
      $i++;
      $sheet->getCell('C'.$i)->setValue("instalado");
      $sheet->getCell('D'.$i)->setValue($value->no_econoi);
      // $sheet->getStyle('B'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('E'.$i)->setValue($value->no_seriei);
      $sheet->getCell('F'.$i)->setValue($value->capacidadi);
      $sheet->getCell('G'.$i)->setValue($value->voltmedi);
      // $sheet->getStyle('C'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('I'.$i)->setValue($value->fasesi);
      $sheet->getCell('H'.$i)->setValue($value->f_fabi);
      // $sheet->getStyle('G'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('J'.$i)->setValue($value->tipoi." ".$value->tipo2i);
      // $sheet->getStyle('H'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('K'.$i)->setValue($value->marcai);
      // $sheet->getStyle('I'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('S'.$i)->setValue($value->f_repi);
      $sheet->getStyle('S'.$i)->getAlignment()->setWrapText(false);

      $sheet->getCell('W'.$i)->setValue($value->coordenadas);
      // $sheet->getStyle('M'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('X'.$i)->setValue($value->ubicacion);
      $sheet->getStyle('X'.$i)->getAlignment()->setWrapText(false);
      $sheet->getStyle('Z'.$i)->getAlignment()->setWrapText(true);
      $sheet->getCell('O'.$i)->setValue($value->fecha);
      $sheet->getStyle('O'.$i)->getAlignment()->setWrapText(false);
      $i++;
    }
  }

  $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
  header('Content-Description: File Transfer');
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment; filename="anexo4.xlsx"');
  return $writer->save("php://output");
})->name('get-excel2');

?>
