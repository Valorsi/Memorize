

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <?php include('components/includes.php')?>
</head>
<body>
<div class="d-flex justify-content-center">
    <img src="./img/memorizelogo.png" alt="">
</div>
<div class="form-container">
    <div class="form-wrapper">
        <form action="login" method="POST">
            <label for="email">E-mail Address</label>
            <input class="mb-4 form-item" type="text" name="email" placeholder="Your e-mail address..." value="">
            <label for="password">Password</label>
            <input class="mb-4 form-item" type="password" name="password" placeholder="Your Password..." value="">
            <input class="mb-4 form-item" type="submit" name="login">
        </form>
        <h4>Don't have an Account yet? <a href="http://boris.codefactory.live/memorize/register">Register Here!</a></h4>
    </div>
</div>



</body>
</html>



