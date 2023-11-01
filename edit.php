<?php
include 'config.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  if (isset($_POST['submit'])) {
    $updatedNote = $_POST['note'];

    $sql = "UPDATE notes SET note = '$updatedNote' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
      echo "Note updated successfully.";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Redirect back to the main to-do list after editing a note.
    header("Location: index.php");
    exit();
  }

  $sql = "SELECT id, note FROM notes WHERE id = $id";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
  } else {
    echo "Note not found.";
  }
} else {
  echo "Invalid request.";
}

$conn->close();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Edit Note</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
  </head>
  <body>
    <h1>Edit Note</h1>

    <form action="edit.php?id=<?php echo $id; ?>" method="post">
      <input type="text" name="note" value="<?php echo $row['note']; ?>" required>
      <input type="submit" name="submit" value="Update Note">
    </form>

    <!-- Footer -->
    <?php include ('footer.php'); ?>