<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: access');
header('Access-Control-Allow-Methods: POST,PUT');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
session_start();

class Connection {
    public $host = "localhost";
    public $user = "root";
    public $password = "";
    public $dbname = "task2";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
}

class Register extends Connection {
    public function __construct() {
        parent::__construct(); // Assuming Connection is a parent class with a constructor
    }

    public function registration($username, $password, $email) {
        $duplicate = mysqli_query($this->conn, "SELECT * FROM users WHERE email = '$email'");
        if (mysqli_num_rows($duplicate) > 0) {
            return 10; // User with the same email already exists
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashedPassword', '$email')";
            mysqli_query($this->conn, $query);
            return 1; // Registration successful
        }
    }
}

class Select extends Connection {
    public function selectUserById($id) {
        $result = mysqli_query($this->conn, "SELECT * FROM users WHERE id='$id'");
        return mysqli_fetch_assoc($result);
    }
}

// Example usage:
$register = new Register();
$data = json_decode(file_get_contents('php://input'), true);

if ($data && isset($data["username"]) && isset($data["email"]) && isset($data["password"])) {
    $username = $data["username"];
    $email = $data["email"];
    $password = $data["password"];

    $result = $register->registration($username, $password, $email);
    // Handle $result as needed
}
?>

 










        

      