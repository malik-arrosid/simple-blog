<?php
include 'db.php';

$post = [];
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT id, title, author, content FROM posts WHERE id='$id'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $post = $result->fetch_assoc();
  } else {
    echo "Post not found.";
    exit;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Post</title>
  <link rel="stylesheet" href="css/styles.css">
  <script>
  function showPopup() {
    document.getElementById('popup').style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
  }
  </script>
</head>

<body>
  <?php
  if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['content'];

    $sql = "UPDATE posts SET title='$title', author='$author', content='$content' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
      echo '<script>document.addEventListener("DOMContentLoaded", showPopup);</script>';
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
  ?>
  <div class="container">
    <h1>Edit Post</h1>
    <form action="edit_post.php?id=<?php echo htmlspecialchars($post['id']); ?>" method="POST">
      <input type="hidden" name="id" value="<?php echo htmlspecialchars($post['id']); ?>">
      <label for="title">Title:</label>
      <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
      <label for="author">Author:</label>
      <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($post['author']); ?>" required>
      <label for="content">Content:</label>
      <textarea id="content" name="content" rows="10"
        required><?php echo htmlspecialchars($post['content']); ?></textarea>
      <button type="submit" name="submit">Update Post</button>
    </form>
    <a href="index.php" class="back-button">Back to Home</a>
  </div>
  <div id="popup" class="popup">
    <h2>Success!</h2>
    <p>Post edited successfully.</p>
    <button onclick="window.location.href='index.php'">Back to Home</button>
  </div>
  <div id="overlay" class="overlay"></div>
</body>

</html>