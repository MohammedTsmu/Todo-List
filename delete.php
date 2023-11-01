<?php
include 'config.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  if (isset($_POST['confirm'])) {
    // User confirmed the delete action.
    $sql = "DELETE FROM notes WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
      echo "Note deleted successfully.";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Redirect back to the main to-do list after deleting a note.
    header("Location: index.php");
    exit();
  } elseif (isset($_POST['cancel'])) {
    // User canceled the delete action.
    header("Location: index.php");
    exit();
  }
} else {
  echo "Invalid request.";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Delete Note</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <h1>Delete Note</h1>
  <p>Are you sure you want to delete this note?</p>
  <form action="delete.php?id=<?php echo $id; ?>" method="post">
    <input type="submit" name="confirm" value="Yes, Delete">
    <input type="submit" name="cancel" value="No, Cancel">
  </form>

  <!-- Footer -->
  <?php include ('footer.php'); ?>