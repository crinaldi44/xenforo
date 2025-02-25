<?php

// Get the message for the current week
$messageOfTheWeek = "Welcome to the OldSchool RuneScape beta!";

// Return the message as JSON
header('Content-Type: application/json');
echo json_encode([
    "message" => $messageOfTheWeek
]);

?>
