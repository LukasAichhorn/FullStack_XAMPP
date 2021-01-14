    
           
<?php
$path_parts= pathinfo($Post->Bildadresse);
$IMG_name=$path_parts["filename"];
$IMG_ending=$path_parts["extension"];
$IMG_dir=$path_parts["dirname"];
$IMG_TN_Path =$IMG_name."_thumbnail".".".$IMG_ending;


$IMG_defaultName= "Default_img_thumbnail";
$IMG_default_Path="//localhost/WEB_SS2020/WP/ressources/pics/Default_img.png";
$IMG_default_Path_thumbnail="//localhost/WEB_SS2020/WP/ressources/pics/Default_img_thumbnail.png";
//if img name = deflaut => use deflaut path
$RD = $DB->getUserRootByID($Post->UserID); $RD = $RD[0]; 
$IMG_dynamic_path_thumbnail = "//" . $RD['RootDir'] . "/".$IMG_name."_thumbnail".".".$IMG_ending;
$IMG_dynamic_path = "//" . $RD['RootDir'] . "/".$IMG_name.".".$IMG_ending;
if($IMG_name==$IMG_defaultName){
    $path_img = $IMG_default_Path_thumbnail;
    $path_link = $IMG_default_Path;
}
else{
    $path_img = $IMG_dynamic_path_thumbnail;
    $path_link = $IMG_dynamic_path;
}


?>
    
    
    <div class="card mb-2 shadow-sm">
        <div class="row g-0">
            <div class="col-md-4  d-flex align-content-center" >
            
                <?php ?>
                <a class="card-img cover" href="<?php echo($path_link);?>" data-lightbox="<?php echo("LB".$Post->UserID); ?>">
                <img class="card-img cover " src="<?php echo($path_img)?>">
                </a>
            </div>
            <div class="col-md-8">
                <div class="card-body d-flex flex-row flex-wrap h-100">
                    <div class="row w-100">
                        <div class="col">
                           <div class="d-flex">
                            <a href="//<?php echo(DIR_PAGES);?>DisplayPost.php?PostID=<?php echo($Post->PostID); ?>">
                                <h5 class="card-title"><?php echo($Post->Titel) ?></h5>   
                            </a>
                           
                           
                            <?php
                                        // if(isset($CurrentUser) && $Post->Username == $CurrentUser->UserName){
                                        //     echo('<div style="margin-left: auto;">
                                            
                                        //     <form action="//'. DIR_UTIL .'handleDelete.php">
                                        //     <input type="hidden" name="PostId" value="'. $Post->PostID . '" />  
                                        //     <button type="submit" class="btn btn-sm btn-sm-my btn-outline-warning">X</button>
                                        //     </form>
                                        //     </div>');
                                        // }

                                        // ?>
                           
                           </div>
                            <p class="d-flex"><small> <?php echo($Post->Sichtbarkeit == 0) ? "privat" : "öffentlich"; ?></small></p>

                            <p class="card-text mb-3">
                            <?php echo($Post->Inhalt)?>
                            </p>
                        </div>
                        

                    </div>

                    <div class="row  w-100 align-self-end">
                        <div class="col">
                            <div class="d-flex flex-wrap">
                            
                            <?php
                                foreach ($Post->SelectedTags as $tag ) {
                                    
                                   echo("<div class='border  mb-1 small-tag'>" . $tag["TagName"] . "</div>");
                                }                                 
                                                         
                            ?>
                            </div>
                            <div class="divider border"></div>
                            
                            <div class="row mt-2 mb-2">
                            
                                <div class="col ">
                                    <p class="card-text"><small class="text-muted">erstellt von <?php echo($Post->Username);?> <br>  <?php echo($Post->CreatedAt); ?> </small></p>
                                </div>

                                <div class="col">
                                    <p class="card-text"><small class="text-muted"><?php echo($commentnr); ?> Kommentar(e)</small></p>
                                </div>
                                
                                

                                <div class="col ">
                                    <div class="d-flex flex-row justify-content-end">
                                        <div class="Comp-like">
                                            
                                            <form action="//<?php echo(DIR_UTIL);?>handleLikes.php">
                                            <input type="hidden" name="action" value="0" />
                                            <input type="hidden" name="PostId" value="<?php echo($Post->PostID);?>" />  
                                            <button type="submit" class="btn btn-sm btn-sm-my btn-outline-success" <?php echo (empty($CurrentUser) == TRUE) ? "disabled" : "" ?>>
                                                
                                            <?php echo($Post->Likes); ?></button></form>
                                        </div>
                                        <div class="Comp-like">
                                            <form action="//<?php echo(DIR_UTIL);?>handleLikes.php">
                                            <input type="hidden" name="action" value="1" />
                                            <input type="hidden" name="PostId" value="<?php echo($Post->PostID);?>" />  
                                            <button type="submit" class="btn btn-sm btn-sm-my btn-outline-danger"<?php echo (empty($CurrentUser) == TRUE) ? "disabled" : "" ?>> <?php echo($Post->Dislikes); ?> </button></form>
                                        </div>

                                        <?php
                                        if(isset($CurrentUser) && $Post->Username == $CurrentUser->UserName){
                                            echo('<div class="Comp-like">
                                            
                                            <form action="//'. DIR_UTIL .'handleDelete.php">
                                            <input type="hidden" name="PostId" value="'. $Post->PostID . '" />  
                                            <button type="submit" class="btn btn-sm btn-sm-my btn-outline-warning">x</button>
                                            </form>
                                            </div>');
                                        }

                                        ?> 

                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>