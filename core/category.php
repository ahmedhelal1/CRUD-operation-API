<?php
class Category
{
    private $connection;
    private $table_name = "categoryies";

    public $id;
    public $name;
    public $creat_at;


    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
