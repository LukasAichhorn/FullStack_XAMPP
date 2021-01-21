<div class="row">

    <div class="col-1"></div>

    <div class="col">
        <form action="createPost.php" method="post" enctype="multipart/form-data">



            <div class="form-group mt-1">
                <label for="Titel">Titel:</label>
                <input type="text" name="Titel" class="form-control" id="Titel" required>
            </div>

            <div class="form-group mt-3">
                <label for="Textarea1" class="form-label">Text:</label>
                <textarea class="form-control" name="Textarea1" id="Textarea1" maxlength="300" rows="4"></textarea>
            </div>

            <div class=" form-group  mt-3 mb-3">
                <label for="formFileSm" class="form-label">Bild hochladen:</label>
                <input class="form-control form-control-sm" id="fileUpload" name="fileUpload" type="file">
            </div>

            <div class="form-group mt-1 d-flex flex-row flex-wrap ">
                <?php
                foreach ($Tags as $tag) {
                    include "../components/tag.comp.php";
                }
                ?>

            </div>

            <div class="form-check mt-3">
                <label class="form-check-label" for="checkPrivate">privat</label>
                <input class="form-check-input" type="checkbox" value="on" name="checkPrivate" id="checkPrivate">

            </div>

            <div class="form-group mt-3">
                <button type="submit" name="Submit" class="btn btn-sm btn-primary" style="border-radius: 40px;">Beitrag erstellen</button>
            </div>

        </form>

    </div>

    <div class="col-1"></div>

</div>