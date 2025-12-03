<?php
// connect or create DB
$db = new PDO("sqlite:database.sqlite");

// create table if not exists
$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    fullname TEXT,
    email TEXT UNIQUE,
    password TEXT
)");

// read input from form
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];

// insert user
$stmt = $db->prepare("INSERT INTO users(fullname, email, password) VALUES(?,?,?)");
$success = $stmt->execute([$fullname, $email, $password]);

// redirect after signup
if ($success) {
    header("Location: home.html");
} else {
    echo "<h2 style='color:red;'>Signup Failed</h2>";
    echo "<p>Email already exists.</p>";
    echo "<a href='signup.html'>Try Again</a>";
}
