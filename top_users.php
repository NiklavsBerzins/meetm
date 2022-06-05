<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>


<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>


<div class="container">

<?php
$db = mysqli_connect('127.0.0.1', 'root', '', 'meetm');
$resultJOIN = $db->query
("SELECT users.id, users.username, user_data.user_id, user_data.rating 
FROM users,user_data WHERE users.id=user_data.user_id 
ORDER BY user_data.rating DESC");

?>

<?php
    $resultSet = $db->query("SELECT * FROM user_data ORDER BY rating DESC");

    if($resultJOIN->num_rows > 0){
        echo"
        <table border='1'>
        <tr>
            <th>Username</th>
            <th>User rating</th>
        ";

            while($rows = $resultJOIN->fetch_assoc()){
                $user_id = $rows['username'];
                $rating = $rows['rating'];
                echo"
                <tr>
                    <td>$user_id</td>
                    <td>$rating</td>
                </tr>
                ";
            }

        echo"
        </table>
        ";
    }else{
        echo "Nav atrasts";
    }

?>  

</div>

</body>
</html>


