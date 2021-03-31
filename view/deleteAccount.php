<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete your Account?</title>
    <?php include('components/includes.php')?>
</head>
<body>

<h1>Are you sure you want to delete your Account? This action is irreversible!</h1>

<form action="delete-account" method="POST">
    <a href="http://localhost/memorize/profile">No, go back</a>
    <input type="submit" name="delete-account">
</form>


</body>
</html>




