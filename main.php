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
                        <a href="user_change.php"><img src="images/userIcon.png" class="profileIcon"></a>
                        <br>
                        <div class="userName"><?php echo"$username"; ?></div>
                        <div class="links">
                            <a href="./login.php">Iziet</a>
                        </div>
                    </div>
                </div>
                <div class="inputCont">
                    <div class="markedUsers">

                        <?php
                        $db = mysqli_connect('127.0.0.1', 'root', '', 'meetm');
                        $resultJOIN = $db->query
                        ("SELECT users.id, users.username, user_data.user_id, user_data.rating
            FROM users,user_data WHERE users.id=user_data.user_id
            ORDER BY user_data.rating DESC");

                        ?>

                        <?php
                        $result = $db->query("SELECT * FROM users");
                        $rowcount= mysqli_num_rows($result);
//                         echo"$rowcount";


                        if($rowcount < 5){
                            $x = ($resultJOIN->num_rows);
                        for ($i = 1 ;  $rowcount >= $i ; $i++) {
                        $rows = $resultJOIN->fetch_assoc();

                        $user_id = $rows['username'];
                        $rating = $rows['rating'];


                        ?>

                        <div class="d-flex justify-content-center">
                            <div class="bd-highlight mb-3">
                                <div class="d-flex flex-row bd-highlight mb-3">
                                    <div class="p-2 bd-highlight">
                                        <div class="flex-column bd-highlight mb-3">
                                            <div class="p-2 bd-highlight"><img src="images/userIcon.png" class="img-fluid rounded" style="width: 50%"></div>
                                            <div class="p-2 bd-highlight"> <?php echo"$user_id" ?> </div>
                                        </div>
                                    </div>
                                    <div class="p-2 bd-highlight">
                                        <div class="flex-column bd-highlight mb-3">
                                            <div class="p-2 bd-highlight"><i class="fa fa-star" style="font-size:24px;"></i></div>
                                            <div class="p-2 bd-highlight" style="font-size: 12;"><strong class="text-success">Stars <?php echo"$rating" ?>/5 </strong></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php

                        };



                        } else {

                                for ($x = 0; $x <= 5; $x++) {
                                    $rows = $resultJOIN->fetch_assoc();

                                $user_id = $rows['username'];
                                $rating = $rows['rating'];


                                ?>

                                <div class="d-flex justify-content-center">
                                    <div class="bd-highlight mb-3">
                                        <div class="d-flex flex-row bd-highlight mb-3">
                                            <div class="p-2 bd-highlight">
                                                <div class="flex-column bd-highlight mb-3">
                                                    <div class="p-2 bd-highlight"><img src="images/userIcon.png" class="img-fluid rounded" style="width: 50%"></div>
                                                    <div class="p-2 bd-highlight"> <?php echo"$user_id" ?> </div>
                                                </div>
                                            </div>
                                            <div class="p-2 bd-highlight">
                                                <div class="flex-column bd-highlight mb-3">
                                                    <div class="p-2 bd-highlight"><i class="fa fa-star" style="font-size:24px;"></i></div>
                                                    <div class="p-2 bd-highlight" style="font-size: 12;"><strong class="text-success">Stars <?php echo"$rating" ?>/5 </strong></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php

                            };
                        };

                        ?>


                    </div>
                </div>
            </div>
        </div>

            
    </body>
</html>
