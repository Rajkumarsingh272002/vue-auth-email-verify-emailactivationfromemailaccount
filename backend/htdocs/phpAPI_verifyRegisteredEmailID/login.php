

<?php
// ✅ Start session early
session_start();

// ✅ Required once for DB config
require_once 'databaseconfig.php';

// ✅ CORS headers for frontend access
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// ✅ Handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// ✅ Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        echo "<h3>This API only accepts POST requests. Please use a REST client or frontend form.</h3>";
        exit;
    }
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
    exit;
}

// ✅ Read and decode incoming JSON
$rawData = file_get_contents('php://input');
$data = json_decode($rawData, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON input']);
    exit;
}

// ✅ Extract values
$email = $data['email'] ?? '';
$password = $data['password'] ?? '';
$status = 1;
$error = [];
$response = [];

// ✅ DB connection check
if ($databaseconfig->connect_error) {
    echo json_encode(['errors' => ['Database connection failed']]);
    exit;
}

// ✅ Prepare and run the query
$stmt = $databaseconfig->prepare("SELECT * FROM emailregis WHERE email = ? AND status = ?");
$stmt->bind_param('si', $email, $status);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $dbEmail = $row['email'];
    $dbHashedPassword = $row['password'];

    // ✅ Email check (redundant since already filtered)
    if ($email === $dbEmail) {
        // ✅ Verify password
        if (password_verify($password, $dbHashedPassword)) {
            $response[] = 'Login successful';
            $response[] = 'Email verified and password matched';
        } else {
            echo json_encode(['errors' => ['Password did not match']]);
            exit;
        }
    } else {
        echo json_encode(['errors' => ['Email mismatch']]);
        exit;
    }
} else {
    echo json_encode(['errors' => ['No matching plz check your email-id if your account alreday activate (or) user  account not activated. Please verify your email-Account.']]);
    exit;
}

// ✅ Final successful response
http_response_code(200);
echo json_encode(['response' => $response]);
exit;

?>