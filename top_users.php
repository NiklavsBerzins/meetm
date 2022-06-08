<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> TOP lietotāji </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <link href="./styles/mainPage.css" rel="stylesheet" type="text/css"/> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<style>
    .img-logo {
        width: 30%;
        height: auto;
    }
</style>

<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="page1.html"><i class="fa fa-home" style="font-size: 52px"></i></a>
        <a class="navbar-brand" href="page1.html"><img class="img-logo" src="./images/GUI_14._grupa-removebg-preview.png" alt="logo"></img></a>

        <ul class="list-unstyled ml-4">
            <li><a href="page3.html"><img src="images/userIcon.png" class="img-thumbnail rounded-circle mx-auto d-block" style="width: 30%"></a></li>
            <li><p class="font-weight-bold font-italic text-center d-block">Pikachu</p></li>
            <li><a class="font-weight-bold text-center text-success d-block" href="#">Iziet</a></li>
        </ul>
    </nav>
</div>



<div class="container">
    <div class="row">
        <div class="col-12 text-left">
            <h2><strong class="text-success">TOP</strong> lietotāji</h2>
        </div>

    </div>
</div>




    <?php
    $db = mysqli_connect('127.0.0.1', 'root', '', 'meetm');
    $resultJOIN = $db->query
    ("SELECT users.id, users.username, user_data.user_id, user_data.rating
            FROM users,user_data WHERE users.id=user_data.user_id
            ORDER BY user_data.rating DESC");

    ?>

    <?php


    if($resultJOIN->num_rows > 0){

    $i = 1;

    while($rows = $resultJOIN->fetch_assoc()){
    if ($i = 3) {
        ?>   <br>  <?php
    }

    $user_id = $rows['username'];
    $rating = $rows['rating'];


    ?>

    <div class="d-flex justify-content-center">
        <div class="bd-highlight mb-3">
            <div class="d-flex flex-row bd-highlight mb-3">
                <div class="p-2 bd-highlight">
                    <div class="flex-column bd-highlight mb-3">
                        <div class="p-2 bd-highlight"><i class="fa fa-star" style="font-size:24px;"></i></div>
                        <div class="p-2 bd-highlight" style="font-size: 12;"><strong class="text-success"><?php echo"$rating" ?> </strong></div>
                    </div>
                </div>
                <div class="p-2 bd-highlight">
                    <div class="flex-column bd-highlight mb-3">
                        <div class="p-2 bd-highlight"><img src="images/userIcon.png" class="img-fluid rounded" style="width: 50%"></div>
                        <div class="p-2 bd-highlight"> <?php echo"$user_id" ?> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



        <?php

        };
        };
        ?>




        <footer class="footer bg-light">
            <div class="row">
                <div class="col-4">
                    <a href="#" class="text-success float-left"><i class="fa fa-arrow-left"></i></a>
                </div>
                <div class="col-4">
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-circle pg-blue">
                            <li class="mr-4 page-item active">1</li>
                            <li class="mr-4 page-item">2</li>
                            <li class="mr-4 page-item">3</li>
                            <li class="mr-4 page-item disabled">...</li>
                            <li class="mr-4 page-item">100</li>
                        </ul>
                    </nav>
                </div>
                <div class="col-4">
                    <a href="#" class="text-success float-right"><i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </footer>




</html>
