    <?php
    //get User info from session;
    // using $Currentuser

    ?>


    <div class="mb-1 mt-1">
        <div class="row  border ">
            <div class="col ">
                <!-- <img class="card-img user-Img cover " src="//<?php //echo ($CurrentUser->IMG); ?>" width="50"> -->
            </div>
            <div class="col">
                <?php echo ($CurrentUser->UserName) ?>
            </div>
            <div class="col">
                status: <?php echo ($CurrentUser->status) ?>
            </div>
            <div class="col">                                   
                <?php echo ($CurrentUser->Anrede) ?>                
            </div>
            <div class="col">
                <?php echo ($CurrentUser->Vorname) ?>           
            </div>
            <div class="col">
                 <?php echo ($CurrentUser->Nachname) ?>
             </div>
             <div class="col">
                <?php echo($CurrentUser->Email) ?>
             </div>

             <form action="//<?php //insert link to edit profile page ?>">
                <input type="hidden" name="edit" value="true" />
                <button type="submit" class="btn btn-sm btn-sm-my btn-outline-primary">edit profile</button>
            </form>

        </div>
        
    </div>
        