<?php

header('Content-Type: application/xml');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

$xml               = new DOMDocument();
$xml->formatOutput = true;
$xml->appendChild($root = $xml->createElement('root'));
$root->appendChild($xml->createElement('ack', time()));
$root->appendchild($headers = $xml->createElement('headers'));

foreach (getallheaders() as $header => $value) {
    $headers->appendChild($xml->createElement($header, $value));
}

echo $xml->saveXML();