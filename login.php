<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(
);
        if (password_verify($password, $row['password'])) {
            header("Location:upload_form.php");
           exit;
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found with that username!";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
<link rel="stylesheet" href="style1.css">
</head>
<body>
        <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <div class="error-message"><?php echo $error_message; ?></div>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
