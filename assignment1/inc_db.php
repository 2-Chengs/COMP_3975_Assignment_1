
<?php
// Hash the password
$db = new SQLite3($_SERVER['DOCUMENT_ROOT'] . '/bank.sqlite');

$SQL_create_table_users = "CREATE TABLE IF NOT EXISTS users(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username VARCHAR(50),
    password TEXT,
    is_admin BOOLEAN DEFAULT 0,
    session_string TEXT
);";

$db->exec($SQL_create_table_users);

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$create_table_transactions = "CREATE TABLE IF NOT EXISTS transactions(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    date DATE,
    name VARCHAR(50),
    user_id INTEGER,
    FOREIGN KEY(user_id) REFERENCES users(id)
);";

?>