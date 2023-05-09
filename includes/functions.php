<?php

function secure()
{
    if (!isset($_SESSION['id']))
    {
        header('Location: index.php');
        die();
    }
}
