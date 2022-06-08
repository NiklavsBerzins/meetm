<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> Autorizācija sistēmā </title>
    <link href="./styles/textField.css" rel="stylesheet" type="text/css" />
    <link href="./styles/button.css" rel="stylesheet" type="text/css" />
    <link href="./styles/mainStyle.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="contBox">
            <form method="post">
        <div class="inputCont">
    <?php
    session_start();
    $emailError = "";
    $passwordError = "";
    $db = mysqli_connect('127.0.0.1', 'root', '', 'meetm');
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $user_check_query = "SELECT * FROM users WHERE email='$email'LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);
        if ($user) {
            if ($user['password'] == $_POST['password']) {
                $_SESSION['username'] = $user['username'];
                header("Location: main.php");
            } else {
                $passwordError = "Ievadiet pareizo paroli!";
            }
        } else {
            $emailError = "Lietotājs ar šādu e-pastu nepastāv";
        }
    }
    ?>

                <img src="./images/GUI_14._grupa-removebg-preview.png" alt="logo"></img>

                <label for="inp" class="inp">
                    <input name="email" type="email" id="email" required placeholder="&nbsp;">
                    <span class="reqLabel">E-pasts</span>
                    <span class="focus-bg"></span>
                    <span class="error"><?= $emailError; ?></span>
                </label>

                <label for="inp" class="inp">
                    <input name="password" id="password" type="password" required placeholder="&nbsp;">
                    <span class="reqLabel">Parole</span>
                    <span class="focus-bg"></span>
                    <span class="error"><?= $passwordError; ?></span>
                </label>

                <input type="submit" name="login" class="login-btn" value="Login" />
                <div class="links">
                    <a href="https://google.com">Aizmirsi paroli?</a>
                    <a href="http://localhost/meetm/register.html">Reģistrēties</a>
                </div>
        </div>
            </form>
    </div>
</body>


</html>
