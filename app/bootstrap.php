<?php
//load config file

require_once 'config/config.php';

//load helpers
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';

//load libraries here

// require_once 'libraries/Controller.php';
// require_once 'libraries/Core.php';
// require_once 'libraries/Database.php';

//instead of loading on by one like above we created the method below to load it automatically.


//autoload core libraries 
spl_autoload_register(function ($className) {

    require_once 'libraries/' . $className . '.php';
});

//With this above method we replace all manual libraries entries mean this function will automatically load 
//libraries if any new librarie made in libraraies class