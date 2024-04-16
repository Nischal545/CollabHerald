<?php

// Database connection details (replace with your actual credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// If form is submitted
if (isset($_POST['submit'])) {

  $email = $_POST['email'];
  $password = $_POST['password'];

  // Hash the password before comparison (recommended)
  // You'll need a password hashing function like password_hash()
  // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Prepare a query to check user credentials
  $sql = "SELECT * FROM login_table WHERE email = '$email'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Verify password (use password_verify() if hashed)
    if (password_verify($password, $row['password'])) {
      // Login successful! (redirect to protected area)
      echo "Login successful!";
      // You can redirect to a protected page or dashboard here
    } else {
      echo "Incorrect password!";
    }
  } else {
    echo "User not found!";
  }

}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pet Adoption Center</title>
  <link rel="stylesheet" href="Login.css">
</head>
<body>

  <div class="container">
    <div class="background-image">
      <img src="dog3.jpg" alt="Pet Adoption Image">
      <div class="overlay"></div>
    </div>
    <div class="login-form">
      <h2>Login</h2>
      <form action="" method="post">
        <input type="email" placeholder="Email" name="email" required>
        <input type="password" placeholder="Password" name="password" required>
        <button type="submit" name="submit">Login</button>

        <?php if (isset($_POST['submit'])) {
          echo "<p class='error-message'>" . (isset($message) ? $message : "") . "</p>";
        } ?>

      </form>
      <div class="signup-link">
        <p>Don't have an account? <a href="#">Sign up</a></p>
      </div>
    </div>
  </div>

  <script src="Form.js"></script>
</body>
</html>
