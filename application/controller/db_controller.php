<?php
class DBController
{
    public $load;
    public $model;

    // Create functions for the controller class
    function __construct($pageURI = null) // constructor of the class
    {
        $this->load = new Load();
        $this->model = new Model();
    }

    function apiCreateTable()
    {
        // echo "Create table function";
        $data = $this->model->dbCreateTable();
        $this->load->view('viewMessage', $data);
    }
    function apiInsertData()
    {
        $data = $this->model->dbInsertData();
        $this->load->view('viewMessage', $data);
    }
    function apiGetData()
    {
        $data = $this->model->dbGetData();
        $this->load->view('view3DAppData', $data);
    }
}
