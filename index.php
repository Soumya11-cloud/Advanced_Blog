<?php
$conn = new mysqli("localhost", "root", "", "blog");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT id, title, content, created_at FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Blog</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f5f5f5; }
        .post { background: white; padding: 20px; margin-bottom: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .date { color: #888; font-size: 0.9em; margin-bottom: 10px; }
        .read-more { color: #007BFF; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Blog Posts</h1>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $excerpt = substr($row["content"], 0, 100) . "...";
            echo "<div class='post'>";
            echo "<h2>" . htmlspecialchars($row["title"]) . "</h2>";
            echo "<div class='date'>Posted on " . date("F j, Y", strtotime($row["created_at"])) . "</div>";
            echo "<p>" . nl2br(htmlspecialchars($excerpt)) . "</p>";
            echo "<a class='read-more' href='post.php?id=" . $row["id"] . "'>Read More</a>";
            echo "</div>";
        }
    } else {
        echo "<p>No posts found.</p>";
    }
    $conn->close();
    ?>
</body>
</html>
