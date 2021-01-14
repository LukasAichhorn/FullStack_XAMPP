<form action="<?php echo ($_SERVER['REQUEST_URI']); ?>" method="post">
    <div class="row mt-3">
        <label for="Textarea1" class="form-label"><b>Neuen Kommentar verfassen:</b></label>
    </div>
    <div class="row d-flex align-content-end justify-content-end">
        <div class="col">

            <textarea class="form-control" name="Comment_text" id="Textarea1" maxlength="100" rows="1"></textarea>

        </div>
        <div class="col-3 justify-content-end">

            <button type="submit" name="Submit" class="btn btn-sm btn-primary form-control-sm" style="border-radius: 40px;" <?php echo (empty($CurrentUser) == TRUE) ? "disabled" : "" ?>>kommentieren</button>

        </div>
    </div>




</form>