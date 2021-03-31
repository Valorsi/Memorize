<?php 

Route::set('profile', function() {
    profile::createView('profile');
    profile::displayUserMemos();
});

Route::set('home', function() {
    home::createView('home');
    home::redirectOffline();
    home::displayPublicMemos();
});


Route::set('register', function() {
    register::createView('register');
    register::registerUser();
});

Route::set('login', function() {
    login::createView('login');
    login::userLogin();
});

Route::set('logout', function() {
    
    logout::userLogout();
    logout::createView('logout');

});

Route::set('create-memo', function(){
    profile::createView('createMemo');
    profile::createMemo();
});

Route::set('edit-memo', function(){
    profile::createView('editMemo');
    profile::editMemo();
    profile::getMemo('editMemo');

});

Route::set('delete-memo', function(){
    profile::createView('deleteMemo');
    profile::deleteMemo();
    profile::getMemo('deleteMemo');
});

Route::set('delete-account', function(){
    profile::createView('deleteAccount');
    profile::deleteAccount();
});

Route::set('admin-dashboard', function() {
    admin::createView('admin');
    admin::getAdminDashboard();
});

Route::set('upgrade-user', function() {
    admin::createView('upgradeUser');
    admin::upgradeUser();
    admin::getUser('upgradeUser');
});

Route::set('ban-user', function() {
    admin::createView('banUser');
    admin::banUser();
    admin::getUser('banUser');
})


?>