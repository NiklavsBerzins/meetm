<?php
session_start();
$username = $_SESSION['username'];
?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> Profila rediģēšana </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <link href="./styles/mainPage.css" rel="stylesheet" type="text/css"/> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="registerStyle/front.css">
</head>

<body>
    <?php
    $db = mysqli_connect('127.0.0.1', 'root', '', 'meetm');
    $user_check_query = "SELECT * FROM users WHERE username='$username'LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    $userID = $user['id'];
    $user_check_query = "SELECT * FROM user_data WHERE user_id='$userID' LIMIT 1";
    $result1 = mysqli_query($db, $user_check_query);
    $user1 = mysqli_fetch_assoc($result1);

    $about = $user1['about'];
    $interests = $user1['interests'];
    $interestArray = explode("-", $interests);
    $finterestArray = array_filter($interestArray);
    $interestSize = sizeof($finterestArray);
    $x = 0;
    $tags = [];
    $tags = $finterestArray;
    print_r($tags);

    if (isset($_POST['aboutSave'])) {
        $aboutInput = $_POST['aboutInput'];
        $user_modify_query = "UPDATE user_data set about = '$aboutInput' WHERE user_ID = $userID";
        $result = mysqli_query($db, $user_modify_query);
        header("Location: user_change.php");
    }


    if (isset($_POST['interestSave'])) {
        $interests = $_POST['tags'];
        print_r($interests);
        print_r($userID);
        $user_modify_query = "UPDATE user_data set interests = '$interests' WHERE user_ID = $userID";
        $result = mysqli_query($db, $user_modify_query);
        header("Location: user_change.php");
    }

    $oldPasswordError = "";
    $newPassword = "";

    if (isset($_POST['passwordSave'])) {
        if (empty($_POST['oldPassword'])) {
            $oldPasswordError = "Ievadiet veco paroli!";
        } else {
            $oldPassword = $_POST['oldPassword'];

            $user_check_query = "SELECT * FROM users WHERE password='$oldPassword' LIMIT 1";
            $result = mysqli_query($db, $user_check_query);
            $user = mysqli_fetch_assoc($result);

            if ($user) {
                if ($newPassword2 == $newPassword) {
                    $user_modify_query = "UPDATE users set password = '$newPassword' WHERE id = $userID";
                    $result = mysqli_query($db, $user_modify_query);
                } else {
                    $oldPasswordError = "Atkārtotajai parolei ir jāsakrīt!";
                }
            } else {
                $oldPasswordError = "Ievadiet jūsu veco paroli pareizi!";
            }
        }
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
            <a class="navbar-brand" href="main.php"><i class="fa fa-home" style="font-size: 52px"></i></a>
            <a class="navbar-brand" href="main.php"><img class="img-logo" src="./images/GUI_14._grupa-removebg-preview.png" alt="logo"></img></a>
            <ul class="list-unstyled ml-4">
                <li><img src="images/userIcon.png" class="img-thumbnail rounded-circle mx-auto d-block" style="width: 30%"></li>
                <li>
                    <p class="font-weight-bold font-italic text-center d-block"><?php echo "$username"; ?></p>
                </li>
                <li><a class="font-weight-bold text-center text-success d-block" href="#">Iziet</a></li>
            </ul>
        </nav>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Profila rediģēšana</h2>
            </div>
            <div class="col-5">
                <form method="post">
                    <div class="form-group">
                        <p class="font-weight-bold">Par sevi</p>
                        <textarea cols="30" rows="5" class="form-control" name="aboutInput"><?php echo $about ?></textarea>
                        <input type="submit" class="btn btn-success mt-2" value="Saglabāt" name="aboutSave"></button></p>
                    </div>
                </form>
                <form method="post" onsubmit="inputTags()">
                    <div class="form-group">
                        <label class="font-weight-bold" for="exampleInputEmail1">Intereses</label>
                        <div class="container1">
                            <div class="tag-container">
                                <input />
                            </div>
                        </div>
                        <div class="invInput"></div>
                        <div class="border border-dark rounded p-2" id="interestsSection">

                        </div>
                        <input type="submit" class="btn btn-success mt-2" id="addInterest" value="Saglabāt" name="interestSave">
                    </div>
                </form>
            </div>
            <div class="col-4">
                <form>
                    <p class="font-weight-bold">Paroles maiņa</p>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Vecā parole</label>
                        <input type="text" class="form-control" id="parole" aria-describedby="vecaParole" name="oldPassword">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jaunā parole</label>
                        <input type="text" class="form-control" id="parole" aria-describedby="jaunaParole" name="newPassword">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Atkārtota jaunā parole</label>
                        <input type="text" class="form-control" id="parole" aria-describedby="atkartotaJaunaParole" name="newPassword2">
                    </div>
                    <input type="submit" class="btn btn-success" value="Saglabāt" name="passwordSave">
                    <span><?php $oldPasswordError ?></span>
                </form>
            </div>
            <div class="col-3">
                <h3 class="text-center">Tavs avatārs</h3>
                <img src="images/userIcon.png" class="img-thumbnail rounded mx-auto d-block">
                <button type="button" class="btn btn-success btn-block mt-2">Izvēlēties avatāru</button>
                <button type="button" class="btn btn-success btn-block mt-2">Saglabāt</button>
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
<script>
    const tagContainer = document.querySelector('.tag-container');

    const input = document.querySelector('.tag-container input');

    const invInput = document.querySelector('.invInput');

    var tags = new Array();
    <?php foreach ($finterestArray as $interest) { ?>
        tags.push('<?php echo $interest; ?>');
    <?php } ?>
    tags = tags.filter(element => {
        return element !== '';
    })



    addTags();


    function createTag(label) {
        const div = document.createElement('div');
        div.setAttribute('class', 'tag');
        const span = document.createElement('span');
        span.innerHTML = label;
        const closeBtn = document.createElement('span');
        closeBtn.setAttribute('class', 'material-icons');
        closeBtn.setAttribute('data-item', label);
        closeBtn.innerHTML = 'close';
        div.appendChild(span);
        div.appendChild(closeBtn);
        return div;
    }

    function Tags() {
        const tagPost = document.createElement('input');
        tagPost.setAttribute('type', 'hidden');
        tagPost.setAttribute('value', setInvTag());
        tagPost.setAttribute('name', 'tags')
        return tagPost;
    }

    function setInvTag() {
        interestTags = tags.join('-');
        return interestTags;
    }

    function inputTags() {
        invInput.appendChild(Tags());
    }

    function reset() {
        document.querySelectorAll('.tag').forEach(function(tag) {
            tag.parentElement.removeChild(tag);
        })
    }

    function addTags() {
        reset();
        tags.slice().reverse().forEach(function(tag) {
            const input = createTag(tag);
            tagContainer.prepend(input);
        })
    }

    if (input) {
        input.addEventListener('keyup', function(e) {
            if (e.key === " ") {
                // const tag = createTag(input.value);
                // tagContainer.prepend(tag);
                tags.push(input.value)
                addTags();
                console.log(tags);
                input.value = '';
            }
        })
    }
    document.addEventListener('click', function(e) {
        if (e.target.className === 'material-icons') {
            const value = e.target.getAttribute('data-item');
            const index = tags.indexOf(value);
            tags = [...tags.slice(0, index), ...tags.slice(index + 1)];
            addTags();
        }
    })

    function submitButtonClick() {
        fetch(ConfigApp.URL + 'user_change.php', {
                method: 'POST',
                header: {
                    Accept: 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'action test',
                    p: 'addSession',
                }),
            })
            .then(response => response.json())
            .then(responseJson => {
                console.warn(responseJson)
            })
            .catch(function(error) {
                console.warn(String.no_result + error.message);
            })
    }

    function sendData(path, parameters, method = 'post') {

        const form = document.createElement('form');
        form.method = method;
        form.action = path;
        document.body.appendChild(form);

        for (const key in parameters) {
            const formField = document.createElement('input');
            formField.type = 'hidden';
            formField.name = key;
            formField.value = parameters[key];

            form.appendChild(formField);
        }
        form.submit();
    }

    function senddata1() {
        sendData('register2.php', {
            query: 'hello world',
            num: '1'
        });
    }
</script>

</html>