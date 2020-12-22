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
    function handleNewPost($DB,$CurrentUser){

        if(
            isset($_POST["Titel"]) &&
            isset($_POST["Textarea1"])
        ){
            
            $validator= new Validator();

            $Title = $validator->validate_string($_POST["Titel"]);
            $Text = $validator->validate_string($_POST["Textarea1"]);
            
            $TagsSelected = array();
            $Tags=$DB->allTags();            

            foreach ($Tags as $Tag) {
                if(isset($_POST[$Tag[0]]))
                {
                    array_push($TagsSelected,$Tag);
                }
                
            }
            print_r($TagsSelected);


            $ImageUpload = $this->handleImgUpload($CurrentUser);

            $_PostID = NUll;
            $_Bildadresse = $ImageUpload[0];
            $_Bildname= $ImageUpload[1];
            $_Titel = $Title;
            $_Inhalt = $Text;
            $_Sichtbarkeit= 1;
            $_FKUserID=$CurrentUser->UserID;
            $NewPost = new Post($_PostID,$_Bildadresse,$_Bildname,$_Titel,$_Inhalt,$_Sichtbarkeit,$_FKUserID,$TagsSelected);


            $DB->insertPost($NewPost);

        }

    }   
    function handleImgUpload($CurrentUser){

    if(isset($_FILES["fileUpload"])){

        $targetDir = $CurrentUser->RootFolder;
        $target_file = $targetDir . DIRECTORY_SEPARATOR . basename($_FILES["fileUpload"]["name"]);
        $fileName=basename($_FILES["fileUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        //check image type: 
        if(  $imageFileType != "jpg" &&
             $imageFileType != "png" &&
             $imageFileType != "jpeg"&&
             $imageFileType != "gif" )
             {
                echo "Only JPG, JPEG, PNG & GIF files are allowed.";
                return 0;
             }

        //upload to User directory
        if(move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)){
            return [$target_file,$fileName];
        }
        else {
            return 0;
        }



    }
        return 0;

    }



}
