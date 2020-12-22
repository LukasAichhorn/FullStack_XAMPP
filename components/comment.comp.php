<div class=" card mb-1 p-1">
    <div class="row">
        <div class="col-3"><p class="card-text"><small class="text-muted">From: <?php echo($Comment->Author);?> <br> <?php echo($Comment->CreatedAt); ?> </small></p></div>
        <div class="col"><p class="card-text"><?php echo($Comment->Inhalt)?></p></div>
    </div>
</div>