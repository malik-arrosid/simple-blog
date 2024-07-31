<?php
include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styles.css">
  <script>
    function showPopup() {
      document.getElementById('popup').style.display = 'block';
      document.getElementById('overlay').style.display = 'block';
    }
  </script>
  <title></title>
</head>

<body>
  <?php
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM posts WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
      echo '<script>document.addEventListener("DOMContentLoaded", showPopup);</script>';
    } else {
      echo "Error: " . $conn->error;
    }
  } else {
    echo "Invalid request.";
  }

  $conn->close();
  ?>
  <div id="popup" class="popup">
    <h2>Success!</h2>
    <p>Post deleted successfully.</p>
    <button onclick="window.location.href='index.php'">OK</button>
  </div>
  <div id="overlay" class="overlay"></div>
</body>

</html>