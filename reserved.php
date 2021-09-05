<?php 
include "templates/shared/header.php"; 
include "templates/shared/navbar.php";


if (isset($_POST["submit"])) {
    $last_name = $_POST["last_name"];
    $first_name = $_POST["first_name"];
    $phone_number = $_POST["phone_number"];
    $book_id = $_POST["book_id"];
    $title = $_POST["title"];
    if ($last_name && $first_name && $phone_number) {
        $pattern = "/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/";
        if (preg_match($pattern,$phone_number)) {
            $result = reserve_book($book_id,$last_name,$first_name,$phone_number);
        } else {
            header("Location: reserve?error=not_phone_number&book_id=$book_id&title=$title");
        }
    } else {
        header("Location: reserve?error=not_complete&book_id=$book_id&title=$title");
    }
}


?>




<div class="container my-3">
    <h1>

    <?php

    if ($result) {
        echo "予約できました。<p class='mt-3'>返却期限：$result</p>";
    } else {
        echo "予約できませんでした";
    }
    ?>
    </h1>
</div>







<?php include "templates/shared/footer.php"; ?>