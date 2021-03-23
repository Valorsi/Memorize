<?php 

Route::set('profile', function() {
    echo "userProfile";
    profile::createView('profile');
});

Route::set('home', function() {
    echo "home";
    home::createView('home');
    home::isLoggedIn();
});

Route::set('admin-dashboard', function() {
    echo "admins only";
    admin::createView('admin');
});

Route::set('register', function() {
    echo "Registration";
    register::createView('register');
    register::registerUser();
});

Route::set('login', function() {
    echo "Login";
    login::createView('login');
    login::userLogin();
});


?>