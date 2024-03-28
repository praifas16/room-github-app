<?php
session_start();

$host = 'localhost';
$dbname = 'Junsuriya';
$username = 'root';
$password = 'root';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("SET NAMES utf8");

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $sqlCheckUser = "SELECT * FROM Member WHERE Mem_Username = :username";
            $stmtCheckUser = $conn->prepare($sqlCheckUser);
            $stmtCheckUser->bindParam(':username', $username);
            $stmtCheckUser->execute();

            if ($stmtCheckUser->rowCount() > 0) {
                $user = $stmtCheckUser->fetch(PDO::FETCH_ASSOC);

                // Check if the entered password matches the password in the database
                if ($password == $user['Mem_Password']) { // Corrected typo here (Mam_Password to Mem_Password)
                    $_SESSION['user_id'] = $user['Mem_ID'];
                    $_SESSION['user_name'] = $user['Mem_Username']; // Use Mem_Username as the username

                    // Redirect to homepage
                    header('Location: homepage.php');
                    exit();
                } else {
                    $_SESSION['error'] = "รหัสผ่านไม่ถูกต้อง";
                    header('Location: login.php');
                    exit();
                }
            } else {
                $_SESSION['error'] = "ไม่พบชื่อผู้ใช้ในระบบ";
                header('Location: login.php');
                exit();
            }
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="login.css"> <!-- Link to your CSS file -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="title">LOGIN</div>
        <div class="content">
            <form method="POST" action="#">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Username</span>
                        <input type="text" name="username" placeholder="Enter username" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" name="password" placeholder="Enter password" required>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" name="login" value="Login"></input>
                </div>
                <br><br>
                <div class="gender-details">Forgot your password? <br><label for="flip" id="forgotPassword">Press here to edit your password.</label></div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#forgotPassword").click(function(e) {
                e.preventDefault(); // Prevent page reload
                window.location.href = "editpass.php";
            });
        });
    </script>
</body>

</html>
