

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Memo!</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>

<h1>Write your memo~</h1>
<form action="create-memo" method="POST">
    <input type="text" name="title" placeholder="Title your Memo..." value="">
    <textarea rows="5" cols="50" name="body" placeholder="Note to self:..." value=""></textarea>
    <select name="audience" >
        <option value="public">Public</option>
        <option value="private">Private</option>
    </select>
    <input type="submit" name="create-memo">
</form>

</body>
</html>



