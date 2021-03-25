<?php
class profile extends Controller {


    public static function displayUserMemos() {

        if(login::isLoggedIn()) {
            
            $userId = login::isLoggedIn();

            $memos = database::query('SELECT memo_id, memo_title, memo_text FROM memo WHERE  fk_user = :userId', array(":userId"=>$userId));


            //prepare memoHtml variable and get the html for the memo's
            $memoHtml = '<div class="memoContainer">';
            $memoSkeleton = file_get_contents('./view/components/crudMemo.html');

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
            header("location:http://localhost/memorize/home");
        }

    }

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
                    echo "Length of memo must not exceed 150 characters";
                    
                } else if (strlen($title) > 60 || strlen($title) <1 ){
                    echo "Length of Title must not exceed 60 characters";

                //if lengths are in order then proceed with creation and redirect to profile
                } else {
                    database::query("INSERT INTO memo VALUES ('', :title, :body, :audience, :user)", array(":title"=>$title, ":body"=>$body, ":audience"=>$audience, ":user"=>$userId));
                    header('location:http://localhost/memorize/profile');
                }


                }

        } else {
            header('location:http://localhost/memorize/login');
        }
    }

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
                    $memoSkeleton = file_get_contents("http://localhost/memorize/view/components/".$file.".html");

                    $memoPrep = str_replace('{memoTitle}', $memoData[0]['memo_title'], $memoSkeleton);
                    $memoPrep = str_replace('{memoBody}', $memoData[0]['memo_text'], $memoPrep);
                    $memoPrep = str_replace('{memoId}', $memoId, $memoPrep);

                    echo $memoPrep;
                    
                }
            }
        } else {
            header('location:http://localhost/memorize/home');
        }
    }

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
                            echo "Length of memo must not exceed 150 characters";
                                
                        } else if (strlen($title) > 60 || strlen($title) <1 ){
                            echo "Length of Title must not exceed 60 characters";
            
                        //if lengths are in order then proceed with update and redirect to profile
                        } else {
                            database::query("UPDATE memo SET memo_title = :title, memo_text = :body, audience = :audience WHERE memo_id = :memoId", array(":title"=>$title, ":body"=>$body, ":audience"=>$audience, ":memoId"=>$memoId));
                            header('location:http://localhost/memorize/profile');
                        }

                    //if user is not the one who posted the memo send them back to home
                    } else {
                        header("location:http://localhost/memorize/home");
                    }
            
                }
            
            } else {
                header('location:http://localhost/memorize/login');
        }
    }

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

                                header('location:http://localhost/memorize/profile');
                                
        
                            //if user is not the one who posted the memo send them back to home
                            } else {
                                header("location:http://localhost/memorize/home");
                            }
                    
                        }
                    
                    } else {
                        header('location:http://localhost/memorize/login');
                }
    }

    public static function deleteAccount(){

    }


}

?>