<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create New Post</title>
  <link rel="stylesheet" href="css/styles.css">
  <script>
  function showPopup() {
    document.getElementById('popup').style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
  }
  </script>
</head>

<body>
  <div class="container">
    <h1>Create New Post</h1>
    <form action="create_post.php" method="POST">
      <label for="title">Title:</label>
      <input type="text" id="title" name="title" placeholder="Input title post" required />
      <label for="author">Author:</label>
      <input type="text" id="author" name="author" placeholder="Input author post" required />
      <label for="content">Content:</label>
      <textarea id="content" name="content" rows="10" placeholder="Input content post" required></textarea>

      <button type="submit" name="submit">Create Post</button>
    </form>
    <a href="index.php" class="back-button">Back to Home</a>

    <?php
    if (isset($_POST['submit'])) {
      $title = $_POST['title'];
      $author = $_POST['author'];
      $content = $_POST['content'];

      // Find the next available ID
      $result = $conn->query("SELECT MAX(id) AS max_id FROM posts");
      $row = $result->fetch_assoc();
      $next_id = $row['max_id'] + 1;

      // Insert the new post with the manually incremented ID
      $sql = "INSERT INTO posts (id, title, author, content) VALUES ('$next_id', '$title', '$author', '$content')";

      if ($conn->query($sql) === TRUE) {
        echo '<script>document.addEventListener("DOMContentLoaded", showPopup);</script>';
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
    $conn->close();
    ?>
  </div>
  <div id="popup" class="popup">
    <h2>Success!</h2>
    <p>New post created successfully.</p>
    <button onclick="window.location.href='index.php'">Back to Home</button>
  </div>
  <div id="overlay" class="overlay"></div>
</body>

</html>