<?php
class PostManager{
private $Posts;



function FetchPosts($DB,$status){

$this->Posts = $DB->getPosts($status);

return $this->Posts;
}

function display($DB,$Posts){

    foreach ($Posts as $Post) {
        $commentnr = $DB->commentCount($Post->PostID);    
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
            $_Sichtbarkeit=($_POST["checkPrivate"] == "on") ? 0 : 1 ;
            $_FKUserID=$CurrentUser->UserID;
            $NewPost = new Post($_PostID,"Fisch",$_Bildadresse,$_Bildname,$_Titel,$_Inhalt,$_Sichtbarkeit,$_FKUserID,$TagsSelected,1234,0,0);


            $DB->insertPost($NewPost);

        }

    }   
    function handleImgUpload($CurrentUser){

    if(!$_FILES["fileUpload"]["name"]==""){
        echo("isset fileupload");
        $targetDir = $CurrentUser->RootFolder ."/". basename($_FILES["fileUpload"]["name"]);
        $target_file = DIR_ROOT."/WEB_SS2020/WP/UsersRoot/".$CurrentUser->UserName ."/". basename($_FILES["fileUpload"]["name"]);
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

            $ImgProcessor = new ImageProcessor();
            $ImgProcessor->createThumbnail($target_file);    
            return [$targetDir,$fileName];
        }
        else {
            return 0;
        }



    }
        return ["localhost/WEB_SS2020/WP/ressources/pics/Default_img.png","Default_img.png"];

    }

function handleNewComment($DB,$PostID,$CurrentUserID,$Path){

    if(!empty($_POST["Comment_text"])){
        
        $validator = new Validator();
        $text = $validator->validate_string($_POST["Comment_text"]);
        $CreatedAt = Null;
        $NewComment = new Comment($text,$CurrentUserID,$PostID,$CreatedAt);

        $DB->insertComment($NewComment); 
        header("Refresh:0; url=$Path");   
    }
}

}
