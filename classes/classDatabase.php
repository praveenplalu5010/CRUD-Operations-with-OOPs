<?php
    /*
    * File Name    : classDatabase.php
    * Description  : Class for managing the CRUD operations and other Database MySQL operations.
    * Author       : Praveen Prabhakaran
    * Date         : 2024-06-03
    * Version      : 1.0
    */
    class Database {
        private $host = 'localhost';
        private $db = 'kelsius_db';
        private $user = 'root';
        private $pass = '';
        private $pdo;

        public function __construct() {
            try {
                $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Could not connect to the database $this->db :" . $e->getMessage());
            }
        }
        //Insert Query
        public function insert($table, $data) {
            $keys = implode(", ", array_keys($data));
            $values = ":" . implode(", :", array_keys($data));
            $sql = "INSERT INTO $table ($keys) VALUES ($values)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($data);
        }
        //Select Query
        public function read($table, $conditions = []) {
            $sql = "SELECT * FROM $table";
            if ($conditions) {
                $sql .= " WHERE " . implode(" AND ", array_map(function($key) {
                    return "$key = :$key";
                }, array_keys($conditions)));
            }
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($conditions);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        //Update Query
        public function update($table, $data, $conditions) {
            $dataKeys = implode(", ", array_map(function($key) {
                return "$key = :$key";
            }, array_keys($data)));
            $conditionKeys = implode(" AND ", array_map(function($key) {
                return "$key = :$key";
            }, array_keys($conditions)));
            $sql = "UPDATE $table SET $dataKeys WHERE $conditionKeys";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute(array_merge($data, $conditions));
        }
        //Delete Query
        public function delete($table, $conditions) {
            $conditionKeys = implode(" AND ", array_map(function($key) {
                return "$key = :$key";
            }, array_keys($conditions)));
            $sql = "DELETE FROM $table WHERE $conditionKeys";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($conditions);
        }
        //Logged In function to check whether user email already exists or not
        public function emailExistsForOtherUser($email, $id) {
            $sql = "SELECT * FROM users WHERE email = :email AND id != :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['email' => $email, 'id' => $id]);
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return !empty($users);
        }
        //Blog title exists or not at the time of create operation
        public function blogTitleExists($title) {
            $sql = "SELECT * FROM blogs WHERE title = :title";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['title' => $title]);
            $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return !empty($blogs);
        }
        //Blog title exists or not from other item at the time of update operation
        public function blogTitleExistsForOtherBlog($title, $id) {
            $sql = "SELECT * FROM blogs WHERE title = :title AND id != :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['title' => $title, 'id' => $id]);
            $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return !empty($blogs);
        }
    }
?>
