    <?php
    //get User info from session;
    // using $Currentuser

    ?>


    <div class="mb-1 mt-1">
        <div class="row d-flex  border <?php echo ($CurrentUser->status== 1) ? "border-success" : "border-danger" ?>">

            <div class=" col-2">
                <img class="card-img user-Img cover " src="//<?php echo ($CurrentUser->IMG); ?>" width="20" height="20">
            </div>
            <div class="col">
                <div class="row ">
                    <div class="col  ">
                        <?php echo ($CurrentUser->UserName) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col d-flex align-items-center justify-content-start">
                        <?php echo ($CurrentUser->Anrede) ?>
                    </div>
                    <div class="col d-flex align-items-center justify-content-start">
                        <?php echo ($CurrentUser->Vorname) ?>
                    </div>
                    <div class="col d-flex align-items-center justify-content-start">
                        <?php echo ($CurrentUser->Nachname) ?>
                    </div>
                    <div class="col d-flex align-items-center justify-content-start">
                        <?php echo ($CurrentUser->Email) ?>
                    </div>
                    <div class="col d-flex align-items-center justify-content-start">
                        status: <?php echo ($CurrentUser->status == 1) ? "active" : "inactive" ?>
                    </div>

                    <div class="col d-flex align-items-center justify-content-start">
                       

                                    <form action="//<?php echo (DIR_SERVERROOT .  $_SERVER['REQUEST_URI']); ?>">
                                        <input type="hidden" name="changeStatus" value="true" />
                                        <input type="hidden" name="UserID" value="<?php echo($CurrentUser->UserID); ?>" />
                                        <button type="submit" class="btn btn-sm btn-sm-my btn-outline-primary">
                                            <?php echo($CurrentUser->status == 1) ? "inactivate" : "activate" ?>
                                            </button>
                                    </form>

                       
                       
                    

                                    
                    </div>
                </div>

            </div>













        </div>

    </div>