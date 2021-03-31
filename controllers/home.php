<?php
class home extends Controller {
    
    public static function displayPublicMemos(){

        $memos = database::query('SELECT memo_title, memo_text FROM memo WHERE audience=:audience', array(":audience"=>"public"));


        //prepare memoHtml variable and get the html for the memo's
        $memoHtml = '<div class="memoContainer row">';
        $memoSkeleton = file_get_contents('./view/components/memo.html');

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

    public static function redirectOffline() {
        if(login::isLoggedIn()) {

        } else {
            header('location:http://localhost/memorize/login');
        }
    }

}

?>