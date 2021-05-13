<?php
class Load
{
	private $fragmentMap;

	public function __construct()
	{
		$this->fragmentMap = array(
			"about" => "generic",
			"statement-of-originality" => "generic",
			"references" => "generic",
			"coca-cola" => "drink",
			"sprite" => "drink",
			"dr-pepper" => "drink",
			"fanta" => "drink",
			"costa" => "drink",
			"georgia-coffee" => "drink"
		);
	}

	function view($file_name, $data = null)
	{
		if (is_array($data)) {
			extract($data);
		}
		include $file_name . '.php';
	}

	function viewFragment($fileName, $data = null)
	{
		if (is_array($data)) {
			extract($data);
		}
		if (array_key_exists($fileName, $this->fragmentMap)) {
			include 'fragment/' . $this->fragmentMap[$fileName] . '.php';
		} else {
			include 'fragment/' . $fileName . '.php';
		}
	}
}
