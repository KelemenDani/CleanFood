<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $message = $data['message'];

    if (isset($_SESSION['user']['email'])) {
        $to = $_SESSION['user']['email'];
        $subject = 'Sikeres fizetés';
        $headers = 'From: no-reply@cleanfood.com' . "\r\n" .
                   'Reply-To: no-reply@cleanfood.com' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();

        if (mail($to, $subject, $message, $headers)) {
            echo json_encode(['success' => true]);
        } else {
            error_log('Mail function failed');
            echo json_encode(['success' => false, 'message' => 'Mail function failed']);
        }
    } else {
        error_log('User email not found in session');
        echo json_encode(['success' => false, 'message' => 'User email not found']);
    }
} else {
    error_log('Invalid request method');
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>