<?php
include 'config.php';

if (isset($_GET['search'])) {
  $searchKeyword = $_GET['search'];

  // Use a prepared statement for the search query
  $sql = "SELECT id, note, created_at, updated_at FROM notes WHERE note LIKE ?";
  $stmt = $conn->prepare($sql);

  if ($stmt) {
    $searchParam = "%" . $searchKeyword . "%";
    $stmt->bind_param("s", $searchParam);
    $stmt->execute();
    $result = $stmt->get_result();

    // Rest of your code for displaying search results
  }
}
?>

<!DOCTYPE html>
<html>

  <!-- ******************** H E A D ********************  -->
  <head>
  <title>Search Notes</title>
  <link rel="stylesheet" type="text/css" href="styles.css">

  <!-- View note as popup -->
  <script type="text/javascript">
        function openPopup(id) {
            window.open('view.php?id=' + id, 'Note Viewer', 'width=600, height=400, resizable=1');
            // window.open('view.php?id=' + id, 'Note Viewer', 'width=1700, height=1100, resizable=1');
        }
  </script>
</head>

  <!-- ******************** B O D Y ********************  -->
  <body>


<!-- find searched note in the table -->
<?php
if (isset($_POST['search'])) {
  $searchKeyword = $_POST['keyword'];

  $sql = "SELECT id, note, created_at, updated_at FROM notes WHERE note LIKE '%$searchKeyword%'";
  $result = $conn->query($sql);
}
?>


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

<div><a href="index.php">Home</a></div>
    <hr>
    <h1>Search Notes</h1>

  <form action="search.php" method="post">
    <input type="text" name="keyword" placeholder="Search notes" required>
    <input type="submit" name="search" value="Search">
  </form>

  <table>
    <tr>
    <th>Note</th>
      <th>Created At</th>
      <th>Updated At</th>
      <th>Action</th>
    </tr>
    <?php


    if (isset($result) && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        // echo "<td>" . highlightMatchingText($row['note'], $searchKeyword) . "</td>";
        // echo "<td><div class='popup-note' title='Double click for reader view' ondblclick=\"openPopup(" . $row['id'] . ")\">" . $row['note'] . "</div></td>";
        echo "<td><div class='popup-note' title='Double click for reader view' ondblclick=\"openPopup(" . $row['id'] . ")\">" . highlightMatchingText($row['note'], $searchKeyword) . "</div></td>";
                                                                // echo "<td>" . highlightMatchingText($row['note'], $searchKeyword) . "</td>";
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
      echo "<tr><td colspan='3'>No matching notes found.</td></tr>";
    }




    
    // Function to highlight matching text
    function highlightMatchingText($text, $keyword) {
      return str_ireplace($keyword, '<span class="highlight">' . $keyword . '</span>', $text);
    }
    
    ?>
  </table>



    
    
   
    
    <!-- // Function to highlight matching text
    function highlightMatchingText($text, $keyword) {
      return str_ireplace($keyword, '<span class="highlight">' . $keyword . '</span>', $text);
    }
    
    ?> -->
  <!-- </table> -->

  <!-- ******************** F O O T E R ********************  -->
  <?php include ('footer.php'); ?>