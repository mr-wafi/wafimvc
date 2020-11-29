<?php

/*
 * Base Controller mean this is the main page for controller all models and views are controlled from here.
 * loads the models and views
 */

class Controller
{
    //load model 
    function model($model)
    {
        //require model file
        require_once '../app/models/' . $model . '.php';
        //Create instance of recived model the below method will return whatever method we pass
        //if we pass user then it will be like new $user() if we pass post it will be new post() 
        //model is the reciver of model or class 
        return new $model();
        //return the model what ever we pass to controller will be reutrn here as below

    }

    //load views
    function views($views, $data = [])
    {
        //check if view file exist in view folder
        if (file_exists('../app/views/' . $views . '.php')) {
            require_once '../app/views/' . $views . '.php';
        } else {
            //view file dose not exist
            die("view file dose not exist");
        }
    }
}
// in main controller class we just have two files one is model or class another is view so these two filse
//are related to controller