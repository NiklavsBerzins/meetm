<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="./registerStyle/front.css">
</head>

<body>
    <div class="container">
        <div class="tag-container">
            <input />
        </div>
    </div>
</body>
<script>
    const tagContainer = document.querySelector('.tag-container');

    const input = document.querySelector('.tag-container input');

    var tags = [];

    function createTag(label) {
        const div = document.createElement('div');
        div.setAttribute('class', 'tag');
        const span = document.createElement('span');
        span.innerHTML = label;
        const closeBtn = document.createElement('span');
        closeBtn.setAttribute('class', 'material-icons');
        closeBtn.innerHTML = 'close';

        div.appendChild(span);
        div.appendChild(closeBtn);
        return div;
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
            if (e.key === "Enter") {
                // const tag = createTag(input.value);
                // tagContainer.prepend(tag);
                tags.push(input.value)
                addTags();
                input.value = '';
            }
        })
    }
</script>

</html>