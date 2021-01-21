<div class="row">

    <div class="col-2"></div>

    <div class="col">
        <form action="login.php" method="post">

            <div class="form-group m-1">
                <label for="Username">Username</label>
                <input type="text" name="Username" class="form-control" id="Username" required>
            </div>

            <div class="form-group m-1">
                <label for="Passwort">Passwort</label>
                <input type="password" name="Passwort" class="form-control" id="Passwort" required>
            </div>

            <div class="form-group m-1">
                <button type="submit" name="Submit" class="btn btn-sm btn-primary">Submit</button>
            </div>

        </form>
        <div class="row">
            <div class="col">
                <p>Noch keinen Account?</p>
                <a class='link' aria-current='page' href='register.php'>Registrieren</a>
            </div>
        </div>
    </div>

    <div class="col-2"></div>

</div>