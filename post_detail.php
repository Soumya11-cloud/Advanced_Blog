<?php
$conn = new mysqli("localhost", "root", "", "blog");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
$sql = "SELECT title, content, created_at FROM posts WHERE id = $id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Full Post</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f5f5f5; }
        .post { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .date { color: #888; font-size: 0.9em; margin-bottom: 10px; }
        .back-btn { display: inline-block; margin-top: 20px; padding: 8px 12px; background: #ccc; color: #333; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>

<?php
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<div class='post'>";
    echo "<h2>" . htmlspecialchars($row["title"]) . "</h2>";
    echo "<div class='date'>Posted on " . date("F j, Y", strtotime($row["created_at"])) . "</div>";
    echo "<p>" . nl2br(htmlspecialchars($row["content"])) . "</p>";
    echo "<a class='back-btn' href='index.php'>&larr; Back to Posts</a>";
    echo "</div>";
} else {
    echo "<p>Post not found.</p>";
}
$conn->close();
?>

</body>
</html>
