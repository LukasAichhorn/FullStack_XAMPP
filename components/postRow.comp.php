    <?php
    $path_parts = pathinfo($Post->Bildadresse);
    $IMG_name = $path_parts["filename"];
    $IMG_ending = $path_parts["extension"];
    $IMG_dir = $path_parts["dirname"];
    $IMG_TN_Path = $IMG_name . "_thumbnail" . "." . $IMG_ending;
    ?>


    <div class=" border mb-2 shadow-sm">
        <div class="row g-0">
            <div class="col-md-8">


                <div class="col">

                    <a href="//<?php echo (DIR_PAGES); ?>DisplayPost.php?PostID=<?php echo ($Post->PostID); ?>">
                        <h5 class="card-title"><?php echo ($Post->Titel) ?></h5>
                    </a>
                </div>
                <div class="col">
                    <p class="d-flex"><small> <?php echo ($Post->Sichtbarkeit == 0) ? "private" : "public"; ?></small></p>

                    <p class="card-text mb-3">
                        <?php echo ($Post->Inhalt) ?>
                    </p>
                </div>


                <div class="row  w-100 align-self-end">
                    <div class="col">
                        <div class="d-flex flex-wrap">

                            <?php
                            foreach ($Post->SelectedTags as $tag) {

                                echo ("<div class='border  mb-1 small-tag'>" . $tag["TagName"] . "</div>");
                            }

                            ?>
                        </div>
                        <div class="divider border"></div>

                        <div class="row mt-2">

                            <div class="col-6 ">
                                <p class="card-text"><small class="text-muted">erstellt von <?php echo ($Post->Username); ?> <br> at: <?php echo ($Post->CreatedAt); ?> </small></p>
                            </div>

                            <div class="col">
                                <p class="card-text"><small class="text-muted"><?php echo ($commentnr); ?> Kommentar(e)</small></p>
                            </div>



                            <div class="col-1 ">
                                <div class="d-flex flex-row justify-content-end">
                                    <div class="Comp-like">

                                        <form action="//<?php echo (DIR_UTIL); ?>handleLikes.php">
                                            <input type="hidden" name="action" value="0" />
                                            <input type="hidden" name="PostId" value="<?php echo ($Post->PostID); ?>" />
                                            <button type="submit" class="btn btn-sm btn-sm-my btn-outline-success" <?php echo (empty($CurrentUser) == TRUE) ? "disabled" : "" ?>>

                                                <?php echo ($Post->Likes); ?></button>
                                        </form>
                                    </div>
                                    <div class="Comp-like">
                                        <form action="//<?php echo (DIR_UTIL); ?>handleLikes.php">
                                            <input type="hidden" name="action" value="1" />
                                            <input type="hidden" name="PostId" value="<?php echo ($Post->PostID); ?>" />
                                            <button type="submit" class="btn btn-sm btn-sm-my btn-outline-danger" <?php echo (empty($CurrentUser) == TRUE) ? "disabled" : "" ?>>
                                                <?php echo ($Post->Dislikes); ?></button>
                                        </form>
                                    </div>

                                    <?php
                                    if (isset($CurrentUser) && $Post->Username == $CurrentUser->UserName) {
                                        echo ('<div class="Comp-like">
                                            
                                            <form action="//' . DIR_UTIL . 'handleDelete.php">
                                            <input type="hidden" name="PostId" value="' . $Post->PostID . '" />  
                                            <button type="submit" class="btn btn-sm btn-sm-my btn-outline-warning">delete</button>
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