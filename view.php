<!DOCTYPE html>
<html>
<head>
  <title>View Note</title>
  <link rel="stylesheet" type="text/css" href="styles.css">

</head>
<body>

  <div class="note-container">
    <?php
    include 'config.php';
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $sql = "SELECT note FROM notes WHERE id = $id";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<div class='note'>" . $row['note'] . "</div>";
        echo "<button id='copyButton' onclick='copyToClipboard(this)' style='width: 60px;'>Copy</button>";
      } else {
        echo "Note not found.";
      }
    }
    $conn->close();
    ?>
  </div>
  <script>
    function copyToClipboard(button) {
      const noteText = document.querySelector('.note');
      const textToCopy = noteText.innerText;

      const tempInput = document.createElement('textarea');
      tempInput.value = textToCopy;
      document.body.appendChild(tempInput);

      tempInput.select();
      const success = document.execCommand('copy');
      document.body.removeChild(tempInput);

      if (success) {
        // button.innerText = 'Copied!';
        button.innerHTML = 'Copied!';
        setTimeout(function() {
          // button.innerText = 'Copy';
          button.innerHTML = 'Copy';
        }, 2000); // Reset the button text after 2 seconds
      }
    }
  </script>

<?php include('footer.php'); ?>