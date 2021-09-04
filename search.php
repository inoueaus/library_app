<?php 
include "templates/shared/header.php"; 
include "templates/shared/navbar.php";
?>

<?php

if (isset($_POST["submit"])) {
    //check what type of search is being conducted
    $type = $_POST["submit"];
    if ($type == "title") {
        search_books_by_title($_POST["params"]);
    }
}

?>



<?php include "templates/shared/footer.php"; ?>