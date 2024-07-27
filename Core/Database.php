<?php
class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "isbn1kel3";
    private $conn;

    function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function execute($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Unable to prepare statement: " . $this->conn->error);
        }

        if ($params) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }

        if (!$stmt->execute()) {
            throw new Exception("Unable to execute statement: " . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result === false) {
            return [];
        }

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        // var_dump($data);
        $stmt->close();
        return $data;
    }

    public function delete($table, $where, $params = []) {
        $query = "DELETE FROM $table WHERE $where";
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            throw new Exception("Unable to prepare statement: " . $this->conn->error);
        }

        if ($params) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }

        if (!$stmt->execute()) {
            throw new Exception("Unable to execute statement: " . $stmt->error);
        }

        $status = $stmt->affected_rows > 0;
        $stmt->close();
        return $status;
    }

    public function insert($table, $col, $values) {
        $columns = implode(',', $col);
        $placeholders = implode(',', array_fill(0, count($values), '?'));

        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        // var_dump($query);
        return $this->execute($query, $values);
    }

    public function getConnection() {
        return $this->conn;
    }



}
