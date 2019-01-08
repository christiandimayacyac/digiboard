<?php

    // Load config
    require_once 'config/config.php';

    // Load helpers
    require_once 'helpers/utilities_helper.php';
    require_once 'helpers/session_helper.php';
    require_once 'helpers/url_helper.php';

    // Automatic Library Loader 
    spl_autoload_register(function($classname){
        require_once 'libraries/' . $classname . '.php';
    });

?>
