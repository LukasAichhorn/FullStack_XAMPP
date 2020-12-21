    
           

    
    
    
    <div class="card mb-1">
        <div class="row g-0">
            <div class="col-md-4">
                <img class="card-img" src="<?php echo($Post['Bildadresse'])?>" style="background-color: #ffaf2a;">
            </div>
            <div class="col-md-8">
                <div class="card-body h-100">
                    <div class="row mb-5">
                        <div class="col">
                            <a href="pages/DisplayPost.php?PostID=<?php echo($Post['PostID']); ?>">
                                <h5 class="card-title"><?php echo($Post["Titel"]) ?></h5>
                            </a>
                            <p class="card-text">
                            <?php echo($Post["Inhalt"])?>
                            </p>
                        </div>
                    </div>

                    <div class="row comp-infoSection">
                        <div class="col">
                            <div class="divider border"></div>

                            <div class="row mt-2">

                                <div class="col">
                                    <p class="card-text"><small class="text-muted">created by <?php echo($Post["Username"])?>  at: <?php echo($Post["CreatedAt"]) ?> </small></p>
                                </div>

                                <div class="col">
                                    <p class="card-text"><small class="text-muted"><?php echo($commentnr); ?> comment(s)</small></p>
                                </div>

                                <div class="col ">
                                    <div class="d-flex flex-row justify-content-end">
                                        <div class="Comp-like">
                                            <form><button type="button" class="btn btn-sm btn-sm-my btn-outline-success"><?php echo($Post["Likes"]) ?></button></form>
                                        </div>
                                        <div class="Comp-like">
                                            <form><button type="button" class="btn btn-sm btn-sm-my btn-outline-danger"> <?php echo($Post["Dislikes"]) ?></button></form>
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