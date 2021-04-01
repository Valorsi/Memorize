<?php
require_once('controller.php');
class profile extends Controller {

    //Takes the data from the User's Created memo's and loads them into HTML. This function displays both private and public memos.
    public static function displayUserMemos() {

        if(login::isLoggedIn()) {
            
            $userId = login::isLoggedIn();

            $memos = database::query('SELECT memo_id, memo_title, memo_text FROM memo WHERE  fk_user = :userId', array(":userId"=>$userId));


            //prepare memoHtml variable and get the html for the memo's
            $memoHtml = '<div class="memo-container row">';
            $memoSkeleton = controller::curl_file_get_contents('http://boris.codefactory.live/memorize/view/components/crudMemo.html');

            foreach($memos as $memo){
                //reset memoPrep to standard html for the memo
                $memoPrep = $memoSkeleton;

                //replace the placeholder title and text
                $memoPrep = str_replace('{memoTitle}', $memo['memo_title'], $memoPrep);
                $memoPrep = str_replace('{memoText}', $memo['memo_text'], $memoPrep);

                //replace the memoId placeholder with the id of the memo
                $memoPrep = str_replace('{memoId}', $memo['memo_id'], $memoPrep);


                //append the finished memo into variable
                $memoHtml.= $memoPrep;
            }

            //append closing tag to memoContainer
            $memoHtml .= "</div>";

            //Echo the HTML 
            echo $memoHtml;

        } else {
            controller::redirectTo("home");
        }

    }


    //Function takes data from POST and creates a database entry for a new Memo.
    public static function createMemo(){

        //if user is logged in proceed, else send them to login
        if(login::isLoggedIn()){
            
            //if user clicked submit
            if(isset($_POST['create-memo'])) {

                //store post variables and strip them of tags
                $title = trim(strip_tags($_POST['title']));
                $body = trim(strip_tags($_POST['body']));
                $audience = trim(strip_tags($_POST['audience']));
                $userId = login::isLoggedIn();

                //Check if length of title and Body are exceeded
                if(strlen($body) > 150 || strlen($body) < 1) {
                    controller::displayError('Incorrect Length', 'Memo must not be empty or exceed 150 characters.');
                    
                } else if (strlen($title) > 40 || strlen($title) <1 ){
                    controller::displayError('Incorrect Length', 'Title must not be empty or exceed 40 characters.');

                //if lengths are in order then proceed with creation and redirect to profile
                } else {
                    database::query("INSERT INTO memo (memo_title, memo_text, audience, fk_user) VALUES (:title, :body, :audience, :user)", array(":title"=>$title, ":body"=>$body, ":audience"=>$audience, ":user"=>$userId));
                    controller::redirectTo('profile');
                }


                }

        } else {
            controller::redirectTo('login');
        }
    }

    //Function takes data from GET and loads a specific memo into form HTML. Is used for Editing and Deleting memo's.
    public static function getMemo($file){

        $memoId = $_GET['memo'];

        //Checks if memo exists
        if(database::query("SELECT memo_id FROM memo WHERE memo_id = :memoId", array(":memoId"=>$memoId))) {
        //if user is logged in grab their ID
            if(login::isLoggedIn()) {
                $userId = login::isLoggedIn();


                //if Memo (foreign key)fk_user is the same as the user's id proceed
                if(database::query("SELECT fk_user FROM memo WHERE memo_id = :memoId", array(":memoId"=>$memoId))[0][0] == $userId) {

                    $memoData = database::query("SELECT memo_title, memo_text FROM memo WHERE memo_id = :memoId", array(":memoId"=>$memoId));
                    $memoSkeleton = controller::curl_file_get_contents("http://boris.codefactory.live/memorize/view/components/".$file.".html");

                    $memoPrep = str_replace('{memoTitle}', $memoData[0]['memo_title'], $memoSkeleton);
                    $memoPrep = str_replace('{memoBody}', $memoData[0]['memo_text'], $memoPrep);
                    $memoPrep = str_replace('{memoId}', $memoId, $memoPrep);

                    echo $memoPrep;
                    
                }
            }
        } else {
            controller::redirectTo('home');
        }
    }

    //Function takes data from POST and UPDATES memo according to the data given. 
    public static function editMemo(){
    
            //if user is logged in proceed, else send them to login
            if(login::isLoggedIn()){
                
                //if user clicked submit
                if(isset($_POST['edit-memo'])) {
            
                    //store post variables and strip them of tags
                    $title = trim(strip_tags($_POST['title']));
                    $body = trim(strip_tags($_POST['body']));
                    $audience = trim(strip_tags($_POST['audience']));
                    $userId = login::isLoggedIn();
                    $memoId = $_GET['memo'];

                    //Check if logged in user is the same as the user who posted the memo
                    if(database::query("SELECT fk_user FROM memo WHERE memo_id = :memoId", array(":memoId"=>$memoId))[0][0] == $userId){
            
                    //Check if length of title and Body are exceeded
                        if(strlen($body) > 150 || strlen($body) < 1) {
                            controller::displayError('Incorrect Length', 'Memo must not be empty or exceed 150 characters.');
                                
                        } else if (strlen($title) > 40 || strlen($title) <1 ){
                            controller::displayError('Incorrect Length', 'Title must not be empty or exceed 40 characters.');
            
                        //if lengths are in order then proceed with update and redirect to profile
                        } else {
                            database::query("UPDATE memo SET memo_title = :title, memo_text = :body, audience = :audience WHERE memo_id = :memoId", array(":title"=>$title, ":body"=>$body, ":audience"=>$audience, ":memoId"=>$memoId));
                            controller::redirectTo('profile');
                        }

                    //if user is not the one who posted the memo send them back to home
                    } else {
                        controller::redirectTo("home");
                    }
            
                }
            
            } else {
                controller::redirectTo('login');
        }
    }

    //Function deletes Memo.
    public static function deleteMemo(){

                    //if user is logged in proceed, else send them to login
                    if(login::isLoggedIn()){
                
                        //if user clicked submit proceed
                        if(isset($_POST['delete-memo'])) {
                    
                            //store post variables and strip them of tags
                            $userId = login::isLoggedIn();
                            $memoId = $_GET['memo'];
        
                            //Check if logged in user is the same as the user who posted the memo
                            if(database::query("SELECT fk_user FROM memo WHERE memo_id = :memoId", array(":memoId"=>$memoId))[0][0] == $userId){

                                database::query("DELETE FROM memo WHERE memo_id = :memoId", array(':memoId'=>$memoId));

                                controller::redirectTo('profile');
                                
        
                            //if user is not the one who posted the memo send them back to home
                            } else {
                                controller::redirectTo('home');
                            }
                    
                        }
                    
                    } else {
                        controller::redirectTo('login');
                }
    }

    //Function enables user to delete their account.
    public static function deleteAccount(){

                    //if user is logged in proceed, else send them to login
                    if(login::isLoggedIn()){
                
                        //if user clicked submit proceed
                        if(isset($_POST['delete-account'])) {
                            
                            //grab the user's id and proceed to deletion
                            $userId = login::isLoggedIn();
                            
                            database::query("DELETE FROM login_tokens WHERE fk_users_id = :userId", array(':userId'=>$userId));
                            database::query("DELETE FROM users WHERE users_id = :userId", array(':userId'=>$userId));

                            controller::redirectTo('login');
                    
                        }
                    
                    } else {
                        controller::redirectTo('login');
                }
    }


}

?>