<?php
include 'config.php';

if (isset($_POST['submit'])) {
  $note = $_POST['note'];

  // Use a prepared statement to insert the note
  $sql = "INSERT INTO notes (note) VALUES (?)";
  $stmt = $conn->prepare($sql);

  if ($stmt) {
    $stmt->bind_param("s", $note);
    
    if ($stmt->execute()) {
      echo "New note created successfully";
    } else {
      echo "Error: " . $stmt->error;
    }

    $stmt->close();
  } else {
    echo "Error: " . $conn->error;
  }
}

$sql = "SELECT id, note, created_at, updated_at FROM notes";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Todo List</title>
        <link rel="stylesheet" type="text/css" href="styles.css">

    <script type="text/javascript">
        function openPopup(id) {
            window.open('view.php?id=' + id, 'Note Viewer', 'width=600, height=400, resizable=1');
            // window.open('view.php?id=' + id, 'Note Viewer', 'width=1700, height=1100, resizable=1');
        }
        </script>
</head>

<body>

    
    
    <h1>Todo List</h1>
   <!-- <a href="user_profile.php">User profile</a> -->
   <!-- Theme -->
   <h1>User Profile</h1>
  <form id="theme-form">
    <label for="theme">Select Theme:</label>
    <select name="theme" id="theme-selector">
      <option value="light">Light</option>
      <option value="dark">Dark</option>
      <option value="heather_blue">Heather Blue</option>
    </select>
    <input type="submit" value="Save Theme Preferences">
  </form>

    <a href='search.php'>Search Notes</a>
    <hr>
    
    <h2>Add new note</h2>
    <form action="index.php" method="post">
        <!-- <input type="text" name="note" required> -->
        <textarea name="note" id="" cols="60" rows="5" required></textarea>
        <br>
        <input type="submit" name="submit" value="Add Note">
    </form>
    
    <table>
        <tr>
            <th>Note</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>
        <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            
            echo "<tr>";
            // echo "<td>" . $row['note'] . "</td>";
            echo "<td><div class='popup-note' title='Double click for reader view' ondblclick=\"openPopup(" . $row['id'] . ")\">" . $row['note'] . "</div></td>";

            echo "<td>" . $row['created_at'] . "</td>";

            if ($row['created_at'] < $row['updated_at']) {
                echo "<td>" . $row['updated_at'] . " Updated</td>";
            }else{
                echo "<td> Not updated</td>";
            }
    
        echo "<td><a href='edit.php?id=" . $row['id'] . "'>Edit</a> | <a href='delete.php?id=" . $row['id'] . "'>Delete</a></td>";
        echo "</tr>";

        
      }
    } else {
      echo "<tr><td colspan='3'>No notes found</td></tr>";
    }
    


    $conn->close();
    ?>
 </table>

 <!-- Footer -->
 <?php include ('footer.php'); ?>