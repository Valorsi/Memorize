<?php 

Route::set('profile', function() {
    ob_start();
    profile::createView('profile');
    profile::displayUserMemos();
    ob_end_flush();
});

Route::set('home', function() {
    ob_start();
    home::createView('home');
    home::redirectOffline();
    home::displayPublicMemos();
    ob_end_flush();
});


Route::set('register', function() {
    ob_start();
    register::createView('register');
    register::registerUser();
    ob_end_flush();
});

Route::set('login', function() {
    ob_start();
    login::createView('login');
    login::userLogin();
    ob_end_flush();

});

Route::set('logout', function() {
    ob_start();
    logout::userLogout();
    logout::createView('logout');
    ob_end_flush();
});

Route::set('create-memo', function(){
    ob_start();
    profile::createView('createMemo');
    profile::createMemo();
    ob_end_flush();
});

Route::set('edit-memo', function(){
    ob_start();
    profile::createView('editMemo');
    profile::editMemo();
    profile::getMemo('editMemo');
    ob_end_flush();

});

Route::set('delete-memo', function(){
    ob_start();
    profile::createView('deleteMemo');
    profile::deleteMemo();
    profile::getMemo('deleteMemo');
    ob_end_flush();
});

Route::set('delete-account', function(){
    ob_start();
    profile::createView('deleteAccount');
    profile::deleteAccount();
});

Route::set('admin-dashboard', function() {
    ob_start();
    admin::createView('admin');
    admin::getAdminDashboard();
    ob_end_flush();
});

Route::set('upgrade-user', function() {
    ob_start();
    admin::createView('upgradeUser');
    admin::upgradeUser();
    admin::getUser('upgradeUser');
    ob_end_flush();
});

Route::set('ban-user', function() {
    ob_start();
    admin::createView('banUser');
    admin::banUser();
    admin::getUser('banUser');
    ob_end_flush();
})


?>