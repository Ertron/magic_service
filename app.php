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
                "scenario_id": "1",
                "popup_id": "1",
                "steps": [
                    {
                      "step_id": "1",
                      "parameter": 10
                    },
                    {
                      "step_id": "2",
                      "parameter": 50
                    }

                ]
        }',
		'{
                "scenario_id": "2",
                "popup_id": "1",
                "steps": [
                    {
                      "step_id": "1",
                      "parameter": 20
                    },
                    {
                      "step_id": "2",
                      "parameter": 30
                    }

                ]
        }',
		'{
                "scenario_id": "3",
                "popup_id": "1",
                "steps": [
                    {
                      "step_id": "1",
                      "parameter": 80
                    },
                    {
                      "step_id": "3",
                      "parameter": 0
                    }

                ]
        }',
		'{
                "scenario_id": "4",
                "popup_id": "5",
                "steps": [
                    {
                      "step_id": "1",
                      "parameter": 60
                    }
                ]
        }');
	$response = new Response($content[array_rand($content, 1)], 200);
	$response->headers->set('Access-Control-Allow-Origin', '*');
	$response->headers->set('Content-Type', 'application/json');
	return $response;

})->bind('index');


$app->run();