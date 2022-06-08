<?php require_once('config.php');
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title> Reģistrācija sistēmā </title>
    <link href="./styles/textField.css" rel="stylesheet" type="text/css" />
    <link href="./styles/button.css" rel="stylesheet" type="text/css" />
    <link href="./styles/mainStyle.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="contBox">
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
            header("Location: registerSecond.php");
        }
        ?>
        <form method="post" action="register.php">

            <div class="registerCont">
                <img src="./images/GUI_14._grupa-removebg-preview.png" alt="logo"></img>

                <div class="header">
                    <h2>Reģistrācija</h2>
                </div>
                <label for="inp" class="inp">
                    <input id="nickname" type="text" name="username" required placeholder="&nbsp;">
                    <span class="reqLabel">Lietotājvārds</span>
                    <span class="focus-bg"></span>
                    <span class="error"><?= $usernameError; ?></span>
                </label>
                <label for="inp" class="inp">
                    <input type="email" id="email" name="email" required placeholder="&nbsp;">
                    <span class="reqLabel">E-pasts</span>
                    <span class="focus-bg"></span>
                    <span class="error"><?= $emailError; ?></span>
                </label>

                <label for="inp" class="inp">
                    <input id="password1" type="password" name="password_1" required placeholder="&nbsp;">
                    <span class="reqLabel">Parole</span>
                    <span class="focus-bg"></span>
                    <span class="error"><?= $passwordError1; ?></span>
                </label>
                <label for="inp" class="inp">
                    <input id="password2" type="password" name="password_2" required placeholder="&nbsp;">
                    <span class="reqLabel">Atkartotā parole</span>
                    <span class="focus-bg"></span>
                    <span class="error"><?= $passwordError2; ?></span>

                </label>


                <input type="submit" name="create" class="login-btn" value="Turpināt">

                <div class="links">
                    <a href="./login.php">Jau esi reģistrēts?</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>