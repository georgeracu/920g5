<?php
class DBController
{
    public $load;
    public $model;

    // Create functions for the controller class
    function __construct($pageURI = null) // constructor of the class
    {
        $this->load = new Load();
        $this->model = new DBModel();
    }

    function apiCreateTable()
    {
        $data = array("alertMessage" => $this->model->createTables());
        $this->load->viewFragment('db_admin', $data);
    }
    function apiInsertData()
    {
        $data = array("alertMessage" => $this->model->dbInsertData());
        $this->load->viewFragment('db_admin', $data);
    }
    function apiGetData()
    {
        $data = $this->model->dbGetData();
        $this->load->view('view3DAppData', $data);
    }

    function truncateDatabase()
    {
        $data = array("alertMessage" => $this->model->truncateDatabase());
        $this->load->viewFragment('db_admin', $data);
    }

    function dropDatabase()
    {
        $data = array("alertMessage" => $this->model->dropDatabase());
        $this->load->viewFragment('db_admin', $data);
    }

    function getSPAPage($pageName)
    {
        $data = $this->model->getSPAPage($pageName);
        $this->load->viewFragment($pageName, $data);
    }

    function getFragment($fragmentName)
    {
        $this->load->viewFragment($fragmentName);
    }
}
