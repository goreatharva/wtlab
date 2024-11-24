<?php
session_start();
require 'db.php';

// Get the logged-in user ID from session
if (!isset($_SESSION['user_id'])) {
    echo "User not logged in. Please log in.";
    exit;
}

$userId = $_SESSION['user_id'];
$maxSessions = 3;
$sessionTimeout = 5 * 60; // 5 minutes in seconds

// Remove expired sessions
$stmt = $conn->prepare("DELETE FROM user_sessions WHERE UNIX_TIMESTAMP(last_activity) < ?");
$expiredTime = time() - $sessionTimeout;
$stmt->bind_param("i", $expiredTime);
$stmt->execute();
$stmt->close();

// Check active sessions for the user
$stmt = $conn->prepare("SELECT session_id FROM user_sessions WHERE user_id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$activeSessions = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// If the current session is not in the database, add it
$currentSessionId = session_id();
$sessionExists = false;

foreach ($activeSessions as $session) {
    if ($session['session_id'] === $currentSessionId) {
        $sessionExists = true;
        break;
    }
}

// Limit to 3 sessions
if (!$sessionExists && count($activeSessions) >= $maxSessions) {
    echo "Maximum concurrent sessions reached. Please log out from another session.";
    session_destroy();
    exit;
} elseif (!$sessionExists) {
    $stmt = $conn->prepare("INSERT INTO user_sessions (user_id, session_id) VALUES (?, ?)");
    $stmt->bind_param("is", $userId, $currentSessionId);
    $stmt->execute();
    $stmt->close();
}

// Update the last activity time
$stmt = $conn->prepare("UPDATE user_sessions SET last_activity = CURRENT_TIMESTAMP WHERE session_id = ?");
$stmt->bind_param("s", $currentSessionId);
$stmt->execute();
$stmt->close();
?>
