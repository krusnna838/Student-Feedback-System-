<?php
include 'db.php';
session_start();
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Check database
    $result = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$pass'");
    
    if ($result->num_rows > 0) {
        $_SESSION['user_email'] = $email;
        header("Location: feedback.php");
        exit();
    } else {
        $msg = "Invalid Email or Password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        /* Using your original CSS */
        * { box-sizing: border-box; font-family: "Segoe UI", sans-serif; }
        body { margin: 0; height: 100vh; background: linear-gradient(135deg, #667eea, #764ba2); display: flex; align-items: center; justify-content: center; }
        .login-card { width: 350px; background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 20px 40px rgba(0,0,0,0.2); }
        .input-group { margin-bottom: 15px; }
        .input-group input { width: 100%; padding: 10px; margin-top: 5px; border-radius: 6px; border: 1px solid #ccc; }
        .login-btn { width: 100%; padding: 10px; border: none; background: #667eea; color: white; font-size: 16px; border-radius: 6px; cursor: pointer; }
    </style>
</head>
<body>
<div class="login-card">
    <h2>Welcome Back</h2>
    <p style="color:red; text-align:center;"><?php echo $msg; ?></p>
    <form method="POST" action="">
        <div class="input-group">
            <label>Email (Username)</label>
            <input type="email" name="email" placeholder="Enter email" required>
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter password" required>
        </div>
        <button type="submit" class="login-btn">Login</button>
    </form>
</div>
</body>
</html>