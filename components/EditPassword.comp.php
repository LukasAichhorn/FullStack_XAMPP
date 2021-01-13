<div class="mb-2 mt-5">
    <div class="row">
        <div class="col-3">
        </div>

        <div class="col">



            <form class="action=//<?php echo (DIR_SERVERROOT .  $_SERVER['REQUEST_URI']); ?>" method="post">
                <div class="form-group mt-3">
                    <label for="PasswortAlt">Altes Passwort</label>
                    <input type="password" name="PasswortAlt" class="form-control" id="PasswortAlt" required>
                </div>
                <div class="form-group mt-3">
                    <label for="PasswortNeu">Neues Passwort</label>
                    <input type="password" name="PasswortNeu" class="form-control" id="PasswortNeu" required>
                </div>
                <div class="form-group mt-3 mb-3">
                    <label for="PasswortNeuRep">Neues Passwort wiederholen</label>
                    <input type="password" name="PasswortNeuRep" class="form-control" id="PasswortNeuRep" required>
                </div>

                <div class="d-flex flex-row justify-content-end">
                    <button type="submit" class="btn btn-sm btn-sm-my btn-outline-primary">change password</button>
            </form>

            <form class="Comp-like" action="//<?php echo (DIR_SERVERROOT .  $_SERVER['REQUEST_URI']); ?>">

                <button type="submit" class="btn btn-sm btn-sm-my btn-outline-secondary">cancel</button>
            </form>
        </div>


        
    </div>
    <div class="col-3">
        </div>


</div>
</div>