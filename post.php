<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Post</title>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <div class="container">
    <?php
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $sql = "SELECT title, author, content, created_at FROM posts WHERE id = $id";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h1>" . $row['title'] . "</h1>";
        echo "<div class='post-page'>";
        echo "<p class='date'>" . $row['created_at'] . ' - ' . $row['author'] . "</p>";
        echo "<p>" . $row['content'] . "</p>";
        echo "</div>";
      } else {
        echo "Post not found.";
      }
    } else {
      echo "Invalid post ID.";
    }
    $conn->close();
    ?>
    <a href="index.php" class="back-button">Back to Home</a>
  </div>
</body>

</html>