<?php 
include "templates/shared/header.php"; 
include "templates/shared/navbar.php";

?>

<div class="container">
<ul class="list-group">
<?php

//set book to display here
if (isset($_GET["book_id"])) {
    $book = new Book($_GET["book_id"]);
    display_one($book,true);
} else {
    random_list();
}

?>
</ul>



<?php include "templates/list_display.php"; ?>



<?php include "templates/shared/footer.php"; ?>