<?php
class Query
{
    private $table = 'users';
    private $conn;

    // Constructor to initialize the database connection
    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    // SELECT all users
    public function select()
    {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // SELECT specific user by email
    public function selectByEmail($email)
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE email = :email';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // INSERT a new user
    public function insert($name, $email, $age)
    {
        $query = 'INSERT INTO ' . $this->table . ' (name, email, age) VALUES (:name, :email, :age)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':age', $age, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // UPDATE user's email by ID
    public function updateEmailById($id, $newEmail)
    {
        $query = 'UPDATE ' . $this->table . ' SET email = :email WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $newEmail, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // DELETE user by ID
    public function deleteById($id)
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>