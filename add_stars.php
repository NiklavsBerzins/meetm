<?php
require_once('config.php');
session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
</head>

<body>
    <div id="rateYo"></div>

    <script src="jquery.js"></script>
    <script src="jquery.rateyo.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

    <script>
        $(function() {
            $(".rateyo").rateYo().on("rateyo.change", function(e, data) {
                var rating = data.rating;
                $(this).parent().find('.score').text('score :' + $(this).attr('data-rateyo-score'));
                $(this).parent().find('.result').text('rating :' + rating);
                $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
            });
        });
    </script>
</body>






<div class="container">
    <div class="row">

        <form action="add_stars.php" method="post">

            <div>
                <h3>User rating system</h3>
            </div>


            <div class="rateyo" id="rating" data-rateyo-rating="4" data-rateyo-num-stars="5" data-rateyo-score="3">
            </div>

            <span class='result'>0</span>

            <div>
                <label>ID</label>
                <br>
                <input type="tetx" name="user_id">
            </div>

            <div>
                <label>New rating</label>
                <br>
                <input type="tetx" name="rating">
                <br>
                <br>
                <button type="submit" name="submit">Change</button>
            </div>


    </div>

    <?php
    $userID = $_POST['user_id'];
    $rating = $_POST['rating'];

    $db = mysqli_connect('127.0.0.1', 'root', '', 'meetm');

    $sql = "UPDATE user_data SET rating = $rating WHERE user_id = $userID";
    mysqli_query($db, $sql);
    ?>