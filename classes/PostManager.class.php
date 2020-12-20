<?php
class PostManager{
private $Posts;



function FetchPosts($DB,$status){

$this->Posts = $DB->getPosts($status);

return $this->Posts;
}

function display($Posts){

    foreach ($Posts as $Post) {    
        include "components/post.comp.php";
    }

}



}
?>
