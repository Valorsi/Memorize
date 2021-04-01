
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <?php include('components/includes.php')?>
</head>
<body>

    <h1 class="accent m-5">Register</h1>
    
<div class="form-container">
    <div class="form-wrapper">
        <form action="register" method="POST">
            <label for="firstName">First Name</label>
            <input required class="form-item mb-4" type="text" name="firstName" placeholder="Your first Name...">
            <label for="lastName">Last Name</label>
            <input required class="form-item mb-4" type="text" name="lastName" placeholder="Your last Name...">
            <label for="e-mail">E-mail Address</label>
            <input required class="form-item mb-4" type="email" name="email" placeholder="Your e-mail address..." value="">
            <label for="e-mail confirm">Confirm E-mail Address</label>
            <input required class="form-item mb-4" type="email" name="emailConfirm" placeholder="Confirm your e-mail address..." value="">
            <label for="password">Password <br><span class="info-text">(Must be atleast 8 digits and have 1 Uppercase letter, 1 Lowercase letter, 1 number and 1 special character)</span></label>
            <input required class="form-item mb-4" type="password" name="password" placeholder="Your Password..." value="">
            <label for="confirm password">Confirm Password</label>
            <input required class="form-item mb-4" type="password" name="passwordConfirm" placeholder="Confirm Your Password..." value="">
            <input class="form-item mb-4" type="submit" name="register">
        </form>
    </div>
</div>

</body>
</html>



