<?php
namespace src\Model;

class StudentModel
{
    private $db = null;
    
    public function __construct($db)
    {
        $this->db = $db;
    }
    // бүх оюутны мэдээлэлийг харах
    public function all()
    {
        $statement = "
        SELECT 
            id, st_code, st_name, st_huis, st_nas, st_phone_number, st_ address
        FROM
            students;
    ";
        try {
            $statement = $this->db->query($statement);
            $result    = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        }
        catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
    // Оюутны id гаар хайх
    public function find($id)
    {
        $statement = "
            SELECT 
                id, st_code, st_name, st_huis, st_nas, st_phone_number, st_ address
            FROM
                students
            WHERE id = ?;
        ";
        
        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                $id
            ));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        }
        catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
    
}