<?php
class PostManager{
private $Posts;



function FetchPosts($DB,$status){

$this->Posts = $DB->getPosts($status);

return $this->Posts;
}

function display($DB,$Posts){

    foreach ($Posts as $Post) {
        $commentnr = $DB->commentCount($Post['PostID']);    
        include "components/post.comp.php";
    }

}
function handleNewPost(){

if(
    isset($_POST["Titel"]) &&
    isset($_POST["Textarea"])
){

   // insert logic for inserting new post plus upload

}

}
function HandleImgUpload(){

}



}
?>
