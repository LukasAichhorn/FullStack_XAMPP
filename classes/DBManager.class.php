<?php
class DBManager
{
    private $DB_LOCATION = "localhost";
    private $DB_USER = "root";
    private $DB_PW = "hl03VAPfORGedk0J";
    private $DB_NAME = "goellhornDB";
    private $DB;



    function ConnectDB()
    {
        $nM= new NotificationHandler();
        $nM->initAlerts();

        $this->DB = new mysqli($this->DB_LOCATION, $this->DB_USER, $this->DB_PW, $this->DB_NAME);
        $DB = $this->DB;
        if ($DB->connect_errno) {
            
            $nM->pushNotification("Failed to connect to MySQL: " . $DB->connect_error,"danger");

            
        } else {
            echo $DB->host_info . " Connection success!\n";
            $nM->pushNotification($DB->host_info . " Connection success!\n","success");
        }
    }



    //checking if pw of username matches the passwort stored in the database
    function validateUser($username, $passwort)
    {
        $DB = $this->DB;
        $pw = $this->HashPW($passwort);


        $ID = 0;

        //$qury = "SELECT UserID FROM goellhorndb.user WHERE Username = '" . $username . "' AND Passwort = '" . $pw . "';";

        if (!($stmt = $DB->prepare("SELECT UserID FROM goellhorndb.user WHERE Username = ? AND Passwort = ?"))) {
            echo "Prepare failed: (" . $DB->errno . ") " . $DB->error;
        }
        if (!$stmt->bind_param("ss", $username, $pw)) {
            echo "Binding Username failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        $stmt->bind_result($ID);

        $stmt->fetch();
        //returns corresponding ID if username and pw match, else returns null
        return $ID;
    }

    function insertUser($validUser)
    { //input is an object called User with valid data

        $DB = $this->DB;
        if (!($stmt = $DB->prepare("INSERT INTO goellhorndb.user(Username,Email,Passwort,Anrede,Vorname,Nachname,Profilbild,RootDir) VALUES (?,?,?,?,?,?,?,?)"))) {
            echo "Prepare failed: (" . $DB->errno . ") " . $DB->error;
        }

        if (!$stmt->bind_param("ssssssss", $validUser->UserName,$validUser->Email, $validUser->UserPW, $validUser->Anrede, $validUser->Vorname, $validUser->Nachname,$validUser->IMG, $validUser->RootFolder)) {
            echo "Binding params failed: (" . $stmt->errno . ") " . $stmt->error;
        }


        if (!$stmt->execute()) {
            $nM= new NotificationHandler();
            $nM->initAlerts();
            $nM->pushNotification("Execute failed: (" . $stmt->errno . ") " . $stmt->error,"danger");
            
        }

        $nM= new NotificationHandler();
        $nM->initAlerts();
        $nM->pushNotification("successfully added a user","success");
    }

    //finding data of UserID then creating and returning User Object with corresponding values
    function getUser($ID)
    {
        if ($ID != 0) {
            //$values = array();
            $DB = $this->DB;
            $stmt = "SELECT * FROM goellhorndb.user WHERE UserID = '" . $ID . "';";

            $result = $DB->query($stmt);
            $values = $result->fetch_row();

            //var_dump($values); ERROR LOG
            $newUser = new User($values[0], $values[1], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9], $values[10],$values[2]);

            return $newUser;
        } else {
            echo "NOT A VALID ID!!";
        }
    }



    //checking if Username exists in our database returning corresponding bool, input:username as string
    function checkifUserExists($input)
    {
        $DB = $this->DB;
        $arr = array();

        $qury = "SELECT Username FROM goellhorndb.user WHERE Username = '" . $input . "';";

        $result = $DB->query($qury);
        $arr = $result->fetch_row();

        if (!empty($arr)) {
            echo "Succses!";
            //var_dump($arr); ERROR LOG
            return True;
        } else {
            var_dump($arr);
            echo "Fail!";
            return False;
        }
    }






    function HashPW($PW)
    {
        $PW = hash("sha256", $PW);
        return $PW;
    }




