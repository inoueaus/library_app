<?php
include "templates/shared/header.php"; 


if (isset($_POST["submit"])) {
    $title = $_POST["title"];
    $date_published = $_POST["date_published"];
    $last_name = $_POST["last_name"];
    $first_name = $_POST["first_name"];
    $text = $_POST["text"];
    if ($title && $date_published && $last_name && $first_name && $text) {
        $book = new Book(null,$title,$date_published,$last_name,$first_name,$text);
        $book->save();
    }
}


?>


<div class="container py-3">
    <h1>新しい本を追加</h1>
    <form action="admin.php" method="post">
        <div class="form-group">
        <label for="title">題名</label>
        <input class="form-control" type="text" name="title">
        <label for="date_published">発行日</label>
        <input class="form-control" type="text" placeholder="2021-09-06" name="date_published">
        <label for="last_name">著者　姓</label>
        <input class="form-control" type="text" name="last_name">
        <label for="first_name">著者　名</label>
        <input class="form-control" type="text" name="first_name">
        <label for="text">説明</label>
        <textarea class="form-control" type="text" name="text" rows="14"></textarea>
        <button class="btn btn-primary" type="submit" name="submit">登録</button>
        </div>
    </form>
</div>


</body>
</html>