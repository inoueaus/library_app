<?php 
include "templates/shared/header.php"; 
include "templates/shared/navbar.php";
?>



<div class="container mb-3">
<ul class="list-group">
<?php
//set book to display here
//check if not on 1st page
if (isset($_GET["page"])) {
    $current_page = $_GET["page"];
    books_list($current_page);
} else {
    //defaults to first page
    books_list();
}
?>
</ul>
</div>


<div class="container mb-5">
    <div class="">
    <?php
    //check if not on 1st page
    if (isset($_GET["page"])) {
        $current_page = $_GET["page"];
        page_nav($current_page);
    } else {
        //defaults to first page
        page_nav();
    }
    
    ?>
    </div>
</div>



<?php include "templates/shared/footer.php"; ?>