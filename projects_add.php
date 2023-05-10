<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if (isset($_POST['title']))
{
    if ($_POST['title'] and $_POST['content'] and $_POST['url'])
    {
        $query = 'INSERT INTO projects (
            title,
            content,
            url,
            type
          ) VALUES (
            "'.mysqli_real_escape_string( $mysqli, $_POST['title'] ).'",
            "'.mysqli_real_escape_string( $mysqli, $_POST['content'] ).'",
            "'.mysqli_real_escape_string( $mysqli, $_POST['url'] ).'",
            "'.$_POST['type'].'"
          )';
        
        $mysqli->query($query);
    
        set_message( 'Project has been added' );
    }

    header('Location: projects.php');
    die();
}

include('includes/header.php');
?>

<h2>Add Project</h2>

<form method="post">

  <label for="title">Title:</label>
  <input type="text" name="title" id="title">

  <br>

  <label for="content">Description:</label>
  <textarea name="content" id="content" cols="30" rows="10" placeholder="Enter a description"></textarea>

  <br>

  <label for="url">Url:</label>
  <input type="text" name="url" id="url">

  <br>

  <label for="type">Type:</label>
  <?php

    $values = array( 'Graphics Design', 'Website' );

    echo '<select name="type" id="type">';
        foreach( $values as $key => $value )
        {
            echo '<option value="'.$value.'"';
            echo '>'.$value.'</option>';
        }
    echo '</select>';

  ?>

  <br>

  <input type="submit" value="Add Project">

</form>

<p>
    <a href="projects.php">
        <i class="fas fa-arrow-circle-left"></i> Return to Project List
    </a>
</p>

<?php

include('includes/footer.php');

?>