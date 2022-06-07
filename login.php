<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> Autorizācija sistēmā </title>
    <link href="./styles/textField.css" rel="stylesheet" type="text/css" />
    <link href="./styles/button.css" rel="stylesheet" type="text/css" />
    <link href="./styles/mainStyle.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <?php
    $emailError = "";
    $passwordError = "";

    ?>
    <div class="contBox">
        <div class="inputCont">
            <form method="post">
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

                <input type="submit" class="login-btn">Pieslēgties</button>
                <div class="links">
                    <a href="https://google.com">Aizmirsi paroli?</a>
                    <a href="http://localhost/meetm/register.html">Reģistrēties</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>