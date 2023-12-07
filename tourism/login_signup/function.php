 <?php
 
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
 
 class Login extends Connection {
     private $id;
 
     public function login($email, $password) {
         $result = mysqli_query($this->conn, "SELECT * FROM users WHERE email = '$email'");
         $row = mysqli_fetch_assoc($result);
 
         if (mysqli_num_rows($result) > 0) {
             if (password_verify($password, $row["password"])) {
                 $this->id = $row["id"];
                 return 1; // Login successful
             }
         } else {
             return 10; // User not found or password is incorrect
         }
     }
 
     public function getUserId() {
         return $this->id;
     }
 }
 
 class Select extends Connection {
     public function selectUserById($id) {
         $result = mysqli_query($this->conn, "SELECT * FROM users WHERE id='$id'");
         return mysqli_fetch_assoc($result);
     }
 }
 ?>
 










        

      