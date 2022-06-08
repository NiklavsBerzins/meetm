<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <link href="./styles/mainPage.css" rel="stylesheet" type="text/css"/> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    if (isset($_GET['see'])) {
        $db = mysqli_connect('127.0.0.1', 'root', '', 'meetm');
        $username = $_GET['see'];
        $username = substr_replace($username, "", -1);
        $user_check_query = "SELECT * FROM users WHERE username='$username'LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        $userID = $user['id'];
        print_r($userID);
        $user_check_query = "SELECT * FROM user_data WHERE user_id='$userID' LIMIT 1";
        $result1 = mysqli_query($db, $user_check_query);
        $user1 = mysqli_fetch_assoc($result1);
        $about = $user1['about'];
        $date = $user1['date'];
        $gender = $user1['gender'];
        $interests = $user1['interests'];
        print_r($interests);
    }
    ?>

    <style>
        .img-logo {
            width: 30%;
            height: auto;
        }
    </style>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#"><i class="fa fa-home" style="font-size: 52px"></i></a>
            <a class="navbar-brand" href="#"><img class="img-logo" src="./images/GUI_14._grupa-removebg-preview.png" alt="logo"></img></a>
            <ul class="list-unstyled ml-4">
                <li><img src="images/userIcon.png" class="img-thumbnail rounded-circle mx-auto d-block" style="width: 30%"></li>
                <li>
                    <p class="font-weight-bold font-italic text-center d-block">Pikachu</p>
                </li>
                <li><a class="font-weight-bold text-center text-success d-block" href="#">Iziet</a></li>
            </ul>
        </nav>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2><?php echo '"' . $_GET['see'] . " " ?>profils</h2>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <p class="font-weight-bold">Par sevi</p>
                    <textarea cols="30" rows="5" class="form-control" readonly><?php echo $about; ?></textarea>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold" for="exampleInputEmail1">Intereses</label>
                    <input type="text" class="form-control mb-2" id="interestName">
                    <div class="border border-dark rounded p-2" id="interestsSection">

                    </div>
                    <button type="button" class="btn btn-success mt-2" id="addInterest">Saglabāt</button>
                </div>
            </div>
            <div class="col-4">
                <form>
                    <p class="font-weight-bold">Cits info</p>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Dzimšanas diena</label>
                        <input type="text" class="form-control" id="parole" aria-describedby="vecaParole" value='<?php echo $date ?>' readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Dzimums</label>
                        <input type="text" class="form-control" id="parole" aria-describedby="vecaParole" value='<?php echo $gender ?>' readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Profila novērtējums</label>
                        <input type="text" class="form-control" id="parole" aria-describedby="atkartotaJaunaParole">
                    </div>
                </form>
            </div>
            <div class="col-3">
                <h3 class="text-center">Lietotāja avatārs</h3>
                <img src="images/userIcon.png" class="img-thumbnail rounded mx-auto d-block">
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(() => {
            $("#addInterest").click(() => {
                var interest = $("#interestName").val();
                $("#interestsSection").append(`<button id=${interest} type="button" class="rounded" disabled>${interest}<span class="closing"><i id="${interest}" class="fa fa-close"></i></button></span>`);
                $("#interestName").val("");
            });

            $(document).on("click", ".closing", (event) => {
                var id = event.target.id;
                var button = $("button#" + id);
                button.remove();
            });
        });
    </script>

</body>

</html>