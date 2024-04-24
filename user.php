<?php
$server_name = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($server_name, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to create table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    gender ENUM('male', 'female', 'other') NOT NULL,
    favorite_artist VARCHAR(255)
)";

if ($conn->query($sql) === true) {
    echo "Table users created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
<?php
$server_name = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($server_name, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Escape user inputs for security
$first_name = $conn->real_escape_string($_POST['first_name']);
$last_name = $conn->real_escape_string($_POST['last_name']);
$email = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']);
$gender = $conn->real_escape_string($_POST['gender']);
$favorite_artist = $conn->real_escape_string($_POST['favorite_artist']);

// Encrypt the password
$password_hashed = password_hash($password, PASSWORD_DEFAULT);

// Attempt insert query execution
$sql = "INSERT INTO users (first_name, last_name, email, password, gender, favorite_artist) VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $first_name, $last_name, $email, $password_hashed, $gender, $favorite_artist);

if ($stmt->execute()) {
    echo "Records inserted successfully.";
} else {
    echo "ERROR: Could not execute query: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

