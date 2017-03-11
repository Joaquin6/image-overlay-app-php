<?php
// use Composer autoloader
require 'vendor/autoload.php';
\Slim\Slim::registerAutoloader();

// configure Slim application instance
$app = new \Slim\Slim();
$app->config(array(
  'debug' => true,
  'templates.path' => '.'
));

// index page handlers
$app->get('/', function () use ($app) {
  $app->redirect('/index');
});

$app->post('/add',  function () use ($app, $dbh) {
  $tdesc = $app->request->params('tdesc');
  $tdue = $app->request->params('tdue');
  if (!empty($tdesc) && !empty($tdue)) {
    $sth = $dbh->prepare("INSERT INTO tasks (tdesc, tdue) VALUES(:desc, :due)");
    $sth->execute(array(':desc' => $tdesc, ':due' => $tdue));
    $app->flash('success', 'Task successfully added.');
  } else {
    $app->flash('error', 'Please enter both description and date.');
  }
  $app->redirect('/index');
});

$app->run();

?>