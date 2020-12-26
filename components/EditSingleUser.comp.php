    <?php
    //get User info from session;
    // using $Currentuser

    ?>


    <div class="mb-2 mt-5">
        <div class="row g-0">
            <div class="col-md-4  d-flex align-content-center">


                <img class="card-img user-Img cover " src="//<?php echo ($CurrentUser->IMG); ?>" width="50">
            </div>
            <div class="col-md-8">
                <div class="card-body d-flex flex-row flex-wrap h-100">
                    <div class="row d-flex align-items-center  ">
                        <div class="col">
                            <small>status: <?php echo ($CurrentUser->status) ?></small>
                            <form class="action=//<?php echo (DIR_SERVERROOT .  $_SERVER['REQUEST_URI']); ?>" method="post">
                            <div class="form-group mt-3">
                                <label for="Username">Username</label>
                                <input type="text" name="Username" value="<?php echo ($CurrentUser->UserName); ?>" class="form-control" id="Username" required>
                            </div>

                            <!-- <div class="form-group mt-3">
                                <label for="Passwort">Password</label>
                                <input type="password" name="Passwort" class="form-control" id="Passwort" required>
                            </div> -->

                            <div class="row">
                                <div class="col">
                                    <div class="form-group mt-3">
                                        <label for="Anrede">Anrede</label>
                                        <select class="form-control" name="Anrede" value="<?php echo ($CurrentUser->Anrede); ?>" id="Anrede" required>
                                            <option>Herr</option>
                                            <option>Frau</option>
                                            <option>X</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mt-3">
                                        <label for="Vorname">Vorname</label>
                                        <input type="text" name="Vorname" class="form-control" value="<?php echo ($CurrentUser->Vorname); ?>" id="Vorname" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mt-3">
                                        <label for="Nachname">Nachname</label>
                                        <input type="text" name="Nachname" class="form-control" value="<?php echo ($CurrentUser->Nachname) ?>" id="Nachname" required>
                                    </div>
                                </div>
                            </div>
                            <div class=" form-group  mt-3 mb-3">
                                <label for="formFileSm" class="form-label">Choose img for Upload:</label>
                                <input class="form-control form-control-sm" id="fileUpload" name="fileUpload" type="file">
                            </div>







                            <div class="d-flex flex-row justify-content-end">
                                
                                    
                                    <button type="submit" class="btn btn-sm btn-sm-my btn-outline-primary">update profile</button>
                                </form>

                                <form class="Comp-like" action="//<?php echo (DIR_SERVERROOT .  $_SERVER['REQUEST_URI']); ?>">


                                    <button type="submit" class="btn btn-sm btn-sm-my btn-outline-secondary">cancle</button>
                                </form>
                            </div>





                        </div>

                    </div>



                </div>
            </div>


        </div>
    </div>