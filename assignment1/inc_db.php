
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

$create_table_transactions = "CREATE TABLE IF NOT EXISTS transactions(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    date DATE,
    name VARCHAR(150),
    deduction FLOAT,
    increase FLOAT,
    balance FLOAT
);";

$db->exec($create_table_transactions);

$create_table_buckets = "CREATE TABLE IF NOT EXISTS buckets(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(150),
    amount FLOAT
);";

$db->exec($create_table_buckets);

?>