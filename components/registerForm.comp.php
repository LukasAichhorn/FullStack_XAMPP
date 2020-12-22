<form action="register.php" method="post">

    <div class="form-group mt-3">
        <label for="Username">Username</label>
        <input type="text" name="Username" class="form-control" id="Username" required>
    </div>

    <div class="form-group mt-3">
        <label for="Passwort">Password</label>
        <input type="password" name="Passwort" class="form-control" id="Passwort" required>
    </div>    

    <div class="row">
        <div class="col">
            <div class="form-group mt-3">
                <label for="Anrede">Anrede</label>
                <select class="form-control" name="Anrede" id="Anrede" required>
                    <option>Herr</option>
                    <option>Frau</option>
                    <option>X</option>

                </select>
            </div>
        </div>
        <div class="col">
            <div class="form-group mt-3">
                <label for="Vorname">Vorname</label>
                <input type="text" name="Vorname" class="form-control" id="Vorname" required>
            </div>
        </div>
        <div class="col">
            <div class="form-group mt-3">
                <label for="Nachname">Nachname</label>
                <input type="text" name="Nachname" class="form-control" id="Nachname" required>
            </div>
        </div>
    </div>
    <button type="submit" name="Submit" class="btn btn-sm btn-primary mt-3">Submit</button>
</form>
