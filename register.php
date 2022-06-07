<?php require_once('config.php');
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Registration system PHP and MySQL</title>


</head>

<div>
    <?php
    header('Cache-Control: no-cache, must-revalidate, max-age=0');
    header('Pragma: no-cache');
    $result = "";
    $usernameError = "";
    $emailError = "";
    $passwordError1 = "";
    $passwordError2 = "";
    $error = 0;
    $password_1 = "";
    $password_2 = "";
    $username = "";
    $email = "";
    if (isset($_POST['create'])) {
        $db = mysqli_connect('127.0.0.1', 'root', '', 'meetm');
        $username   = $_POST['username'];
        $email      = $_POST['email'];
        $password_1 = $_POST['password_1'];
        $password_2 = $_POST['password_2'];
        if (!empty($_POST['username'])) {
            $user_check_query = "SELECT * FROM users WHERE username='$username'LIMIT 1";
            $result = mysqli_query($db, $user_check_query);
            $user = mysqli_fetch_assoc($result);
            if ($user) {
                if ($user['username'] === $username) {
                    $error = 1;
                    $usernameError = "Lietotājvārds jau pastāv!";
                }
            }
        } else {
            $error = 1;
            $usernameError = "Ievadiet lietotājvārdu!";
        }
        if (!empty($_POST['email'])) {
            $email = $_POST['email'];
            $email_check_query = "SELECT * FROM users WHERE email='$email'LIMIT 1";
            $result = mysqli_query($db, $email_check_query);
            $emailReq = mysqli_fetch_assoc($result);
            if ($emailReq) {
                if ($emailReq['email'] == $email) {
                    $emailError = "E-pasts jau pastāv reģistrā";
                    $error = 1;
                }
            }
        } else {
            $error = 1;
            $emailError = "Ievadiet savu e-pastu!";
        }
        if (!empty($_POST['password_1'])) {
            if (empty($_POST['password_2'])) {
                $error = 1;
                $passwordError1 = "Ievadiet atkārtotu paroli!";
            } elseif (strlen($_POST['password_1']) < 5) {
                $error = 1;
                $passwordError1 = "Parolei jābūt vismaz 6 simbolu garai!";
            } elseif ($password_1 != $password_2) {
                $error = 1;
                $passwordError2 = "Ievadiet atkārtoto paroli pareizi!";
            }
        } elseif (empty($_POST['password_1'])) {
            $error = 1;
            $passwordError1 = "Ievadiet paroli!";
        }



        if ($error == 0) {
            $query = "insert into users (email, username, password) values ('$email', '$username', '$password_1')";
            $stmtinsert = $db->prepare($query);
            $result = $stmtinsert->execute();
        }
    }
    if ($result and $error == 0) {
        $_SESSION["username"] = $username;
        header("Location: register2.php");
    }
    ?>
</div>

<body>
    <div class="header">
        <h2>Reģistrācija</h2>
        <p>Aizpildi visus laukus!</p>
        <?php echo $password_1 ?>
    </div>
    <hr class="mb-3">
    <div class="container">
        <div class="col-sm-3">
            <form method="post" action="register.php">

                <label>Lietotājvārds</label>
                <input class="form-control" type="text" name="username">
                <span class="error"><?= $usernameError; ?></span>

                <label>E-pasts</label>
                <input class="form-control" type="email" name="email">
                <span class="error"><?= $emailError; ?></span>

                <label>Parole</label>
                <input class="form-control" type="password" name="password_1">
                <span class="error"><?= $passwordError1; ?></span>

                <label>Atkārtota parole</label>
                <input class="form-control" type="password" name="password_2">
                <span class="error"><?= $passwordError2; ?></span>

                <input type="submit" name="create" value="Turpināt">
            </form>
        </div>
    </div>
</body>

</html>