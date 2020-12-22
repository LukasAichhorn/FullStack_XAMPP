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

        $this->DB = new mysqli($this->DB_LOCATION, $this->DB_USER, $this->DB_PW, $this->DB_NAME);
        $DB = $this->DB;
        if ($DB->connect_errno) {
            echo "Failed to connect to MySQL: " . $DB->connect_error;
        } else {
            echo $DB->host_info . " Connection success!\n";
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
        if (!($stmt = $DB->prepare("INSERT INTO goellhorndb.user(Username,Passwort,Anrede,Vorname,Nachname,RootDir) VALUES (?,?,?,?,?,?)"))) {
            echo "Prepare failed: (" . $DB->errno . ") " . $DB->error;
        }

        if (!$stmt->bind_param("ssssss", $validUser->UserName, $validUser->UserPW, $validUser->Anrede, $validUser->Vorname, $validUser->Nachname, $validUser->RootFolder)) {
            echo "Binding params failed: (" . $stmt->errno . ") " . $stmt->error;
        }


        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
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
            $newUser = new User($values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9]);

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
        $DB->query($stmt);
    }

    //fnc for changing visibility of post
    function changeVisibility($postID)
    {
        $DB = $this->DB;
        $stmt = "UPDATE post SET ";
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
    function getPosts($status)
    {
        $DB = $this->DB;
        //
        if ($status == 0) { //no prepared statemnt needed because user input has no influence on query
            $stmt = "SELECT Username,PostID,Bildadresse,Bildname,Titel,Inhalt,Likes,Dislikes,CreatedAt,Sichtbarkeit,FK_UserID FROM user Inner JOIN post ON post.FK_UserID = user.UserID WHERE Sichtbarkeit = 1";
            $result = mysqli_query($DB, $stmt);
            $posts = array();
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $posts[] = $row;
                }
            }

            //print_r($posts);




        } else {
            $stmt = "SELECT Username,PostID,Bildadresse,Bildname,Titel,Inhalt,Likes,Dislikes,CreatedAt,Sichtbarkeit,FK_UserID FROM user Inner JOIN post ON post.FK_UserID = user.UserID";
            $result = mysqli_query($DB, $stmt);
            $posts = array();
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $posts[] = $row;
                }
            }

            //print_r($posts);


        }

        $postObjects = array();
        foreach ($posts as $p) {
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
}
