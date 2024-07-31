<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple Blog</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
  <div class="container">
    <h1>Simple Blog</h1>
    <a href="create_post.php" class="new-post-button">Create New Post</a>
    <div class="posts">
      <?php
      $sql = "SELECT id, title, author, content, created_at FROM posts ORDER BY created_at DESC";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='post'>";
          echo "<h2><a href='post.php?id=" . $row['id'] . "'>" . $row['title'] . "</a> - " . $row['author'] . "</h2>";
          echo "<p>" . substr($row['content'], 0, 100) . "...</p>";
          echo "<p class='date'>" . $row['created_at'] . "</p>";
          echo "<div class='actions'>";
          echo "<a href='edit_post.php?id=" . $row['id'] . "' title='Edit'><i class='fas fa-edit'></i></a>";
          echo "<a href='delete_post.php?id=" . $row['id'] . "' title='Delete' onclick='return confirm(\"Are you sure you want to delete this post?\");'><i class='fas fa-trash-alt'></i></a>";
          echo "</div>";
          echo "</div>";
        }
      } else {
        echo "<span>No posts available.</span>";
      }
      $conn->close();
      ?>
    </div>
  </div>
</body>

</html>