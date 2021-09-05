<?php 
include "templates/shared/header.php"; 
include "templates/shared/navbar.php";
?>

<?php

if (isset($_GET["error"])) {
    if ($_GET["error"] == "not_phone_number") {
        ?>
    <div class="alert alert-danger" role="alert">
        電話番号に問題がありました。
    </div>
    <?php
    } else {
        ?>
    <div class="alert alert-danger" role="alert">
        登録に問題がありました。
    </div>
    <?php
    }
    
}

?>

<div class="container my-3">
    <h1 class="mb-3">予約申し込み</h1>
    <h5 class="text-muted"><?php echo $_GET["title"]; ?></h5>
</div>

<div class="container">
    <form action="reserved" method="post">
        <div class="form-group">
            <label for="last_name">姓</label>
            <input class="form-control mb-1" name="last_name" placeholder="田中" type="text">
            <label for="first_name">名</label>
            <input class="form-control mb-1" name="first_name" placeholder="太郎" type="text">
            <label for="phone_number">電話番号</label>
            <input class="form-control mb-1" name="phone_number" placeholder="080-1010-2020" type="text">
            <input type="hidden" name="book_id" value="<?php echo $_GET["book_id"]; ?>">
            <input type="hidden" name="title" value="<?php echo $_GET["title"]; ?>">
            <button class="btn btn-primary my-3" type="submit" name="submit">申し込む</button>
        </div>
    </form>
</div>





<?php include "templates/shared/footer.php"; ?>