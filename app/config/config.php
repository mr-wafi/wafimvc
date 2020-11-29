<?php

//DB PARAMS
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'khanoo');
define('DB_NAME', 'sharedposts');



//app root
//IN APPROOT we saved our file location so we can access our file location via APPROOT which we define BELOW
define('APPROOT', dirname(dirname(__FILE__)));

//URL ROOT, this we use for links when we have links from views then we will be using this url root not app root.
define('URLROOT', 'http://localhost/wafimvc');

//Site Name
define('SITENAME', 'SharedPost');

//app version
define('APPVERSION', '1.0.1');
