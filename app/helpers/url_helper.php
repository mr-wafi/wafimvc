<?php
//simple page redirection method
function redirect($page)
{
    header('location: ' . URLROOT . '/' . $page);
}
