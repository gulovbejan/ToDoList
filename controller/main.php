<?php
require_once "../model/account.php";
require_once "../model/todolist.php";
require_once "../model/dataAccess.php";

session_start();

///////////////////////////////----LOGIN

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
    <form action="main.php" method="post">
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

<?php
///////////////////////////////----Adding A new Task

if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['delete_task'])) {
    // Check if all required fields are set
    if (isset($_POST["task"]) && isset($_POST["date"]) && isset($_POST["start_time"]) && isset($_POST["end_time"]) && isset($_POST["priority"]) && isset($_POST["status"])) {
        // Create a new toDoList object and set its properties
        $addNewTask = new toDoList();
        $addNewTask->task = $_POST["task"];
        $addNewTask->date = $_POST["date"];
        $addNewTask->start_time = $_POST["start_time"];
        $addNewTask->end_time = $_POST["end_time"];
        $addNewTask->priority = $_POST["priority"];
        $addNewTask->status = $_POST["status"];

        // Add the new task to the database
        DataAccess::addNewTask($addNewTask);

        // Redirect back to the main page or display a success message
        header("Location: ../view/index_view.php");
        exit;
    }
}

///////////////////////////////----Deleting a Task

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_task'])) {
    // Check if all required fields are set
    if (isset($_POST["task"]) && isset($_POST["date"]) && isset($_POST["start_time"]) && isset($_POST["end_time"]) && isset($_POST["priority"]) && isset($_POST["status"])) {
        // Delete the task from the database
        DataAccess::deleteTask($_POST["task"], $_POST["date"], $_POST["start_time"], $_POST["end_time"], $_POST["priority"], $_POST["status"]);

        // Redirect back to the main page or display a success message
        header("Location: ../view/index_view.php");
        exit;
    }
}
?>