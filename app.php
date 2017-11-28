<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$autoload = require_once __DIR__.'/vendor/autoload.php';
$autoload->add('api\\', __DIR__);
$autoload->register();

$app = new Silex\Application();

$app['debug'] = true;

$app->register(new \Silex\Provider\TwigServiceProvider(), array(
	'twig.path' => __DIR__ . '/view',
));

$app->register(new \Silex\Provider\DoctrineServiceProvider(), array(
	'db.options' => array(
		'driver'    => 'pdo_mysql',
		'host'      => 'localhost',
		'dbname'    => 'register_service',
		'user'      => 'root',
		'password'  => '',
		'charset'   => 'utf8',
	)
));


$app->get('/', function() use ($app) {
	$content = array(
		'{
                "id": "1",
                "popup_id": "1",
                "steps": [
                    {
                      "step_id": "1",
                      "parameters": 10
                    },
                    {
                      "step_id": "2",
                      "parameters": 50
                    }

                ]
        }',
		'{
                "id": "2",
                "popup_id": "1",
                "steps": [
                    {
                      "step_id": "1",
                      "parameters": 20
                    },
                    {
                      "step_id": "2",
                      "parameters": 30
                    }

                ]
        }',
		'{
                "id": "3",
                "popup_id": "1",
                "steps": [
                    {
                      "step_id": "1",
                      "parameters": 80
                    },
                    {
                      "step_id": "3",
                      "parameters": 0
                    }

                ]
        }');
	$response = new Response($content[array_rand($content, 1)], 200);
	$response->headers->set('Access-Control-Allow-Origin', '*');
	$response->headers->set('Content-Type', 'application/json');
	return $response;

})->bind('index');


$app->run();