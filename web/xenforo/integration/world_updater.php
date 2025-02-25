<?php

// Define the key in a secure way, ideally from environment variables or a config file
// $secureKey = getenv('RSPS_KEY');
$secureKey = "VO2nMrpVKOaPPWjAyq24Un3a1LKLcvki";

if (!isset($_GET['k']) || $_GET['k'] !== $secureKey) {
http_response_code(403);
die('Forbidden');
}

$dataDir = 'data';
$filePath = $dataDir . '/worlds.ws';

if (!is_dir($dataDir)) {
if (!mkdir($dataDir, 0755, true)) {
error_log('Failed to create data directory');
die('0');
}
}

if (!is_writable($dataDir)) {
error_log('Data directory is not writable');
die('0');
}

// Write the raw POST data to the file
$n = file_put_contents($filePath, file_get_contents('php://input'));

if ($n === false) {
error_log('Failed to write data to file');
die('0');
}

die('1');

?>