<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_GET['delete'] ) )
{

  $query = 'DELETE FROM projects
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  $mysqli->query($query);

  set_message( 'Project has been deleted' );

  header( 'Location: projects.php' );
  die();

}

/*$query = 'SELECT *
  FROM users 
  '.( ( $_SESSION['id'] != 1 and $_SESSION['id'] != 4 ) ? 'WHERE id = '.$_SESSION['id'].' ' : '' ).'
  ORDER BY last,first';*/
$query = "SELECT * FROM projects";
//$result = mysqli_query($mysqli, $query);
$result = $mysqli->query($query);

include( 'includes/header.php' );
?>

<h2>Manage projects</h2>

<table>
  <tr>
    <th align="center">ID</th>
    <th align="left">Title</th>
    <th align="left">Url</th>
    <th align="left">Type</th>
    <th></th>
    <th>Active</th>
  </tr>
  <?php if (mysqli_num_rows($result)) : ?>
  <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
    <tr>
      <td align="center"><?php echo $record['id']; ?></td>
      <td align="left"><?php echo htmlentities( $record['title'] ); ?></td>
      <td align="left"><a href="mailto:<?php echo htmlentities( $record['url'] ); ?>"><?php echo htmlentities( $record['url'] ); ?></a></td>
      <td align="center">
        <a href="projects_edit.php?id=<?php echo $record['id']; ?>">Edit</a>
      </td>
      <td align="center">
        <a onclick="return confirm('Are you sure you want to delete this project?')"      href="projects.php?delete=<?php echo $record['id'] ?>"
        >
          Delete
        </a>
      </td>
      <td align="center">
        <?php echo $record['type']; ?>
      </td>
    </tr>
  <?php endwhile; ?>
  <?php else : ?>
    <h3>You have no projects yet!!!</h3>
  <?php endif; ?>
</table>

<p>
    <a href="projects_add.php">
        <i class="fas fa-plus-square"></i> Add Project
    </a>
</p>

<?php

include( 'includes/footer.php' );

?>