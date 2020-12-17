<div class="container-fluid">
<form action="login.php" method="post">

    <div class="form-group">
        <label for="Username">Username</label>
        <input type="text" name="Username" class="form-control" id="Username" required>
    </div>

    <div class="form-group">
        <label for="Passwort">Password</label>
        <input type="password" name="Passwort" class="form-control" id="Passwort" required>
    </div>   

    
    <button type="submit" name="Submit" class="btn btn-primary">Submit</button>
</form>
<div class="row">
    <div class="col">
    <p>Don´t have an account?</p>
    <a class='link' aria-current='page' href='register.php'>register</a>
    </div>
</div>
</div>
