    
           

    
    
    
    <div class="card mb-3 shadow-sm">
        <div class="row g-0">
            <div class="col-md-4">
            

                <img class="card-img" src="//<?php echo($Post->Bildadresse)?>">
            </div>
            <div class="col-md-8">
                <div class="card-body h-100">
                    <div class="row mb-5">
                        <div class="col">
                        
                            <a href="pages/DisplayPost.php?PostID=<?php echo($Post->PostID); ?>">
                                <h5 class="card-title"><?php echo($Post->Titel) ?></h5>   
                            </a>

                            <p class="card-text">
                            <?php echo($Post->Inhalt)?>
                            </p>
                        </div>
                    </div>

                    <div class="row comp-infoSection">
                        <div class="col ">
                            <div class="d-flex flex-wrap">
                            
                            <?php
                                foreach ($Post->SelectedTags as $tag ) {
                                    
                                   echo("<div class='border  m-1 small-tag'>" . $tag["TagName"] . "</div>");
                                }                                 
                                                         
                            ?>
                            </div>
                            <div class="divider border"></div>
                            
                            <div class="row mt-2">
                            
                                <div class="col">
                                    <p class="card-text"><small class="text-muted">created by <?php echo($Post->Username);?> <br> at: <?php echo($Post->CreatedAt); ?> </small></p>
                                </div>

                                <div class="col">
                                    <p class="card-text"><small class="text-muted"><?php echo($commentnr); ?> comment(s)</small></p>
                                </div>
                                <div class="col">
                                <p class="d-flex"><small> <?php echo($Post->Sichtbarkeit == 0) ? "private" : "public"; ?></small></p>
                                </div>
                                

                                <div class="col-1 ">
                                    <div class="d-flex flex-row justify-content-end">
                                        <div class="Comp-like">
                                            <form action="util/handleLikes.php">
                                            <input type="hidden" name="action" value="0" />
                                            <input type="hidden" name="PostId" value="<?php echo($Post->PostID);?>" />  
                                            <button type="submit" class="btn btn-sm btn-sm-my btn-outline-success"><?php echo($Post->Likes); ?></button></form>
                                        </div>
                                        <div class="Comp-like">
                                            <form action="util/handleLikes.php">
                                            <input type="hidden" name="action" value="1" />
                                            <input type="hidden" name="PostId" value="<?php echo($Post->PostID);?>" />  
                                            <button type="submit" class="btn btn-sm btn-sm-my btn-outline-danger"> <?php echo($Post->Dislikes); ?></button></form>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>