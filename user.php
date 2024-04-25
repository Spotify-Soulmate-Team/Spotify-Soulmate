<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "signup_database";
$loginURL = "http://localhost/Spotify-Soulmate/login.php";
$signupURL = "http://localhost/Spotify-Soulmate/signup.php";
$conn = new mysqli($servername, $username, $password);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully <br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}


$conn->select_db($dbname);

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    gender ENUM('male', 'female', 'other') NOT NULL,
    favorite_artist VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'users' created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

if (isset($_SERVER['HTTP_REFERER'])) {
    $referrer = $_SERVER['HTTP_REFERER'];
    if($referrer == $signupURL)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Using isset() to check each variable
            $first_name = isset($_POST['first_name']) ? $conn->real_escape_string($_POST['first_name']) : '';
            $last_name = isset($_POST['last_name']) ? $conn->real_escape_string($_POST['last_name']) : '';
            $email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';
            $password = isset($_POST['password']) ? $conn->real_escape_string($_POST['password']) : '';
            $gender = isset($_POST['gender']) ? $conn->real_escape_string($_POST['gender']) : '';
            $favorite_artist = isset($_POST['favorite_artist']) ? $conn->real_escape_string($_POST['favorite_artist']) : '';
        
            if ($password && $gender) {
                $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        
                $sql = "INSERT INTO users (first_name, last_name, email, password, gender, favorite_artist) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssss", $first_name, $last_name, $email, $password_hashed, $gender, $favorite_artist);
                
                if ($stmt->execute()) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Required fields are missing.";
            }
        }
        
    } else if ($referrer == $loginURL){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $conn->real_escape_string($_POST['email']);
            $password = $_POST['password'];
        
            
            $sql = "SELECT password FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
        
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($hashed_password);
                $stmt->fetch();
        
                if (password_verify($password, $hashed_password)) {
                    echo "Login successful!";
                    $_SESSION['user_email'] = $email; 

                    header("Location: index.php");
                } else {
                    echo "Invalid email or password";
                }
            } else {
                echo "Invalid email or password";
            }
        
            $stmt->close();
        }
        
        $conn->close();
    }
 }
    
displayUsers();



function displayUsers()
{

$servername = "localhost";
$username = "root";  // Default username in XAMPP/WAMP
$password = "";      // Default password in XAMPP/WAMP is empty
$dbname = "signup_database";  // The name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";

// SQL query to fetch all data from the table
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>First Name</th>";
    echo "<th>Last Name</th>";
    echo "<th>Email</th>";
    echo "<th>Password</th>";
    echo "<th>Gender</th>";
    echo "<th>Favorite Artist</th>";
    echo "</tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["first_name"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["last_name"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["password"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["gender"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["favorite_artist"]) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();

}
?>
