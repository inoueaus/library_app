<?php

include "db.php";

class Book
{
    public $id = null;
    public $title;
    public $date_published;
    public $last_name;
    public $first_name;
    public $text;
    public $short_text;
    public $author_id;

    function __construct($id=null,$title=null,$date_published=null,$last_name=null,$first_name=null,$text=null)
    {
        if (isset($id)) {
            $this->id = $id;
            $this->load($id);
        } else {
            $this->title = $title;
            $this->date_published = $date_published;
            $this->last_name = $last_name;
            $this->first_name = $first_name;
            $this->text = $text;
        }
    }

    public function can_borrow()
    {
        global $connection;
        $query = "SELECT * FROM reservations WHERE book_id = $this->id";
        $result = pg_query($connection,$query);
        $length = pg_num_rows($result);
        if ($length) {
            return "<small>不可</small>";
        } else {
            return "<small>可</small><br><a href='reserve.php?book_id=$this->id&title=$this->title' class='btn btn-primary'>予約</a>";
        }
    }

    protected function load($id)
    {   
        global $connection;
        $query = "SELECT books.book_id,books.author_id,title,date_published,last_name,first_name,text FROM books INNER JOIN authors ON books.author_id = authors.author_id INNER JOIN descriptions ON books.book_id = descriptions.book_id WHERE books.book_id = $id";
        $result = pg_query($connection,$query);
        $row = pg_fetch_assoc($result);
        $this->title = $row["title"];
        $this->date_published = $row["date_published"];
        $this->last_name = $row["last_name"];
        $this->first_name = $row["first_name"];
        $this->text = $row["text"];
        $this->author_id = $row["author_id"];
        $this->short_text = mb_substr($this->text,0,25) . " ...";
    }

    public function save()
    {
        global $connection;
        if (isset($this->id)) {
            $query = "SELECT * FROM books WHERE book_id = $this->id";
            $result = pg_query($connection,$query);
            $count = pg_num_rows($result);
            if ($count == 1) {
                //update information changed if exists
                $this->update();
            } else {
                //insert into tables if does not exist
                $this->insert();
            }
        } else {
            $query = "SELECT * FROM books WHERE title = '$this->title'";
            $result = pg_query($connection,$query);
            $count = pg_num_rows($result);
            if ($count == 1) {
                //do nothing because the book was already created
            } else {
                //insert into tables if does not exist
                $this->insert();
            }
        }
    }

    protected function insert()
    {
        global $connection;
        $query = "WITH rows AS (INSERT INTO authors(last_name,first_name)
        VALUES('$this->last_name','$this->first_name')
        RETURNING author_id)
        INSERT INTO books(title,date_published,author_id)
        SELECT '$this->title','$this->date_published',author_id
        FROM rows;";
        $result = pg_query($connection,$query);
        if ($result) {
            $query = "SELECT book_id FROM books WHERE title = '$this->title' AND date_published = '$this->date_published'";
            $result = pg_query($connection,$query);
            $row = pg_fetch_assoc($result);
            $this->id = $row["book_id"];
            $query = "INSERT INTO descriptions(text,book_id) VALUES('$this->text',$this->id)";
            $result = pg_query($connection,$query);
            if ($result) {
                echo "登録成功";
            }
        } else {
            echo "失敗";
        }
    }

    protected function update()
    {
        global $connection;
        //update books table info
        $query = "UPDATE books SET title = '$this->title', date_published = '$this->date_published' WHERE book_id = $this->id";
        pg_query($connection,$query);
        //update author table info
        $query = "UPDATE authors SET last_name = '$this->last_name', first_name = '$this->first_name' WHERE author_id = $this->author_id";
        pg_query($connection,$query);
        //update descriptions table infor
        $query = "UPDATE descriptions SET text = '$this->text' WHERE book_id = $this->id";
        pg_query($connection,$query);
    }    
}


?>