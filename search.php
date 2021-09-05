<?php 
include "templates/shared/header.php"; 
include "templates/shared/navbar.php";
?>


<div class="container my-3">
    <h1>検索結果</h1>
</div>


<div class="container">
    <ul class="list-group">
<?php

if (isset($_POST["submit"])) {
    //check what type of search is being conducted
    $type = $_POST["submit"];
    if ($type == "title") {
        search_books_by_title($_POST["params"]);
    }
}

?>
</ul>
</div>



<?php include "templates/shared/footer.php"; ?>