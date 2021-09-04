<?php

include "book_class.php";

function search_books_by_title($params)
{
    global $connection;
    $query = "SELECT books.book_id FROM books WHERE title ILIKE '%$params%' LIMIT 5;";
    $result = pg_query($connection,$query);
    $books_arr = result_to_books_array($result);
    books_to_list($books_arr);
}

function random_list()
{
    global $connection;
    $query = "SELECT books.book_id FROM books ORDER BY random() LIMIT 5;";
    $result = pg_query($connection,$query);
    $books_arr = result_to_books_array($result);
    books_to_list($books_arr);
    
}

function books_to_list($books_arr)
{
    if (count($books_arr) > 0) {
        foreach ($books_arr as $book) {
            ?>
            <li class="list-group-item" data-id="<?php echo $book->id; ?>">
        <div class="d-flex w-100 justify-content-between my-2">
          <h5 class="fw-bold"><?php echo $book->title; ?></h5>
          <small class="ms-5">著者：<?php echo $book->last_name . " " . $book->first_name; ?></small>
        </div>
        <p class="text-muted mb-2 mx-2"><?php echo $book->short_text; ?></p>
        <small class="mb-2">発行日：<?php echo $book->date_published; ?></small>
    </li>
    <?php
        }
    } else {
        ?>
        <h5 class="text-center text-muted">本が見つかりませんでした。</h5>
        <?php
    }
    
}

function result_to_books_array($result)
{
    $books_arr = [];
    while($row = pg_fetch_assoc($result)) {
        $books_arr[] = new Book($id=$row["book_id"]);
    }
    return $books_arr;
}


?>
