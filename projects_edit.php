<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if (isset($_POST['title']))
{
    if ($_POST['title'] && $_POST['content'] && $_POST['url'])
    {
        $query = 'UPDATE projects SET
            title = "'.mysqli_real_escape_string( $mysqli, $_POST['title'] ).'",
            content = "'.mysqli_real_escape_string( $mysqli, $_POST['content'] ).'",
            url = "'.mysqli_real_escape_string( $mysqli, $_POST['url'] ).'",
            type = "'.$_POST['type'].'"
            WHERE id = '.$_GET['id'].'
            LIMIT 1';

        $mysqli->query($query);

        set_message('Project has been updated');
    }

    header( 'Location: projects.php' );
    die();
}

if (!isset($_GET['id']))
{
    header('Location: projects.php');
    die();
}

if (isset($_GET['id']))
{
    $query = 'SELECT *
        FROM projects
        WHERE id = '.$_GET['id'].'
        LIMIT 1';

    $result = $mysqli->query($query);

    if (!mysqli_num_rows($result))
    {
        header('Location: projects.php');
        die();
    }

    $record = mysqli_fetch_assoc($result);
}

include( 'includes/header.php' );

?>

<h2>Edit Project</h2>

<form method="post">

  <label for="title">Title:</label>
  <input type="text" name="title" id="title" value="<?php echo htmlentities( $record['title'] ); ?>">

  <br>

  <label for="content">Description:</label>
  <textarea name="content" id="content" cols="30" rows="10" placeholder="Enter a description"><?php echo htmlentities($record['content']) ?></textarea>

  <br>

  <label for="url">Url:</label>
  <input type="text" name="url" id="url" value="<?php echo htmlentities( $record['url'] ); ?>">

  <br>

  <label for="type">Type:</label>
  <?php

  $values = array( 'Graphics Design', 'Website' );

  echo '<select name="type" id="type">';
  foreach( $values as $key => $value )
  {
    echo '<option value="'.$value.'"';
    if( $value == $record['type'] ) echo ' selected="selected"';
    echo '>'.$value.'</option>';
  }
  echo '</select>';

  ?>

  <br>

  <input type="submit" value="Edit Project">

</form>

<p>
    <a href="projects.php">
        <i class="fas fa-arrow-circle-left"></i> 
        Return to Project List
    </a>
</p>


<?php

include( 'includes/footer.php' );

?>