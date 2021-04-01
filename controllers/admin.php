<?php

require_once('controller.php');
class admin extends Controller {
    

    // Function checks if current user is an Admin. 
    public static function isAdmin() {
        
        //Check if user is logged in
        if(login::isLoggedIn()) {

            $userId = login::isLoggedIn();

            //Check if user has the role of admin
            if (database::query("SELECT role FROM users WHERE users_id=:userId", array(':userId'=>$userId))[0]['role'] == "admin") {
                return true;

            //if they are not an admin they will be redirected 
            } else {
                controller::redirectTo('home');
            }
        
        //if they are not logged in they will be redirected
        } else {
            controller::redirectTo('home');
        }

        
        return false;

    }


    // Function creates Admin Dashboard from fetched user Data. and Echoes the HTML on to the page.
    public static function getAdminDashboard() {

        if(admin::isAdmin()) {

            $userList = database::query("SELECT first_name, last_name, email, role, users_id FROM users");

            $tableHtml = "<div class='table-container'><table class='admin-dashboard'><tr><th>Full Name</th><th>E-mail</th><th>Role</th><th>Actions</th></tr>";
            $tableEnd = "</table></div>";
            $tableRow = controller::curl_file_get_contents('http://boris.codefactory.live/memorize/view/components/dashboardUser.html');

            foreach($userList as $u) {
                
                $userRow = $tableRow;

                $userRow = str_replace("{firstName}", $u['first_name'], $userRow);
                $userRow = str_replace("{lastName}", $u['last_name'], $userRow);
                $userRow = str_replace("{emailAddress}", $u['email'], $userRow);
                $userRow = str_replace("{role}", $u['role'], $userRow);
                $userRow = str_replace("{userId}", $u['users_id'], $userRow);
                
                $tableHtml .= $userRow;

            }

            $tableHtml .= $tableEnd;

            echo $tableHtml;

        }

    }


    //Get's the User's ID, first name, last name ,email and loads them into the HTML Forms for Upgrade/Ban functions.
    public static function getUser($mode) {

        $userId = $_GET['userId'];

        $userData = database::query("SELECT users_id, first_name, last_name, email FROM users WHERE users_id = :userId", array(":userId"=>$userId));
        $userSkeleton = controller::curl_file_get_contents("http://boris.codefactory.live/memorize/view/components/".$mode.".html");


        $userPrep = str_replace('{firstName}', $userData[0]['first_name'], $userSkeleton);
        $userPrep = str_replace('{lastName}', $userData[0]['last_name'], $userPrep);
        $userPrep = str_replace('{email}', $userData[0]['email'], $userPrep);
        $userPrep = str_replace('{userId}', $userData[0]['users_id'], $userPrep);

        echo $userPrep;
                    

    }


    // Function Upgrades user to Admin Status
    public static function upgradeUser() {

        if(admin::isAdmin()) {

            if (isset($_POST['upgrade-user'])) {
                
                $userId = $_POST['userId'];

                if (database::query("SELECT * FROM users WHERE users_id = :userId", array(":userId"=>$userId))) {
                    
                    database::query("UPDATE users SET `role` = 'admin' WHERE users_id = :userId", array(":userId"=>$userId));

                    controller::redirectTo("admin-dashboard");

                } else {
                    controller::displayError('Oops', 'Something went wrong, try again later?');
                }
            } 
        }

    }

    // Function deletes a user and their login tokens from the dabatase
    public static function banUser() {

        if(admin::isAdmin()) {

            if (isset($_POST['ban-user'])) {
                
                $userId = $_POST['userId'];

                if (database::query("SELECT * FROM users WHERE users_id = :userId", array(":userId"=>$userId))) {
                    
                    database::query("DELETE FROM users WHERE users_id = :userId", array(":userId"=>$userId));
                    database::query("DELETE FROM login_tokens WHERE fk_users_id = :userId", array(":userId"=>$userId));

                    controller::redirectTo("admin-dashboard");

                } else {
                    controller::displayError('Oops', 'Something went wrong, try again later?');
                }
            } 
        }
    }

}


?>