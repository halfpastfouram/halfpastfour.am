<?php

header('Content-Type: application/json');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

echo json_encode([
    'ack'     => time(),
    'headers' => getallheaders(),
], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
