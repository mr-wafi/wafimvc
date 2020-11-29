<?php

//this will be ruls for url 
/*
* App Core Class
* Creates URL & loads core controller
* URL FORMAT - /controller/method/params
*/

class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    function __construct()
    {
        // print_r($this->getUrl());

        $url = $this->getUrl();

        //look in controllers for first value

        if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            //if exist set as controller
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        } else {
            $this->currentController;
        }

        //require the controller 
        require_once '../app/controllers/' . $this->currentController . '.php';


        //creating instance of the controller class
        $this->currentController = new $this->currentController;

        //checking for the second part of the url which should be method 
        if (isset($url[1])) {
            //check if method exist in controller,controller mean class check if method exist in class
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];

                //unset url here
                unset($url[1]);
            }
        }

        // //geting parameters from url,
        $this->params = $url ? array_values($url) : [];

        // //call a callback with an array of parameters
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/'); //this will strip the url and will check if there is backslash at the end 
            $url = filter_var($url, FILTER_SANITIZE_URL); //this will filter url for other symbols
            $url = explode('/', $url); //this method will break the url into an array
            return $url;
        }
    }
}
