<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';

$has_db = function ($app) {
  return function () use ($app) {
    if(is_null($app->db)){
      return $app->redirect($app->urlFor('500'),500);
    } else {
      return true;
    }
  };
};

$app->get('/',function() use($app) {
  $app->render("land.twig");
})->name('home');

$app->get('/500/', function() use($app){
  $app->render('errors/500.twig');
})->name('500');


# Include Controllers here
include_once CONTROLLERS_DIR.'user.php';
include_once CONTROLLERS_DIR.'graficas.php';
include_once CONTROLLERS_DIR.'paginas.php';
$app->run();

?>
