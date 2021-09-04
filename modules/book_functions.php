<?php

function search_books_by_title($params)
{
    global $connection;
    $query = "SELECT title,date_published,last_name,first_name,text FROM books INNER JOIN authors ON books.author_id = authors.author_id INNER JOIN descriptions ON books.book_id = descriptions.book_id WHERE title ILIKE '%$params%' LIMIT 5;";
    $result = pg_query($connection,$query);
    books_to_list($result);
}

function random_list()
{
    global $connection;
    $query = "SELECT title,date_published,last_name,first_name,text FROM books INNER JOIN authors ON books.author_id = authors.author_id INNER JOIN descriptions ON books.book_id = descriptions.book_id ORDER BY random() LIMIT 5;";
    $result = pg_query($connection,$query);
    books_to_list($result);
    
}

function books_to_list($result)
{
    while ($row = pg_fetch_assoc($result)) {
        $text = mb_substr($row["text"],0,25) . " ..."
        ?>
<li class="list-group-item">
    <div class="d-flex w-100 justify-content-between my-2">
      <h5 class="fw-bold"><?php echo $row["title"]; ?></h5>
      <small class="ms-5">著者：<?php echo $row["last_name"] . " " . $row["first_name"]; ?></small>
    </div>
    <p class="text-muted mb-2 mx-2"><?php echo $text; ?></p>
    <small class="mb-2">発行日：<?php echo $row["date_published"]; ?></small>
</li>
<?php
    }
}


?>
