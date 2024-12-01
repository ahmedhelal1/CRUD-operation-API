<?php
class Post
{
    private $connection;
    private $table_name = "posts";

    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function read()
    {
        $query = "SELECT 
        c.name as category_name,
        p.id,
        p.category_id,
        p.title,
        p.body,
        p.author,
        p.creat_at
        FROM 
        " . $this->table_name . " p
        LEFT JOIN
        categoryies c ON p.category_id=c.id 
        ORDER BY p.creat_at DESC";

        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function read_single()
    {
        $query = "SELECT 
        c.name as category_name,
        p.id,
        p.category_id,
        p.title,
        p.body,
        p.author,
        p.creat_at
        FROM 
        " . $this->table_name . " p
        LEFT JOIN
        categoryies c ON p.category_id=c.id 
        WHERE p.id =? LIMIT 1 ";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->title = $row['title'];
        $this->body = $row['body'];
        $this->author = $row['author'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
    }
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . "(title,body,author,category_id) VALUES(:title,:body,:author,:category_id)";
        $stmt = $this->connection->prepare($query);
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":body", $this->body);
        $stmt->bindParam(":author", $this->author);
        $stmt->bindParam(":category_id", $this->category_id);

        if ($stmt->execute()) {
            return true;
        }
        printf("error %s.\n", $stmt->error);
        return false;
    }
    public function update()
    {


        $query = "UPDATE " . $this->table_name . " SET title=:title,body=:body,author=:author,category_id=:category_id WHERE id=:id ";
        $stmt = $this->connection->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":body", $this->body);
        $stmt->bindParam(":author", $this->author);
        $stmt->bindParam(":category_id", $this->category_id);
        if ($stmt->execute()) {
            return true;
        } else {
            printf("error %s.\n", $stmt->error);
            return false;
        }
    }
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->connection->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);
        if ($stmt->execute()) {
            return true;
        } else {
            printf("Error %s.\n", $stmt->error);
            return false;
        }
    }
}
