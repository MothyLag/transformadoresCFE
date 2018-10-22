<?php
$app->get("/getPagina/",function () use($app){
    $pagina = $_GET['pagina'];
    switch($pagina){
        case 1:
            return $app->render("regform/form1.twig");
            break;
        case 2:
            return $app->render("regform/form2.twig");
            break;
        case 3:
            return $app->render("regform/form3.twig");
            break;
    }
})->name('getPagina');

$app->post("/registrar/",function () use($app){
  $instalado = array();
  $retirado = array();
  foreach ($_POST['instalado'] as $value) {
    $instalado[] = $value;
  }
  foreach ($_POST['retirado'] as $value) {
    $retirado[] = $value;
  }
  $sql2 = "INSERT INTO retirado(id_instalado,fecha,ubicacion,responsable,num_circuito,causa,coordenadas,marca,capacidad,fases,voltmed,voltbaj,no_serie,no_econo,tipo,tipo2,aceite,peso,causadan,clavedan,condiciones) VALUES (last_insert_rowid(),?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  $st = $app->db->prepare("INSERT INTO instalado(fecha,ubicacion,responsable,num_circuito,causa,coordenadas,marca,capacidad,fases,voltmed,voltbaj,no_serie,no_econo,tipo,tipo2,aceite,peso,condiciones) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
  $st->execute($instalado);
  $st2 = $app->db->prepare($sql2);
  $st2->execute($retirado);
  //var_dump($st->debugDumpParams());
})->name('registrar');

$app->get("/get-verm/",function () use($app){
  $id = $_GET['id'];
  $tabla = $_GET['tabla'];
  $st = $app->db->prepare("SELECT * FROM $tabla WHERE id = ?");
  $st->setFetchMode(PDO::FETCH_OBJ);
  $st->execute(array($id));
  $select = $st->fetch();
  $data['all'] = $select;
  return $app->render("modals/verm.twig",$data);
})->name('getverm');

$app->get("/get-edit/",function () use($app){
  $id = $_GET['id'];
  $tabla = $_GET['tabla'];
  $st = $app->db->prepare("SELECT * FROM $tabla WHERE id = ?");
  $st->setFetchMode(PDO::FETCH_OBJ);
  $st->execute(array($id));
  $select = $st->fetch();
  $data['all'] = $select;
  return $app->render("modals/editar.twig",$data);
})->name('getedit');

$app->post("/update-retirado/",function () use($app){
  $data = [];
  foreach ($_POST as $value) {
    $data[] = $value;
  }
  $st = $app->db->prepare("UPDATE retirado SET fecha = ?,ubicacion = ?,responsable = ?,num_circuito = ?,causa = ?,coordenadas = ?,marca = ?,capacidad = ?,fases = ?,voltmed = ?,voltbaj = ?,no_serie = ?,no_econo = ?,aceite = ?,peso = ?,causadan = ?,clavedan = ?,condiciones = ? WHERE id=?");
  $st->execute($data);
})->name('update-retirado');

$app->post("/update-instalado/",function () use($app){
  $data = [];
  foreach ($_POST as $value) {
    $data[] = $value;
  }
  $st = $app->db->prepare("UPDATE instalado SET fecha = ?,ubicacion = ?,responsable = ?,num_circuito = ?,causa = ?,coordenadas = ?,marca = ?,capacidad = ?,fases = ?,voltmed = ?,voltbaj = ?,no_serie = ?,no_econo = ?,aceite = ?,peso = ?,condiciones = ? WHERE id=?");
  $st->execute($data);
})->name('update-instalado');

$app->post("/eliminar/",function () use($app){
  $id = $_POST['id'];
  $tabla = $_POST['tabla'];
  if($tabla == "instalado"){
    $st = $app->db->prepare("DELETE FROM instalado WHERE id = ?");
    $st->execute(array($id));
    $st = $app->db->prepare("DELETE FROM retirado WHERE id_instalado = ?");
    $st->execute(array($id));
  }else{
    $st = $app->db->prepare("SELECT id_instalado FROM retirado WHERE id=?");
    $st->setFetchMode(PDO::FETCH_OBJ);
    $st->execute(array($id));
    $idi = $st->fetch();
    $st = $app->db->prepare("DELETE FROM instalado WHERE id = ?");
    $st->execute(array($idi->id_instalado));
    $st = $app->db->prepare("DELETE FROM retirado WHERE id = ?");
    $st->execute(array($id));
  }
})->name('eliminar');

$app->get("/getcharts/",function () use($app){
  return $app->render('charts.twig');
})->name('loadcharts');
?>
