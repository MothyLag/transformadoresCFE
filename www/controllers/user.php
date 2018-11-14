<?php
$app->get('/dashboard/',function() use($app) {
  $vista = $_GET['vista'];
  $view = 'add_form.twig';
  switch ($vista) {
    case 'inicio':
      $view = 'add_form.twig';
      break;

      case 'busqueda':
        $view = 'busqueda.twig';
        break;
      case 'graficas':
        $view = 'graficas.twig';
        break;
      case 'reporte':
        $view = 'reporte.twig';
        break;

    default:
      $view = 'add_form.twig';
      break;
  }
  return $app->render($view);
})->name('getdash');
$app->get('/search/',function () use($app){
  $rubro = $_GET['rubro'];
  $texto = $_GET['texto'];
  $datos['all'] = null;
  if($rubro == "tiempo" || $rubro == "mes"){
      $tiempo = "'%/".$_GET['texto']."'";
      $st = $app->db->prepare("SELECT r.id,r.fecha,r.ubicacion,r.responsable,r.num_circuito,r.causa,i.id idi,i.fecha fechai,i.ubicacion ubicacioni,i.responsable responsablei,i.num_circuito num_circuitoi ,i.causa causai FROM retirado AS r JOIN instalado AS i ON(r.id_instalado = i.id) WHERE fechai LIKE $tiempo ORDER BY(fechai)");
      $st->execute();
      $datos['all'] = $st->fetchAll();
  }else{
    $st = $app->db->prepare("SELECT r.id,r.fecha,r.ubicacion,r.responsable,r.num_circuito,r.causa,i.id idi,i.fecha fechai,i.ubicacion ubicacioni,i.responsable responsablei,i.num_circuito num_circuitoi ,i.causa causai FROM retirado AS r JOIN instalado AS i ON(r.id_instalado = i.id) WHERE r.$rubro = '$texto'");
    $st->setFetchMode(PDO::FETCH_OBJ);
    $st->execute();
    $datos['all'] = $st->fetchAll();
  }
  return $app->render('tabla.twig',$datos);
})->name('getsearch');

$app->get('/opciones/',function () use($app){
  $rubro = $_GET['rubro'];
  if ($rubro == "tiempo" || $rubro == "mes") {
    // code...
  }else{
    $st = $app->db->prepare("SELECT $rubro FROM retirado");
    $st->setFetchMode(PDO::FETCH_NUM);
    $st->execute();
    $data = $st->fetchAll();
    $st = $app->db->prepare("SELECT $rubro FROM instalado");
    $st->setFetchMode(PDO::FETCH_NUM);
    $st->execute();
    $data2 = $st->fetchAll();
    foreach ($data2 as $value) {
      array_push($data,$value);
    }
    $datos = array();
    for ($i=0; $i < count($data); $i++) {
      $datos[] = [$data[$i],$data[$i]];
    }
    echo json_encode($datos);
  }
})->name('getopciones');
?>
