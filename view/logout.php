
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goodbye!</title>
    <?php include('components/includes.php')?>
</head>
<body>
<div class="mt-5 form-container">
    <div class="form-wrapper">
        <h1 class="accent">Logout of your Account?</h1>
        <p>Are you sure you want to logout?</p>
        <form action="logout" method="post">
            <a href="http://localhost/memorize/home">No, take me back!</a>
            <input class="form-item form-danger" type="submit" name="confirm">
        </form>
    </div>
</div>


</body>
</html>



