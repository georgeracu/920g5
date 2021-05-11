<?php

class NotFoundController
{
    public $load;
    public $model;

    function __construct($uri = null)
    {
        $this->model = new Model();
        $this->load = new Load();

        $data = $this->model->not_found($uri);
        header("HTTP/1.0 404 Not Found");
        $this->load->view('404', $data);
    }
}
