<div class="row">

<div class="col-1"></div>

<div class="col">
    <form action="createPost.php" method="post" enctype="multipart/form-data">

        <div class="form-group m-1">
            <label for="Titel">Title:</label>
            <input type="text" name="Titel" class="form-control" id="Titel" required>
        </div>

        <div class="form-group m-1">
            <label for="Textarea1" class="form-label">Text:</label>
            <textarea class="form-control" name="Textarea1" id="Textarea1" maxlength="300"></textarea>
        </div>

        <div class=" form-group  m-1 mb-3">
  <label for="formFileSm" class="form-label">Choose img for Upload</label>
  <input class="form-control form-control-sm" id="fileUpload" name="fileUpload" type="file">
</div>

        <div class="form-group m-1 d-flex flex-row flex-wrap ">
        <?php
        foreach ($Tags as $tag) {
         include "../components/tag.comp.php";
        }
        ?>

        </div>

        <div class="form-group m-1">
            <button type="submit" name="Submit" class="btn btn-sm btn-primary">Create Post</button>
        </div>

    </form>
   
    </div>

    <div class="col-1"></div>

    </div>