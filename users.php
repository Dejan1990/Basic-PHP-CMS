<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();



if( isset( $_GET['delete'] ) )
{

  $query = 'DELETE FROM users
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $mysqli, $query );

  set_message( 'User has been deleted' );

  header( 'Location: users.php' );
  die();

}

//$query = "SELECT * FROM users";
//$result = mysqli_query($mysqli, $query);
$query = 'SELECT *
  FROM users 
  '.( ( $_SESSION['id'] != 1 and $_SESSION['id'] != 4 ) ? 'WHERE id = '.$_SESSION['id'].' ' : '' ).'
  ORDER BY last,first';
$result = $mysqli->query($query);

include( 'includes/header.php' );
?>

<h2>Manage users</h2>

<table>
  <tr>
    <th align="center">ID</th>
    <th align="left">Name</th>
    <th align="left">Email</th>
    <th></th>
    <th></th>
    <th>Active</th>
  </tr>
  <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
    <tr>
      <td align="center"><?php echo $record['id']; ?></td>
      <td align="left"><?php echo htmlentities( $record['first'] ); ?> <?php echo htmlentities( $record['last'] ); ?></td>
      <td align="left"><a href="mailto:<?php echo htmlentities( $record['email'] ); ?>"><?php echo htmlentities( $record['email'] ); ?></a></td>
      <td align="center"><a href="#">Edit</a></td>
      <td align="center">
          <?php if ($_SESSION['id'] != $record['id']) : ?>
            <a onclick="return confirm('Are you sure you want to delete this user?')"      href="users.php?delete=<?php echo $record['id'] ?>"
            >
                Delete
            </a>
          <?php endif; ?>
      </td>
      <td align="center">
        <?php if ($record['active'] == 'Yes') : ?>
            <span style="color:green;"><?php echo $record['active']; ?></span>
        <?php else : ?>
            <span style="color:red;"><?php echo $record['active']; ?></span>
        <?php endif; ?>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<p>
    <a href="users_add.php">
        <i class="fas fa-plus-square"></i> Add User
    </a>
</p>

<?php

include( 'includes/footer.php' );

?>