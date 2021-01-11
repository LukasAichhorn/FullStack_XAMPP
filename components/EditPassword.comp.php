<div class="mb-2 mt-5">
    <div class="row g-0">
        <div class="col-md-4  d-flex align-content-center">


            <img class="card-img user-Img cover " src="//<?php echo ($CurrentUser->IMG); ?>" width="50">
        </div>
        <div class="col-md-8">
            <div class="card-body d-flex flex-row flex-wrap h-100">
                <div class="row d-flex align-items-center  ">
                    <div class="col">
                        <form class="action=//<?php echo (DIR_SERVERROOT .  $_SERVER['REQUEST_URI']); ?>" method="post">
                            <div class="form-group mt-3">
                                <label for="Username">Username</label>
                                <input type="text" name="Username" value="<?php echo ($CurrentUser->UserName); ?>" class="form-control" id="Username" required>
                            </div>
                            <div class="form-group mt-3">
                                <label for="Username">Email:</label>
                                <input type="text" name="Email" value="<?php echo ($CurrentUser->Email); ?>" class="form-control" id="Email" required>
                            </div>
                            <div class="form-group mt-3">
                                <label for="Passwort">Password</label>
                                <input type="password" name="Passwort" class="form-control" id="Passwort" required>
                            </div>
                            <div class="form-group mt-3">
                                <label for="PasswortRep">Repeat Password</label>
                                <input type="password" name="PasswortRep" class="form-control" id="PasswortRep" required>
                            </div>












                            <div class="d-flex flex-row justify-content-end">


                                <button type="submit" class="btn btn-sm btn-sm-my btn-outline-primary">update profile</button>
                        </form>

                        <form class="Comp-like" action="//<?php echo (DIR_SERVERROOT .  $_SERVER['REQUEST_URI']); ?>">


                            <button type="submit" class="btn btn-sm btn-sm-my btn-outline-secondary">cancel</button>
                        </form>
                    </div>





                </div>

            </div>



        </div>
    </div>


</div>
</div>