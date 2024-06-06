<?php
require_once "../model/account.php";
require_once "../model/dataAccess.php";

session_start();

// Initialize variables
$username = "";
$password = "";
$error = "";
$isLoggedIn = false;

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Attempt login
    $user = DataAccess::loginAccess($username, $password);

    if (!empty($user)) {
        $_SESSION['userLogIn'] = $user[0];
        $isLoggedIn = true;
    } else {
        $error = "Invalid username or password";
    }
}

if ($isLoggedIn): ?>
    <!-- Success message -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <p><b>Login successful. Redirecting...<b></p>
    <meta http-equiv="refresh" content="2;url=../view/index_view.php" />
<?php else: ?>
    <!-- Login form -->
    <!doctype html>
    <link rel="stylesheet" href="../assets/css/style.css">
    <section id="apply">
    <title>Login</title>
    <form action="login.php" method="post">
        <label for="username">User Name:</label>
        <input type="text" id="username" name="username" required/>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required/>

        <input type="hidden" name="login" value="1">
        <input class="btn btn-primary" type="submit" value="Login">
        </br>
    </form>
    </section>
</body>
</html>
<?php if (!empty($error)): ?>
    <!-- Error message -->
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<?php endif; ?>
