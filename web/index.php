<?php; 
//require('../vendor/autoload.php');

curl -X GET -G \
  'https://api.foursquare.com/v2/venues/search' \
    -d client_id="2BQU5RNR31YWW5UXL0UQ3BGDT04ZRZOOLH5Z454K5NJOMFNX" \
    -d client_secret="2YKLYMCCYNYTIW4JLD3TJYE2LDB2YHRBKXDQR45GK5PYOCCB" \
    -d v="20170801" \
    -d query="pizzeria" \
    -d near="bergamo" \
    -d limit=40 \
    -d intent="checkin" 



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
