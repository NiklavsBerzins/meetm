<?php
require_once('config.php');
session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> MeetM </title>
    <link href="./styles/textField.css" rel="stylesheet" type="text/css" />
    <link href="./styles/mainPage.css" rel="stylesheet" type="text/css" />
    <link href="./styles/radiobutton.css" rel="stylesheet" type="text/css" />
    <link href="./styles/button.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="registerStyle/front.css">
    <link href="./styles/mainStyle.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="contBox">
        <?php if (isset($_POST['create'])) {
            $username = $_SESSION['username'];
            $db = mysqli_connect('127.0.0.1', 'root', '', 'meetm');
            $user_ID_query = "SELECT * FROM users WHERE username='$username'LIMIT 1";
            $result = mysqli_query($db, $user_ID_query);
            $user = mysqli_fetch_assoc($result);
            $userID = $user['id'];
            $user_tags = $_POST['tags'];
            $user_about = $_POST['about'];
            $user_gender = '';
            if ($_POST['select'] == 1) {
                $user_gender = "Vīrietis";
            } elseif ($_POST['select'] == 2) {
                $user_gender = "Sieviete";
            }
            $user_date = $_POST['date'];

            // $query = "insert into user_data (user_id, rating, interests, about, date, gender) values ($userID, 0,'$user_tags', '$user_about', '$user_gender')";
            // $stmtinsert = $db->prepare($query);
            // $insert_result = $stmtinsert->execute();
            echo $userID;
            $user_data_insertion = "INSERT INTO user_data (user_id, rating, interests, about, date, gender)
        VALUES ($userID, 0, '$user_tags', '$user_about', '$user_date', '$user_gender')";
            mysqli_query($db, $user_data_insertion);
            header("Location: main.php");
        } ?>

        <?php print_r($_POST);
        print_r($_SESSION['username']) ?>
        <form method="post" onsubmit="inputTags()">
            <div class="inputCont" style="width: 750px;" id="register2">
                <img src="./images/GUI_14._grupa-removebg-preview.png" alt="logo"></img>
                <div class="container1">
                    <h3 class="interests">Intereses</h3>
                    <div class="tag-container">
                        <input />
                    </div>
                </div>
                <div class="invInput"></div>

                <label for="inp" class="inp">
                    <textarea name="about" id="username" rows="4" placeholder="&nbsp;"></textarea>
                    <span class="label">Par sevi</span>
                    <span class="focus-bg"></span>
                </label>

                <label for="inp" class="inp">
                    <input name="date" type="date" id="calendar" value="" placeholder="&nbsp;">
                    <span class="label">Dzimšanas diena</span>
                    <span class="focus-bg"></span>
                </label>

                <div class="wrapper">
                    <input type="radio" value="1" name="select" id="option-1" checked>
                    <input type="radio" value="2" name="select" id="option-2">
                    <label for="option-1" class="option option-1">
                        <div class="dot"></div>
                        <span>Sieviete</span>
                    </label>
                    <label for="option-2" class="option option-2">
                        <div class="dot"></div>
                        <span>Vīrietis</span>
                    </label>
                </div>

                <input type="submit" class="login-btn" id="register2Submit" name="create" value="Reģistrēties" />
            </div>
        </form>
    </div>

</body>
<script>
    const tagContainer = document.querySelector('.tag-container');

    const input = document.querySelector('.tag-container input');

    const invInput = document.querySelector('.invInput');

    var tags = [];

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
        fetch(ConfigApp.URL + 'register2.php', {
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