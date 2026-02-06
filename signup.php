<?php
include 'db.php';
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['a1'];
    $mobile = $_POST['a2'];
    $email = $_POST['a3'];
    $pass = $_POST['a4'];
    $confirm = $_POST['a5'];

    if ($pass !== $confirm) {
        $msg = "Passwords do not match!";
    } else {
        // Insert into database
        $sql = "INSERT INTO users (full_name, mobile, email, password) VALUES ('$name', '$mobile', '$email', '$pass')";
        if ($conn->query($sql)) {
            header("Location: login.php?signup=success");
            exit();
        } else {
            $msg = "Error: Email might already exist.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <style>
        /* Using your original CSS */
        * { box-sizing: border-box; font-family: "Segoe UI", sans-serif; }
        body { margin: 0; height: 100vh; background: linear-gradient(135deg, #43cea2, #185a9d); display: flex; justify-content: center; align-items: center; }
        .signup-card { width: 380px; background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 20px 40px rgba(0,0,0,0.2); }
        .input-group { margin-bottom: 15px; }
        .input-group label { font-size: 14px; color: #555; }
        .input-group input { width: 100%; padding: 10px; margin-top: 5px; border-radius: 6px; border: 1px solid #ccc; outline: none; }
        .signup-btn { width: 100%; padding: 10px; border: none; background: #43cea2; color: white; font-size: 16px; border-radius: 6px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="signup-card">
        <h2>Create Account</h2>
        <p style="color:red; text-align:center;"><?php echo $msg; ?></p>
        <form method="POST" action="">
            <div class="input-group"><label>Full Name</label><input type="text" name="a1" required></div>
            <div class="input-group"><label>Mobile Number</label><input type="number" name="a2" required></div>
            <div class="input-group"><label>Email</label><input type="email" name="a3" required></div>
            <div class="input-group"><label>Password</label><input type="password" name="a4" required></div>
            <div class="input-group"><label>Confirm Password</label><input type="password" name="a5" required></div>
            <button class="signup-btn" type="submit">Sign Up</button>
        </form>
        <div class="extra"><p>Already have an account? <a href="login.php">Login</a></p></div>
    </div>
</body>
</html>