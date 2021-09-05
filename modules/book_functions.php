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
            display_one($book);
        }
    } else {
        ?>
        <h5 class="text-center text-muted">本が見つかりませんでした。</h5>
        <?php
    }
    
}

function display_one($book,$only_one=false)
{
    ?>
            <li class="list-group-item" data-id="<?php echo $book->id; ?>">
        <div class="d-flex w-100 justify-content-between my-2">
          <h5 class="fw-bold"><?php echo $book->title; ?></h5>
          <small class="ms-5">著者：<?php echo $book->last_name . " " . $book->first_name; ?></small>
        </div>
        <p class="text-muted mb-2 mx-2"><?php 
        if ($only_one) {
            echo $book->text;
        } else {
            echo $book->short_text;
        }
        
        
        ?></p>
        <div class="d-flex w-100 justify-content-between mb-2">
        <small class="">発行日：<?php echo $book->date_published; ?></small>
        
        <?php 
        if ($only_one) {
            ?>
            <small>貸出：
                <?php
            echo $book->can_borrow();
            ?>
            </small>
            <?php
        } 
        ?>
        
        </div>
    </li>
    <?php
}

function result_to_books_array($result)
{
    $books_arr = [];
    while($row = pg_fetch_assoc($result)) {
        $books_arr[] = new Book($id=$row["book_id"]);
    }
    return $books_arr;
}

function reserve_book($book_id,$last_name,$first_name,$phone_number)
{
    global $connection;
    //check if book is still available
    $query = "SELECT * FROM reservations WHERE book_id = $book_id";
    $result = pg_query($connection,$query);
    $length = pg_num_rows($result);
    if ($length) {
        return false;
    } else {
        //check if user exists with phone number
        $query = "SELECT user_id FROM users WHERE phone_number = '$phone_number'";
        $result = pg_query($connection,$query);
        $count = pg_num_rows($result);
        if ($count) {
            $row = pg_fetch_assoc($result);
            $user_id = $row["user_id"];
            $query = "INSERT INTO reservations(book_id,user_id) VALUES($book_id,$user_id) RETURNING due_date";
            $result = pg_query($connection,$query);
            if ($result) {
                $row = pg_fetch_assoc($result);
                return $row["due_date"];
            } else {
                return false;
            }
        } else {
            //if user does not exist create new and create reservation
            $query = "WITH row AS (INSERT INTO users(last_name,first_name,phone_number) 
            VALUES ('$last_name','$first_name','$phone_number') 
            RETURNING user_id) 
            INSERT INTO reservations(book_id,user_id) SELECT $book_id,user_id FROM row
            RETURNING due_date;";
            $result = pg_query($connection,$query);
            if ($result) {
                $row = pg_fetch_assoc($result);
                return $row["due_date"];
            } else {
                return false;
            }
        }
    }
    
}


?>
