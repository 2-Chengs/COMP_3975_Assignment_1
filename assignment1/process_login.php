<?php
session_start();
// $_SESSION['test_two'] = 'session is test test test test';


header("Content-Type: application/json");
header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 1000");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");



// Immediately return 200 for OPTIONS method, used in CORS preflight
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200); // OK
    exit;
}

// if (isset($_SESSION['user_id'])) {
//     // Session variable exists, user is logged in
//     $user_id = $_SESSION['user_id'];
//     echo "User ID: $user_id";
// } else {
//     // Session variable does not exist, user is not logged in
//     echo "User is not logged in";
// }


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Method Nosdft Allowed']);
    exit;
}

// Assuming you're using SQLite3 as in the registration example
$db = new SQLite3($_SERVER['DOCUMENT_ROOT'] . '/bank.sqlite');

$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

if (empty($username) || empty($password)) {
    echo json_encode(['error' => 'Username and password are required']);
    exit;
}

$stmt = $db->prepare('SELECT id, password FROM users WHERE username = :username');
$stmt->bindValue(':username', $username, SQLITE3_TEXT);
$result = $stmt->execute();

$record = $result->fetchArray(SQLITE3_ASSOC);

if ($record) {
    if (password_verify($password, $record['password'])) {
        
        // Login successful, generate a unique session string
        // $session_string = generateSessionString();
        $session_string = session_id();
        
       

        // Store the session string in the users table
        $stmt = $db->prepare('UPDATE users SET session_string = :session_string WHERE id = :user_id');
        $stmt->bindValue(':session_string', $session_string, SQLITE3_TEXT);
        $stmt->bindValue(':user_id', $record['id'], SQLITE3_INTEGER);
        $stmt->execute();
        
        $_SESSION['user_id'] = "test";
        // Send the session string back to the client
        
        
        
        
        echo json_encode(['success' => true, 'session_string' => $session_string]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid username or password']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'User not found']);
}

function generateSessionString() {
    // Generate a unique session string using a combination of current timestamp and random hash
    return hash('sha256', uniqid(mt_rand(), true));
}
?>
