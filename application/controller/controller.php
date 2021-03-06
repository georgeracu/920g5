<?php
include './debug/ChromePhp.php';
ChromePhp::log('controller.php: Hello World');
ChromePhp::log($_SERVER);

// Create the controller class for the MVC design pattern
class Controller
{

	// Declare public variables for the controller class
	public $load;
	public $model;

	// Create functions for the controller class
	function __construct($pageURI = null) // constructor of the class
	{
		$this->load = new Load();
		$this->model = new Model();
		// determine what page you are on
		$this->$pageURI();
	}
	// home page function
	function home()
	{
		$data = $this->model->model3D_info();
		// $this->load->view('view3DAppTest_2', $data);
		$this->load->view('home', $data);
	}

	public static function getFragment($fragmentName)
	{
		// $model = new Model();
		// $data = $model->getDataForPage($fragmentName);
		$data = array("alertMessage" => "");
		$load = new Load();
		$load->viewFragment($fragmentName, $data);
	}

	// API call to read JSON data from a JSON file
	function apiGetJson()
	{
		$this->load->view('viewJson');
	}

	// API call to select 3D images
	function apiLoadImage()
	{
		// Get the brand data from the (this) Model using the dbGetBrand() meyhod in this Model class	
		ChromePhp::warn('controller.php: [apiLoadImage] Get the Brand data');
		$data = $this->model->dbGetBrand();
		// Note, the viewDrinks.php view being loaded here calls a new model
		// called modelDrinkDetails.php, which is not part of the Model class
		// It is a separate model illustrating that you can have many models
		ChromePhp::log($data);
		$this->load->view('viewDrinks', $data);
	}
}
