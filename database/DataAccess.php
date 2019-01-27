<?php

//session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ("database/Connection.php");

class DataAccess{

    private $conn;

    public function __construct() {
        $data_access = new Connection();
        $this->conn = $data_access->getConnection();
    }
    
    public function redirect($url) {
        header('Location:' . $url);
        exit();
        return true;
    }

    public function getAll($table) {
        $stmt = $this->conn->prepare("SELECT * FROM $table");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_CLASS);
        return $data;
    }

    public function getCount($table, $status) {
        $stmt = null;
        if (!$status) {
            $stmt = $this->conn->prepare("SELECT COUNT(*) AS count FROM $table");
        } else {
            $stmt = $this->conn->prepare("SELECT COUNT(*) AS count FROM $table WHERE status=$status");
        }
        $stmt->execute();
        $data = $stmt->fetch();
        return $data;
    }

    public function getById($table, $id) {
        $stmt = $this->conn->prepare("SELECT * FROM $table WHERE id=$id");
        $stmt->execute();
        $data = $stmt->fetch();
        return $data;
    }

    public function select($table, $field = '*', $condition = null, $order_by = null, $limit = null) {
        $sql = "SELECT $field FROM $table";
        $sql.=$condition ? " $condition" : " ";
        $sql.=$order_by ? " ORDER BY $order_by" : '';
        $sql.=$limit ? " LIMIT $limit" : '';
        // echo $sql;exit;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function insert($table, $data = array()) {
        $fields = implode(',', array_keys($data));
        $placeholder = implode(',', array_fill(0, count($data), '?'));
        $sql = "INSERT INTO $table ($fields) VALUES ($placeholder)";
        $stmt = $this->conn->prepare($sql);
        $result = $stmt->execute(array_values($data));
        return $result;
    }

    public function update($table, $data = array(), $condition) {
        $fields = '';
        $params = [];
        foreach ($data as $key => $value) {
            $fields.=$key . '=:' . $key . ',';
            $params[':' . $key] = $value;
        }
        $fields = trim($fields, ',');
        $sql = "UPDATE $table SET $fields WHERE $condition";
        $stmt = $this->conn->prepare($sql);
        $result = $stmt->execute($params);
        return $result;
    }

    public function delete($table, $condition) {
        $sql = "DELETE FROM $table WHERE $condition";
        $stmt = $this->conn->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }

}
