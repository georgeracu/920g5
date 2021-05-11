<?php
require 'view/load.php';
require 'model/model.php';
require 'controller/controller.php';
require 'controller/not_found_controller.php';
require 'controller/db_controller.php';
$pageURI = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$queryString = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);

$substrLength = 17;

$pageURI = substr($pageURI, $substrLength);

var_dump($pageURI . "|" . $queryString);

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
else if ($pageURI == 'api/create-table')
	new DBController('apiCreateTable');
else if ($pageURI == 'api/insert-data')
	new DBController('apiInsertData');
else if ($pageURI == 'api/get-data')
	new DBController('apiGetData');
else
	new NotFoundController($pageURI);
