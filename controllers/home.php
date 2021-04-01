<?php
require_once('controller.php');

class home extends Controller {
    
    //Gets all public memos and loads the data from them into HTML, then displays them.
    public static function displayPublicMemos(){

        $memos = database::query('SELECT memo_title, memo_text FROM memo WHERE audience=:audience', array(":audience"=>"public"));


        //prepare memoHtml variable and get the html for the memo's
        $memoHtml = '<div class="memo-container row">';
        $memoSkeleton = controller::curl_file_get_contents('http://boris.codefactory.live/memorize/view/components/memo.html');

        foreach($memos as $memo){
            //reset memoPrep to standard html for the memo
            $memoPrep = $memoSkeleton;

            //replace the placeholder title and text
            $memoPrep = str_replace('{memoTitle}', $memo['memo_title'], $memoPrep);
            $memoPrep = str_replace('{memoText}', $memo['memo_text'], $memoPrep);

            //append the finished memo into variable
            $memoHtml.= $memoPrep;
        }

        //append closing tag to memoContainer
        $memoHtml .= "</div>";

        //Echo the HTML 
        echo $memoHtml;
        
    }


    //Redirects users who are not logged in to the login page.
    public static function redirectOffline() {
        if(login::isLoggedIn()) {

        } else {
            controller::redirectTo('login');
        }
    }

}

?>