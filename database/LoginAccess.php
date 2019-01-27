<?php
session_start();
require_once("database/Connection.php");

class LoginAccess{
    private $conn;
    public function __construct() {
        $data_access = new Connection();
        $this->conn = $data_access->getConnection();
    }

    public function login($table, $indx, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM $table WHERE indx = '$indx' AND passwd = '$password' AND status=1");
        $stmt->execute();
        $data = $stmt->fetch();
        if ($data) {
            $_SESSION['name'] = $data['name'];
            $_SESSION['valid'] = true;
            $_SESSION['index'] = $data['indx'];
            $_SESSION['usertype'] = $data['usertype'];
            return true;
        } else {
            return false;
        }
    }

    public function logout() {
        unset($_SESSION['name']);
        unset($_SESSION['valid']);
        unset($_SESSION['index']);
        unset($_SESSION['usertype']);
        session_destroy();
        header("Location: login.php");
        return true;
    }

}
