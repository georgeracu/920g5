<?php

class ApiController
{
    public $model;

    function __construct($pageURI = null) // constructor of the class
    {
        $this->model = new DBModel();
    }
    public function getJsonFromTable($tableName)
    {
        $this->model->getAllFromTable($tableName);
    }
}
