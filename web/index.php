<?php
echo("Mostra pizzerie in Bergamo");
//require('../vendor/autoload.php');


/ create curl resource 
$ch = curl_init(); 

// set url 
curl_setopt($ch, CURLOPT_URL, "https://api.foursquare.com/v2/venues/search?v=20161016&near=bergamo&query=pizzeria&intent=checkin&client_id=2BQU5RNR31YWW5UXL0UQ3BGDT04ZRZOOLH5Z454K5NJOMFNX&client_secret=2YKLYMCCYNYTIW4JLD3TJYE2LDB2YHRBKXDQR45GK5PYOCCB"); 

//return the transfer as a string 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

// $output contains the output string 
$output = curl_exec($ch); 

// close curl resource to free up system resources 
curl_close($ch);  

echo "<br><br>".$output;



$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Register view rendering
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Our web handlers

$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig');
});

$app->run();
