<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title> MeetM </title>
        <link href="./styles/textField.css" rel="stylesheet" type="text/css"/>
        <link href="./styles/loginButton.css" rel="stylesheet" type="text/css"/>
        <link href="./styles/mainStyle.css" rel="stylesheet" type="text/css"/>
        <link href="./styles/mainPage.css" rel="stylesheet" type="text/css"/>
        <link href="./styles/profileIcon.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="contBox">
            <?php
            session_start();
            $username = $_SESSION['username'];
            ?>
            
            <div class="contBoxMain">
                <div class="leftSide">
                <img src="./images/GUI_14._grupa-removebg-preview.png" alt="logo"></img>
                    <div class="inputCont" style="width: 750px;">
                        <label for="inp" class="inp">
                            <input type="text" id="username" placeholder="&nbsp;">
                            <span class="label">Lietotājvārds</span>
                            <span class="focus-bg"></span>
                        </label>
                        <label for="inp" class="inp">
                            <input type="text" id="keywords" placeholder="&nbsp;">
                            <span class="label">Intereses</span>
                            <span class="focus-bg"></span>
                        </label>
                        Vecums
                        <div class="genderAge">
                            <label for="inp" class="inp">
                                <input type="number" id="ageFrom" placeholder="&nbsp;">
                                <span class="label">No</span>
                                <span class="focus-bg"></span>
                            </label>
                            
                            <label for="inp" class="inp">
                                <input type="number" id="ageTill" placeholder="&nbsp;">
                                <span class="label">Līdz</span>
                                <span class="focus-bg"></span>
                            </label>

                            <label class="container">Sieviete
                                <input type="checkbox" checked="checked">
                                <span class="checkmark"></span>
                            </label>
                            <label class="container">Vīrietis
                                <input type="checkbox" checked="checked">
                                <span class="checkmark"></span>
                            </label>

                        </div>
                            <div>
                                Saraksts
                            </div>
                    </div>
                </div>
            <div class="rightSide">
                <div class="inputCont">
                    <div class="profileComb">
                        <a href="page3.html"><img src="images/userIcon.png" class="profileIcon"></a>
                        <br>
                        <div class="userName"><?php echo"$username"; ?></div>
                        <div class="links">
                            <a href="./login.php">Iziet</a>
                        </div>
                    </div>
                </div>
                <div class="inputCont">
                    <div class="markedUsers">
                    </div>
                </div>
            </div>
        </div>

            
    </body>
</html>