    function getSinglePost($postID)
    {
        $DB = $this->DB;
        $stmt = "SELECT Username,PostID,Bildadresse,Titel,Inhalt,Likes,Dislikes,CreatedAt,Sichtbarkeit,FK_UserID,Bildname FROM user Inner JOIN post ON post.FK_UserID = user.UserID WHERE post.PostID = $postID";
        $result = mysqli_query($DB, $stmt);
        $post = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $post[] = $row;
            }
        }
        $postObjects = array();
        foreach ($post as $p) {
            $tags = $this->getTags($p['PostID']);

            $postObj = new Post($p['PostID'], $p['Username'], $p['Bildadresse'], $p['Bildname'], $p['Titel'], $p['Inhalt'], $p['Sichtbarkeit'], $p['FK_UserID'], $tags, $p['CreatedAt'], $p['Likes'], $p['Dislikes']);
            array_push($postObjects, $postObj);
        }

        return $postObjects;
    }

    function insertPost($validPost)
    { //input is an object of class: Post and the currentUser object

        $DB = $this->DB;
        if (!($stmt = $DB->prepare("INSERT INTO goellhorndb.post(Bildadresse,Bildname,Titel,Inhalt,Sichtbarkeit,FK_UserID) VALUES (?,?,?,?,?,?)"))) {
            echo "Prepare failed: (" . $DB->errno . ") " . $DB->error;
        }

        if (!$stmt->bind_param("ssssii", $validPost->Bildadresse, $validPost->Bildname, $validPost->Titel, $validPost->Inhalt, $validPost->Sichtbarkeit, $validPost->UserID)) {
            echo "Binding params failed: (" . $stmt->errno . ") " . $stmt->error;
        }


        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        $insertID = $stmt->insert_id;
        foreach ($validPost->SelectedTags as $tag) {
            $stmt = "INSERT INTO post_tags (PostID,TagID) VALUES ($insertID,$tag[1])";

            if (!$DB->query($stmt)) {
                echo $DB->error;
            }
        }
    }


    function likePost($postID)
    {
        $DB = $this->DB;
        $stmt = "UPDATE post SET Likes = Likes + 1 WHERE PostID = $postID";
        $DB->query($stmt);
    }

    function dislikePost($postID)
    {
        $DB = $this->DB;
        $stmt = "UPDATE post SET Dislikes = Dislikes + 1 WHERE PostID = $postID";
        $DB->query($stmt);
    }

    function allTags()
    {
        $DB = $this->DB;
        $stmt = "SELECT TagName, TagID FROM tags";
        $result = $DB->query($stmt);

        return $result->fetch_all();
    }

    function deletePost($postID)
    {
        $DB = $this->DB;
        $stmt = "DELETE FROM post WHERE PostID = $postID";
        if(!$DB->query($stmt)){
            printf($DB->error);
        }
        else {
            return "successfully deleted post!";
        }
    }

    //fnc for changing visibility of post
    function changeVisibility($postID)
    {
        $DB = $this->DB;
        $getVisibility = "SELECT Sichtbarkeit FROM post WHERE PostID = $postID";
        $result = $DB->query($getVisibility);
        $visibility = $result->fetch_row();//$status[0] = Sichtbarkeit des posts
        
        if($visibility[0] == 0){
            $stmt = "UPDATE post SET Sichtbarkeit = 1 WHERE PostID = $postID";
        }
        else{
            $stmt = "UPDATE post SET Sichtbarkeit = 0 WHERE PostID = $postID"; 
        }
        $DB->query($stmt);
    }

    //fnc that returns the number of comments of a single post
    function commentCount($postID)
    {
        $DB = $this->DB;
        $stmt = "SELECT COUNT(*) FROM comment c Inner JOIN post p ON c.FK_PostID = p.PostID WHERE p.PostID = $postID";
        $count_get = mysqli_query($DB, $stmt);
        $count = mysqli_fetch_row($count_get);
        return $count[0];
    }


    function filterPosts($tagArray)
    {
        $DB = $this->DB;
        $stmt = "SELECT DISTINCT PostID from post_tags pt inner join tags t on pt.TagID = t.TagID WHERE t.TagName in $tagArray";
    }

    function getTags($PostID)
    {
        $DB = $this->DB;
        $stmt = "SELECT TagName from post_tags pt inner join tags t on pt.TagID = t.TagID WHERE PostID = $PostID";
        $result = mysqli_query($DB, $stmt);
        $tags = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $tags[] = $row;
            }
        }

        return $tags;
    }

    //fnc for getting assoc. array of posts to depict, output depends on loginstatus of user (public posts or all posts)
    function getPosts($status,$col,$order)
    {
        $DB = $this->DB;
        $statusString = "('1')";
        if($status == 1 || $status == 2){
            $statusString = "('0','1')";
        }
        

        //no prepared statemnt needed because user input has no influence on query
        
            if(!$stmt = $DB->query("SELECT Username,PostID,Bildadresse,Bildname,Titel,Inhalt,Likes,Dislikes,CreatedAt,Sichtbarkeit,FK_UserID FROM user Inner JOIN post ON post.FK_UserID = user.UserID WHERE Sichtbarkeit 
            IN $statusString ORDER BY $col $order")){
                echo "Prepare failed: (" . $DB->errno . ") " . $DB->error;
            }
            // if(!($stmt->bind_param())){
            //     echo "Binding params failed: (" . $stmt->errno . ") " . $stmt->error;
            // }   

            // if(!$stmt->execute()){
            //     echo "Executing statement failed: (" . $stmt->errno . ") " . $stmt->error;
            // }
            
            $result = $stmt;
            $result->fetch_all();
            echo("<br>");
           
            

        $postObjects = array();
        foreach ($result as $p) {
            $tags = $this->getTags($p['PostID']);

            $postObj = new Post($p['PostID'], $p['Username'], $p['Bildadresse'], $p['Bildname'], $p['Titel'], $p['Inhalt'], $p['Sichtbarkeit'], $p['FK_UserID'], $tags, $p['CreatedAt'], $p['Likes'], $p['Dislikes']);
            array_push($postObjects, $postObj);
        }

        return $postObjects;
    }

    function insertComment($validComment)
    { //input is an object of class: Post and the currentUser object

        $DB = $this->DB;
        if (!($stmt = $DB->prepare("INSERT INTO goellhorndb.comment(Inhalt,FK_PostID,FK_UserID) VALUES (?,?,?)"))) {
            echo "Prepare failed: (" . $DB->errno . ") " . $DB->error;
        }

        if (!$stmt->bind_param("sii", $validComment->Inhalt, $validComment->PostID, $validComment->Author)){
            echo "Binding params failed: (" . $stmt->errno . ") " . $stmt->error;
        }


        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

    }

    function getComments($PostID){    
        $DB = $this->DB;
        //no prepared statemnt needed because user input has no influence on query
            $stmt = "SELECT Inhalt,CreatedAt,Username, FK_PostID  FROM comment Inner JOIN user  ON comment.FK_UserID = user.UserID  Where FK_PostID =$PostID";
            $result = mysqli_query($DB, $stmt);
            $comments = array();
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $comments[] = $row;
                }
            }

            $CommentsObjects = array();
            foreach ($comments as $c) {
                
    
                $commentObj = new Comment($c["Inhalt"],$c["Username"],$c["FK_PostID"],$c["CreatedAt"]);
                //$_Inhalt,$_UserID,$_PostID,$_CreatedAt
                array_push($CommentsObjects, $commentObj);
            }
            
            return $CommentsObjects;
    }

    //Admin: getAllUsers(active/inactive)-->changeUserStatus(), myProfile -->currentUserObject

    function getPostsUser($UserID){

  
        $DB = $this->DB;
    
            $stmt = "SELECT Username,PostID,Bildadresse,Bildname,Titel,Inhalt,Likes,Dislikes,CreatedAt,Sichtbarkeit,FK_UserID FROM user Inner JOIN post ON post.FK_UserID = user.UserID WHERE user.UserID = $UserID";
            $result = mysqli_query($DB, $stmt);
            $posts = array();
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $posts[] = $row;
                }
            }

            //print_r($posts);
        $postObjects = array();
        foreach ($posts as $p) {
            $tags = $this->getTags($p['PostID']);

            $postObj = new Post($p['PostID'], $p['Username'], $p['Bildadresse'], $p['Bildname'], $p['Titel'], $p['Inhalt'], $p['Sichtbarkeit'], $p['FK_UserID'], $tags, $p['CreatedAt'], $p['Likes'], $p['Dislikes']);
            array_push($postObjects, $postObj);
        }

        return $postObjects;
    
    }

    function updateUser($user){
        $DB = $this->DB;
        
        if (!($stmt = $DB->prepare("UPDATE user SET Username = ?,Anrede = ?,Vorname=?,Nachname=?,Profilbild=?,Email=?,RootDir=? WHERE UserID = ?"))) {
            echo "Prepare failed: (" . $DB->errno . ") " . $DB->error;
        }
        if (!$stmt->bind_param("sssssssi", $user->UserName, $user->Anrede, $user->Vorname, $user->Nachname, $user->IMG,$user->Email,$user->RootFolder, $user->UserID)){
            echo "Binding params failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        if (!$stmt->execute()) {

            $nM= new NotificationHandler();
            $nM->initAlerts();
            $nM->pushNotification("Execute failed: (" . $stmt->errno . ") " . $stmt->error,"danger");
            
        }

    }
    
    function changeStatus($UserID){
        $DB = $this->DB;
        $getStatus = "SELECT Aktiv FROM user WHERE UserID = $UserID";
        $result = $DB->query($getStatus);
        $status = $result->fetch_row();//$status[0] = UserStatus
        
        if($status[0] == 0){
            $stmt = "UPDATE user SET Aktiv = 1 WHERE UserID = $UserID";
        }
        else{
            $stmt = "UPDATE user SET Aktiv = 0 WHERE UserID = $UserID"; 
        }
        $DB->query($stmt);
    }
    function getUserArray(){

  
        $DB = $this->DB;
    
            $stmt = "SELECT UserID,Username,Email,Anrede,Vorname,Nachname,Aktiv,Profilbild,RootDir FROM user  WHERE Admin = 0";
            $result = mysqli_query($DB, $stmt);
            $users = array();
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $users[] = $row;
                }
            }

            //print_r($posts);
        $userObjects = array();
        foreach ($users as $u) {
            
            $userObj = new User($u['UserID'], $u['Username'], "PW", $u['Anrede'], $u['Vorname'], $u['Nachname'], 0, intval($u['Aktiv']), $u['Profilbild'], $u['RootDir'], $u['Email']);
            array_push($userObjects, $userObj);
        }
        
        return $userObjects;
    
    }

    function searchPosts($string,$tags,$status,$tagBool){
        $DB = $this->DB;
        
        $statusString = "('1')";
        //filters all posts if user is logged in and only public posts if user is not logged in
        if($status == 1 || $status == 2){
            $statusString = "('0','1')";
        }
        
        $tagString = '(';
        foreach($tags as $t){
         $tagString .= "'" . $t ."'" .", ";

         }

        $tagString = rtrim($tagString,", ") . ")";
        
        echo $tagString;
        echo $statusString;

        /*
        $TagsSelect = false;
        case1 default : string is empty &&  tagsSelected == false
            => query all posts on sichtbarkeit
        case 2: string is empty && tagsSelected == true 
            => query all posts on tagsSelected && sichtbarkeit
        case 3: string not empty && tagsselected == false
            => qeruy all posts on strings && sichtbarkeit
        case 4: string not empty && tagsselected == true
            => query all posts on string && tags && sichtbarkeit
        */
        
        if((ctype_space($string) || empty($string) && $tagBool == false))//ctype_space returns true if entire string is only whitespace, empty returns true if string is ""
        {
            echo "im IN 1";
            if(!($stmt = $DB->prepare("SELECT DISTINCT u.Username,p.PostID,u.Username,p.Bildadresse,p.Bildname,p.Titel,p.Inhalt,p.Sichtbarkeit,p.FK_UserID,p.CreatedAt,p.Likes,p.Dislikes 
            FROM ((((post p left join comment c on p.PostID = c.FK_PostID) left join post_tags pt on pt.PostID = p.PostID) left join tags t on t.TagID = pt.TagID) inner join user u on u.UserID = p.FK_UserID) 
            where p.Sichtbarkeit IN $statusString ORDER BY p.CreatedAt DESC")))
            {
                echo "Prepare failed: (" . $DB->errno . ") " . $DB->error;
            }  
        }
        elseif((ctype_space($string) || empty($string)) && $tagBool == true)
        {
            echo "im IN 2";
            if(!($stmt = $DB->prepare("SELECT DISTINCT u.Username,p.PostID,u.Username,p.Bildadresse,p.Bildname,p.Titel,p.Inhalt,p.Sichtbarkeit,p.FK_UserID,p.CreatedAt,p.Likes,p.Dislikes 
            FROM ((((post p left join comment c on p.PostID = c.FK_PostID) left join post_tags pt on pt.PostID = p.PostID) left join tags t on t.TagID = pt.TagID) inner join user u on u.UserID = p.FK_UserID) 
            where t.TagName IN $tagString AND p.Sichtbarkeit IN $statusString ORDER BY p.CreatedAt DESC")))
            {
                echo "Prepare failed: (" . $DB->errno . ") " . $DB->error;
            }
        }
        elseif(!empty($string) && $tagBool == false)
        {
            echo "im IN 3";
            if(!($stmt = $DB->prepare("SELECT DISTINCT u.Username,p.PostID,u.Username,p.Bildadresse,p.Bildname,p.Titel,p.Inhalt,p.Sichtbarkeit,p.FK_UserID,p.CreatedAt,p.Likes,p.Dislikes 
            FROM ((((post p left join comment c on p.PostID = c.FK_PostID) left join post_tags pt on pt.PostID = p.PostID) left join tags t on t.TagID = pt.TagID) inner join user u on u.UserID = p.FK_UserID) 
            where (p.Titel REGEXP ? or p.Inhalt REGEXP ? or c.Inhalt REGEXP ?) AND p.Sichtbarkeit IN $statusString ORDER BY p.CreatedAt DESC"))){
                echo "Prepare failed: (" . $DB->errno . ") " . $DB->error;
            }
            if(!$stmt->bind_param("sss",$string,$string,$string)){
                echo "Binding params failed: (" . $stmt->errno . ") " . $stmt->error;
            }
        }
        elseif(!empty($string) && $tagBool == true)
        {
            echo "im IN 4";
            if(!($stmt = $DB->prepare("SELECT DISTINCT u.Username,p.PostID,u.Username,p.Bildadresse,p.Bildname,p.Titel,p.Inhalt,p.Sichtbarkeit,p.FK_UserID,p.CreatedAt,p.Likes,p.Dislikes 
            FROM ((((post p left join comment c on p.PostID = c.FK_PostID) left join post_tags pt on pt.PostID = p.PostID) left join tags t on t.TagID = pt.TagID) inner join user u on u.UserID = p.FK_UserID) 
            where t.TagName IN $tagString AND (p.Titel REGEXP ? or p.Inhalt REGEXP ? or c.Inhalt REGEXP ?) AND p.Sichtbarkeit IN $statusString ORDER BY p.CreatedAt DESC"))){
                echo "Prepare failed: (" . $DB->errno . ") " . $DB->error;
            }
            if(!$stmt->bind_param("sss",$string,$string,$string)){
                echo "Binding params failed: (" . $stmt->errno . ") " . $stmt->error;
            }
        }
        

        if(!$stmt->execute()){
            echo "Executing statement failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        $result = $stmt->get_result();

        $result->fetch_all();
        $PostsObj= array();
        // creating post objects:
        foreach ($result as $p) {
            $tags = $this->getTags($p['PostID']);
            $postObj = new Post($p['PostID'], $p['Username'], $p['Bildadresse'], $p['Bildname'], $p['Titel'], $p['Inhalt'], $p['Sichtbarkeit'], $p['FK_UserID'], $tags, $p['CreatedAt'], $p['Likes'], $p['Dislikes']);
            array_push($PostsObj, $postObj);
        }
        return $PostsObj;
        
    }
    function getUserRootByID($UserID){
        $DB = $this->DB;
    
            $stmt = "SELECT RootDir FROM user  WHERE UserID  = $UserID";
            $result = mysqli_query($DB, $stmt);
            $RootDir = array();
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $RootDir[] = $row;
                }
            return $RootDir;
        }
    }

    /*function getPostsUser($UserID){

  
        $DB = $this->DB;
    
            $stmt = "SELECT Username,PostID,Bildadresse,Bildname,Titel,Inhalt,Likes,Dislikes,CreatedAt,Sichtbarkeit,FK_UserID FROM user Inner JOIN post ON post.FK_UserID = user.UserID WHERE user.UserID = $UserID";
            $result = mysqli_query($DB, $stmt);
            $posts = array();
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $posts[] = $row;
                }
            }

            //print_r($posts);
        $postObjects = array();
        foreach ($posts as $p) {
            $tags = $this->getTags($p['PostID']);

            $postObj = new Post($p['PostID'], $p['Username'], $p['Bildadresse'], $p['Bildname'], $p['Titel'], $p['Inhalt'], $p['Sichtbarkeit'], $p['FK_UserID'], $tags, $p['CreatedAt'], $p['Likes'], $p['Dislikes']);
            array_push($postObjects, $postObj);
        }

        return $postObjects;
    
    }*/

    function changePassword($CurrentUser,$newPW){
        $DB = $this->DB;
        $stmt = "UPDATE user SET Passwort = '" . $newPW . "' WHERE UserID = $CurrentUser->UserID";
        if($DB->query($stmt)){
            
        }
        $updatedUser = $this->getUser($CurrentUser->UserID);
        return $updatedUser;
    }
    
}
