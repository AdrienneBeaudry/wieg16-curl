<?php

$ch = curl_init("https://www.milletech.se/invoicing/export/customers");
$fileName = "customers.html";
$fp = fopen($fileName, "w");

curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);
curl_close($ch);
fclose($fp);

/*$keywords = ['header', 'http', 'php'];

$content = file_get_contents($fileName);
$content = strip_tags($content);
$content = strtolower($content);

foreach ($keywords as $word) {
    $nr = substr_count($content, $word);
    echo "<p><strong>$word</strong> appears <strong>$nr</strong> times in the document</p>";
}*/
