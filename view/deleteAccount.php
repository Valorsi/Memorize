<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete your Account?</title>
    <?php include('components/includes.php')?>
</head>
<body>



<div class="form-container m-5">
    <div class="form-wrapper">
        <h1 class="dark">Are you sure you want to delete your Account? This action is irreversible!</h1>
        <form action="delete-account" method="POST">
            <a href="http://boris.codefactory.live/memorize/profile">No, go back</a>
            <input type="submit" name="delete-account" class="form-item form-danger">
        </form>

    </div>
</div>


</body>
</html>




