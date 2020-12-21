<!-- Search form -->
<form class="d-flex m-2 ">
    <input class=" headline-search form-control me-2" type="search" placeholder="Search" aria-label="Search">
    <button class=" headline-button btn btn-outline-success" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></button>
</form>


    <div class="container-fluid d-flex flex-row justify-content-start flex-wrap">
    <?php
        foreach ($Tags as $tag) {
         include "components/tag.comp.php";
        }
        ?>
      
    </div>  



