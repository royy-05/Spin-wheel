<?php
session_start(); // IMPORTANT for login system
header('Content-Type: application/json');

// 1. CONNECT TO DATABASE
include 'db.php';
if ($conn->connect_error) {
    echo json_encode(["success" => false, "error" => "Database connection failed"]);
    exit;
}

// 2. READ PRIZES FROM JSON FILE
$prizesData = json_decode(file_get_contents('prizes.json'), true);
if (!$prizesData) {
    echo json_encode(["success" => false, "error" => "Failed to load prizes"]);
    exit;
}

// 3. SELECT RANDOM PRIZE BASED ON PROBABILITY
$rand = mt_rand() / mt_getrandmax();
$sum = 0;
foreach ($prizesData as $index => $prize) {
    $sum += $prize['probability'];
    if ($rand <= $sum) {
        $selected = $prize;
        $segments = explode(",", $prize['segments']);
        $segmentIndex = $segments[array_rand($segments)];
        break;
    }
}

// 4. SAVE TO DATABASE (NEW: store user_id also if logged in)
$user_ip = $_SERVER['REMOTE_ADDR'];
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL; // <-- NEW

// UPDATED query for multi-user
$stmt = $conn->prepare("INSERT INTO spins (user_ip, prize_name, segment_index, user_id) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssii", $user_ip, $selected['name'], $segmentIndex, $user_id);
$stmt->execute();

// 5. SEND RESULT TO FRONTEND
echo json_encode([
    "success" => true,
    "segmentIndex" => (int)$segmentIndex,
    "prize" => [
        "name" => $selected['name'],
        "icon" => $selected['name'] === "Better Luck Next Time" ? "😢" :
                 ($selected['name'] === "50% OFF" ? "🎁" : "🏆")
    ]
]);
?>
