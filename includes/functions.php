<?php

function secure()
{
    set_message('You must first log in to view this page.');

    if (!isset($_SESSION['id']))
    {
        header('Location: index.php');
        die();
    }
}

function set_message($message)
{
    $_SESSION['message'] = $message;
}

function get_message()
{

  if( isset( $_SESSION['message'] ) )
  {

    echo '<p style="padding: 0 1%;" class="error">
        <i class="fas fa-exclamation-circle"></i> 
        '.$_SESSION['message'].'
      </p>
      <hr>';
    unset( $_SESSION['message'] );

  }

}