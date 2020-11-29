<?php

session_start();
//flash message helper

//example of flash message -  flash('register_success, 'you are now register);
// flash is function register_success is name and you are now register is alert message

function flash($name = '', $message = '', $class = 'alert alert-success')
{
    if (!empty([$name])) {
        if (!empty([$message]) && empty($_SESSION[$name])) {

            //first check if the name is already set if set then then unset it and then resset it
            if (!empty($_SESSION[$name])) {

                unset($_SESSION[$name]);
            }

            //check if message is already set then unset it this function will unset if message is already set
            if (!empty($_SESSION[$name . '_class'])) {

                unset($_SESSION[$name . '_class']);
            }


            //after checking that name and message are unseted then this function will reset it
            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
            echo '<div class="' . $class . '"id="msg-flash">' . $_SESSION[$name] . '</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}

function isLoggedIn()
{
    if (isset($_SESSION['user_id'])) {
        return true;
    } else {
        return false;
    }
}





















// session_start();

// // Flash message helper
// // EXAMPLE - flash('register_success', 'You are now registered');
// // DISPLAY IN VIEW - echo flash('register_success');
// function flash($name = '', $message = '', $class = 'alert alert-success')
// {
//     if (!empty($name)) {
//         if (!empty($message) && empty($_SESSION[$name])) {
//             if (!empty($_SESSION[$name])) {
//                 unset($_SESSION[$name]);
//             }

//             if (!empty($_SESSION[$name . '_class'])) {
//                 unset($_SESSION[$name . '_class']);
//             }

//             $_SESSION[$name] = $message;
//             $_SESSION[$name . '_class'] = $class;
//         } elseif (empty($message) && !empty($_SESSION[$name])) {
//             $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
//             echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
//             unset($_SESSION[$name]);
//             unset($_SESSION[$name . '_class']);
//         }
//     }
// }
