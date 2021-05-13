<?php
require 'view/load.php';
require 'model/model.php';
require 'model/db_model.php';
require 'controller/controller.php';
require 'controller/not_found_controller.php';
require 'controller/db_controller.php';
require 'controller/ApiController.php';

$pageURI = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$queryString = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);

$substrLength = 17;

$pageURI = substr($pageURI, $substrLength);

var_dump($pageURI . " | " . $queryString);

$dbController = new DBController();
$apiController = new ApiController();

if (!$pageURI)
	new Controller('home');
else if ($pageURI == 'api/get-json')
	new Controller('apiGetJson');
else if ($pageURI == 'createJson')
	new Controller('createJson');
else if ($pageURI == 'api/get-flickr-service')
	new Controller('getFlickerService');
else if ($pageURI == 'api/get-fragment')
	Controller::getFragment($queryString);
else if ($pageURI == 'api/db/create')
	$dbController->apiCreateTable();
else if ($pageURI == 'api/db/truncate')
	$dbController->truncateDatabase();
else if ($pageURI == 'api/db/seed')
	$dbController->apiInsertData();
else if ($pageURI == 'api/get-data')
	$dbController->apiGetData();
else if ($pageURI == 'api/db/drop')
	$dbController->dropDatabase();
else if ($pageURI == 'api/get-spa-page')
	$dbController->getSPAPage($queryString);
else if ($pageURI == 'api/get-json-from-table')
	$apiController->getJsonFromTable($queryString);
else
	new NotFoundController($pageURI);
