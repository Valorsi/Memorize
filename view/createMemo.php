

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Memo!</title>
    <?php include('components/includes.php')?>
</head>
<body>
<?php include('components/navbar.html')?>

<h1 class="accent m-5">Write your memo~</h1>
<div class="form-container">
    <div class="form-wrapper">
        <form action="create-memo" method="POST">
            <div class="d-flex justify-content-between">
                <label for="title">Memo Title</label>
                <input type="text" class="countdown" readonly name="titleCountdown" size="3" value="40">
            </div>
            <input class="mb-4 form-item" type="text" name="title" placeholder="Title your Memo..." value="" maxlength="40" onkeydown="limitText(this.form.title, this.form.titleCountdown, 40)" onkeyup="limitText(this.form.title, this.form.titleCountdown, 40)">
            <div class="d-flex justify-content-between">
                <label for="body">Memo Content</label>
                <input type="text" class="countdown" readonly name="bodyCountdown" size="3" value="150">
            </div>
            <textarea class="mb-4 form-item" rows="5" cols="50" name="body" placeholder="Note to self:..." value="" maxlength="150" onkeydown="limitText(this.form.body, this.form.bodyCountdown, 150)" onkeyup="limitText(this.form.body, this.form.bodyCountdown, 150)"></textarea>
            <label for="audience">Audience</label>
            <select class="mb-4 form-item" name="audience" >
                <option value="public">Public</option>
                <option value="private">Private</option>
            </select>
            <input type="submit" name="create-memo" class="form-item">
        </form>
    </div>
</div>
</body>
</html>



