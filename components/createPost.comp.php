<div class="row">

<div class="col-2"></div>

<div class="col">
    <form action="createPost.php" method="post">

        <div class="form-group m-1">
            <label for="Titel">Title:</label>
            <input type="text" name="Titel" class="form-control" id="Titel" required>
        </div>

        <div class="form-group m-1">
            <label for="Textarea1" class="form-label"></label>
            <textarea class="form-control" name="Textarea1" id="Textarea1" maxlength="300"></textarea>
        </div>

        <div class="form-group m-1 d-flex">
        <?php
        foreach ($Tags as $tag) {
            echo("
            <div class='form-check form-switch'>
                <input class='form-check-input' type='checkbox' id='" . $tag . "' checked>
                    <label class='form-check-label' for='" . $tag . "'>Checked switch checkbox input</label>
                    </div>

            ");
        }
        ?>

        </div>

        <div class="form-group m-1">
            <button type="submit" name="Submit" class="btn btn-sm btn-primary">Create Post</button>
        </div>

    </form>
   
    </div>

    <div class="col-2"></div>

    </div>