<?php
    session_start();

    //Function to reset sessions for flash messages
    function reset_flashmsg_sessions($name, $message, $class) {  
        if ( isset($_SESSION[$name]) ) {
            unset($_SESSION[$name]);
        }
        if ( isset($_SESSION[$name.'_class']) ) {
            unset($_SESSION[$name.'_class']);
        }
        
        if ( isset($_SESSION['message']) ) {
            unset($_SESSION['message']);
        }
    }

    //Checks if the user is logged in
    function isLoggedIn() {
        if ( isset($_SESSION['user_id']) && isset($_SESSION['user_email']) && isset($_SESSION['user_name']) ) {
            return true;
        }
        else {
            return false;
        }
    }

    // Flash Messaging Function
    function flash($name = '', $message = '', $class = 'alert alert-success') {
        if ( !empty($message) ) {

            // unset sessions before setting a new value
            reset_flashmsg_sessions($name, $message, $class);

            //Create Session Variables
            $_SESSION[$name] = $name;
            $_SESSION['message'] = $message;
            $_SESSION[$name.'_class'] = $class;
        } 
        elseif( empty($message) && isset($_SESSION['message']) ) {
            //set the html code block
            echo "<div class='. $class . ' id='flash-msg'>" . $_SESSION['message'] . "</div>";
            // unset sessions after flashing messages
            reset_flashmsg_sessions($name, $message, $class);
        }
    }

?>