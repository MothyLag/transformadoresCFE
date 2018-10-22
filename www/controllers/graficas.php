<?php
$app->get("/get-grafica/",function () use($app){
  $meses = array(
  '01'=>'Enero',
  '02' => 'Febrero',
  '03' => 'Marzo',
  '04' => 'Abril',
  '05' => 'Mayo',
  '06' => 'Junio',
  '07' => 'Julio',
  '08' => 'Agosto',
  '09' => 'Septiembre',
  '10' => 'Octubre',
  '11' => 'Noviembre',
  '12' => 'Diciembre',
);
//echo json_encode($meses);
  $year = "'%/".$_GET['year']."'";
  //echo json_encode($data);
  $datos['general'] = array(0,0,0,0,0,0,0,0,0,0,0,0);
  $datos['chatarra'] = array(0,0,0,0,0,0,0,0,0,0,0,0);
  $datos['reha'] = array(0,0,0,0,0,0,0,0,0,0,0,0);
  $datos['almacen'] = array(0,0,0,0,0,0,0,0,0,0,0,0);
  $st=$app->db->prepare("SELECT fecha FROM retirado WHERE fecha LIKE $year");
  $st->setFetchMode(PDO::FETCH_OBJ);
  $st->execute();
  $data = $st->fetchAll();
  foreach ($data as $value) {
    $fecha = explode("/",$value->fecha);
    $mes = $fecha[1];
    $datos['general'][intval($mes)-1]++;
    //$label = $meses[$mes];
  }

  $st=$app->db->prepare("SELECT fecha FROM retirado WHERE fecha LIKE $year AND condiciones = 'CHATARRA'");
  $st->setFetchMode(PDO::FETCH_OBJ);
  $st->execute();
  $data = $st->fetchAll();
  foreach ($data as $value) {
    $fecha = explode("/",$value->fecha);
    $mes = $fecha[1];
    $datos['chatarra'][intval($mes)-1]++;
    //$label = $meses[$mes];
  }

  $st=$app->db->prepare("SELECT fecha FROM retirado WHERE fecha LIKE $year AND condiciones = 'REHA'");
  $st->setFetchMode(PDO::FETCH_OBJ);
  $st->execute();
  $data = $st->fetchAll();
  foreach ($data as $value) {
    $fecha = explode("/",$value->fecha);
    $mes = $fecha[1];
    $datos['reha'][intval($mes)-1]++;
    //$label = $meses[$mes];
  }

  $st=$app->db->prepare("SELECT fecha FROM retirado WHERE fecha LIKE $year AND condiciones = 'ALMACEN'");
  $st->setFetchMode(PDO::FETCH_OBJ);
  $st->execute();
  $data = $st->fetchAll();
  foreach ($data as $value) {
    $fecha = explode("/",$value->fecha);
    $mes = $fecha[1];
    $datos['almacen'][intval($mes)-1]++;
    //$label = $meses[$mes];
  }
  echo json_encode($datos);
})->name("get-grafica");
 ?>
