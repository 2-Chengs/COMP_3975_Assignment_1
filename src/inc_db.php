
<?php
// Hash the password
$db = new SQLite3($_SERVER['DOCUMENT_ROOT'] . '/bank.sqlite');

$SQL_create_table_users = "CREATE TABLE IF NOT EXISTS users(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username VARCHAR(50),
    password TEXT,
    is_admin BOOLEAN DEFAULT 0,
    is_approved BOOLEAN DEFAULT 0
   
);";

$db->exec($SQL_create_table_users);

$create_table_transactions = "CREATE TABLE IF NOT EXISTS transactions(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    date DATE,
    name VARCHAR(150),
    deduction FLOAT,
    increase FLOAT
);";

$db->exec($create_table_transactions);

// Uncomment below if need to reset buckets table
// $db->exec("DROP TABLE buckets;");
$create_table_buckets = "CREATE TABLE IF NOT EXISTS buckets (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    entry_name VARCHAR(255),
    category VARCHAR(255)
);";

$db->exec($create_table_buckets);

$insert_buckets = "INSERT INTO buckets (entry_name, category) VALUES
('ST JAMES RESTAURANT', 'Food and Restaurants'),
('PUR & SIMPLE RESTAUR', 'Food and Restaurants'),
('Subway', 'Food and Restaurants'),
('WHITE SPOT RESTAURANT', 'Food and Restaurants'),
('MCDONALDS', 'Food and Restaurants'),
('TIM HORTONS #73', 'Food and Restaurants'),
('REAL CDN SUPERS', 'Supermarkets/Grocery Stores'),
('SAFEWAY', 'Supermarkets/Grocery Stores'),
('GC 9103-DEPOSIT', 'Financial Transactions'),
('CHQ#00795-0145121987', 'Financial Transactions'),
('BMO PAY', 'Financial Transactions'),
('CHQ#00395-4142613936', 'Financial Transactions'),
('O.D.P. FEE', 'Financial Transactions'),
('MONTHLY ACCOUNT FEE', 'Financial Transactions'),
('FORTISBC GAS U8U7W9', 'Utilities and Services'),
('SHAW CABLE Y2L7L3', 'Utilities and Services'),
('ROGERS MOBILE', 'Utilities and Services'),
('WALMART STORE #', 'Retail and Wholesale'),
('COSTCO', 'Retail and Wholesale'),
('CANADIAN TIRE', 'Retail and Wholesale'),
('ICBC INS', 'Insurance and Health'),
('GATEWAY MSP', 'Insurance and Health'),
('World Vision MSP', 'Insurance and Health'),
('RED CROSS', 'Miscellaneous'
);";

if ($db->querySingle("SELECT COUNT(*) FROM buckets") == 0) {
    $db->exec($insert_buckets);
}
?>