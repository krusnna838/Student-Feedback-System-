<?php
include 'db.php';

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_feedback'])) {
    $rating = $_POST['rating'];
    $comment = $conn->real_escape_string($_POST['comment']);

    $sql = "INSERT INTO feedback (rating, comment) VALUES ('$rating', '$comment')";
    $conn->query($sql);
}

// Fetch Admin Stats
$result = $conn->query("SELECT AVG(rating) as avg_rating FROM feedback");
$row = $result->fetch_assoc();
$average = round($row['avg_rating'], 1);

$all_comments = $conn->query("SELECT * FROM feedback ORDER BY submitted_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Feedback System</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; padding: 20px; }
        .container { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .admin-section { background: #eef2f3; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 5px solid #667eea; }
        .rating-input { margin: 15px 0; }
        textarea { width: 100%; height: 80px; margin-top: 10px; padding: 10px; border-radius: 5px; border: 1px solid #ccc; }
        .btn { background: #43cea2; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
        .comment-box { border-bottom: 1px solid #eee; padding: 10px 0; }
        .stars { color: #f39c12; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <div class="admin-section">
        <h2>Admin Dashboard</h2>
        <p><strong>Average Event Rating:</strong> <span style="font-size: 24px; color: #764ba2;"><?php echo $average ? $average : "No ratings yet"; ?> / 5</span></p>
    </div>

    <h3>Submit Feedback</h3>
    <form method="POST">
        <div class="rating-input">
            <label>Rating (1-5): </label>
            <select name="rating" required>
                <option value="5">5 - Excellent</option>
                <option value="4">4 - Very Good</option>
                <option value="3">3 - Good</option>
                <option value="2">2 - Fair</option>
                <option value="1">1 - Poor</option>
            </select>
        </div>
        <textarea name="comment" placeholder="Write your comment here..." required></textarea>
        <br><br>
        <button type="submit" name="submit_feedback" class="btn">Submit Feedback</button>
    </form>

    <hr>

    <h3>All Comments</h3>
    <?php while($row = $all_comments->fetch_assoc()): ?>
        <div class="comment-box">
            <span class="stars"><?php echo str_repeat("★", $row['rating']); ?></span>
            <p><?php echo htmlspecialchars($row['comment']); ?></p>
            <small style="color: gray;"><?php echo $row['submitted_at']; ?></small>
        </div>
    <?php endwhile; ?>
</div>

</body>
</html>