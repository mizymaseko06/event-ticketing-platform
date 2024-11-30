<?php
session_start();
include_once "db/db_conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture form data
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = trim($_POST['password']);

    // Check if email exists in the database
    $checkUser = "SELECT userID, password FROM Users WHERE email = ?";
    $stmt = $conn->prepare($checkUser);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($userID, $hashedPassword);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Set session variables upon successful login
            $_SESSION['userID'] = $userID;
            $_SESSION['email'] = $email;

            // Redirect to a dashboard or user homepage
            header("Location: index.php"); // Change this to the page you want to redirect after login
            exit();
        } else {
            // Incorrect password
            $loginError = "Incorrect password. Please try again.";
?>
<?php
        }
    } else {
        // User not found
        $loginError = "No user found with that email. Please sign up.";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
    <main>

        <section class="login-form d-flex justify-content-center align-items-center">
            <div class="form-container border d-flex flex-column justify-content-center align-items-center">
                <img src="public/images/ticket-logo_9850-381.png" class="form-logo img-fluid" alt="Logo" class="logo">
                <form method="POST" style="width: 400px; padding: 0px 10px 0 10px;">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input name="email" type="email" class="form-control" id="email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Log In</button>
                    <p style="font-size: smaller; padding-top: 10px;">Don't have an account? <span><a href="signup.php">Sign up here.</a></span></p>
                </form>
            </div>

        </section>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>